<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function index()
    {
        $parentCategories = $this->productService->getParentCategoriesForTabs();

        $productsByCategory = $this->productService->getProductsByParentCategories($parentCategories);

        return view('frontend.home', compact(
            'parentCategories',
            'productsByCategory'
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
