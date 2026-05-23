@extends('layouts.frontend.app')
@section('content')

    <style>
        /* ─── HERO ─── */
        .hero-section {
            position: relative;
            min-height: 460px;
            overflow: hidden;
        }

        /* Background slides */
        .hero-bg-slides {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-bg-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.2s ease;
        }

        .hero-bg-slide.active {
            opacity: 1;
        }

        /* Overlay */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(15, 46, 47, 0.75) 0%,
                    rgba(43, 170, 173, 0.4) 100%);
            z-index: 1;
        }

        /* Nội dung */
        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        /* Dots */
        .hero-bg-dots {
            position: absolute;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 7px;
            z-index: 3;
        }

        .hero-bg-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .4);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all .3s;
        }

        .hero-bg-dot.active {
            background: #fff;
            width: 22px;
            border-radius: 4px;
        }

        /* Nút prev/next */
        .hero-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, .35);
            background: rgba(255, 255, 255, .12);
            color: #fff;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s;
            backdrop-filter: blur(4px);
        }

        .hero-nav-btn:hover {
            background: rgba(255, 255, 255, .28);
        }

        .hero-nav-btn.prev {
            left: 14px;
        }

        .hero-nav-btn.next {
            right: 14px;
        }

        /* ─── ẢNH TRÒN (giữ nguyên) ─── */
        .hero-img-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flower-circle {
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, .2);
            overflow: hidden;
            flex-shrink: 0;
        }

        .flower-circle img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, .3);
        }

        .hero-float-badge {
            position: absolute;
            background: #fff;
            border-radius: 12px;
            padding: 10px 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            font-size: 0.8rem;
            z-index: 2;
        }

        .hero-float-badge.top-right {
            top: 30px;
            right: -20px;
        }

        .hero-float-badge.bottom-left {
            bottom: 40px;
            left: -20px;
        }

        .hero-float-badge strong {
            color: var(--green-main);
            font-size: 1.1rem;
            display: block;
        }

        @media (max-width: 767px) {
            .hero-section {
                min-height: 320px;
            }

            .hero-img-wrapper {
                display: none;
            }

            .hero-nav-btn {
                display: none;
            }
        }
    </style>

    <div>
        @include('admin.partials.alert')
    </div>



    <section class="hero-section">

        {{-- ── Background slider ── --}}
        @php
            $bgSlides = [
                'storage/baner/baner1.jpg',
                'storage/baner/baner2.jpg',
                'storage/baner/baner4.jpg',
            ];
        @endphp

        <div class="hero-bg-slides" id="heroBgSlides">
            @foreach ($bgSlides as $i => $slide)
                <div class="hero-bg-slide {{ $i === 0 ? 'active' : '' }}" style="background-image:url('{{ asset($slide) }}')">
                </div>
            @endforeach
        </div>

        <div class="hero-overlay"></div>

        {{-- Prev / Next --}}
        <button class="hero-nav-btn prev" id="heroPrev" aria-label="Ảnh trước">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="hero-nav-btn next" id="heroNext" aria-label="Ảnh tiếp">
            <i class="bi bi-chevron-right"></i>
        </button>

        {{-- ── Nội dung ── --}}
        <div class="container py-5">
            <div class="row align-items-center g-4" style="min-height:400px">

                {{-- Cột trái --}}
                <div class="col-lg-6 py-4">
                    <div class="hero-badge">🌿 Shop hoa tươi uy tín</div>
                    <h1 class="hero-title mb-3">
                        Gửi trọn <em>yêu thương</em><br>qua từng đóa hoa
                    </h1>
                    <p class="hero-subtitle mb-4">
                        Hoa tươi mỗi ngày – giao hàng nhanh trong 2 giờ – thiết kế theo yêu cầu.
                        Hơn 500 mẫu hoa cho mọi dịp đặc biệt.
                    </p>
                    <div class="hero-cta d-flex gap-3 flex-wrap">
                        <a href="#" class="btn-primary-hero">Đặt hoa ngay <i class="bi bi-arrow-right ms-1"></i></a>
                        <a href="#" class="btn-outline-hero"><i class="bi bi-whatsapp me-1"></i> Tư vấn miễn phí</a>
                    </div>
                    <div class="d-flex gap-4 mt-4">
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">500+</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Mẫu hoa</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">10K+</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Khách hàng</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">8 năm</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Kinh nghiệm</div>
                        </div>
                    </div>
                </div>

                {{-- Cột phải: ảnh tròn + badges (giữ nguyên) --}}
                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <div class="hero-img-wrapper">
                        <div class="flower-circle">
                            <img src="{{ asset('storage/baner/baner.jpg') }}" alt="Hoa tươi Mộc Hương">
                        </div>
                        <div class="hero-float-badge top-right">
                            <strong>Hoa Cưới</strong>
                            <span style="font-size:.72rem;color:#666;">Hạnh phúc trăm năm</span>
                        </div>
                        <div class="hero-float-badge bottom-left">
                            <strong>Lễ Tốt Nghiệp</strong>
                            <span style="font-size:.72rem;color:#666;">Lưu giữ khoảnh khắc</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Dots --}}
        <div class="hero-bg-dots" id="heroBgDots">
            @foreach ($bgSlides as $i => $slide)
                <button class="hero-bg-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></button>
            @endforeach
        </div>

    </section>



    <section style="background:#fff;padding:28px 0;border-bottom:1px solid #f0f0f0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🌿</div>
                        <div>
                            <div class="feature-title">Hoa tươi mỗi ngày</div>
                            <div class="feature-desc">Nhập hoa trực tiếp từ vườn Đà Lạt</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🚚</div>
                        <div>
                            <div class="feature-title">Giao hàng nhanh</div>
                            <div class="feature-desc">Trong vòng 2 giờ nội thành</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🎨</div>
                        <div>
                            <div class="feature-title">Thiết kế theo yêu cầu</div>
                            <div class="feature-desc">Tùy chỉnh màu sắc & kiểu dáng</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">💬</div>
                        <div>
                            <div class="feature-title">Tư vấn 24/7</div>
                            <div class="feature-desc">Hỗ trợ qua Zalo & điện thoại</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-py">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Danh mục</div>
                <h2 class="section-title">Khám phá theo dịp</h2>
                <div class="divider-leaf mx-auto"></div>
            </div>
            <div class="row g-3">
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">💍</div>
                        <span>Hoa cưới</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎂</div>
                        <span>Sinh nhật</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🏪</div>
                        <span>Khai trương</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎓</div>
                        <span>Tốt nghiệp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🌸</div>
                        <span>Lan hồ điệp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎁</div>
                        <span>Quà tặng</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🪴</div>
                        <span>Cây văn phòng</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🧺</div>
                        <span>Giỏ quà tết</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🍰</div>
                        <span>Bánh kem</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🍓</div>
                        <span>Giỏ trái cây</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🕯️</div>
                        <span>Hoa sáp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🌹</div>
                        <span>Hoa độc đáo</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ═══════════════════════════════════════
                                                                                     FEATURED PRODUCTS
                                                                                    ═══════════════════════════════════════ -->
    <section class="section-py bg-pale">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Bán chạy nhất</div>
                    <h2 class="section-title mb-0">Sản phẩm nổi bật</h2>
                    <div class="divider-leaf"></div>
                </div>
                <a href="{{ route('frontend.product.index') }}" class="btn-outline-green d-none d-md-inline-block">
                    Xem tất cả
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <!-- Filter tabs -->
            <ul class="nav filter-tabs mb-4 gap-2 flex-wrap" role="tablist">
                @foreach ($parentCategories as $parentCategory)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="product-tab-{{ $parentCategory->id }}"
                            data-bs-toggle="tab" data-bs-target="#product-category-{{ $parentCategory->id }}" type="button"
                            role="tab">
                            {{ $parentCategory->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($parentCategories as $parentCategory)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                        id="product-category-{{ $parentCategory->id }}" role="tabpanel"
                        aria-labelledby="product-tab-{{ $parentCategory->id }}">

                        <div class="row g-3">
                            @forelse ($productsByCategory[$parentCategory->id] ?? [] as $product)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <a href="{{ route('frontend.product.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                        class="product-card h-100 text-decoration-none d-block">
                                        <div class="img-wrap">
                                            @if ($product->main_image)
                                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->name }}">
                                            @endif

                                            @if ($product->is_featured)
                                                <span class="product-badge bg-danger text-white">
                                                    Nổi bật
                                                </span>
                                            @endif

                                            <button class="product-wishlist" onclick="event.preventDefault()">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </div>

                                        <div class="product-body">
                                            <div class="product-stars mb-1">
                                                ★★★★★
                                                <span style="color:#aaa;font-size:.75rem">(0)</span>
                                            </div>

                                            <div class="product-name">
                                                {{ $product->name }}
                                            </div>

                                            <div class="mt-2 mb-3">
                                                <span class="product-price">
                                                    {{ number_format($product->price, 0, ',', '.') }}đ
                                                </span>
                                            </div>

                                            <form class="ajax-add-cart-form"
                                                action="{{ route('user.cart.add', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                method="POST">
                                                @csrf

                                                <input type="hidden" name="quantity" value="1">

                                                <button type="submit" class="btn-add-cart">
                                                    <i class="bi bi-bag-plus me-1"></i>
                                                    Thêm vào giỏ
                                                </button>
                                            </form>

                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center text-muted py-5">
                                        Chưa có sản phẩm trong danh mục này.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="#" class="btn-green">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
                                                                                     PROMO BANNERS
                                                                    ═══════════════════════════════════════ -->
    <section class="section-py">
        <div class="container">
            <div class="row g-3">
                <!-- Big banner -->
                <div class="col-md-6">
                    <div class="promo-banner promo-banner-1" style="min-height:240px;">
                        <div class="promo-banner-content">
                            <div
                                style="font-size:.75rem;color:#8dd5d7;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                Ưu đãi đặc biệt</div>
                            <h3 style="color:#fff;font-family:'Playfair Display',serif;margin:10px 0;">Hoa cưới trọn
                                gói<br><em>Giảm
                                    25%</em></h3>
                            <p style="color:#b2e8ea;font-size:.85rem;margin-bottom:18px;">Dịch vụ trang trí đám cưới từ
                                A-Z. Đặt lịch
                                trước 30 ngày.</p>
                            <a href="#" class="btn-primary-hero" style="padding:10px 24px;font-size:.85rem;">Xem ngay
                                →</a>
                        </div>
                    </div>
                </div>
                <!-- Two small banners -->
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="promo-banner promo-banner-2" style="min-height:110px;">
                                <div class="promo-banner-content" style="padding:20px 24px;">
                                    <div
                                        style="font-size:.72rem;color:#f0c8a0;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                        Mỗi ngày</div>
                                    <h5 style="color:#fff;font-family:'Playfair Display',serif;margin:6px 0 8px;">Combo
                                        hoa + bánh
                                        kem<br>chỉ từ <span style="color:#f0c88c;">599.000đ</span></h5>
                                    <a href="#"
                                        style="color:#f0c88c;font-size:.82rem;font-weight:600;text-decoration:none;">Đặt
                                        ngay
                                        →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="promo-banner promo-banner-3" style="min-height:110px;">
                                <div class="promo-banner-content" style="padding:20px 24px;">
                                    <div
                                        style="font-size:.72rem;color:#a0b8f0;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                        Tặng kèm</div>
                                    <h5 style="color:#fff;font-family:'Playfair Display',serif;margin:6px 0 8px;">Thiệp
                                        & ruy-băng miễn
                                        phí<br>cho mọi đơn từ <span style="color:#a0c8f0;">200.000đ</span></h5>
                                    <a href="#"
                                        style="color:#a0c8f0;font-size:.82rem;font-weight:600;text-decoration:none;">Tìm
                                        hiểu
                                        →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
                                                                                     TESTIMONIALS
                                                                                    ═══════════════════════════════════════ -->
    <section class="section-py bg-pale">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Khách hàng nói gì</div>
                <h2 class="section-title">Đánh giá từ trái tim</h2>
                <div class="divider-leaf mx-auto"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Hoa rất tươi và đẹp, đúng như hình ảnh. Giao hàng nhanh chóng, gói
                            hàng cẩn
                            thận. Mình rất hài lòng và sẽ tiếp tục ủng hộ shop!"</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--green-main);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                T</div>
                            <div>
                                <div class="testimonial-author">Thảo Nguyên</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng thân thiết
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Đặt hoa cưới tại đây, phục vụ rất chuyên nghiệp. Nhân viên tư vấn
                            nhiệt tình,
                            mẫu hoa đẹp không thua gì nước ngoài. Cảm ơn team Mộc Hương!"</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                M</div>
                            <div>
                                <div class="testimonial-author">Minh Khoa</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng cưới 2024
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Mua hoa tươi mỗi tuần tại đây từ 2 năm nay. Giá cả hợp lý, chất
                            lượng ổn định.
                            Đặc biệt dịch vụ đặt theo yêu cầu rất linh hoạt và sáng tạo."</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:#e74c3c;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                L</div>
                            <div>
                                <div class="testimonial-author">Lan Phương</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng VIP</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
                                                                                     BLOG / TIN TỨC
                                                                                    ═══════════════════════════════════════ -->
    <section class="section-py">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Tin tức & cẩm nang</div>
                    <h2 class="section-title mb-0">Bí quyết chọn hoa</h2>
                    <div class="divider-leaf"></div>
                </div>
                <a href="#" class="btn-outline-green d-none d-md-inline-block">Xem thêm <i
                        class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/05.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Cẩm nang hoa</div>
                            <h5 class="blog-title"><a href="#">10 loại hoa tặng mẹ ý nghĩa nhất nhân dịp 20/10</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 15/10/2024 · 5 phút đọc</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/06.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Hoa cưới</div>
                            <h5 class="blog-title"><a href="#">Xu hướng hoa cưới 2025: minimalist & tự nhiên</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 08/10/2024 · 7 phút đọc</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/07.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Mẹo hay</div>
                            <h5 class="blog-title"><a href="#">Cách bảo quản hoa tươi lâu hơn tại nhà</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 01/10/2024 · 4 phút đọc</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
                                                                                     NEWSLETTER
                                                                                    ═══════════════════════════════════════ -->
    <section class="py-5">
        <div class="container">
            <div class="newsletter-section p-4 p-md-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-12">
                        <div style="font-size:2rem;margin-bottom:8px;">🌸</div>
                        <h3 style="color:#fff;font-family:'Playfair Display',serif;margin-bottom:10px;">
                            Đăng ký nhận ưu đãi
                        </h3>
                        <p style="color:#b2e8ea;font-size:.88rem;margin-bottom:24px;">
                            Nhận thông báo khuyến mãi và mẹo cắm hoa mỗi tuần qua email
                        </p>

                        <!-- Desktop: ngang | Mobile: dọc -->
                        <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-0">
                            <input type="email" class="newsletter-input flex-grow-1" placeholder="Email của bạn..." />
                            <button class="newsletter-btn">Đăng ký</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        (function () {
            const slides = Array.from(document.querySelectorAll('.hero-bg-slide'));
            const dots = Array.from(document.querySelectorAll('.hero-bg-dot'));
            const btnPrev = document.getElementById('heroPrev');
            const btnNext = document.getElementById('heroNext');
            let current = 0;
            let timer;

            if (!slides.length) return;

            function goTo(index) {
                slides[current].classList.remove('active');
                dots[current]?.classList.remove('active');
                current = (index + slides.length) % slides.length;
                slides[current].classList.add('active');
                dots[current]?.classList.add('active');
            }

            function restart() {
                clearInterval(timer);
                timer = setInterval(function () { goTo(current + 1); }, 5000);
            }

            dots.forEach(function (dot, i) {
                dot.addEventListener('click', function () { goTo(i); restart(); });
            });

            if (btnPrev) btnPrev.addEventListener('click', function () { goTo(current - 1); restart(); });
            if (btnNext) btnNext.addEventListener('click', function () { goTo(current + 1); restart(); });

            // Swipe mobile
            let tx = 0;
            const sec = document.querySelector('.hero-section');
            sec.addEventListener('touchstart', function (e) { tx = e.touches[0].clientX; }, { passive: true });
            sec.addEventListener('touchend', function (e) {
                const diff = tx - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) { diff > 0 ? goTo(current + 1) : goTo(current - 1); restart(); }
            });

            restart();
        })();
    </script>

@endsection