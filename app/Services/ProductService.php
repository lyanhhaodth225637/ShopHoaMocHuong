<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use App\Models\Category;

class ProductService
{
    public function getList()
    {
        return Product::with([
            'categories.parent',
            'images',
        ])
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function show(Product $product): Product
    {
        return $product->load([
            'categories.parent',
            'images',
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

            unset($data['category_ids'], $data['images']);

            $data['slug'] = $this->makeUniqueSlug($data['name']);
            $data['sku'] = null;

            $data['price'] = $data['price'] ?? 0;
            $data['stock_quantity'] = $data['stock_quantity'] ?? 0;
            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['is_active'] = $data['is_active'] ?? false;
            $data['is_featured'] = $data['is_featured'] ?? false;

            if (!empty($data['main_image'])) {
                $data['main_image'] = $this->uploadCompressedImage(
                    $data['main_image'],
                    'products/main'
                );
            }

            if (!empty($data['og_image'])) {
                $data['og_image'] = $this->uploadCompressedImage(
                    $data['og_image'],
                    'products/og'
                );
            }

            $product = Product::create($data);

            $product->update([
                'sku' => $this->makeSku($product->id),
            ]);

            $product->categories()->sync($categoryIds);

            $this->uploadGalleryImages($product, $galleryImages);

            return $product;
        });
    }

    public function update(Product $product, array $data): bool
    {
        return DB::transaction(function () use ($product, $data) {
            $categoryIds = $data['category_ids'] ?? [];
            $galleryImages = $data['images'] ?? [];

            unset($data['category_ids'], $data['images']);

            $data['slug'] = $this->makeUniqueSlug($data['name'], $product->id);

            $data['price'] = $data['price'] ?? 0;
            $data['stock_quantity'] = $data['stock_quantity'] ?? 0;
            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['is_active'] = $data['is_active'] ?? false;
            $data['is_featured'] = $data['is_featured'] ?? false;

            if (!empty($data['main_image'])) {
                $this->deleteImage($product->main_image);

                $data['main_image'] = $this->uploadCompressedImage(
                    $data['main_image'],
                    'products/main'
                );
            } else {
                unset($data['main_image']);
            }

            if (!empty($data['og_image'])) {
                $this->deleteImage($product->og_image);

                $data['og_image'] = $this->uploadCompressedImage(
                    $data['og_image'],
                    'products/og'
                );
            } else {
                unset($data['og_image']);
            }

            $updated = $product->update($data);

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
            if (!$image instanceof UploadedFile) {
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

    private function makeSku(int $id): string
    {
        return 'HMH' . str_pad($id, 6, '0', STR_PAD_LEFT);
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


    //frontend
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

            $productsByCategory[$parentCategory->id] = Product::with(['images', 'categories'])
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
