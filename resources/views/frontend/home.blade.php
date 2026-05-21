@extends('layouts.frontend.app')
@section('content')
    <section class="hero-section">
        <div class="container py-5">
            <div class="row align-items-center min-vh-auto g-4" style="min-height:400px">
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

                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <div class="hero-img-wrapper">
                        <div class="flower-circle">
                            <img src="assets/img/shop/01.png" alt="Hoa tươi" />
                        </div>
                        <div class="hero-float-badge top-right">
                            <strong>⭐ 4.9/5</strong>
                            <span style="font-size:.72rem;color:#666;">3,200 đánh giá</span>
                        </div>
                        <div class="hero-float-badge bottom-left">
                            <strong>🚚 2h</strong>
                            <span style="font-size:.72rem;color:#666;">Giao hàng nội thành</span>
                        </div>
                    </div>
                </div>
            </div>
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
                <a href="#" class="btn-outline-green d-none d-md-inline-block">Xem tất cả <i
                        class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <!-- Filter tabs -->
            <ul class="nav filter-tabs mb-4 gap-2 flex-wrap">
                <li class="nav-item"><a class="nav-link active" href="#">Tất cả</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hoa hồng</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hoa cưới</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sinh nhật</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Lan hồ điệp</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Giỏ quà</a></li>
            </ul>

            <div class="row g-3">
                <!-- Product 1 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/01.png" alt="Bó hoa hồng đỏ" />
                            <span class="product-badge bg-danger text-white">Bán chạy</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(128)</span>
                            </div>
                            <div class="product-name">Bó hoa hồng đỏ tình yêu – 30 bông nhung</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">380.000đ</span>
                                <span class="product-price-old">480.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/02.png" alt="Giỏ hoa sinh nhật" />
                            <span class="product-badge bg-warning text-dark">Mới</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(94)</span>
                            </div>
                            <div class="product-name">Giỏ hoa sinh nhật pastel dễ thương</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">450.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/03.png" alt="Hoa lan hồ điệp" />
                            <span class="product-badge" style="background:var(--green-main);color:#fff;">Phổ biến</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★☆ <span style="color:#aaa;font-size:.75rem">(76)</span>
                            </div>
                            <div class="product-name">Chậu lan hồ điệp trắng – 3 cành sang trọng</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">750.000đ</span>
                                <span class="product-price-old">900.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/04.png" alt="Hộp hoa cưới" />
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(211)</span>
                            </div>
                            <div class="product-name">Hộp hoa cưới cao cấp – hồng phấn & trắng</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">680.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/01.png" alt="Kệ hoa khai trương" />
                            <span class="product-badge bg-info text-white">Hot</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(63)</span>
                            </div>
                            <div class="product-name">Kệ hoa khai trương đứng – màu đỏ may mắn</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">1.200.000đ</span>
                                <span class="product-price-old">1.500.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/02.png" alt="Bó hoa hướng dương" />
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★☆ <span style="color:#aaa;font-size:.75rem">(47)</span>
                            </div>
                            <div class="product-name">Bó hoa hướng dương rực rỡ – 15 bông tươi</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">290.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/03.png" alt="Giỏ quà tết" />
                            <span class="product-badge bg-danger text-white">-20%</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(88)</span>
                            </div>
                            <div class="product-name">Giỏ quà tết cao cấp – lan + quà + bánh</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">980.000đ</span>
                                <span class="product-price-old">1.200.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/04.png" alt="Hoa sáp thơm" />
                            <span class="product-badge" style="background:var(--gold);color:#fff;">Độc đáo</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(155)</span>
                            </div>
                            <div class="product-name">Bó hoa sáp thơm – lưu giữ mãi mãi</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">550.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
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
            <div class="newsletter-section p-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div style="font-size:2rem;margin-bottom:8px;">🌸</div>
                        <h3 style="color:#fff;font-family:'Playfair Display',serif;margin-bottom:10px;">Đăng ký nhận ưu
                            đãi</h3>
                        <p style="color:#b2e8ea;font-size:.88rem;margin-bottom:24px;">Nhận thông báo khuyến mãi và mẹo
                            cắm hoa mỗi
                            tuần qua email</p>
                        <div class="d-flex" style="max-width:420px;margin:0 auto;">
                            <input type="email" class="newsletter-input flex-grow-1" placeholder="Email của bạn..." />
                            <button class="newsletter-btn">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection