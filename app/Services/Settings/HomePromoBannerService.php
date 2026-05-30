<?php

namespace App\Services\Settings;

use App\Models\HomePromoBanner;
use Illuminate\Support\Facades\Storage;

class HomePromoBannerService
{
    public function getList()
    {
        return HomePromoBanner::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();
    }

    public function store(array $data): HomePromoBanner
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('home/promo-banners', 'public');
        }

        return HomePromoBanner::create($data);
    }

    public function update(HomePromoBanner $homePromoBanner, array $data): bool
    {
        $data['is_active'] = $data['is_active'] ?? false;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if (isset($data['image'])) {
            if ($homePromoBanner->image && Storage::disk('public')->exists($homePromoBanner->image)) {
                Storage::disk('public')->delete($homePromoBanner->image);
            }

            $data['image'] = $data['image']->store('home/promo-banners', 'public');
        }

        return $homePromoBanner->update($data);
    }

    public function delete(HomePromoBanner $homePromoBanner): bool
    {
        if ($homePromoBanner->image && Storage::disk('public')->exists($homePromoBanner->image)) {
            Storage::disk('public')->delete($homePromoBanner->image);
        }

        return $homePromoBanner->delete();
    }
}