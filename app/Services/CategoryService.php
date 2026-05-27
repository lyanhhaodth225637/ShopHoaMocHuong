<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CategoryService
{
    public function getMegaSectionSuggestions()
    {
        return Category::query()
            ->whereNotNull('mega_section_key')
            ->where('mega_section_key', '!=', '')
            ->select('mega_section_key', 'mega_section_label')
            ->orderBy('mega_section_label', 'asc')
            ->orderBy('mega_section_key', 'asc')
            ->get()
            ->unique('mega_section_key')
            ->values();
    }

    public function getList()
    {
        return Category::with('parent')
            ->whereNull('parent_id')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function getChildList()
    {
        return Category::with('parent')
            ->whereNotNull('parent_id')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function getParentCategories(?int $exceptId = null)
    {
        return Category::query()
            ->whereNull('parent_id')
            ->when($exceptId, function ($query) use ($exceptId) {
                $query->where('id', '!=', $exceptId);
            })
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getCategoryWithChildren(string $slug): Category
    {
        return Category::with([
            'children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('id', 'asc');
            },
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function getCategoryChildrenGrouped(string $slug): Category
    {
        $category = $this->getCategoryWithChildren($slug);

        $category->children_grouped = $this->groupChildrenForMegaMenu($category);

        return $category;
    }

    public function getCategoryChildrenGroupedByIdAndSlug(int $id, ?string $slug = null): Category
    {
        $category = Category::with([
            'children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('id', 'asc');
            },
        ])
            ->where('id', $id)
            ->when($slug, function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->firstOrFail();

        $category->children_grouped = $this->groupChildrenForMegaMenu($category);

        return $category;
    }

    public function getMenuCategories()
    {
        return Category::with([
            'children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('id', 'asc');
            },
        ])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function (Category $category) {
                $category->mega_groups = $this->groupChildrenForMegaMenu($category);

                return $category;
            });
    }

    public function create(array $data): Category
    {
        $data = $this->normalizeCategoryData($data);

        $baseSlug = $this->makeBaseSlug($data['name']);

        $data['slug'] = $this->makeTemporarySlug($baseSlug);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? false;

        $category = Category::create($data);

        $finalSlug = $this->makeFinalSlug($baseSlug, $category->id);

        if ($category->slug !== $finalSlug) {
            $category->update([
                'slug' => $finalSlug,
            ]);
        }

        /*
         * Nếu tạo danh mục cha có mega_section_key/label,
         * tự cập nhật xuống các danh mục con đang trống nhóm.
         */
        if ($category->parent_id === null) {
            $this->syncMegaSectionToChildren($category, $data, null);
        }

        return $category;
    }

    public function update(Category $category, array $data): bool
    {
        $oldMegaKey = $category->mega_section_key;

        $data = $this->normalizeCategoryData($data);

        $baseSlug = $this->makeBaseSlug($data['name']);

        $data['slug'] = $this->makeFinalSlug($baseSlug, $category->id);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? false;

        $updated = $category->update($data);

        /*
         * Chỉ sync xuống con khi đang sửa danh mục cha.
         *
         * Điều kiện sync:
         * - child chưa có mega_section_key
         * - hoặc child đang dùng mega_section_key cũ của cha
         *
         * Không đè child đã có nhóm riêng.
         */
        if ($updated && $category->parent_id === null) {
            $this->syncMegaSectionToChildren($category, $data, $oldMegaKey);
        }

        return $updated;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    private function groupChildrenForMegaMenu(Category $category)
    {
        return $category->children
            ->groupBy(function ($child) {
                return $child->mega_section_resolved_key ?: 'khac';
            })
            ->sortKeys();
    }

    private function normalizeCategoryData(array $data): array
    {
        /*
         * Chống lỗi form cũ còn gửi mega_section.
         * Nếu form cũ có mega_section mà form mới chưa có mega_section_key,
         * tự map qua mega_section_key.
         */
        if (empty($data['mega_section_key']) && !empty($data['mega_section'])) {
            $data['mega_section_key'] = $data['mega_section'];
        }

        $data['mega_section_key'] = $this->normalizeMegaSectionKey($data['mega_section_key'] ?? null);
        $data['mega_section_label'] = $this->normalizeMegaSectionLabel($data['mega_section_label'] ?? null);

        /*
         * Nếu có label mà không có key, tự tạo key từ label.
         */
        if (blank($data['mega_section_key']) && filled($data['mega_section_label'])) {
            $data['mega_section_key'] = Str::slug($data['mega_section_label'], '_');
        }

        /*
         * Nếu có key mà không có label, tự tạo label từ key.
         */
        if (filled($data['mega_section_key']) && blank($data['mega_section_label'])) {
            $data['mega_section_label'] = (string) Str::of($data['mega_section_key'])
                ->replace(['_', '-'], ' ')
                ->title();
        }

        return Arr::except($data, ['mega_section']);
    }

    private function normalizeMegaSectionKey(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        return Str::slug(trim($value), '_');
    }

    private function normalizeMegaSectionLabel(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        return trim($value);
    }

    private function syncMegaSectionToChildren(
        Category $category,
        array $data,
        ?string $oldMegaKey
    ): void {
        $newMegaKey = $data['mega_section_key'] ?? null;
        $newMegaLabel = $data['mega_section_label'] ?? null;

        if (blank($newMegaKey) && blank($newMegaLabel)) {
            return;
        }

        Category::query()
            ->where('parent_id', $category->id)
            ->where(function ($query) use ($oldMegaKey) {
                $query
                    ->whereNull('mega_section_key')
                    ->orWhere('mega_section_key', '');

                if (filled($oldMegaKey)) {
                    $query->orWhere('mega_section_key', $oldMegaKey);
                }
            })
            ->update([
                'mega_section_key' => $newMegaKey,
                'mega_section_label' => $newMegaLabel,
            ]);
    }

    private function makeBaseSlug(string $name): string
    {
        $slug = Str::slug($name);

        return $slug !== '' ? $slug : 'category';
    }

    private function makeTemporarySlug(string $baseSlug): string
    {
        $exists = Category::where('slug', $baseSlug)->exists();

        if (!$exists) {
            return $baseSlug;
        }

        return $baseSlug . '-' . Str::random(8);
    }

    private function makeFinalSlug(string $baseSlug, ?int $id = null): string
    {
        $query = Category::where('slug', $baseSlug);

        if ($id !== null) {
            $query->where('id', '!=', $id);
        }

        $exists = $query->exists();

        if (!$exists) {
            return $baseSlug;
        }

        return $id
            ? $baseSlug . '-' . $id
            : $baseSlug . '-' . time();
    }
}