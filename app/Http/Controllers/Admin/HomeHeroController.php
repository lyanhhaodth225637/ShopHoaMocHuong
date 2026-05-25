<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeHero\StoreHomeHeroSlideRequest;
use App\Http\Requests\Admin\HomeHero\StoreHomeHeroStatRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroSlideRequest;
use App\Http\Requests\Admin\HomeHero\UpdateHomeHeroStatRequest;
use App\Models\HomeHeroSlide;
use App\Models\HomeHeroStat;
use App\Services\HomeHeroService;

class HomeHeroController extends Controller
{
    public function __construct(
        protected HomeHeroService $homeHeroService
    ) {
    }

    public function index()
    {
        $data = $this->homeHeroService->getData();

        return view('admin.setting.index', $data);
    }

    public function updateHero(UpdateHomeHeroRequest $request)
    {
        $this->homeHeroService->updateHero($request->validated());

        return back()->with('success', 'Cập nhật Hero trang chủ thành công.');
    }

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
}
