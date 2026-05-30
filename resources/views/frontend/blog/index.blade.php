@extends('layouts.frontend.app')

@section('title', 'Tin tức & Cẩm nang hoa')

@section('content')
<style>
    /* ─── BLOG PAGE ─── */
    .blog-page { background: var(--cream); }

    /* ─── HERO ─── */
    .blog-hero {
        background: linear-gradient(135deg, #1a6b6e 0%, #2BAAAD 60%, #3dc4c8 100%);
        padding: 52px 0 56px;
        position: relative;
        overflow: hidden;
    }
    .blog-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/svg%3E") repeat;
        pointer-events: none;
    }
    .blog-hero-inner { position: relative; z-index: 1; }
    .blog-hero .section-label { color: #b2e8ea; }
    .blog-hero .section-title { color: #fff; }
    .blog-hero .section-title em { color: #8dd5d7; font-style: italic; }
    .blog-hero p { color: #b2e8ea; font-size: .9rem; margin-top: 10px; max-width: 500px; }

    /* Search trong hero */
    .blog-search-wrap {
        max-width: 480px;
        margin-top: 24px;
    }
    .blog-search-wrap .input-group {
        border: 2px solid rgba(255,255,255,.35);
        border-radius: 50px;
        overflow: hidden;
        background: rgba(255,255,255,.12);
        backdrop-filter: blur(8px);
    }
    .blog-search-wrap input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: .88rem;
        padding: 12px 20px;
        outline: none;
        box-shadow: none !important;
    }
    .blog-search-wrap input::placeholder { color: rgba(255,255,255,.6); }
    .blog-search-wrap .btn {
        background: rgba(255,255,255,.2);
        border: none;
        color: #fff;
        padding: 0 20px;
        transition: background .2s;
    }
    .blog-search-wrap .btn:hover { background: rgba(255,255,255,.35); }

    /* ─── CATEGORY PILLS (filter) ─── */
    .blog-filter-strip {
        background: #fff;
        border-bottom: 1.5px solid #e8f5f5;
        padding: 14px 0;
        position: sticky;
        top: 70px; /* below sticky header */
        z-index: 100;
    }
    .blog-filter-inner {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        scrollbar-width: none;
        padding-bottom: 2px;
    }
    .blog-filter-inner::-webkit-scrollbar { display: none; }
    .blog-filter-pill {
        padding: 6px 18px;
        border-radius: 50px;
        border: 1.5px solid #b2e8ea;
        background: #fff;
        color: var(--text-muted);
        font-size: .78rem;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        text-decoration: none;
        transition: all .18s;
        flex-shrink: 0;
    }
    .blog-filter-pill:hover { border-color: var(--green-main); color: var(--green-dark); background: var(--green-pale); }
    .blog-filter-pill.active { background: var(--green-main); border-color: var(--green-main); color: #fff; }

    /* ─── LAYOUT MAIN ─── */
    .blog-main { padding: 48px 0 64px; }

    /* ─── FEATURED POST (large card) ─── */
    .blog-featured {
        border-radius: 20px;
        overflow: hidden;
        border: 1.5px solid #e8f5f5;
        background: #fff;
        display: flex;
        flex-direction: column;
        transition: all .3s;
        text-decoration: none;
        color: inherit;
        margin-bottom: 28px;
    }
    .blog-featured:hover {
        box-shadow: 0 14px 40px rgba(43,170,173,.13);
        transform: translateY(-3px);
        color: inherit;
    }
    .blog-featured .bf-img {
        height: 320px;
        overflow: hidden;
        background: var(--green-pale);
        position: relative;
    }
    .blog-featured .bf-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s;
    }
    .blog-featured:hover .bf-img img { transform: scale(1.05); }
    .blog-featured .bf-badge {
        position: absolute;
        top: 16px; left: 16px;
        background: var(--green-main);
        color: #fff;
        font-size: .68rem;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 50px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .blog-featured .bf-body { padding: 24px 28px; }
    .blog-featured .bf-tag { font-size: .7rem; font-weight: 700; color: var(--green-main); text-transform: uppercase; letter-spacing: 1px; }
    .blog-featured .bf-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.2rem, 2.5vw, 1.6rem);
        color: var(--text-dark); font-weight: 700;
        margin: 8px 0 10px; line-height: 1.3;
    }
    .blog-featured .bf-excerpt { font-size: .87rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 16px; }
    .blog-featured .bf-meta { display: flex; align-items: center; gap: 16px; font-size: .76rem; color: var(--text-muted); }
    .blog-featured .bf-meta i { color: var(--green-main); margin-right: 4px; }
    .blog-featured .bf-read-more {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--green-main); font-size: .83rem; font-weight: 600;
        margin-top: 16px;
        transition: gap .2s;
    }
    .blog-featured:hover .bf-read-more { gap: 10px; }

    /* ─── POST CARD (grid) ─── */
    /* Dùng lại .blog-card, .blog-card-body, .blog-tag, .blog-title, .blog-meta từ CSS gốc */
    /* Chỉ bổ sung thêm: */
    .blog-card { height: 100%; display: flex; flex-direction: column; text-decoration: none; color: inherit; }
    .blog-card:hover { color: inherit; }
    .blog-card .img-wrap { position: relative; }
    .blog-card .bc-tag {
        position: absolute; bottom: 10px; left: 10px;
        background: var(--green-main); color: #fff;
        font-size: .65rem; font-weight: 700;
        padding: 2px 10px; border-radius: 50px;
        text-transform: uppercase; letter-spacing: .8px;
    }
    .blog-card-body { flex: 1; display: flex; flex-direction: column; }
    .blog-card .blog-title { flex: 1; }
    .blog-card .blog-meta { margin-top: auto; padding-top: 10px; border-top: 1px solid #f0f9f9; }
    .blog-card .blog-meta i { color: var(--green-main); margin-right: 3px; }
    .blog-card .bc-read {
        font-size: .78rem; font-weight: 600; color: var(--green-main);
        display: inline-flex; align-items: center; gap: 4px; margin-top: 10px;
        transition: gap .2s;
    }
    .blog-card:hover .bc-read { gap: 8px; }

    /* ─── SIDEBAR ─── */
    .blog-sidebar { display: flex; flex-direction: column; gap: 24px; }

    .sidebar-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #e8f5f5;
        overflow: hidden;
    }
    .sidebar-card-header {
        background: var(--green-dark);
        padding: 12px 18px;
        font-family: 'Playfair Display', serif;
        font-size: .95rem;
        font-weight: 700;
        color: #fff;
        display: flex; align-items: center; gap: 8px;
    }
    .sidebar-card-header i { color: #b2e8ea; font-size: .9rem; }
    .sidebar-card-body { padding: 16px 18px; }

    /* Popular posts */
    .popular-post {
        display: flex; gap: 12px; align-items: flex-start;
        padding: 10px 0; border-bottom: 1px solid #f0f9f9;
        text-decoration: none; color: inherit;
        transition: background .15s;
    }
    .popular-post:last-child { border-bottom: none; padding-bottom: 0; }
    .popular-post:first-child { padding-top: 0; }
    .popular-post:hover { color: var(--green-dark); }
    .popular-post-img {
        width: 64px; height: 64px; border-radius: 10px;
        overflow: hidden; flex-shrink: 0; background: var(--green-pale);
    }
    .popular-post-img img { width: 100%; height: 100%; object-fit: cover; }
    .popular-post-title {
        font-size: .82rem; font-weight: 600; color: var(--text-dark);
        line-height: 1.4; margin-bottom: 4px;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .popular-post:hover .popular-post-title { color: var(--green-main); }
    .popular-post-date { font-size: .72rem; color: var(--text-muted); }

    /* Tags cloud */
    .tag-cloud { display: flex; flex-wrap: wrap; gap: 6px; }
    .tag-pill {
        padding: 4px 14px; border-radius: 50px;
        border: 1.5px solid #b2e8ea; background: #fff;
        color: var(--text-muted); font-size: .76rem; font-weight: 500;
        text-decoration: none; transition: all .18s;
    }
    .tag-pill:hover { background: var(--green-main); border-color: var(--green-main); color: #fff; }

    /* Newsletter sidebar */
    .sidebar-newsletter {
        background: linear-gradient(135deg, var(--green-dark), var(--green-main));
        border-radius: 16px;
        padding: 20px 18px;
        text-align: center;
    }
    .sidebar-newsletter i { font-size: 2rem; color: rgba(255,255,255,.6); margin-bottom: 8px; display: block; }
    .sidebar-newsletter h6 { font-family: 'Playfair Display', serif; color: #fff; font-size: 1rem; margin-bottom: 6px; }
    .sidebar-newsletter p { font-size: .78rem; color: #b2e8ea; margin-bottom: 14px; }
    .sidebar-newsletter input {
        width: 100%; border: none; border-radius: 8px 8px 0 0;
        padding: 10px 14px; font-size: .83rem; outline: none;
        background: rgba(255,255,255,.15); color: #fff;
        border-bottom: 1px solid rgba(255,255,255,.2);
    }
    .sidebar-newsletter input::placeholder { color: rgba(255,255,255,.5); }
    .sidebar-newsletter .btn-sub {
        width: 100%; background: var(--gold); color: #fff; border: none;
        border-radius: 0 0 8px 8px; padding: 10px;
        font-size: .83rem; font-weight: 700; cursor: pointer;
        transition: background .2s;
    }
    .sidebar-newsletter .btn-sub:hover { background: #b88a30; }

    /* ─── PAGINATION ─── */
    .blog-pagination { display: flex; justify-content: center; gap: 6px; margin-top: 40px; }
    .page-btn {
        width: 38px; height: 38px; border-radius: 10px;
        border: 1.5px solid #b2e8ea; background: #fff;
        color: var(--text-muted); font-size: .85rem; font-weight: 600;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none; cursor: pointer; transition: all .18s;
    }
    .page-btn:hover, .page-btn.active {
        background: var(--green-main); border-color: var(--green-main); color: #fff;
    }
    .page-btn.disabled { opacity: .4; pointer-events: none; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 991px) {
        .blog-hero { padding: 40px 0 44px; }
        .blog-featured .bf-img { height: 240px; }
        .blog-filter-strip { top: 60px; }
    }
    @media (max-width: 767px) {
        .blog-hero { padding: 32px 0 36px; }
        .blog-featured .bf-body { padding: 18px 16px; }
        .blog-filter-strip { top: 56px; }
        .blog-main { padding: 32px 0 48px; }
    }
</style>

<div class="blog-page">

    {{-- ── HERO ── --}}
    <div class="blog-hero">
        <div class="container blog-hero-inner">
            <div class="section-label">Kiến thức & Cảm hứng</div>
            <h1 class="section-title">Tin tức & <em>Cẩm nang</em> hoa</h1>
            <p>Chia sẻ kiến thức về hoa, ý nghĩa từng loài, bí quyết chăm sóc và cảm hứng trang trí.</p>
            <div class="blog-search-wrap">
                <form action="{{ route('frontend.blog.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Tìm bài viết...">
                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── FILTER STRIP ── --}}
    <div class="blog-filter-strip">
        <div class="container">
            <div class="blog-filter-inner">
                <a href="{{ route('frontend.blog.index') }}"
                    class="blog-filter-pill {{ !request('category') ? 'active' : '' }}">
                    Tất cả
                </a>
                @foreach($categories ?? [] as $cat)
                    <a href="{{ route('frontend.blog.index', ['category' => $cat->slug]) }}"
                        class="blog-filter-pill {{ request('category') === $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="blog-main">
        <div class="container">
            <div class="row g-4">

                {{-- ── CỘT NỘI DUNG ── --}}
                <div class="col-lg-8">

                    {{-- Bài nổi bật --}}
                    @if(isset($featured))
                        <a href="{{ route('frontend.blog.show', $featured->slug) }}" class="blog-featured">
                            <div class="bf-img">
                                <img src="{{ $featured->thumbnail ? asset('storage/'.$featured->thumbnail) : asset('images/no-image.png') }}"
                                    alt="{{ $featured->title }}">
                                <span class="bf-badge">Nổi bật</span>
                            </div>
                            <div class="bf-body">
                                <div class="bf-tag">{{ $featured->category->name ?? 'Tin tức' }}</div>
                                <h2 class="bf-title">{{ $featured->title }}</h2>
                                <p class="bf-excerpt">{{ Str::limit($featured->excerpt ?? strip_tags($featured->content), 160) }}</p>
                                <div class="bf-meta">
                                    <span><i class="bi bi-person"></i>{{ $featured->user->name ?? 'Moc Huong' }}</span>
                                    <span><i class="bi bi-calendar3"></i>{{ $featured->created_at->format('d/m/Y') }}</span>
                                    <span><i class="bi bi-clock"></i>{{ $featured->read_time ?? '5' }} phút đọc</span>
                                </div>
                                <div class="bf-read-more">
                                    Đọc tiếp <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    @endif

                    {{-- Grid bài viết --}}
                    <div class="row g-4">
                        @forelse($posts ?? [] as $post)
                            <div class="col-sm-6">
                                <a href="{{ route('frontend.blog.show', $post->slug) }}" class="blog-card">
                                    <div class="img-wrap">
                                        <img src="{{ $post->thumbnail ? asset('storage/'.$post->thumbnail) : asset('images/no-image.png') }}"
                                            alt="{{ $post->title }}">
                                        <span class="bc-tag">{{ $post->category->name ?? 'Tin tức' }}</span>
                                    </div>
                                    <div class="blog-card-body">
                                        <h3 class="blog-title">{{ $post->title }}</h3>
                                        <p style="font-size:.82rem;color:var(--text-muted);line-height:1.6;margin:8px 0 0;">
                                            {{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}
                                        </p>
                                        <div class="blog-meta">
                                            <span><i class="bi bi-calendar3"></i>{{ $post->created_at->format('d/m/Y') }}</span>
                                            <span class="ms-3"><i class="bi bi-clock"></i>{{ $post->read_time ?? '3' }} phút</span>
                                        </div>
                                        <span class="bc-read">Đọc tiếp <i class="bi bi-arrow-right"></i></span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                                    <i class="bi bi-newspaper" style="font-size:3rem;color:#b2e8ea;"></i>
                                    <p class="mt-3 mb-0 text-muted">Chưa có bài viết nào.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if(isset($posts) && $posts->hasPages())
                        <div class="blog-pagination">
                            <a href="{{ $posts->previousPageUrl() }}"
                                class="page-btn {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                <a href="{{ $url }}"
                                    class="page-btn {{ $posts->currentPage() === $page ? 'active' : '' }}">
                                    {{ $page }}
                                </a>
                            @endforeach
                            <a href="{{ $posts->nextPageUrl() }}"
                                class="page-btn {{ !$posts->hasMorePages() ? 'disabled' : '' }}">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    @endif

                </div>

                {{-- ── SIDEBAR ── --}}
                <div class="col-lg-4">
                    <div class="blog-sidebar">

                        {{-- Bài đọc nhiều --}}
                        <div class="sidebar-card">
                            <div class="sidebar-card-header">
                                <i class="bi bi-fire"></i> Bài đọc nhiều
                            </div>
                            <div class="sidebar-card-body" style="padding-top:8px;padding-bottom:8px;">
                                @forelse($popularPosts ?? [] as $p)
                                    <a href="{{ route('frontend.blog.show', $p->slug) }}" class="popular-post">
                                        <div class="popular-post-img">
                                            <img src="{{ $p->thumbnail ? asset('storage/'.$p->thumbnail) : asset('images/no-image.png') }}"
                                                alt="{{ $p->title }}">
                                        </div>
                                        <div>
                                            <div class="popular-post-title">{{ $p->title }}</div>
                                            <div class="popular-post-date">
                                                <i class="bi bi-calendar3" style="color:var(--green-main);font-size:.65rem;"></i>
                                                {{ $p->created_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    @for($i = 1; $i <= 4; $i++)
                                        <div class="popular-post" style="pointer-events:none;">
                                            <div class="popular-post-img" style="background:var(--green-pale);"></div>
                                            <div style="flex:1;">
                                                <div style="height:12px;background:#f0f0f0;border-radius:4px;margin-bottom:6px;"></div>
                                                <div style="height:10px;background:#f0f0f0;border-radius:4px;width:60%;"></div>
                                            </div>
                                        </div>
                                    @endfor
                                @endforelse
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="sidebar-card">
                            <div class="sidebar-card-header">
                                <i class="bi bi-tags"></i> Chủ đề
                            </div>
                            <div class="sidebar-card-body">
                                <div class="tag-cloud">
                                    @foreach($tags ?? ['Hoa tươi','Hoa cưới','Hoa sinh nhật','Cẩm nang','Trang trí','Cây cảnh','Quà tặng','Phong thủy','Hoa lan','Hoa hồng'] as $tag)
                                        <a href="{{ route('frontend.blog.index', ['tag' => Str::slug($tag)]) }}"
                                            class="tag-pill">{{ $tag }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Newsletter --}}
                        <div class="sidebar-newsletter">
                            <i class="bi bi-envelope-heart"></i>
                            <h6>Nhận cẩm nang hoa</h6>
                            <p>Đăng ký để nhận các bài viết hay và ưu đãi độc quyền mỗi tuần.</p>
                            <form action="#" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Email của bạn...">
                                <button type="submit" class="btn-sub">Đăng ký ngay</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
