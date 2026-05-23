@extends('layouts.frontend.app')

@section('title', $product->meta_title ?? $product->name)

@section('content')
    <style>
        /* ─── PRODUCT DETAIL PAGE ─── */
        .product-detail-page {
            background: var(--cream);
        }

        /* Breadcrumb */
        .product-detail-page .breadcrumb {
            font-size: 0.82rem;
            color: var(--text-muted);
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

        /* ─── GALLERY ─── */
        .main-image-box {
            position: relative;
            width: 100%;
            height: 420px;
            border-radius: 20px;
            overflow: hidden;
            border: 1.5px solid #e8f5f5;
            background: #fff;
            margin-bottom: 12px;
        }

        .main-image-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform .4s;
            display: block;
        }

        .main-image-box:hover img {
            transform: scale(1.04);
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, .85);
            color: var(--green-dark);
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .12);
            transition: background .2s, color .2s;
        }

        .gallery-nav:hover {
            background: var(--green-main);
            color: #fff;
        }

        .gallery-nav.prev {
            left: 10px;
        }

        .gallery-nav.next {
            right: 10px;
        }

        .thumb-list {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .thumb-btn {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid transparent;
            padding: 0;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
            flex-shrink: 0;
        }

        .thumb-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .thumb-btn:hover {
            border-color: var(--green-accent);
        }

        .thumb-btn.active {
            border-color: var(--green-main);
            box-shadow: 0 0 0 3px var(--green-pale);
        }

        /* ─── PRODUCT INFO ─── */
        .product-info {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e8f5f5;
            padding: 32px 28px;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.4rem, 3vw, 1.9rem);
            color: var(--text-dark);
            font-weight: 700;
            line-height: 1.3;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--green-main);
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .product-short-description {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.75;
            border-left: 3px solid var(--green-accent);
            padding-left: 14px;
        }

        .product-info .fw-semibold {
            color: var(--text-dark);
            font-size: 0.875rem;
        }

        .product-info .fw-semibold+span {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-left: 6px;
        }

        /* ─── QUANTITY BOX ─── */
        .quantity-box {
            border: 1.5px solid #b2e8ea;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            display: inline-flex;
            align-items: center;
        }

        .qty-minus,
        .qty-plus {
            width: 40px;
            height: 44px;
            background: var(--green-pale);
            border: none;
            font-size: 1.2rem;
            color: var(--green-dark);
            cursor: pointer;
            transition: background .2s, color .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .qty-minus:hover,
        .qty-plus:hover {
            background: var(--green-main);
            color: #fff;
        }

        .qty-input {
            width: 52px;
            height: 44px;
            border: none;
            border-left: 1px solid #b2e8ea;
            border-right: 1px solid #b2e8ea;
            text-align: center;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            outline: none;
            -moz-appearance: textfield;
        }

        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .product-info .btn-add-cart {
            padding: 14px 36px;
            font-size: 0.95rem;
            border-radius: 50px;
            width: auto;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── DESCRIPTION SECTION ─── */
        .product-description {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e8f5f5;
            padding: 36px 32px;
        }

        .product-description h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--text-dark);
            font-weight: 700;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--green-pale);
            margin-bottom: 20px !important;
        }

        .description-content {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.85;
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

        .description-content ul,
        .description-content ol {
            padding-left: 20px;
            margin-bottom: 14px;
        }

        .description-content li {
            margin-bottom: 6px;
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

        /* ─── RELATED PRODUCTS ─── */
        .related-products h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--text-dark);
            font-weight: 700;
        }

        .product-card .product-card-img {
            display: block;
            height: 200px;
            overflow: hidden;
            background: #f9f9f9;
        }

        .product-card .product-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .product-card:hover .product-card-img img {
            transform: scale(1.06);
        }

        .product-card-body {
            padding: 14px 16px 16px;
        }

        .product-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-title a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .product-card-title a:hover {
            color: var(--green-main);
        }

        .product-card-price {
            font-size: 1rem;
            font-weight: 700;
            color: var(--green-main);
            margin-bottom: 12px;
        }

        .btn-add-cart.btn-sm {
            padding: 8px 0;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .badge.bg-success-subtle {
            background: var(--green-pale) !important;
            color: var(--green-dark) !important;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 50px;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 767px) {
            .main-image-box {
                height: 280px;
            }

            .product-info {
                padding: 20px 16px;
            }

            .product-description {
                padding: 24px 16px;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .thumb-btn {
                width: 60px;
                height: 60px;
            }
        }
    </style>

    <main class="product-detail-page py-4">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Sản phẩm</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="row g-4">
                {{-- Ảnh sản phẩm --}}
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div class="main-image-box">
                            <button type="button" class="gallery-nav prev">
                                <i class="bi bi-chevron-left"></i>
                            </button>

                            <img id="mainProductImage"
                                src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/no-image.png') }}"
                                alt="{{ $product->name }}">

                            <button type="button" class="gallery-nav next">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>

                        <div class="thumb-list">
                            @if($product->main_image)
                                <button type="button" class="thumb-btn active"
                                    data-image="{{ asset('storage/' . $product->main_image) }}">
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                </button>
                            @endif

                            @foreach($product->images as $image)
                                <button type="button" class="thumb-btn" data-image="{{ asset('storage/' . $image->image) }}">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Thông tin sản phẩm --}}
                <div class="col-lg-6">
                    <div class="product-info">
                        <div class="mb-2">
                            @foreach($product->categories as $category)
                                <span class="badge bg-success-subtle text-success me-1">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <h1 class="product-title mb-3">{{ $product->name }}</h1>

                        <div class="product-price mb-3">
                            {{ number_format($product->price, 0, ',', '.') }}đ
                        </div>

                        @if($product->short_description)
                            <p class="product-short-description mb-4">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <div class="mb-3">
                            <span class="fw-semibold">Mã sản phẩm:</span>
                            <span>{{ $product->sku ?? 'Đang cập nhật' }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="fw-semibold">Tình trạng:</span>
                            @if($product->stock_quantity > 0)
                                <span class="text-success">Còn hàng</span>
                            @else
                                <span class="text-danger">Hết hàng</span>
                            @endif
                        </div>

                        @if($product->stock_quantity > 0)
                            <form class="ajax-add-cart-form"
                                action="{{ route('user.cart.add', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                method="POST">
                                @csrf

                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="quantity-box d-flex align-items-center">
                                        <button type="button" class="qty-minus">-</button>
                                        <input type="number" name="quantity" value="1" min="1" max="10" class="qty-input">
                                        <button type="button" class="qty-plus">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-add-cart">
                                    <i class="bi bi-bag-plus me-1"></i>
                                    Thêm vào giỏ
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>
                                Sản phẩm đã hết hàng
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Mô tả chi tiết --}}
            <section class="product-description mt-5">
                <h3 class="mb-3">Mô tả sản phẩm</h3>
                <div class="description-content">
                    {!! $product->description ?? '<p>Thông tin sản phẩm đang được cập nhật.</p>' !!}
                </div>
            </section>

            {{-- Sản phẩm liên quan --}}
            @if($relatedProducts->count() > 0)
                <section class="related-products mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Sản phẩm liên quan</h3>
                    </div>

                    <div class="row g-4">
                        @foreach($relatedProducts as $item)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="product-card">
                                    <a href="{{ route('product.show', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                        class="product-card-img">
                                        <img src="{{ $item->main_image ? asset('storage/' . $item->main_image) : asset('images/no-image.png') }}"
                                            alt="{{ $item->name }}">
                                    </a>

                                    <div class="product-card-body">
                                        <h4 class="product-card-title">
                                            <a href="{{ route('product.show', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                                {{ $item->name }}
                                            </a>
                                        </h4>

                                        <div class="product-card-price">
                                            {{ number_format($item->price, 0, ',', '.') }}đ
                                        </div>

                                        <form class="ajax-add-cart-form"
                                            action="{{ route('user.cart.add', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn-add-cart btn-sm w-100">
                                                <i class="bi bi-bag-plus me-1"></i>
                                                Thêm vào giỏ
                                            </button>
                                        </form>
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
            const btnPrev = document.querySelector('.gallery-nav.prev');
            const btnNext = document.querySelector('.gallery-nav.next');

            if (!thumbs.length || !mainImg) return;

            let current = 0;

            function goTo(index) {
                thumbs[current].classList.remove('active');
                current = (index + thumbs.length) % thumbs.length;
                mainImg.src = thumbs[current].dataset.image;
                thumbs[current].classList.add('active');
            }

            thumbs.forEach(function (btn, i) {
                btn.addEventListener('click', function () { goTo(i); });
            });

            if (btnPrev) btnPrev.addEventListener('click', function () { goTo(current - 1); });
            if (btnNext) btnNext.addEventListener('click', function () { goTo(current + 1); });

            // Quantity box
            const qtyInput = document.querySelector('.qty-input');
            if (qtyInput) {
                document.querySelector('.qty-minus').addEventListener('click', function () {
                    if (qtyInput.value > 1) qtyInput.value--;
                });
                document.querySelector('.qty-plus').addEventListener('click', function () {
                    if (qtyInput.value < 10) qtyInput.value++;
                });
            }
        })();
    </script>
@endsection