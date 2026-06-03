@extends('layouts.frontend.app')
@section('meta_description', $post->meta_description ?: ($post->excerpt ?: ('Bài viết ' . $post->title . ' từ Hoa Gỗ Mộc Hương.')))
@section('meta_keywords', ($post->category->name ?? 'tin tức hoa') . ', ' . $post->title . ', blog Hoa Gỗ Mộc Hương')
@section('canonical', route('frontend.blog.show', $post->slug))
@section('og_title', $post->meta_title ?: $post->title)
@section('og_description', $post->meta_description ?: ($post->excerpt ?: ('Bài viết ' . $post->title . ' từ Hoa Gỗ Mộc Hương.')))
@section('og_image', $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/img/logo.png'))
@section('og_type', 'article')

@section('title', $post->meta_title ?: $post->title)

@section('content')
    @php
        $videoUrl = $post->video_url;
        $youtubeEmbedUrl = null;

        if ($videoUrl && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/|youtube\.com\/embed\/)([^&\n?#\/]+)/', $videoUrl, $matches)) {
            $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        }

        $mediaItems = collect();

        if ($post->thumbnail) {
            $mediaItems->push(['type' => 'image', 'src' => asset('storage/' . $post->thumbnail), 'thumb' => asset('storage/' . $post->thumbnail), 'alt' => $post->title]);
        }

        foreach ($post->activeImages as $image) {
            $mediaItems->push(['type' => 'image', 'src' => asset('storage/' . $image->image), 'thumb' => asset('storage/' . $image->image), 'alt' => $image->alt ?: $post->title]);
        }

        if ($youtubeEmbedUrl) {
            $mediaItems->push(['type' => 'video', 'src' => $youtubeEmbedUrl, 'thumb' => $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/no-image.png'), 'alt' => 'Video YouTube']);
        }

        $firstImage = $mediaItems->firstWhere('type', 'image');
    @endphp

    <style>
        .post-detail-page {
            background: var(--cream);
        }

        /* ─── BREADCRUMB ─── */
        .post-detail-page .breadcrumb {
            font-size: .82rem;
            margin-bottom: 0;
        }

        .post-detail-page .breadcrumb-item a {
            color: var(--green-main);
            text-decoration: none;
        }

        .post-detail-page .breadcrumb-item a:hover {
            color: var(--green-dark);
        }

        .post-detail-page .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .post-detail-page .breadcrumb-item+.breadcrumb-item::before {
            color: #b2e8ea;
        }

        /* ─── STICKY COL ─── */
        .media-col {
            position: sticky;
            top: 80px;
            align-self: flex-start;
        }

        /* ─── MAIN VIEWER ─── */
        .main-viewer {
            position: relative;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            border: 1.5px solid #e0f2f2;
            background: #fff;
            box-shadow: 0 4px 24px rgba(43, 170, 173, .08);
        }

        .main-viewer__img-wrap {
            width: 100%;
            aspect-ratio: 1 / 1;
            max-height: min(440px, 48vh);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fafefe;
        }

        .main-viewer__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform .5s cubic-bezier(.25, .46, .45, .94);
            display: block;
        }

        .main-viewer:hover .main-viewer__img-wrap img {
            transform: scale(1.03);
        }

        .main-viewer__video-wrap {
            display: none;
            width: 100%;
            aspect-ratio: 1 / 1;
            max-height: min(440px, 48vh);
            background: #000;
            align-items: center;
            justify-content: center;
        }

        .main-viewer__video-wrap.is-active {
            display: flex;
        }

        .main-viewer__video-wrap iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Gallery nav */
        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, .9);
            color: var(--green-dark);
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .14);
            transition: background .2s, color .2s, transform .2s;
            backdrop-filter: blur(4px);
        }

        .gallery-nav:hover {
            background: var(--green-main);
            color: #fff;
            transform: translateY(-50%) scale(1.08);
        }

        .gallery-nav.prev {
            left: 12px;
        }

        .gallery-nav.next {
            right: 12px;
        }

        /* Video badge */
        .viewer-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 5;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            font-size: .7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 50px;
            display: none;
            align-items: center;
            gap: 5px;
            backdrop-filter: blur(4px);
            letter-spacing: .5px;
        }

        .viewer-badge i {
            font-size: .8rem;
            color: #ff4444;
        }

        /* ─── THUMB STRIP ─── */
        .thumb-strip-wrap {
            position: relative;
            width: 100%;
            margin: 10px auto 0;
            padding: 0 26px;
        }

        .thumb-strip {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 4px 2px;
            cursor: grab;
        }

        .thumb-strip:active {
            cursor: grabbing;
        }

        .thumb-strip::-webkit-scrollbar {
            display: none;
        }

        .thumb-btn {
            position: relative;
            width: 66px;
            height: 66px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid transparent;
            padding: 0;
            background: #f9f9f9;
            cursor: pointer;
            flex-shrink: 0;
            scroll-snap-align: start;
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }

        .thumb-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .thumb-btn:hover {
            border-color: var(--green-accent);
            transform: translateY(-2px);
        }

        .thumb-btn.active {
            border-color: var(--green-main);
            box-shadow: 0 0 0 3px rgba(43, 170, 173, .2);
        }

        .thumb-btn--video::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .38) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M8 5v14l11-7z'/%3E%3C/svg%3E") center/28px no-repeat;
            border-radius: 8px;
        }

        .strip-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 1.5px solid #b2e8ea;
            background: #fff;
            color: var(--green-dark);
            font-size: .65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            transition: all .2s;
            padding: 0;
        }

        .strip-nav-btn:hover {
            background: var(--green-main);
            border-color: var(--green-main);
            color: #fff;
        }

        .strip-nav-btn.prev {
            left: 0;
        }

        .strip-nav-btn.next {
            right: 0;
        }

        /* ─── POST INFO CARD ─── */
        .post-info {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e0f2f2;
            padding: 28px 24px;
            box-shadow: 0 4px 24px rgba(43, 170, 173, .06);
        }

        .post-category-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--green-pale);
            color: var(--green-dark);
            font-size: .72rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 50px;
            text-decoration: none;
            margin: 0 4px 6px 0;
            transition: background .2s;
        }

        .post-category-badge:hover {
            background: var(--green-main);
            color: #fff;
        }

        .post-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.25rem, 2.5vw, 1.75rem);
            color: var(--text-dark);
            font-weight: 700;
            line-height: 1.3;
        }

        .post-highlight {
            font-size: .88rem;
            color: var(--text-muted);
            line-height: 1.8;
            border-left: 3px solid var(--green-accent);
            padding-left: 14px;
            margin: 0;
        }

        /* Meta rows */
        .meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .84rem;
            padding: 9px 0;
            border-bottom: 1px dashed #e8f5f5;
        }

        .meta-row:last-child {
            border-bottom: none;
        }

        .meta-label {
            color: var(--text-muted);
            white-space: nowrap;
            min-width: 100px;
            font-weight: 500;
        }

        .meta-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Status strip */
        .post-status-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding: 14px;
            background: #f9fefe;
            border-radius: 14px;
            border: 1px solid #e0f2f2;
        }

        .post-status-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 4px;
            font-size: .72rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .post-status-item i {
            font-size: 1.25rem;
            color: var(--green-main);
        }

        .post-status-item strong {
            color: var(--text-dark);
            font-size: .74rem;
        }

        /* ─── TABS ─── */
        .detail-tabs-wrap {
            margin-top: 32px;
        }

        .detail-tabs-nav {
            display: flex;
            gap: 0;
            background: #fff;
            border-radius: 16px 16px 0 0;
            border: 1.5px solid #e0f2f2;
            border-bottom: none;
            overflow: hidden;
        }

        .detail-tab-btn {
            background: none;
            border: none;
            padding: 13px 24px;
            font-size: .88rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 2.5px solid transparent;
            margin-bottom: -1px;
            transition: color .2s, border-color .2s;
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .detail-tab-btn.active {
            color: var(--green-main);
            border-bottom-color: var(--green-main);
        }

        .detail-tab-btn:hover:not(.active) {
            color: var(--green-dark);
            background: var(--green-pale);
        }

        .detail-tabs-body {
            background: #fff;
            border-radius: 0 0 16px 16px;
            border: 1.5px solid #e0f2f2;
            border-top: none;
            padding: 28px 32px;
        }

        .tab-pane-content {
            display: none;
        }

        .tab-pane-content.active {
            display: block;
        }

        .description-content {
            font-size: .9rem;
            color: var(--text-muted);
            line-height: 1.9;
        }

        .description-content h2,
        .description-content h3,
        .description-content h4 {
            font-family: 'Playfair Display', serif;
            color: var(--text-dark);
            margin-top: 24px;
            margin-bottom: 10px;
        }

        .description-content p {
            margin-bottom: 14px;
        }

        .description-content img {
            max-width: 100%;
            border-radius: 12px;
            margin: 12px 0;
        }

        .description-content a {
            color: var(--green-main);
            text-decoration: none;
        }

        .description-content a:hover {
            color: var(--green-dark);
            text-decoration: underline;
        }

        /* ─── RELATED ─── */
        .related-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--text-dark);
            font-weight: 700;
        }

        .rel-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #f0f0f0;
            transition: all .3s;
            display: block;
            text-decoration: none;
            height: 100%;
        }

        .rel-card:hover {
            border-color: var(--green-main);
            box-shadow: 0 10px 28px rgba(43, 170, 173, .13);
            transform: translateY(-4px);
            color: inherit;
        }

        .rel-card__img {
            height: 180px;
            overflow: hidden;
            background: #f9f9f9;
        }

        .rel-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .rel-card:hover .rel-card__img img {
            transform: scale(1.06);
        }

        .rel-card__body {
            padding: 14px 16px;
        }

        .rel-card__cat {
            font-size: .68rem;
            font-weight: 700;
            color: var(--green-main);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 6px;
            display: block;
        }

        .rel-card__name {
            color: var(--text-dark);
            font-size: .88rem;
            line-height: 1.45;
            font-weight: 700;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .rel-card__meta {
            font-size: .76rem;
            color: var(--text-muted);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991px) {
            .media-col {
                position: static;
            }

            .main-viewer__img-wrap,
            .main-viewer__video-wrap {
                max-height: min(380px, 50vw);
            }
        }

        @media (max-width: 767px) {
            .post-info {
                padding: 20px 16px;
            }

            .detail-tabs-body {
                padding: 20px 16px;
            }

            .post-status-strip {
                grid-template-columns: repeat(3, 1fr);
            }

            .main-viewer__img-wrap,
            .main-viewer__video-wrap {
                max-height: min(320px, 70vw);
            }

            .thumb-btn {
                width: 58px;
                height: 58px;
            }
        }
    </style>

    <main class="post-detail-page py-4 py-lg-5">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.blog.index') }}">Tin tức & cẩm nang</a></li>
                    @if($post->category)
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('frontend.blog.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ \Illuminate\Support\Str::limit($post->title, 60) }}</li>
                </ol>
            </nav>

            <div class="row g-4">

                {{-- ── Cột media ── --}}
                <div class="col-lg-6 media-col">

                    <div class="main-viewer" id="mainViewer">
                        <div class="viewer-badge" id="videoBadge">
                            <i class="bi bi-youtube"></i> Video YouTube
                        </div>

                        <div class="main-viewer__img-wrap" id="imgWrap">
                            <img id="mainPostImage" src="{{ $firstImage['src'] ?? asset('images/no-image.png') }}"
                                alt="{{ $firstImage['alt'] ?? $post->title }}">
                        </div>

                        <div class="main-viewer__video-wrap" id="videoWrap">
                            <iframe id="videoIframe" src=""
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>

                        @if($mediaItems->where('type', 'image')->count() > 1)
                            <button class="gallery-nav prev" id="galleryPrev" type="button">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="gallery-nav next" id="galleryNext" type="button">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        @endif
                    </div>

                    @if($mediaItems->isNotEmpty())
                        <div class="thumb-strip-wrap">
                            <button class="strip-nav-btn prev" id="stripPrev" type="button">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <div class="thumb-strip" id="thumbStrip">
                                @foreach($mediaItems as $index => $item)
                                    <button type="button"
                                        class="thumb-btn {{ $item['type'] === 'video' ? 'thumb-btn--video' : '' }} {{ $index === 0 ? 'active' : '' }}"
                                        data-type="{{ $item['type'] }}" @if($item['type'] === 'image') data-image="{{ $item['src'] }}"
                                        data-alt="{{ $item['alt'] }}" @else data-video="{{ $item['src'] }}" @endif>
                                        <img src="{{ $item['thumb'] }}" alt="{{ $item['alt'] }}">
                                    </button>
                                @endforeach
                            </div>
                            <button class="strip-nav-btn next" id="stripNext" type="button">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                </div>

                {{-- ── Cột thông tin ── --}}
                <div class="col-lg-6">
                    <div class="post-info">

                        <div class="mb-2">
                            @if($post->category)
                                <a href="{{ route('frontend.blog.index', ['category' => $post->category->slug]) }}"
                                    class="post-category-badge">
                                    <i class="bi bi-bookmark-star"></i>{{ $post->category->name }}
                                </a>
                            @endif
                            @if($post->is_featured)
                                <span class="post-category-badge">
                                    <i class="bi bi-stars"></i>Nổi bật
                                </span>
                            @endif
                        </div>

                        <h1 class="post-title mb-3">{{ $post->title }}</h1>

                        @if($post->excerpt)
                            <p class="post-highlight mb-4">{{ $post->excerpt }}</p>
                        @endif

                        <div class="mb-4">
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-person me-2 text-green"></i>Tác giả</span>
                                <span class="meta-value">{{ $post->user->name ?? 'Mộc Hương' }}</span>
                            </div>
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-calendar3 me-2 text-green"></i>Ngày đăng</span>
                                <span
                                    class="meta-value">{{ $post->published_at?->format('d/m/Y H:i') ?? $post->created_at?->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-eye me-2 text-green"></i>Lượt xem</span>
                                <span class="meta-value">{{ number_format($post->view_count) }}</span>
                            </div>
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-grid me-2 text-green"></i>Loại bài</span>
                                <span class="meta-value">{{ strtoupper($post->type) }}</span>
                            </div>
                        </div>

                        <div class="post-status-strip">
                            <div class="post-status-item">
                                <i class="bi bi-patch-check"></i>
                                <strong>Đã xuất bản</strong>
                                <span>Nội dung thật</span>
                            </div>
                            <div class="post-status-item">
                                <i class="bi bi-camera"></i>
                                <strong>{{ $post->activeImages->count() }}</strong>
                                <span>Ảnh minh họa</span>
                            </div>
                            <div class="post-status-item">
                                <i class="bi bi-youtube"></i>
                                <strong>{{ $youtubeEmbedUrl ? 'Có video' : 'Không có' }}</strong>
                                <span>YouTube kèm theo</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── Tabs nội dung ── --}}
            <div class="detail-tabs-wrap">
                <div class="detail-tabs-nav">
                    <button class="detail-tab-btn active" data-tab="desc">Nội dung bài viết</button>
                    <button class="detail-tab-btn" data-tab="spec">Thông tin thêm</button>
                </div>
                <div class="detail-tabs-body">
                    <div class="tab-pane-content description-content active" id="tab-desc">
                        {!! nl2br(e($post->content ?: 'Nội dung bài viết đang được cập nhật.')) !!}
                    </div>
                    <div class="tab-pane-content" id="tab-spec">
                        <table class="table table-sm" style="font-size:.875rem;">
                            <tbody>
                                <tr>
                                    <td style="color:var(--text-muted);width:140px;">Chủ đề</td>
                                    <td class="fw-600">{{ $post->category->name ?? 'Đang cập nhật' }}</td>
                                </tr>
                                <tr>
                                    <td style="color:var(--text-muted);">Trạng thái</td>
                                    <td class="fw-600">{{ $post->status }}</td>
                                </tr>
                                <tr>
                                    <td style="color:var(--text-muted);">Tác giả</td>
                                    <td class="fw-600">{{ $post->user->name ?? 'Mộc Hương' }}</td>
                                </tr>
                                <tr>
                                    <td style="color:var(--text-muted);">Lượt xem</td>
                                    <td class="fw-600">{{ number_format($post->view_count) }}</td>
                                </tr>
                                <tr>
                                    <td style="color:var(--text-muted);">Video</td>
                                    <td class="fw-600">{{ $youtubeEmbedUrl ? 'YouTube' : 'Không có' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ── Bài liên quan ── --}}
            @if($relatedPosts->count() > 0)
                <section class="related-section mt-5">
                    <h3 class="mb-1">Bài viết liên quan</h3>
                    <div class="divider-leaf mb-4"></div>
                    <div class="row g-3">
                        @foreach($relatedPosts as $item)
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('frontend.blog.show', $item->slug) }}" class="rel-card">
                                    <div class="rel-card__img">
                                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/no-image.png') }}"
                                            alt="{{ $item->title }}">
                                    </div>
                                    <div class="rel-card__body">
                                        <span class="rel-card__cat">{{ $item->category->name ?? 'Tin tức' }}</span>
                                        <div class="rel-card__name">{{ $item->title }}</div>
                                        <div class="rel-card__meta">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $item->published_at?->format('d/m/Y') ?? $item->created_at?->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </main>

    <script>
        (function () {
            const thumbs = Array.from(document.querySelectorAll('.thumb-btn'));
            const mainImg = document.getElementById('mainPostImage');
            const imgWrap = document.getElementById('imgWrap');
            const videoWrap = document.getElementById('videoWrap');
            const videoIframe = document.getElementById('videoIframe');
            const videoBadge = document.getElementById('videoBadge');
            const btnPrev = document.getElementById('galleryPrev');
            const btnNext = document.getElementById('galleryNext');
            const strip = document.getElementById('thumbStrip');
            const sPrev = document.getElementById('stripPrev');
            const sNext = document.getElementById('stripNext');

            if (!thumbs.length || !mainImg || !imgWrap || !videoWrap || !videoIframe) return;

            const imageThumbs = thumbs.filter(t => t.dataset.type === 'image');
            let imgCurrent = 0;
            let isVideo = false;

            function showImage(index) {
                if (!imageThumbs.length) return;
                isVideo = false;
                imgCurrent = (index + imageThumbs.length) % imageThumbs.length;

                imgWrap.style.display = '';
                videoWrap.classList.remove('is-active');
                videoBadge.style.display = 'none';
                if (btnPrev) btnPrev.style.display = '';
                if (btnNext) btnNext.style.display = '';

                videoIframe.src = '';
                mainImg.src = imageThumbs[imgCurrent].dataset.image;
                mainImg.alt = imageThumbs[imgCurrent].dataset.alt || '';

                thumbs.forEach(b => b.classList.remove('active'));
                imageThumbs[imgCurrent].classList.add('active');
                imageThumbs[imgCurrent].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            function showVideo(embedUrl, btn) {
                isVideo = true;
                imgWrap.style.display = 'none';
                videoWrap.classList.add('is-active');
                videoBadge.style.display = 'flex';
                if (btnPrev) btnPrev.style.display = 'none';
                if (btnNext) btnNext.style.display = 'none';

                videoIframe.src = embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1';
                thumbs.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }

            thumbs.forEach(btn => {
                btn.addEventListener('click', function () {
                    if (btn.dataset.type === 'video') showVideo(btn.dataset.video, btn);
                    else showImage(imageThumbs.indexOf(btn));
                });
            });

            if (btnPrev) btnPrev.addEventListener('click', () => showImage(imgCurrent - 1));
            if (btnNext) btnNext.addEventListener('click', () => showImage(imgCurrent + 1));
            if (sPrev && strip) sPrev.addEventListener('click', () => strip.scrollBy({ left: -160, behavior: 'smooth' }));
            if (sNext && strip) sNext.addEventListener('click', () => strip.scrollBy({ left: 160, behavior: 'smooth' }));

            // Drag strip
            let isDown = false, startX, scrollLeft;
            if (strip) {
                strip.addEventListener('mousedown', e => { isDown = true; startX = e.pageX - strip.offsetLeft; scrollLeft = strip.scrollLeft; strip.style.cursor = 'grabbing'; });
                strip.addEventListener('mouseleave', () => { isDown = false; strip.style.cursor = 'grab'; });
                strip.addEventListener('mouseup', () => { isDown = false; strip.style.cursor = 'grab'; });
                strip.addEventListener('mousemove', e => { if (!isDown) return; e.preventDefault(); strip.scrollLeft = scrollLeft - (e.pageX - strip.offsetLeft - startX); });
            }

            // Swipe
            let tx = 0;
            const viewer = document.getElementById('mainViewer');
            if (viewer) {
                viewer.addEventListener('touchstart', e => { tx = e.touches[0].clientX; }, { passive: true });
                viewer.addEventListener('touchend', e => {
                    const diff = tx - e.changedTouches[0].clientX;
                    if (!isVideo && Math.abs(diff) > 40) diff > 0 ? showImage(imgCurrent + 1) : showImage(imgCurrent - 1);
                });
            }

            // Init
            const init = document.querySelector('.thumb-btn.active');
            if (init?.dataset.type === 'video') showVideo(init.dataset.video, init);
            else if (imageThumbs.length) showImage(0);

            // Tabs
            document.querySelectorAll('.detail-tab-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.detail-tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-pane-content').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('tab-' + btn.dataset.tab)?.classList.add('active');
                });
            });
        })();
    </script>
@endsection
