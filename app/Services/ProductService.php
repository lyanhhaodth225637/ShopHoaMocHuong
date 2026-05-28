<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class ProductService
{
    public function getList()
    {
        return Product::with([
            'categories.parent',
            'images',
            'sku.inventory',
        ])
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function show(Product $product): Product
    {
        return $product->load([
            'categories.parent',
            'images',
            'sku.inventory',
        ]);
    }

    public function showByIdAndSlug(int $id, string $slug): Product
    {
        $product = Product::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->show($product);
    }

    public function store(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $categoryIds = $data['category_ids'] ?? [];
            $galleryImages = $data['images'] ?? [];
            $productData = $this->extractProductPayload($data);

            $this->ensureSkuAvailable($productData['sku_id']);

            $productData['slug'] = $this->makeUniqueSlug($productData['name']);

            if (! empty($productData['main_image'])) {
                $productData['main_image'] = $this->uploadCompressedImage(
                    $productData['main_image'],
                    'products/main'
                );
            }

            if (! empty($productData['og_image'])) {
                $productData['og_image'] = $this->uploadCompressedImage(
                    $productData['og_image'],
                    'products/og'
                );
            }

            $product = Product::create($productData);

            $product->categories()->sync($categoryIds);

            $this->uploadGalleryImages($product, $galleryImages);

            return $product->fresh([
                'categories.parent',
                'images',
                'sku.inventory',
            ]);
        });
    }

    public function update(Product $product, array $data): bool
    {
        return DB::transaction(function () use ($product, $data) {
            $categoryIds = $data['category_ids'] ?? [];
            $galleryImages = $data['images'] ?? [];
            $productData = $this->extractProductPayload($data);

            $this->ensureSkuAvailable($productData['sku_id'], $product->id);

            $productData['slug'] = $this->makeUniqueSlug($productData['name'], $product->id);

            if (! empty($productData['main_image'])) {
                $this->deleteImage($product->main_image);

                $productData['main_image'] = $this->uploadCompressedImage(
                    $productData['main_image'],
                    'products/main'
                );
            } else {
                unset($productData['main_image']);
            }

            if (! empty($productData['og_image'])) {
                $this->deleteImage($product->og_image);

                $productData['og_image'] = $this->uploadCompressedImage(
                    $productData['og_image'],
                    'products/og'
                );
            } else {
                unset($productData['og_image']);
            }

            $updated = $product->update($productData);

            $product->categories()->sync($categoryIds);

            $this->uploadGalleryImages($product, $galleryImages);

            return $updated;
        });
    }

    public function delete(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            $product->loadMissing('images');

            $this->deleteImage($product->main_image);
            $this->deleteImage($product->og_image);

            foreach ($product->images as $image) {
                $this->deleteImage($image->image);
                $image->delete();
            }

            return $product->delete();
        });
    }

    private function uploadGalleryImages(Product $product, array $images): void
    {
        foreach ($images as $index => $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $product->images()->create([
                'image' => $this->uploadCompressedImage(
                    $image,
                    'products/gallery'
                ),
                'sort_order' => $index,
            ]);
        }
    }

    private function extractProductPayload(array $data): array
    {
        return [
            'sku_id' => $data['sku_id'],
            'name' => $data['name'],
            'short_description' => $data['short_description'] ?? null,
            'description' => $data['description'] ?? null,
            'main_image' => $data['main_image'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'product_type' => $data['product_type'] ?? 'stock',
            'is_active' => $data['is_active'] ?? false,
            'is_featured' => $data['is_featured'] ?? false,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'canonical_url' => $data['canonical_url'] ?? null,
            'og_title' => $data['og_title'] ?? null,
            'og_description' => $data['og_description'] ?? null,
            'og_image' => $data['og_image'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }

    private function ensureSkuAvailable(int $skuId, ?int $ignoreProductId = null): void
    {
        $exists = Product::query()
            ->where('sku_id', $skuId)
            ->when($ignoreProductId, function ($query) use ($ignoreProductId) {
                $query->where('id', '!=', $ignoreProductId);
            })
            ->exists();

        if ($exists) {
            throw new \RuntimeException('SKU này đã được gán cho sản phẩm khác.');
        }
    }

    private function uploadCompressedImage(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1200,
        int $quality = 80
    ): string {
        $fileName = Str::uuid() . '.webp';
        $path = $folder . '/' . $fileName;

        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decodePath($file->getRealPath());

        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        Storage::disk('public')->put($path, $encoded->toString());

        return $path;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $count = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getParentCategoriesForTabs()
    {
        return Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getProductsByParentCategories($parentCategories): array
    {
        $productsByCategory = [];

        foreach ($parentCategories as $parentCategory) {
            $categoryIds = $parentCategory->children
                ->pluck('id')
                ->push($parentCategory->id)
                ->unique()
                ->values()
                ->toArray();

            $productsByCategory[$parentCategory->id] = Product::with(['images', 'categories', 'sku.inventory'])
                ->where('is_active', true)
                ->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                })
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();
        }

        return $productsByCategory;
    }
}
