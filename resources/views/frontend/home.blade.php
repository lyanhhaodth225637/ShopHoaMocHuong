@extends('layouts.frontend.app')
@section('meta_description', 'Hoa Mộc Hương chuyên hoa tươi, sen đá, cây cảnh và quà tặng tại Long Xuyên. Đặt hoa nhanh, thiết kế theo yêu cầu, giao nội thành trong 2 giờ.')
@section('meta_keywords', 'hoa tươi Long Xuyên, shop hoa Mộc Hương, đặt hoa online, sen đá Long Xuyên, cây cảnh quà tặng')
@section('og_image', !empty($hero?->circle_image) ? asset('storage/' . $hero->circle_image) : asset('assets/img/logo.png'))
@section('title', 'Trang Chủ')
@section('content')
    <div>
        @include('admin.partials.alert')
    </div>
    <section class="hero-section">
        {{-- ── Background slider ── --}}
        <div class="hero-bg-slides" id="heroBgSlides">
            @forelse ($heroSlides as $i => $slide)
                <div class="hero-bg-slide {{ $i === 0 ? 'active' : '' }}" data-desktop="{{ asset('storage/' . $slide->image) }}"
                    data-mobile="{{ $slide->mobile_image ? asset('storage/' . $slide->mobile_image) : asset('storage/' . $slide->image) }}">
                </div>
            @empty
                <div class="hero-bg-slide active" data-desktop="{{ asset('storage/baner/baner1.jpg') }}"
                    data-mobile="{{ asset('storage/baner/baner1.jpg') }}">
                </div>
            @endforelse
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
                    <div class="hero-badge">
                        🌿 {{ $hero->badge_text ?? 'Shop hoa tươi uy tín' }}
                    </div>

                    <h1 class="hero-title mb-3">
                        {{ $hero->title_line_1 ?? 'Gửi trọn' }}
                        <em>{{ $hero->title_highlight ?? 'yêu thương' }}</em><br>
                        {{ $hero->title_line_2 ?? 'qua từng đóa hoa' }}
                    </h1>

                    <p class="hero-subtitle mb-4">
                        {{ $hero->subtitle ?? 'Hoa tươi mỗi ngày – giao hàng nhanh trong 2 giờ – thiết kế theo yêu cầu. Hơn 500 mẫu hoa cho mọi dịp đặc biệt.' }}
                    </p>

                    <div class="hero-cta d-flex gap-3 flex-wrap">
                        <a href="{{ $hero->primary_button_link ?? '#' }}" class="btn-primary-hero">
                            {{ $hero->primary_button_text ?? 'Đặt hoa ngay' }}
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <a href="{{ $hero->secondary_button_link ?? '#' }}" class="btn-outline-hero">
                            <i class="bi bi-whatsapp me-1"></i>
                            {{ $hero->secondary_button_text ?? 'Tư vấn miễn phí' }}
                        </a>
                    </div>

                    <div class="d-flex gap-4 mt-4">
                        @forelse ($heroStats as $stat)
                            <div>
                                <div style="font-size:1.4rem;font-weight:700;color:#fff;">
                                    {{ $stat->value }}
                                </div>
                                <div style="font-size:0.78rem;color:#7ec8ca;">
                                    {{ $stat->label }}
                                </div>
                            </div>

                            @if (!$loop->last)
                                <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                            @endif
                        @empty
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
                        @endforelse
                    </div>
                </div>

                {{-- Cột phải --}}
                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <div class="hero-img-wrapper">
                        <div class="flower-circle">
                            <img src="{{ !empty($hero?->circle_image) ? asset('storage/' . $hero->circle_image) : asset('storage/baner/baner.jpg') }}"
                                alt="Hoa tươi Mộc Hương">
                        </div>

                        <div class="hero-float-badge top-right">
                            <strong>{{ $hero->float_badge_1_title ?? 'Hoa Cưới' }}</strong>
                            <span style="font-size:.72rem;color:#666;">
                                {{ $hero->float_badge_1_subtitle ?? 'Hạnh phúc trăm năm' }}
                            </span>
                        </div>

                        <div class="hero-float-badge bottom-left">
                            <strong>{{ $hero->float_badge_2_title ?? 'Lễ Tốt Nghiệp' }}</strong>
                            <span style="font-size:.72rem;color:#666;">
                                {{ $hero->float_badge_2_subtitle ?? 'Lưu giữ khoảnh khắc' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Dots --}}
        <div class="hero-bg-dots" id="heroBgDots">
            @forelse ($heroSlides as $i => $slide)
                <button class="hero-bg-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></button>
            @empty
                <button class="hero-bg-dot active" data-index="0"></button>
            @endforelse
        </div>

    </section>

    @if(isset($featureBoxes) && $featureBoxes->count())
        <section style="background:#fff;padding:28px 0;border-bottom:1px solid #f0f0f0;">
            <div class="container">
                <div class="row g-4">
                    @foreach($featureBoxes as $featureBox)
                        <div class="col-6 col-md-3">
                            <a href="{{ $featureBox->link_url ?? '#' }}" class="feature-box text-decoration-none"
                                @if($featureBox->is_external) target="_blank" rel="noopener noreferrer" @endif>

                                <div class="feature-icon">
                                    @if($featureBox->icon)
                                        <i class="{{ $featureBox->icon }}"></i>
                                    @endif
                                </div>

                                <div>
                                    <div class="feature-title">
                                        {{ $featureBox->title }}
                                    </div>

                                    <div class="feature-desc">
                                        {{ $featureBox->description }}
                                    </div>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($occasionCategories) && $occasionCategories->count())
        <section class="section-py">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-label">Danh mục</div>
                    <h2 class="section-title">Khám phá theo dịp</h2>
                    <div class="divider-leaf mx-auto"></div>
                </div>

                <div class="row g-3">
                    @foreach($occasionCategories as $occasionCategory)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{ $occasionCategory->link_url ?? '#' }}" class="cat-card">
                                <div class="cat-icon">
                                    <i class=" {{ $occasionCategory->icon }}"></i>
                                </div>

                                <span>
                                    {{ $occasionCategory->title }}
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
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
            <ul class="nav filter-tabs mb-4 gap-2 flex-nowrap overflow-auto product-tabs-scroll" role="tablist">
                @foreach ($parentCategories as $parentCategory)
                    <li class="nav-item flex-shrink-0" role="presentation">
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
    @if(isset($promoBanners) && $promoBanners->count())
        @php
            $bigBanner = $promoBanners->where('size', 'big')->first();
            $smallBanners = $promoBanners->where('size', 'small')->take(2);
        @endphp

        <section class="section-py">
            <div class="container">
                <div class="row g-3">

                    {{-- Big banner --}}
                    @if($bigBanner)
                        <div class="col-md-6">
                            <div class="promo-banner {{ $bigBanner->css_class }}" style="
                                                                                min-height:240px;
                                                                                @if($bigBanner->image)
                                                                                    background-image:url('{{ asset('storage/' . $bigBanner->image) }}');
                                                                                @endif
                                                                             ">
                                <div class="promo-banner-content">
                                    @if($bigBanner->badge_text)
                                        <div
                                            style="font-size:.75rem;color:#8dd5d7;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                            {{ $bigBanner->badge_text }}
                                        </div>
                                    @endif

                                    <h3 style="color:#fff;font-family:'Playfair Display',serif;margin:10px 0;">
                                        {{ $bigBanner->title }}

                                        @if($bigBanner->highlight_text)
                                            <br>
                                            <em>{{ $bigBanner->highlight_text }}</em>
                                        @endif
                                    </h3>

                                    @if($bigBanner->description)
                                        <p style="color:#b2e8ea;font-size:.85rem;margin-bottom:18px;">
                                            {{ $bigBanner->description }}
                                        </p>
                                    @endif

                                    @if($bigBanner->button_text)
                                        <a href="{{ $bigBanner->button_url ?? '#' }}"
                                            style="color:#f0c88c;font-size:.82rem;font-weight:600;text-decoration:none;">
                                            {{ $bigBanner->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Two small banners --}}
                    @if($smallBanners->count())
                        <div class="col-md-6">
                            <div class="row g-3">
                                @foreach($smallBanners as $banner)
                                    <div class="col-12">
                                        <div class="promo-banner {{ $banner->css_class }}" style="
                                                                                                            min-height:110px;
                                                                                                            @if($banner->image)
                                                                                                                background-image:url('{{ asset('storage/' . $banner->image) }}');
                                                                                                            @endif
                                                                                                         ">
                                            <div class="promo-banner-content" style="padding:20px 24px;">
                                                @if($banner->badge_text)
                                                    <div
                                                        style="font-size:.72rem;color:#f0c8a0;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                                        {{ $banner->badge_text }}
                                                    </div>
                                                @endif

                                                <h5 style="color:#fff;font-family:'Playfair Display',serif;margin:6px 0 8px;">
                                                    {{ $banner->title }}

                                                    @if($banner->highlight_text)
                                                        <br>
                                                        <span style="color:#f0c88c;">
                                                            {{ $banner->highlight_text }}
                                                        </span>
                                                    @endif
                                                </h5>

                                                @if($banner->description)
                                                    <p style="color:#b2e8ea;font-size:.8rem;margin-bottom:8px;">
                                                        {{ $banner->description }}
                                                    </p>
                                                @endif

                                                @if($banner->button_text)
                                                    <a href="{{ $banner->button_url ?? '#' }}"
                                                        style="color:#f0c88c;font-size:.82rem;font-weight:600;text-decoration:none;">
                                                        {{ $banner->button_text }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    @endif


    <!-- ═══════════════════════════════════════
                                    TESTIMONIALS
                                     ═══════════════════════════════════════ -->
    <section class="section-py bg-pale" hidden>
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
                <a href="{{ route('frontend.blog.index') }}" class="btn-outline-green d-none d-md-inline-block">Xem thêm <i
                        class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                @forelse($featuredPosts ?? collect() as $post)
                    @php
                        $postImage = $post->thumbnail
                            ? asset('storage/' . $post->thumbnail)
                            : ($post->activeImages->first()?->image
                                ? asset('storage/' . $post->activeImages->first()->image)
                                : asset('assets/img/logo.png'));
                        $readTime = max(1, (int) ceil(str_word_count(strip_tags((string) $post->content)) / 200));
                    @endphp
                    <div class="col-md-4">
                        <div class="blog-card h-100">
                            <div class="img-wrap">
                                <a href="{{ route('frontend.blog.show', $post->slug) }}">
                                    <img src="{{ $postImage }}" alt="{{ $post->title }}" />
                                </a>
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-tag">{{ $post->category->name ?? 'Tin tức' }}</div>
                                <h5 class="blog-title">
                                    <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h5>
                                <div class="blog-meta">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ optional($post->published_at ?? $post->created_at)->format('d/m/Y') }}
                                    · {{ $readTime }} phút đọc
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-4">
                            Chưa có bài viết nổi bật để hiển thị.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
                             NEWSLETTER
                            ═══════════════════════════════════════ -->
    <section class="py-5" hidden>
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
            const mobileQuery = window.matchMedia('(max-width: 991.98px)');
            let current = 0;
            let timer;

            if (!slides.length) return;

            function applySlideImages() {
                slides.forEach(function (slide) {
                    const desktop = slide.dataset.desktop || '';
                    const mobile = slide.dataset.mobile || desktop;
                    const image = mobileQuery.matches ? mobile : desktop;
                    slide.style.backgroundImage = image ? `url('${image}')` : '';
                });
            }

            function goTo(index) {
                slides[current].classList.remove('active');
                dots[current]?.classList.remove('active');
                current = (index + slides.length) % slides.length;
                slides[current].classList.add('active');
                dots[current]?.classList.add('active');
            }

            function restart() {
                clearInterval(timer);
                if (slides.length <= 1) return;
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

            applySlideImages();
            if (typeof mobileQuery.addEventListener === 'function') {
                mobileQuery.addEventListener('change', applySlideImages);
            } else if (typeof mobileQuery.addListener === 'function') {
                mobileQuery.addListener(applySlideImages);
            }
            window.addEventListener('resize', applySlideImages);
            restart();
        })();
    </script>

@endsection
