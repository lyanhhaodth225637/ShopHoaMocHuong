<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class PostService
{
    public function getCategoryList()
    {
        return PostCategory::orderBy('name', 'asc')->get();
    }

    public function getPostList()
    {
        return Post::with([
            'category',
            'images',
            'user',
        ])->orderByDesc('id')->paginate(10);
    }

    public function storeCategory(array $data)
    {
        return PostCategory::create([
            'name' => $data['name'],
            'slug' => $this->makeUniqueCategorySlug($data['name']),
            'description' => $data['description'] ?? null,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => isset($data['is_active']),
        ]);
    }

    public function updateCategory(PostCategory $postCategory, array $data): bool
    {
        return $postCategory->update([
            'name' => $data['name'],
            'slug' => $this->makeUniqueCategorySlug($data['name'], $postCategory->id),
            'description' => $data['description'] ?? null,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : false,
        ]);
    }

    public function destroyCategory(PostCategory $postCategory): array
    {
        if ($postCategory->posts()->exists()) {
            return [
                'success' => false,
                'message' => 'Khong the xoa chu de vi van con bai viet thuoc danh muc nay.',
            ];
        }

        $postCategory->delete();

        return [
            'success' => true,
            'message' => 'Xoa chu de thanh cong.',
        ];
    }

    public function storePost(array $data): Post
    {
        return DB::transaction(function () use ($data) {
            $galleryImages = $data['images'] ?? [];
            $postData = $this->extractPostPayload($data);

            $postData['slug'] = $this->makeUniquePostSlug($postData['title']);
            $postData['user_id'] = auth()->id();

            if (! empty($postData['thumbnail'])) {
                $postData['thumbnail'] = $this->uploadCompressedImage(
                    $postData['thumbnail'],
                    'posts/thumbnail'
                );
            }

            $post = Post::create($postData);

            $this->uploadGalleryImages($post, $galleryImages);

            return $post->fresh(['category', 'images', 'user']);
        });
    }

    public function updatePost(Post $post, array $data): bool
    {
        return DB::transaction(function () use ($post, $data) {
            $galleryImages = $data['images'] ?? [];
            $removeImageIds = $data['remove_image_ids'] ?? [];
            $postData = $this->extractPostPayload($data, $post);

            $postData['slug'] = $this->makeUniquePostSlug($postData['title'], $post->id);

            if (! empty($postData['thumbnail'])) {
                $this->deleteImage($post->thumbnail);

                $postData['thumbnail'] = $this->uploadCompressedImage(
                    $postData['thumbnail'],
                    'posts/thumbnail'
                );
            } else {
                unset($postData['thumbnail']);
            }

            $updated = $post->update($postData);

            $this->removeGalleryImages($post, $removeImageIds);
            $maxSortOrder = $post->images()->max('sort_order');
            $startSortOrder = $maxSortOrder !== null ? ((int) $maxSortOrder + 1) : 0;

            $this->uploadGalleryImages($post, $galleryImages, $startSortOrder);

            return $updated;
        });
    }

    public function deletePost(Post $post): bool
    {
        return DB::transaction(function () use ($post) {
            $post->loadMissing('images');

            $this->deleteImage($post->thumbnail);

            foreach ($post->images as $image) {
                $this->deleteImage($image->image);
                $image->delete();
            }

            return $post->delete();
        });
    }

    public function toggleStatus(Model $model): bool
    {
        return $model->update([
            'is_active' => !$model->is_active,
        ]);
    }

    private function extractPostPayload(array $data, ?Post $post = null): array
    {
        $status = $data['status'] ?? 'draft';
        $publishedAt = $data['published_at'] ?? null;

        if ($status === 'published' && empty($publishedAt)) {
            $publishedAt = $post?->published_at ?? now();
        }

        if ($status !== 'published' && empty($data['published_at'])) {
            $publishedAt = null;
        }

        return [
            'post_category_id' => $data['post_category_id'] ?? null,
            'title' => $data['title'],
            'thumbnail' => $data['thumbnail'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'] ?? null,
            'type' => $data['type'] ?? 'news',
            'status' => $status,
            'is_featured' => $data['is_featured'] ?? false,
            'is_active' => $data['is_active'] ?? false,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'published_at' => $publishedAt,
        ];
    }

    private function uploadGalleryImages(Post $post, array $images, int $startSortOrder = 0): void
    {
        $sortOrder = $startSortOrder;

        foreach ($images as $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $post->images()->create([
                'image' => $this->uploadCompressedImage($image, 'posts/gallery'),
                'alt' => $post->title,
                'caption' => null,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);

            $sortOrder++;
        }
    }

    private function removeGalleryImages(Post $post, array $removeImageIds): void
    {
        if (empty($removeImageIds)) {
            return;
        }

        $images = $post->images()
            ->whereIn('id', $removeImageIds)
            ->get();

        foreach ($images as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }
    }

    private function uploadCompressedImage(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1600,
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

    private function makeUniqueCategorySlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $count = 1;

        while (
            PostCategory::where('slug', $slug)
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

    private function makeUniquePostSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $count = 1;

        while (
            Post::where('slug', $slug)
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
}
