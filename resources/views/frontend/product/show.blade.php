@extends('layouts.frontend.app')

@section('title', $product->meta_title ?? $product->name)

@section('content')
    <style>
        /* ═══════════════════════════════════════
                       PRODUCT DETAIL PAGE
                    ═══════════════════════════════════════ */
        .product-detail-page {
            background: var(--cream);
        }

        /* ─── BREADCRUMB ─── */
        .product-detail-page .breadcrumb {
            font-size: .82rem;
            margin-bottom: 0;
        }

        .product-detail-page .breadcrumb-item a {
            color: var(--green-main);
            text-decoration: none;
        }

        .product-detail-page .breadcrumb-item a:hover {
            color: var(--green-dark);
        }

        .product-detail-page .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .product-detail-page .breadcrumb-item+.breadcrumb-item::before {
            color: #b2e8ea;
        }

        /* ─── MEDIA COLUMN ─── */
        .media-col {
            position: sticky;
            top: 80px;
            align-self: flex-start;
        }

        /* ─── MAIN VIEWER ─── */
        .main-viewer {
            position: relative;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #e0f2f2;
            background: #fff;
            box-shadow: 0 3px 16px rgba(43, 170, 173, .08);
        }

        /* Ảnh chính – tỉ lệ 4:3, giới hạn chiều cao */
        .main-viewer__img-wrap {
            width: 100%;
            aspect-ratio: 4 / 3;
            max-height: 420px;
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
            transform: scale(1.04);
        }

        /* Video embed */
        .main-viewer__video-wrap {
            display: none;
            width: 100%;
            aspect-ratio: 4 / 3;
            max-height: 420px;
            background: #000;
            align-items: center;
            justify-content: center;
        }

        .main-viewer__video-wrap.is-active {
            display: flex;
        }

        .main-viewer__video-wrap iframe {
            width: 56.25%;
            height: 100%;
            border: none;
        }

        /* Nút prev/next */
        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, .9);
            color: var(--green-dark);
            font-size: .9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .14);
            transition: background .2s, color .2s, transform .2s;
            backdrop-filter: blur(4px);
        }

        .gallery-nav:hover {
            background: var(--green-main);
            color: #fff;
            transform: translateY(-50%) scale(1.08);
        }

        .gallery-nav.prev {
            left: 10px;
        }

        .gallery-nav.next {
            right: 10px;
        }

        /* Badge video */
        .viewer-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 5;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            font-size: .68rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 4px;
            backdrop-filter: blur(4px);
            letter-spacing: .5px;
        }

        .viewer-badge i {
            font-size: .75rem;
            color: #ff4444;
        }

        /* ─── THUMB STRIP ─── */
        .thumb-strip-wrap {
            position: relative;
            padding: 0 26px;
            margin-top: 10px;
        }

        .thumb-strip {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 3px 2px;
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
            width: 60px;
            height: 60px;
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
            background: rgba(0, 0, 0, .38) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M8 5v14l11-7z'/%3E%3C/svg%3E") center/26px no-repeat;
            border-radius: 8px;
        }

        /* Strip nav arrows */
        .strip-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1.5px solid #b2e8ea;
            background: #fff;
            color: var(--green-dark);
            font-size: .6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
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

        /* ─── PRODUCT INFO CARD ─── */
        .product-info {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e0f2f2;
            padding: 24px 22px;
            box-shadow: 0 3px 16px rgba(43, 170, 173, .06);
        }

        .product-category-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--green-pale);
            color: var(--green-dark);
            font-size: .7rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
            text-decoration: none;
            margin: 0 4px 4px 0;
            transition: background .2s;
        }

        .product-category-badge:hover {
            background: var(--green-main);
            color: #fff;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.2rem, 2.5vw, 1.6rem);
            color: var(--text-dark);
            font-weight: 700;
            line-height: 1.3;
        }

        /* Rating row */
        .rating-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .82rem;
            color: var(--text-muted);
        }

        .stars {
            color: #f5a623;
            letter-spacing: 1px;
        }

        /* Price block */
        .price-block {
            display: flex;
            align-items: baseline;
            gap: 10px;
            flex-wrap: wrap;
            padding: 12px 16px;
            background: var(--green-pale);
            border-radius: 12px;
            border-left: 4px solid var(--green-main);
        }

        .price-current {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--green-dark);
            font-family: 'Be Vietnam Pro', sans-serif;
            line-height: 1;
        }

        .price-old {
            font-size: .95rem;
            color: #aaa;
            text-decoration: line-through;
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .price-badge-discount {
            background: #e74c3c;
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 50px;
            margin-left: auto;
        }

        /* Short desc */
        .product-short-desc {
            font-size: .87rem;
            color: var(--text-muted);
            line-height: 1.75;
            border-left: 3px solid var(--green-accent);
            padding-left: 12px;
            margin: 0;
        }

        /* Meta rows */
        .meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            padding: 8px 0;
            border-bottom: 1px dashed #e8f5f5;
        }

        .meta-row:last-child {
            border-bottom: none;
        }

        .meta-label {
            color: var(--text-muted);
            white-space: nowrap;
            min-width: 95px;
            font-weight: 500;
        }

        .meta-value {
            color: var(--text-dark);
            font-weight: 600;
        }

        .stock-badge-in {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #eaf6ec;
            color: #28a745;
            font-size: .76rem;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
        }

        .stock-badge-out {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #fdecea;
            color: #e74c3c;
            font-size: .76rem;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
        }

        /* ─── QUANTITY ─── */
        .qty-label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .quantity-box {
            border: 1.5px solid #b2e8ea;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            display: inline-flex;
            align-items: stretch;
        }

        .qty-minus,
        .qty-plus {
            width: 38px;
            height: 42px;
            background: var(--green-pale);
            border: none;
            font-size: 1.2rem;
            color: var(--green-dark);
            cursor: pointer;
            transition: background .2s, color .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 400;
            line-height: 1;
        }

        .qty-minus:hover,
        .qty-plus:hover {
            background: var(--green-main);
            color: #fff;
        }

        .qty-input {
            width: 50px;
            height: 42px;
            border: none;
            border-left: 1px solid #b2e8ea;
            border-right: 1px solid #b2e8ea;
            text-align: center;
            font-size: .95rem;
            font-weight: 700;
            color: var(--text-dark);
            outline: none;
            -moz-appearance: textfield;
            background: #fff;
        }

        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        /* ─── CTA BUTTONS ─── */
        .cta-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-cart-main {
            flex: 1;
            min-width: 140px;
            background: var(--green-main);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: .9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            cursor: pointer;
            transition: background .25s, transform .2s, box-shadow .2s;
            letter-spacing: .3px;
        }

        .btn-cart-main:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(43, 170, 173, .3);
        }

        .btn-wishlist {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            border: 1.5px solid #e0f2f2;
            background: #fff;
            color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all .2s;
            flex-shrink: 0;
        }

        .btn-wishlist:hover {
            border-color: #e74c3c;
            color: #e74c3c;
            background: #fdecea;
        }

        /* ─── GUARANTEE STRIP ─── */
        .guarantee-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            padding: 11px;
            background: #f9fefe;
            border-radius: 12px;
            border: 1px solid #e0f2f2;
        }

        .guarantee-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 3px;
            font-size: .7rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .guarantee-item i {
            font-size: 1.1rem;
            color: var(--green-main);
        }

        .guarantee-item strong {
            color: var(--text-dark);
            font-size: .72rem;
        }

        /* ─── TABS ─── */
        .detail-tabs-nav {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #e8f5f5;
            margin-bottom: 0;
        }

        .detail-tab-btn {
            background: none;
            border: none;
            padding: 11px 20px;
            font-size: .875rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 2.5px solid transparent;
            margin-bottom: -2px;
            transition: color .2s, border-color .2s;
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .detail-tab-btn.active {
            color: var(--green-main);
            border-bottom-color: var(--green-main);
        }

        .detail-tab-btn:hover:not(.active) {
            color: var(--text-dark);
        }

        .detail-tabs-body {
            background: #fff;
            border-radius: 0 0 16px 16px;
            border: 1.5px solid #e0f2f2;
            border-top: none;
            padding: 22px 26px;
        }

        .tab-pane-content {
            display: none;
        }

        .tab-pane-content.active {
            display: block;
        }

        /* Description content */
        .description-content {
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.85;
        }

        .description-content h2,
        .description-content h3,
        .description-content h4 {
            font-family: 'Playfair Display', serif;
            color: var(--text-dark);
            margin-top: 20px;
            margin-bottom: 8px;
        }

        .description-content p {
            margin-bottom: 12px;
        }

        .description-content ul,
        .description-content ol {
            padding-left: 18px;
            margin-bottom: 12px;
        }

        .description-content li {
            margin-bottom: 5px;
        }

        .description-content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 10px 0;
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
            font-size: 1.2rem;
            color: var(--text-dark);
            font-weight: 700;
        }

        .related-section .divider-leaf {
            margin-bottom: 16px;
        }

        .rel-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 1.5px solid #f0f0f0;
            transition: all .3s;
            display: block;
            text-decoration: none;
        }

        .rel-card:hover {
            border-color: var(--green-main);
            box-shadow: 0 8px 22px rgba(43, 170, 173, .13);
            transform: translateY(-4px);
        }

        .rel-card__img {
            height: 170px;
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
            padding: 12px 14px 14px;
        }

        .rel-card__name {
            font-family: 'Playfair Display', serif;
            font-size: .875rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .rel-card__price {
            font-size: .9rem;
            font-weight: 700;
            color: var(--green-main);
            margin-bottom: 8px;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1199px) {

            .main-viewer__img-wrap,
            .main-viewer__video-wrap {
                max-height: 380px;
            }
        }

        @media (max-width: 991px) {
            .media-col {
                position: static;
            }

            .main-viewer__img-wrap,
            .main-viewer__video-wrap {
                max-height: 340px;
            }
        }

        @media (max-width: 767px) {
            .product-info {
                padding: 16px 14px;
            }

            .detail-tabs-body {
                padding: 16px 14px;
            }

            .main-viewer__img-wrap,
            .main-viewer__video-wrap {
                max-height: 280px;
            }

            .price-current {
                font-size: 1.4rem;
            }

            .thumb-btn {
                width: 52px;
                height: 52px;
            }

            .guarantee-strip {
                grid-template-columns: repeat(3, 1fr);
                gap: 5px;
            }

            .cta-row {
                flex-direction: column;
            }

            .btn-cart-main {
                width: 100%;
            }

            .btn-wishlist {
                width: 100%;
                border-radius: 12px;
                height: 46px;
            }
        }
    </style>

    <main class="product-detail-page py-3 pb-5">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}"><i
                                class="bi bi-house me-1"></i>Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.product.index') }}">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
                </ol>
            </nav>

            <div class="row g-3 g-lg-4">

                {{-- ══ CỘT MEDIA (trái) ══ --}}
                <div class="col-lg-5 media-col">

                    {{-- Main viewer --}}
                    <div class="main-viewer" id="mainViewer">
                        <div class="main-viewer__img-wrap" id="imgWrap">
                            <img id="mainProductImage"
                                src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/no-image.png') }}"
                                alt="{{ $product->name }}">
                        </div>

                        <div class="main-viewer__video-wrap" id="videoWrap">
                            <iframe id="videoIframe" src="" title="Video sản phẩm"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>

                        <div class="viewer-badge" id="videoBadge" style="display:none;">
                            <i class="bi bi-youtube"></i> Video sản phẩm
                        </div>

                        <button type="button" class="gallery-nav prev" id="galleryPrev"><i
                                class="bi bi-chevron-left"></i></button>
                        <button type="button" class="gallery-nav next" id="galleryNext"><i
                                class="bi bi-chevron-right"></i></button>
                    </div>

                    {{-- Thumb strip --}}
                    <div class="thumb-strip-wrap">
                        <button class="strip-nav-btn prev" id="stripPrev"><i class="bi bi-chevron-left"></i></button>

                        <div class="thumb-strip" id="thumbStrip">

                            @php
                                $videoId = null;
                                $embedUrl = null;
                                if (!empty($product->video_url)) {
                                    $v = $product->video_url;
                                    if (preg_match('/shorts\/([a-zA-Z0-9_-]+)/', $v, $m))
                                        $videoId = $m[1];
                                    elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $v, $m))
                                        $videoId = $m[1];
                                    elseif (preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $v, $m))
                                        $videoId = $m[1];
                                    elseif (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $v, $m))
                                        $videoId = $m[1];
                                    if ($videoId) {
                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId . '?rel=0&playsinline=1&enablejsapi=1';
                                    }
                                }
                            @endphp

                            @if($embedUrl)
                                <button type="button" class="thumb-btn thumb-btn--video" data-type="video"
                                    data-video="{{ $embedUrl }}" title="Xem video sản phẩm">
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="Video"
                                        onerror="this.src='{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/no-image.png') }}'">
                                </button>
                            @endif

                            @if($product->main_image)
                                <button type="button" class="thumb-btn {{ $embedUrl ? '' : 'active' }}" data-type="image"
                                    data-image="{{ asset('storage/' . $product->main_image) }}">
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                </button>
                            @endif

                            @foreach($product->images as $img)
                                <button type="button" class="thumb-btn" data-type="image"
                                    data-image="{{ asset('storage/' . $img->image) }}">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $product->name }}">
                                </button>
                            @endforeach

                        </div>

                        <button class="strip-nav-btn next" id="stripNext"><i class="bi bi-chevron-right"></i></button>
                    </div>

                </div>{{-- /media col --}}

                {{-- ══ CỘT THÔNG TIN (phải) ══ --}}
                <div class="col-lg-7">
                    <div class="product-info">

                        @if($product->categories->count())
                            <div class="mb-2">
                                @foreach($product->categories as $cat)
                                    <span class="product-category-badge">
                                        <i class="bi bi-tag-fill"></i> {{ $cat->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <h1 class="product-title mb-2">{{ $product->name }}</h1>

                        <div class="rating-row mb-3">
                            <span class="stars">★★★★★</span>
                            <span style="color:#ccc">|</span>
                            <span>0 đánh giá</span>
                            <span style="color:#ccc">|</span>
                            <span>{{ $product->sku_code ?? 'SKU đang cập nhật' }}</span>
                        </div>

                        <div class="price-block mb-3">
                            <span class="price-current">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        </div>

                        @if($product->short_description)
                            <p class="product-short-desc mb-3">{{ $product->short_description }}</p>
                        @endif

                        <div class="mb-3">
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-box-seam me-2 text-green"></i>Tình trạng</span>
                                <span>
                                    @if($product->stock_quantity > 0)
                                        <span class="stock-badge-in"><i class="bi bi-check-circle-fill"></i> Còn hàng</span>
                                    @else
                                        <span class="stock-badge-out"><i class="bi bi-x-circle-fill"></i> Hết hàng</span>
                                    @endif
                                </span>
                            </div>
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-truck me-2 text-green"></i>Giao hàng</span>
                                <span class="meta-value">Nội thành trong 2 giờ</span>
                            </div>
                            <div class="meta-row">
                                <span class="meta-label"><i class="bi bi-patch-check me-2 text-green"></i>Bảo đảm</span>
                                <span class="meta-value">Hoa tươi – đổi trả trong 24h</span>
                            </div>
                        </div>

                        @if($product->stock_quantity > 0)
                            <div class="mb-3">
                                <div class="qty-label">Số lượng</div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="quantity-box">
                                        <button type="button" class="qty-minus">−</button>
                                        <input type="number" name="quantity" value="1" min="1"
                                            max="{{ max(1, min($product->stock_quantity, 10)) }}" class="qty-input">
                                        <button type="button" class="qty-plus">+</button>
                                    </div>
                                    <span style="font-size:.8rem;color:var(--text-muted);">
                                        Còn {{ $product->stock_quantity }} sản phẩm
                                    </span>
                                </div>
                            </div>
                            <form class="ajax-add-cart-form"
                                action="{{ route('user.cart.add', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1" class="product-detail-quantity-hidden">
                                <div class="cta-row mb-3">
                                    <button type="submit" class="btn-cart-main">
                                        <i class="bi bi-bag-plus"></i> Thêm vào giỏ hàng
                                    </button>
                                    <a href="{{ route('user.cart.index') }}" class="btn-cart-main"
                                        style="background:#fff;color:var(--green-dark);border:1.5px solid #b2e8ea;text-decoration:none;">
                                        <i class="bi bi-cart3"></i> Xem giỏ hàng
                                    </a>
                                    <button type="button" class="btn-wishlist" title="Lưu yêu thích">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button type="button" class="btn-cart-main mb-3" disabled
                                style="opacity:.5;cursor:not-allowed;width:100%;">
                                <i class="bi bi-x-circle"></i> Sản phẩm đã hết hàng
                            </button>
                        @endif

                        <div class="guarantee-strip">
                            <div class="guarantee-item">
                                <i class="bi bi-flower1"></i>
                                <strong>Hoa tươi</strong>
                                <span>Từ vườn Đà Lạt</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="bi bi-shield-check"></i>
                                <strong>Đổi trả</strong>
                                <span>Trong 24h</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="bi bi-headset"></i>
                                <strong>Hỗ trợ</strong>
                                <span>24/7 Zalo</span>
                            </div>
                        </div>

                    </div>
                </div>{{-- /info col --}}

            </div>{{-- /row --}}

            {{-- ══ TABS ══ --}}
            <div class="mt-4">
                <div style="background:#fff;border-radius:16px 16px 0 0;border:1.5px solid #e0f2f2;border-bottom:none;">
                    <div class="detail-tabs-nav" id="detailTabsNav">
                        <button class="detail-tab-btn active" data-tab="desc">Mô tả sản phẩm</button>
                        <button class="detail-tab-btn" data-tab="spec">Thông tin thêm</button>
                    </div>
                </div>

                <div class="detail-tabs-body">
                    <div class="tab-pane-content description-content active" id="tab-desc">
                        {!! $product->description ?? '<p style="color:var(--text-muted);font-style:italic;">Thông tin sản phẩm đang được cập nhật.</p>' !!}
                    </div>
                    <div class="tab-pane-content" id="tab-spec">
                        <table class="table table-sm" style="font-size:.85rem;">
                            <tbody>
                                <tr>
                                    <td style="color:var(--text-muted);width:140px;">Mã sản phẩm</td>
                                    <td class="fw-600">{{ $product->sku_code ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="color:var(--text-muted);">Tồn kho</td>
                                    <td class="fw-600">{{ $product->stock_quantity }} sản phẩm</td>
                                </tr>
                                @foreach($product->categories as $cat)
                                    <tr>
                                        <td style="color:var(--text-muted);">Danh mục</td>
                                        <td class="fw-600">{{ $cat->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══ SẢN PHẨM LIÊN QUAN ══ --}}
            @if($relatedProducts->count() > 0)
                <section class="related-section mt-4">
                    <h3 class="mb-1">Sản phẩm liên quan</h3>
                    <div class="divider-leaf mb-3"></div>
                    <div class="row g-3">
                        @foreach($relatedProducts as $item)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="rel-card h-100" style="display:flex;flex-direction:column;">
                                    <a href="{{ route('frontend.product.show', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                        class="rel-card__img" style="text-decoration:none;display:block;">
                                        <img src="{{ $item->main_image ? asset('storage/' . $item->main_image) : asset('images/no-image.png') }}"
                                            alt="{{ $item->name }}">
                                    </a>
                                    <div class="rel-card__body" style="flex:1;display:flex;flex-direction:column;">
                                        <div class="rel-card__name" style="flex:1;">{{ $item->name }}</div>
                                        <div class="rel-card__price">{{ number_format($item->price, 0, ',', '.') }}đ</div>
                                        @if($item->stock_quantity > 0 || !$item->track_inventory)
                                            <form class="ajax-add-cart-form"
                                                action="{{ route('user.cart.add', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-add-cart"
                                                    style="border-radius:8px;padding:8px 0;font-size:.8rem;">
                                                    <i class="bi bi-bag-plus me-1"></i>Thêm vào giỏ
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn-add-cart" disabled
                                                style="border-radius:8px;padding:8px 0;font-size:.8rem;opacity:.65;">
                                                Hết hàng
                                            </button>
                                        @endif
                                    </div>
                                </div>
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
            const mainImg = document.getElementById('mainProductImage');
            const imgWrap = document.getElementById('imgWrap');
            const videoWrap = document.getElementById('videoWrap');
            const videoIframe = document.getElementById('videoIframe');
            const videoBadge = document.getElementById('videoBadge');
            const btnPrev = document.getElementById('galleryPrev');
            const btnNext = document.getElementById('galleryNext');
            const strip = document.getElementById('thumbStrip');
            const sPrev = document.getElementById('stripPrev');
            const sNext = document.getElementById('stripNext');

            if (!thumbs.length) return;

            const imageThumbs = thumbs.filter(t => t.dataset.type === 'image');
            let imgCurrent = 0;
            let isVideo = false;

            function showImage(index) {
                isVideo = false;
                imgCurrent = (index + imageThumbs.length) % imageThumbs.length;
                imgWrap.style.display = '';
                videoWrap.classList.remove('is-active');
                videoBadge.style.display = 'none';
                btnPrev.style.display = '';
                btnNext.style.display = '';
                videoIframe.src = '';
                mainImg.src = imageThumbs[imgCurrent].dataset.image;
                thumbs.forEach(b => b.classList.remove('active'));
                imageThumbs[imgCurrent].classList.add('active');
                imageThumbs[imgCurrent].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            function showVideo(embedUrl, btn) {
                isVideo = true;
                imgWrap.style.display = 'none';
                videoWrap.classList.add('is-active');
                videoBadge.style.display = 'flex';
                btnPrev.style.display = 'none';
                btnNext.style.display = 'none';
                videoIframe.src = embedUrl + '&autoplay=1';
                thumbs.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }

            thumbs.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (btn.dataset.type === 'video') {
                        showVideo(btn.dataset.video, btn);
                    } else {
                        showImage(imageThumbs.indexOf(btn));
                    }
                });
            });

            btnPrev?.addEventListener('click', () => showImage(imgCurrent - 1));
            btnNext?.addEventListener('click', () => showImage(imgCurrent + 1));
            sPrev?.addEventListener('click', () => strip.scrollBy({ left: -140, behavior: 'smooth' }));
            sNext?.addEventListener('click', () => strip.scrollBy({ left: 140, behavior: 'smooth' }));

            /* Drag strip */
            let isDown = false, startX, scrollLeft0;
            strip.addEventListener('mousedown', e => {
                isDown = true; startX = e.pageX - strip.offsetLeft; scrollLeft0 = strip.scrollLeft;
                strip.style.cursor = 'grabbing';
            });
            strip.addEventListener('mouseleave', () => { isDown = false; strip.style.cursor = 'grab'; });
            strip.addEventListener('mouseup', () => { isDown = false; strip.style.cursor = 'grab'; });
            strip.addEventListener('mousemove', e => {
                if (!isDown) return;
                e.preventDefault();
                strip.scrollLeft = scrollLeft0 - (e.pageX - strip.offsetLeft - startX);
            });

            /* Swipe main image */
            let tx = 0;
            const viewer = document.getElementById('mainViewer');
            viewer.addEventListener('touchstart', e => { tx = e.touches[0].clientX; }, { passive: true });
            viewer.addEventListener('touchend', e => {
                const diff = tx - e.changedTouches[0].clientX;
                if (!isVideo && Math.abs(diff) > 40) {
                    diff > 0 ? showImage(imgCurrent + 1) : showImage(imgCurrent - 1);
                }
            });

            /* Init */
            const firstImg = imageThumbs[0];
            if (firstImg) firstImg.classList.add('active');

            /* Quantity */
            const qInput = document.querySelector('.qty-input');
            const hiddenQtyInput = document.querySelector('.product-detail-quantity-hidden');
            if (qInput) {
                const syncQuantity = () => {
                    const max = Number(qInput.max || 99);
                    const min = Number(qInput.min || 1);
                    let v = Number(qInput.value || min);
                    if (v < min) v = min;
                    if (v > max) v = max;
                    qInput.value = v;
                    if (hiddenQtyInput) hiddenQtyInput.value = v;
                };
                document.querySelector('.qty-minus')?.addEventListener('click', () => { if (+qInput.value > 1) qInput.value--; syncQuantity(); });
                document.querySelector('.qty-plus')?.addEventListener('click', () => { if (+qInput.value < +qInput.max) qInput.value++; syncQuantity(); });
                qInput.addEventListener('input', syncQuantity);
                qInput.addEventListener('change', syncQuantity);
                syncQuantity();
            }

            /* Detail Tabs */
            document.querySelectorAll('.detail-tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.detail-tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-pane-content').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('tab-' + btn.dataset.tab)?.classList.add('active');
                });
            });
        })();
    </script>
@endsection