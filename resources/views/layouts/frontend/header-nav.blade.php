<style>
    /* ─── HEADER ACCOUNT DROPDOWN ─── */
    .header-account-wrap {
        position: relative;
    }

    .header-account-wrap .account-dropdown-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 180px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .13);
        padding: 8px;
        display: none;
        z-index: 2000;
    }

    .header-account-wrap.is-open .account-dropdown-menu {
        display: block;
    }

    .account-dropdown-menu a,
    .account-dropdown-menu button {
        width: 100%;
        border: none;
        background: transparent;
        padding: 9px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-dark);
        font-size: 0.83rem;
        text-decoration: none;
        border-radius: 10px;
        cursor: pointer;
        white-space: nowrap;
        text-align: left;
    }

    .account-dropdown-menu a:hover,
    .account-dropdown-menu button:hover {
        background: var(--green-pale);
        color: var(--green-dark);
    }

    .account-dropdown-menu .dropdown-divider {
        margin: 4px 0;
        border-color: #f0f0f0;
    }

    /* tên user cắt ngắn */
    .header-icon-btn .user-name {
        max-width: 80px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
    }
</style>

<header class="site-header">
    <div class="container py-3">
        <div class="d-flex align-items-center gap-3">

            {{-- Logo --}}
            <a href="{{ route('frontend.home.index') }}" class="brand-name me-3 flex-shrink-0">
                <img src="{{ asset('assets/tablar-logo.png') }}" alt="Mộc Hương"
                    style="height:52px;width:52px;object-fit:cover;border-radius:50%;">
                <span class="brand-text">Mộc <em>Hương</em></span>
            </a>

            {{-- Search --}}
            <div class="search-wrapper d-none d-lg-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm hoa, giỏ quà, dịch vụ..." />
                    <button class="btn"><i class="bi bi-search"></i></button>
                </div>
            </div>

            {{-- Icons --}}
            <div class="d-flex align-items-center gap-3 ms-auto">

                <a href="#" class="header-icon-btn d-none d-sm-flex">
                    <i class="bi bi-geo-alt"></i>
                    <span>Cửa hàng</span>
                </a>

                {{-- Tài khoản --}}
                @auth
                    <div class="header-account-wrap d-none d-sm-flex" id="headerAccountWrap">
                        <button type="button" class="header-icon-btn" id="headerAccountBtn"
                            style="background:none;border:none;padding:0;">
                            <i class="bi bi-person-check"></i>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </button>

                        <div class="account-dropdown-menu">
                            @role('super-admin')
                            <a href="{{ route('admin.index') }}">
                                <i class="bi bi-speedometer2"></i>Trang quản trị
                            </a>
                            <hr class="dropdown-divider">
                            @endrole

                            <a href="">
                                <i class="bi bi-person-lines-fill"></i>Trang cá nhân
                            </a>

                            <a href="">
                                <i class="bi bi-bag-check"></i>Đơn hàng của tôi
                            </a>

                            <hr class="dropdown-divider">

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="bi bi-box-arrow-right"></i>Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="header-icon-btn d-none d-sm-flex">
                        <i class="bi bi-person"></i>
                        <span>Đăng nhập</span>
                    </a>
                @endguest

                <a href="#" class="header-icon-btn">
                    <i class="bi bi-heart"></i>
                    <span class="badge">3</span>
                    <span class="d-none d-sm-inline">Yêu thích</span>
                </a>

                <button id="cartOpenBtn" class="header-icon-btn" style="background:none;border:none;padding:0;">
                    <i class="bi bi-bag"></i>
                    <span class="badge" id="cartBadge" data-cart-count>{{ $cartCount ?? 0 }}</span>
                    <span class="d-none d-sm-inline">Giỏ hàng</span>
                </button>

                {{-- Hamburger - chỉ hiện mobile --}}
                <button class="hamburger-btn d-flex d-lg-none" id="mobileMenuBtn" aria-label="Mở menu">
                    <span></span><span></span><span></span>
                </button>

            </div>
        </div>
    </div>

    {{-- MEGA MENU NAV --}}
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

                    @if ($children->count())
                        <li class="nav-item dropdown mega-item">
                            <a class="nav-link dropdown-toggle fw-600" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                @if ($parent->icon)
                                    <i class="{{ $parent->icon }} me-1"></i>
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
                                                        <i class="{{ $child->icon }} me-1"></i>
                                                    @endif
                                                    {{ $child->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endforeach

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
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-600" href="#">
                                @if ($parent->icon)
                                    <i class="{{ $parent->icon }} me-1"></i>
                                @endif
                                {{ $parent->name }}
                            </a>
                        </li>
                    @endif
                @endforeach

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

<script>
    (function () {
        const wrap = document.getElementById('headerAccountWrap');
        const btn = document.getElementById('headerAccountBtn');
        if (!wrap || !btn) return;

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            wrap.classList.toggle('is-open');
        });

        document.addEventListener('click', function () {
            wrap.classList.remove('is-open');
        });
    })();
</script>