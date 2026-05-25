<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FontAwesomeIconService
{
    public function all(): Collection
    {
        return Cache::rememberForever('font_awesome_icons', function () {
            $cssPath = public_path('font-awesome/css/all.min.css');

            if (!file_exists($cssPath)) {
                return collect();
            }

            $css = file_get_contents($cssPath);

            preg_match_all('/\.fa-([a-z0-9-]+):before/i', $css, $matches);

            return collect($matches[1] ?? [])
                ->unique()
                ->sort()
                ->values()
                ->map(fn($icon) => 'fa-' . $icon);
        });
    }

    public function clearCache(): void
    {
        Cache::forget('font_awesome_icons');
    }
}