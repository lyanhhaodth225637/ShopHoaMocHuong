<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $products = Product::with(['categories.parent', 'images'])
            ->where('is_active', true)
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = $request->keyword;

                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('short_description', 'like', '%' . $keyword . '%')
                        ->orWhereHas('sku', function ($skuQuery) use ($keyword) {
                            $skuQuery->where('sku', 'like', '%' . $keyword . '%');
                        });
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $category = Category::with('children')
                    ->find($request->category_id);

                if ($category) {
                    $categoryIds = $category->children
                        ->pluck('id')
                        ->push($category->id)
                        ->unique()
                        ->values()
                        ->toArray();

                    $query->whereHas('categories', function ($q) use ($categoryIds) {
                        $q->whereIn('categories.id', $categoryIds);
                    });
                }
            })
            ->when($request->filled('min_price'), function ($query) use ($request) {
                $query->whereHas('sku', function ($skuQuery) use ($request) {
                    $skuQuery
                        ->where('is_active', true)
                        ->where('default_sale_price', '>=', $request->min_price);
                });
            })
            ->when($request->filled('max_price'), function ($query) use ($request) {
                $query->whereHas('sku', function ($skuQuery) use ($request) {
                    $skuQuery
                        ->where('is_active', true)
                        ->where('default_sale_price', '<=', $request->max_price);
                });
            })
            ->when($request->filled('featured'), function ($query) use ($request) {
                if ($request->featured == 1) {
                    $query->where('is_featured', true);
                }
            })
            ->when($request->filled('stock_status'), function ($query) use ($request) {
                if ($request->stock_status === 'in_stock') {
                    $query->whereHas('sku.inventory', function ($inventoryQuery) {
                        $inventoryQuery->where('quantity', '>', 0);
                    });
                }

                if ($request->stock_status === 'out_of_stock') {
                    $query->whereDoesntHave('sku.inventory', function ($inventoryQuery) {
                        $inventoryQuery->where('quantity', '>', 0);
                    });
                }
            });

        match ($request->sort) {
            'price_asc' => $products->join('skus', 'skus.id', '=', 'products.sku_id')
                ->orderBy('skus.default_sale_price', 'asc')
                ->select('products.*'),
            'price_desc' => $products->join('skus', 'skus.id', '=', 'products.sku_id')
                ->orderBy('skus.default_sale_price', 'desc')
                ->select('products.*'),
            'name_asc' => $products->orderBy('name', 'asc'),
            'newest' => $products->orderBy('id', 'desc'),
            'random' => $products->inRandomOrder(),
            default => $products->inRandomOrder(),
        };

        $products = $products
            ->paginate(12)
            ->withQueryString();

        return view('frontend.product.index', compact('products', 'categories'));
    }

    public function show($id, $slug)
    {
        $product = Product::query()
            ->with(['categories', 'images', 'sku.inventory'])
            ->where('id', $id)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->with(['categories', 'images', 'sku.inventory'])
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->whereHas('categories', function ($query) use ($product) {
                $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }
}
