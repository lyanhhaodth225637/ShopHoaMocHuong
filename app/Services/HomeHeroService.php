<?php

namespace App\Services;

use App\Models\HomeHeroSetting;
use App\Models\HomeHeroSlide;
use App\Models\HomeHeroStat;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HomeHeroService
{
    public function getData(): array
    {
        return [
            'hero' => HomeHeroSetting::first(),
            'slides' => HomeHeroSlide::orderBy('sort_order')
                ->orderBy('id')
                ->get(),
            'stats' => HomeHeroStat::orderBy('sort_order')
                ->orderBy('id')
                ->get(),
        ];
    }

    public function getFrontendData(): array
    {
        return [
            'hero' => HomeHeroSetting::where('is_active', true)->first(),
            'heroSlides' => HomeHeroSlide::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
            'heroStats' => HomeHeroStat::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
        ];
    }

    public function updateHero(array $data): HomeHeroSetting
    {
        $hero = HomeHeroSetting::firstOrNew(['id' => 1]);

        if (isset($data['circle_image']) && $data['circle_image'] instanceof UploadedFile) {
            $this->deleteFile($hero->circle_image);

            $data['circle_image'] = $this->uploadFile(
                file: $data['circle_image'],
                path: 'home/hero'
            );
        } else {
            unset($data['circle_image']);
        }

        $hero->fill($data);
        $hero->save();

        return $hero;
    }

    public function createSlide(array $data): HomeHeroSlide
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadFile(
                file: $data['image'],
                path: 'home/hero/slides'
            );
        }

        if (isset($data['mobile_image']) && $data['mobile_image'] instanceof UploadedFile) {
            $data['mobile_image'] = $this->uploadFile(
                file: $data['mobile_image'],
                path: 'home/hero/slides/mobile'
            );
        } else {
            unset($data['mobile_image']);
        }

        return HomeHeroSlide::create($data);
    }

    public function updateSlide(HomeHeroSlide $slide, array $data): bool
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $this->deleteFile($slide->image);

            $data['image'] = $this->uploadFile(
                file: $data['image'],
                path: 'home/hero/slides'
            );
        } else {
            unset($data['image']);
        }

        if (isset($data['mobile_image']) && $data['mobile_image'] instanceof UploadedFile) {
            $this->deleteFile($slide->mobile_image);

            $data['mobile_image'] = $this->uploadFile(
                file: $data['mobile_image'],
                path: 'home/hero/slides/mobile'
            );
        } else {
            unset($data['mobile_image']);
        }

        return $slide->update($data);
    }

    public function deleteSlide(HomeHeroSlide $slide): bool
    {
        $this->deleteFile($slide->image);
        $this->deleteFile($slide->mobile_image);

        return $slide->delete();
    }

    public function createStat(array $data): HomeHeroStat
    {
        return HomeHeroStat::create($data);
    }

    public function updateStat(HomeHeroStat $stat, array $data): bool
    {
        return $stat->update($data);
    }

    public function deleteStat(HomeHeroStat $stat): bool
    {
        return $stat->delete();
    }

    private function uploadFile(UploadedFile $file, string $path): string
    {
        return $file->store($path, 'public');
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
    
}
