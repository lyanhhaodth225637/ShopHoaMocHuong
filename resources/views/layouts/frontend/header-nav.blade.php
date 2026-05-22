<header class="site-header">
    <div class="container py-3">
        <div class="d-flex align-items-center gap-3">
            <!-- Logo -->
            <a href="{{ route('frontend.home.index') }}" class="brand-name me-3 flex-shrink-0">
                <img src="{{ asset('assets/tablar-logo.png') }}" alt="Mộc Hương"
                    style="height:52px;width:52px;object-fit:cover;border-radius:50%;"> <span class="brand-text">Mộc
                    <em>Hương</em></span>
            </a>

            <!-- Search -->
            <div class="search-wrapper d-none d-lg-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm hoa, giỏ quà, dịch vụ..." />
                    <button class="btn"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <!-- Icons -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                <a href="#" class="header-icon-btn d-none d-sm-flex">
                    <i class="bi bi-geo-alt"></i>
                    <span>Cửa hàng</span>
                </a>
                <a href="#" class="header-icon-btn d-none d-sm-flex">
                    <i class="bi bi-person"></i>
                    <span>Tài khoản</span>
                </a>
                <a href="#" class="header-icon-btn">
                    <i class="bi bi-heart"></i>
                    <span class="badge">3</span>
                    <span class="d-none d-sm-inline">Yêu thích</span>
                </a>
                <button id="cartOpenBtn" class="header-icon-btn" style="background:none;border:none;padding:0;">
                    <i class="bi bi-bag"></i>
                    <span class="badge" id="cartBadge">5</span>
                    <span class="d-none d-sm-inline">Giỏ hàng</span>
                </button>
                <!-- Hamburger - chỉ hiện mobile -->
                <button class="hamburger-btn d-flex d-lg-none" id="mobileMenuBtn" aria-label="Mở menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>

    <!-- MEGA MENU NAV – ẩn trên mobile, dùng modal thay thế -->
    @php
        $sectionLabels = [
            'kieu_dang' => 'Kiểu dáng',
            'loai_hoa' => 'Loại hoa',
            'theo_dip' => 'Theo dịp',
            'theo_mau' => 'Theo màu sắc',
            'dac_biet' => 'Đặc biệt',

            'hoa_co_dau' => 'Cô dâu & chú rể',
            'phu_kien_cuoi' => 'Phụ kiện cưới',
            'trang_tri_cuoi' => 'Trang trí',
            'dich_vu_cuoi' => 'Dịch vụ trọn gói',

            'lan' => 'Lan hồ điệp',
            'cay_xanh' => 'Cây xanh',
            'qua_tang_cay' => 'Quà tặng cây',

            'combo_hoa' => 'Combo hoa + quà',
            'gio_qua' => 'Giỏ & hộp quà',
            'hop_qua' => 'Hộp quà',
            'phu_kien' => 'Phụ kiện & khác',

            'banh' => 'Bánh kem',
            'combo' => 'Combo đặc biệt',
            'do_uong' => 'Đồ uống',
            'do_go' => 'Đồ gỗ',
            'vat_tu_hoa' => 'Vật từ hoa',
            'goi_hoa' => 'Gói hoa',
            'trang_tri' => 'Trang trí',

            'khac' => 'Khác',
        ];
    @endphp

    <nav class="mega-nav d-none d-lg-block">
        <div class="container">
            <ul class="nav align-items-center" id="mainNav">

                @foreach ($menuCategories ?? [] as $parent)
                    @php
                        $children = $parent->children ?? collect();
                        $megaGroups = $parent->mega_groups ?? $children->groupBy(fn($child) => $child->mega_section ?: 'khac');
                    @endphp

                    {{-- Nếu có danh mục con --}}
                    @if ($children->count())
                        <li class="nav-item dropdown mega-item">
                            <a class="nav-link dropdown-toggle fw-600" href="demo" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">

                                @if ($parent->icon)
                                    <span class="me-1"><i class="{{ $parent->icon }}"></i></span>
                                @endif

                                {{ $parent->name }}
                            </a>

                            <div class="dropdown-menu mega-panel">
                                <div class="mega-panel-inner">

                                    @foreach ($megaGroups as $sectionKey => $items)
                                        <div class="mega-col">
                                            <div class="mega-col-title">
                                                {{ $sectionLabels[$sectionKey] ?? $sectionKey }}
                                            </div>

                                            @foreach ($items as $child)
                                                <a class="mega-link"
                                                    href="{{ route('frontend.category.show', ['id' => $child->id, 'slug' => $child->slug]) }}">

                                                    @if ($child->icon)
                                                        <span class="me-1"><i class="{{ $child->icon }}"></i></span>
                                                    @endif

                                                    {{ $child->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    {{-- Feature box cho Hoa tươi --}}
                                    @if ($parent->slug === 'hoa-tuoi')
                                        <div class="mega-feature">
                                            <div class="mega-feature-img">🌹</div>
                                            <div class="mega-feature-title">Thiết kế theo yêu cầu</div>
                                            <div class="mega-feature-desc">
                                                Tùy chỉnh màu, kiểu, lời nhắn theo ý muốn
                                            </div>
                                            <a href="#" class="mega-feature-btn">Đặt ngay →</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </li>

                        {{-- Nếu không có danh mục con --}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-600" href="">

                                @if ($parent->icon)
                                    <span class="me-1"><i class="{{ $parent->icon }}"></i></span>
                                @endif

                                {{ $parent->name }}
                            </a>
                        </li>
                    @endif
                @endforeach

                {{-- Link tĩnh --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">📰 Tin tức</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">📞 Liên hệ</a>
                </li>

            </ul>
        </div>
    </nav>

</header>