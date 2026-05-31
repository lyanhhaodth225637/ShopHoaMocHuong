<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\Settings\HomeHeroService;
use App\Models\Category;
use App\Models\Post;
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

    $featureBoxes = $heroData['featureBoxes'] ?? collect();
    $occasionCategories = $heroData['occasionCategories'] ?? collect();
    $promoBanners = $heroData['promoBanners'] ?? collect();
    $featuredPosts = Post::query()
        ->with(['category', 'user', 'activeImages'])
        ->where('is_active', true)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('is_featured', true)
        ->latest('published_at')
        ->limit(3)
        ->get();

    // if ($featuredPosts->count() < 3) {
    //     $featuredPosts = Post::query()
    //         ->with(['category', 'user', 'activeImages'])
    //         ->where('is_active', true)
    //         ->where('status', 'published')
    //         ->whereNotNull('published_at')
    //         ->where('published_at', '<=', now())
    //         ->when($featuredPosts->isNotEmpty(), function ($query) use ($featuredPosts) {
    //             $query->whereNotIn('id', $featuredPosts->pluck('id'));
    //         })
    //         ->latest('published_at')
    //         ->limit(3 - $featuredPosts->count())
    //         ->get()
    //         ->pipe(fn($posts) => $featuredPosts->concat($posts));
    // }

    return view('frontend.home', compact(
        'parentCategories',
        'productsByCategory',
        'heroData',
        'hero',
        'heroSlides',
        'heroStats',
        'featureBoxes',
        'occasionCategories',
        'promoBanners',
        'featuredPosts'
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
            ->with(['images', 'categories', 'sku.inventory'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('frontend.category.show', compact('category', 'products'));
    }
}
