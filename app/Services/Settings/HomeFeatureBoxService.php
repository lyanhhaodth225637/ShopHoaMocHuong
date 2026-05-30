<?php

namespace App\Services\Settings;

use App\Models\HomeFeatureBox;

class HomeFeatureBoxService
{
    public function getList()
    {
        return HomeFeatureBox::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();
    }

    public function store(array $data): HomeFeatureBox
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['is_external'] = $data['is_external'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return HomeFeatureBox::create($data);
    }

    public function update(HomeFeatureBox $homeFeatureBox, array $data): bool
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['is_external'] = $data['is_external'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $homeFeatureBox->update($data);
    }

    public function delete(HomeFeatureBox $homeFeatureBox): bool
    {
        return $homeFeatureBox->delete();
    }
}