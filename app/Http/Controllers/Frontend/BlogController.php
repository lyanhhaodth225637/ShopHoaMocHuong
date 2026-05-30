<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = PostCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $baseQuery = Post::query()
            ->with(['category', 'user', 'images'])
            ->where('is_active', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        if ($request->filled('category')) {
            $baseQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->string('category'));
            });
        }

        if ($request->filled('q')) {
            $keyword = $request->string('q')->toString();

            $baseQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('excerpt', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('tag')) {
            $tag = str_replace('-', ' ', $request->string('tag')->toString());

            $baseQuery->where(function ($query) use ($tag) {
                $query->where('title', 'like', '%' . $tag . '%')
                    ->orWhere('excerpt', 'like', '%' . $tag . '%')
                    ->orWhere('type', 'like', '%' . $tag . '%');
            });
        }

        $featured = (clone $baseQuery)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $posts = (clone $baseQuery)
            ->when($featured, function ($query) use ($featured) {
                $query->where('id', '!=', $featured->id);
            })
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        $popularPosts = Post::query()
            ->with(['category', 'user'])
            ->where('is_active', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('view_count')
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        $tags = collect($categories->pluck('name'))
            ->merge(
                Post::query()
                    ->where('is_active', true)
                    ->where('status', 'published')
                    ->distinct()
                    ->pluck('type')
            )
            ->filter()
            ->unique()
            ->values()
            ->all();

        return view('frontend.blog.index', compact(
            'categories',
            'featured',
            'posts',
            'popularPosts',
            'tags'
        ));
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->with([
                'category',
                'user',
                'activeImages',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $post->increment('view_count');
        $post->refresh();

        $categories = PostCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $popularPosts = Post::query()
            ->with(['category'])
            ->where('id', '!=', $post->id)
            ->where('is_active', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('view_count')
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        $relatedPosts = Post::query()
            ->with(['category'])
            ->where('id', '!=', $post->id)
            ->where('is_active', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when($post->post_category_id, function ($query) use ($post) {
                $query->where('post_category_id', $post->post_category_id);
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        $tags = collect($categories->pluck('name'))
            ->merge([$post->type])
            ->filter()
            ->unique()
            ->values()
            ->all();

        return view('frontend.blog.show', compact(
            'post',
            'categories',
            'popularPosts',
            'relatedPosts',
            'tags'
        ));
    }
}
