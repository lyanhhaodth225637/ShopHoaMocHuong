<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getMegaSectionSuggestions()
    {
        return Category::query()
            ->whereNotNull('mega_section_key')
            ->where('mega_section_key', '!=', '')
            ->select('mega_section_key', 'mega_section_label')
            ->orderBy('mega_section_label')
            ->orderBy('mega_section_key')
            ->get()
            ->unique('mega_section_key')
            ->values();
    }

    public function getList()
    {
        return Category::with('parent')
            ->whereNull('parent_id')
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function getChildList()
    {
        return Category::with('parent')
            ->whereNull('parent_id')
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function getParentCategories(?int $exceptId = null)
    {
        return Category::whereNull('parent_id')
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
                    ->orderBy('id', 'desc');
            }
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function getCategoryChildrenGrouped(string $slug): Category
    {
        $category = $this->getCategoryWithChildren($slug);

        $category->children_grouped = $category->children->groupBy(function ($child) {
            return $child->mega_section_key ?: 'khac';
        });

        return $category;
    }

    public function getCategoryChildrenGroupedByIdAndSlug(int $id, ?string $slug = null): Category
    {
        $category = Category::with([
            'children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('id', 'asc');
            }
        ])
            ->where('id', $id)
            ->when($slug, function ($query) use ($slug) {
                $query->where('slug', $slug);
            })

            ->firstOrFail();

        $category->children_grouped = $category->children->groupBy(function ($child) {
            return $child->mega_section_key ?: 'khac';
        });

        return $category;
    }


    public function create(array $data): Category
    {
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

        return $category;
    }

    public function update(Category $category, array $data): bool
    {
        $baseSlug = $this->makeBaseSlug($data['name']);

        $data['slug'] = $this->makeFinalSlug($baseSlug, $category->id);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? false;

        return $category->update($data);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    private function makeBaseSlug(string $name): string
    {
        return Str::slug($name);
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



    public function getMenuCategories()
    {
        return Category::with([
            'children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('id', 'asc');
            }
        ])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($category) {
                $category->mega_groups = $category->children->groupBy(function ($child) {
                    return $child->mega_section_key ?: 'khac';
                });

                return $category;
            });
    }
}
