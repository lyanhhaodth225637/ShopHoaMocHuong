<?php

namespace App\Services\Settings;

use App\Models\HomeOccasionCategory;

class HomeOccasionCategoryService
{
    public function getList()
    {
        return HomeOccasionCategory::with('category')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();
    }

    public function store(array $data): HomeOccasionCategory
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return HomeOccasionCategory::create($data);
    }

    public function update(HomeOccasionCategory $homeOccasionCategory, array $data): bool
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $homeOccasionCategory->update($data);
    }

    public function delete(HomeOccasionCategory $homeOccasionCategory): bool
    {
        return $homeOccasionCategory->delete();
    }
}