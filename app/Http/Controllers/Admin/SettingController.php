<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Settings\HomeHeroService;

class SettingController extends Controller
{
    public function __construct(
        protected HomeHeroService $homeHeroService
    ) {
    }

    public function index()
    {
        return view('admin.setting.index', $this->homeHeroService->getData());
    }
}
