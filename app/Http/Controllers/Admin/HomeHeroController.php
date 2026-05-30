<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// Hero requests
use App\Http\Requests\Admin\HomeHero\StoreHomeHeroSlideRequest;
use App\Http\Requests\Admin\HomeHero\StoreHomeHeroStatRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroSlideRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroStatRequest;

// Feature Box requests
use App\Http\Requests\Admin\HomeFeatureBox\StoreHomeFeatureBoxRequest;
use App\Http\Requests\Admin\HomeFeatureBox\UpdateHomeFeatureBoxRequest;

// Occasion Category requests
use App\Http\Requests\Admin\HomeOccasionCategory\StoreHomeOccasionCategoryRequest;
use App\Http\Requests\Admin\HomeOccasionCategory\UpdateHomeOccasionCategoryRequest;

// Promo Banner requests
use App\Http\Requests\Admin\HomePromoBanner\StoreHomePromoBannerRequest;
use App\Http\Requests\Admin\HomePromoBanner\UpdateHomePromoBannerRequest;

// Models
use App\Models\HomeFeatureBox;
use App\Models\HomeHeroSlide;
use App\Models\HomeHeroStat;
use App\Models\HomeOccasionCategory;
use App\Models\HomePromoBanner;

// Services
use App\Services\Settings\HomeFeatureBoxService;
use App\Services\Settings\HomeHeroService;
use App\Services\Settings\HomeOccasionCategoryService;
use App\Services\Settings\HomePromoBannerService;

class HomeHeroController extends Controller
{
    public function __construct(
        protected HomeHeroService $homeHeroService,
        protected HomeFeatureBoxService $homeFeatureBoxService,
        protected HomeOccasionCategoryService $homeOccasionCategoryService,
        protected HomePromoBannerService $homePromoBannerService,
    ) {
    }

    public function index()
    {
        $data = $this->homeHeroService->getData();

        return view('admin.setting.index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Hero Setting
    |--------------------------------------------------------------------------
    */

    public function updateHero(UpdateHomeHeroRequest $request)
    {
        $this->homeHeroService->updateHero($request->validated());

        return back()->with('success', 'Cập nhật Hero trang chủ thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | Hero Slides
    |--------------------------------------------------------------------------
    */

    public function storeSlide(StoreHomeHeroSlideRequest $request)
    {
        $this->homeHeroService->createSlide($request->validated());

        return back()->with('success', 'Thêm ảnh nền thành công.');
    }

    public function updateSlide(UpdateHomeHeroSlideRequest $request, HomeHeroSlide $slide)
    {
        $this->homeHeroService->updateSlide($slide, $request->validated());

        return back()->with('success', 'Cập nhật ảnh nền thành công.');
    }

    public function destroySlide(HomeHeroSlide $slide)
    {
        $this->homeHeroService->deleteSlide($slide);

        return back()->with('success', 'Xóa ảnh nền thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | Hero Stats
    |--------------------------------------------------------------------------
    */

    public function storeStat(StoreHomeHeroStatRequest $request)
    {
        $this->homeHeroService->createStat($request->validated());

        return back()->with('success', 'Thêm thống kê thành công.');
    }

    public function updateStat(UpdateHomeHeroStatRequest $request, HomeHeroStat $stat)
    {
        $this->homeHeroService->updateStat($stat, $request->validated());

        return back()->with('success', 'Cập nhật thống kê thành công.');
    }

    public function destroyStat(HomeHeroStat $stat)
    {
        $this->homeHeroService->deleteStat($stat);

        return back()->with('success', 'Xóa thống kê thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | Home Feature Boxes
    |--------------------------------------------------------------------------
    */

    public function storeFeatureBox(StoreHomeFeatureBoxRequest $request)
    {
        $this->homeFeatureBoxService->store($request->validated());

        return back()->with('success', 'Thêm feature box thành công.');
    }

    public function updateFeatureBox(UpdateHomeFeatureBoxRequest $request, HomeFeatureBox $homeFeatureBox)
    {
        $this->homeFeatureBoxService->update($homeFeatureBox, $request->validated());

        return back()->with('success', 'Cập nhật feature box thành công.');
    }

    public function destroyFeatureBox(HomeFeatureBox $homeFeatureBox)
    {
        $this->homeFeatureBoxService->delete($homeFeatureBox);

        return back()->with('success', 'Xóa feature box thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | Home Occasion Categories
    |--------------------------------------------------------------------------
    */

    public function storeOccasionCategory(StoreHomeOccasionCategoryRequest $request)
    {
        $this->homeOccasionCategoryService->store($request->validated());

        return back()->with('success', 'Thêm danh mục theo dịp thành công.');
    }

    public function updateOccasionCategory(
        UpdateHomeOccasionCategoryRequest $request,
        HomeOccasionCategory $homeOccasionCategory
    ) {
        $this->homeOccasionCategoryService->update($homeOccasionCategory, $request->validated());

        return back()->with('success', 'Cập nhật danh mục theo dịp thành công.');
    }

    public function destroyOccasionCategory(HomeOccasionCategory $homeOccasionCategory)
    {
        $this->homeOccasionCategoryService->delete($homeOccasionCategory);

        return back()->with('success', 'Xóa danh mục theo dịp thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | Home Promo Banners
    |--------------------------------------------------------------------------
    */

    public function storePromoBanner(StoreHomePromoBannerRequest $request)
    {
        $this->homePromoBannerService->store($request->validated());

        return back()->with('success', 'Thêm banner khuyến mãi thành công.');
    }

    public function updatePromoBanner(UpdateHomePromoBannerRequest $request, HomePromoBanner $homePromoBanner)
    {
        $this->homePromoBannerService->update($homePromoBanner, $request->validated());

        return back()->with('success', 'Cập nhật banner khuyến mãi thành công.');
    }

    public function destroyPromoBanner(HomePromoBanner $homePromoBanner)
    {
        $this->homePromoBannerService->delete($homePromoBanner);

        return back()->with('success', 'Xóa banner khuyến mãi thành công.');
    }
}