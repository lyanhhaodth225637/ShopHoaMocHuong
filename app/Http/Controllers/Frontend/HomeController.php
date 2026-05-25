<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\HomeHeroService;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected HomeHeroService $homeHeroService
    ) {
    }


    public function index()
    {
        $parentCategories = $this->productService->getParentCategoriesForTabs();

        $productsByCategory = $this->productService->getProductsByParentCategories($parentCategories);
        $heroData = $this->homeHeroService->getFrontendData();
        $hero = $heroData['hero'] ?? null;
        $heroSlides = $heroData['heroSlides'] ?? collect();
        $heroStats = $heroData['heroStats'] ?? collect();

        return view('frontend.home', compact(
            'parentCategories',
            'productsByCategory',
            'heroData',
            'hero',
            'heroSlides',
            'heroStats'
        ));

    }
    public function show($id, $slug)
    {
        // dd('vào đây');
        $category = Category::where('id', $id)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('frontend.category.show', compact('category', 'products'));
    }
}
