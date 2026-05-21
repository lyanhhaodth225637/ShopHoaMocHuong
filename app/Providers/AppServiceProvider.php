<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CategoryService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer([
            'layouts.frontend.header-nav',
            'layouts.frontend.nav-mobile',
        ], function ($view) {
            $categoryService = app(CategoryService::class);
            $view->with('menuCategories', $categoryService->getMenuCategories());
        });
    }
}
