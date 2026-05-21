<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    public function index()
    {
        $categories = $this->categoryService->getList();
        $parentCategories = $this->categoryService->getParentCategories();
        return view('admin.category.index', compact('categories', 'parentCategories'));
    }

    public function create()
    {
        $parentCategories = $this->categoryService->getParentCategories();

        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Thêm danh mục thành công.');
    }

    public function edit(Category $category)
    {
        $parentCategories = $this->categoryService->getParentCategories($category->id);

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(UpdateCategoryRequest $request, int $id, string $slug)
    {
        $category = Category::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        $this->categoryService->update($category, $request->validated());

        return back()->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);

        $this->categoryService->delete($category);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Xóa danh mục thành công.');
    }

    public function show(int $id, string $slug)
    {
        // dd('vào đây');
        $category = $this->categoryService->getCategoryChildrenGroupedByIdAndSlug($id, $slug);
        $parentCategories = $this->categoryService->getParentCategories();

        return view('admin.category.show', compact('category', 'parentCategories'));
    }
}
