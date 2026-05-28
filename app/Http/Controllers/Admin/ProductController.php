<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getList();
        $categories = Category::with('parent')
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        $allSkus = $this->getSelectableSkus();
        $availableSkus = $allSkus->filter(fn ($sku) => $sku->products->isEmpty())->values();

        return view('admin.product.index', compact('products', 'categories', 'availableSkus', 'allSkus'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->store($request->validated());

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Thêm sản phẩm thành công.');
    }

    public function show(int $id, string $slug)
    {
        $product = $this->productService->showByIdAndSlug($id, $slug);
        $categories = Category::with('parent')
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        $allSkus = $this->getSelectableSkus();
        $availableSkus = $allSkus->filter(fn ($sku) => $sku->products->isEmpty())->values();

        return view('admin.product.show', compact('product', 'categories', 'availableSkus', 'allSkus'));
    }

    public function update(UpdateProductRequest $request, int $id, string $slug)
    {
        $product = Product::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        $this->productService->update($product, $request->validated());

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        $this->productService->delete($product);

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Xóa sản phẩm thành công.');
    }

    public function khachHang()
    {
        return view('admin.customer.index');
    }

    private function getSelectableSkus()
    {
        return Sku::query()
            ->with(['inventory', 'products:id,sku_id'])
            ->where('is_active', true)
            ->orderBy('name')
            ->orderBy('sku')
            ->get();
    }
}
