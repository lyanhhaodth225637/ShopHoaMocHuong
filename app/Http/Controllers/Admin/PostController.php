<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Http\Requests\Admin\PostCategory\StorePostCategoryRequest;
use App\Http\Requests\Admin\PostCategory\UpdatePostCategoryRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {
    }

    public function indexCategory()
    {
        $postCategories = $this->postService->getCategoryList();
        $posts = $this->postService->getPostList();

        return view('admin.post.index', compact('postCategories', 'posts'));
    }

    public function storeCategory(StorePostCategoryRequest $request)
    {
        $this->postService->storeCategory($request->validated());

        return back()->with('success', 'Them chu de thanh cong');
    }

    public function updateCategory(UpdatePostCategoryRequest $request, string $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $this->postService->updateCategory($postCategory, $request->validated());

        return back()->with('success', 'Cap nhat chu de thanh cong.');
    }

    public function destroyCategory(string $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $result = $this->postService->destroyCategory($postCategory);

        if (! $result['success']) {
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }

    public function toggleCategoryStatus(string $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $this->postService->toggleStatus($postCategory);

        return back()->with('success', 'Cap nhat trang thai danh muc thanh cong.');
    }

    public function storePost(StorePostRequest $request)
    {
        $this->postService->storePost($request->validated());

        return back()->with('success', 'Them bai viet thanh cong.');
    }

    public function updatePost(UpdatePostRequest $request, string $id, string $slug)
    {
        $post = Post::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        $this->postService->updatePost($post, $request->validated());

        return back()->with('success', 'Cap nhat bai viet thanh cong.');
    }

    public function destroyPost(string $id)
    {
        $post = Post::findOrFail($id);
        $this->postService->deletePost($post);

        return back()->with('success', 'Xoa bai viet thanh cong.');
    }
}
