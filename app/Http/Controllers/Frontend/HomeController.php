<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

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
}
