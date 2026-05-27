
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

    .header-filter-btn {
        border: none;
        background: transparent;
        padding: 0;
    }

    .filter-box .form-control,
    .filter-box .form-select {
        border-radius: 12px;
    }

    .filter-drawer {
        z-index: 2050;
    }

    .filter-drawer .cart-panel {
        width: min(92vw, 360px);
        display: flex;
        flex-direction: column;
    }

    .filter-drawer .cart-header {
        flex-shrink: 0;
    }

    .filter-drawer .cart-body {
        flex: 1;
        overflow-y: auto;
        overscroll-behavior: contain;
        -webkit-overflow-scrolling: touch;
        padding: 20px 16px;
    }

    .filter-drawer .cart-actions {
        padding: 14px 16px 24px;
        border-top: 1px solid #f0f0f0;
        flex-shrink: 0;
    }
</style>
<style>
    /* ─── FILTER DRAWER ─── */
    .filter-drawer .cart-panel {
        width: min(92vw, 380px);
    }

    .filter-drawer .cart-header {
        background: var(--green-dark);
    }

    /* ─── FORM LABEL ─── */
    .filter-box .filter-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 8px;
        display: block;
    }

    /* ─── INPUT / SELECT chung ─── */
    .filter-box .form-control,
    .filter-box .form-select {
        border: 1.5px solid #b2e8ea;
        border-radius: 10px;
        font-size: 0.85rem;
        color: var(--text-dark);
        transition: border-color .2s, box-shadow .2s;
    }

    .filter-box .form-control:focus,
    .filter-box .form-select:focus {
        border-color: var(--green-main);
        box-shadow: 0 0 0 3px rgba(43, 170, 173, .12);
    }

    /* ─── CATEGORY SEARCHABLE ─── */
    .filter-cat-wrap {
        position: relative;
    }

    .filter-cat-search {
        border: 1.5px solid #b2e8ea;
        border-radius: 10px 10px 0 0;
        border-bottom: none;
        padding: 8px 12px 8px 34px;
        font-size: 0.83rem;
        width: 100%;
        outline: none;
        color: var(--text-dark);
        background: #fff;
        transition: border-color .2s;
    }

    .filter-cat-search:focus {
        border-color: var(--green-main);
    }

    .filter-cat-search-icon {
        position: absolute;
        top: 10px;
        left: 11px;
        color: var(--text-muted);
        font-size: 0.85rem;
        pointer-events: none;
    }

    .filter-cat-list {
        border: 1.5px solid #b2e8ea;
        border-radius: 0 0 10px 10px;
        background: #fff;
        max-height: 220px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #b2e8ea transparent;
    }

    .filter-cat-list::-webkit-scrollbar {
        width: 4px;
    }

    .filter-cat-list::-webkit-scrollbar-thumb {
        background: #b2e8ea;
        border-radius: 2px;
    }

    .filter-cat-option {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        font-size: 0.83rem;
        color: var(--text-dark);
        cursor: pointer;
        border-bottom: 1px solid #f0f9f9;
        transition: background .15s;
        user-select: none;
    }

    .filter-cat-option:last-child {
        border-bottom: none;
    }

    .filter-cat-option:hover {
        background: var(--green-pale);
    }

    .filter-cat-option.active {
        background: var(--green-pale);
        color: var(--green-dark);
        font-weight: 600;
    }

    .filter-cat-option.active::after {
        content: '\F633';
        font-family: 'Bootstrap-icons';
        margin-left: auto;
        color: var(--green-main);
        font-size: 0.85rem;
    }

    /* indent danh mục con */
    .filter-cat-option.child {
        padding-left: 28px;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .filter-cat-option.child.active {
        color: var(--green-dark);
    }

    /* parent label (không chọn được) */
    .filter-cat-option.parent-label {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--green-main);
        background: #f6fcfc;
        padding: 6px 14px;
        cursor: default;
        border-bottom: 1px solid #e8f5f5;
    }

    .filter-cat-option.parent-label:hover {
        background: #f6fcfc;
    }

    .filter-cat-empty {
        padding: 16px;
        text-align: center;
        font-size: 0.82rem;
        color: var(--text-muted);
        display: none;
    }

    /* ─── KHOẢNG GIÁ: preset pills ─── */
    .filter-price-presets {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 10px;
    }

    .filter-price-btn {
        padding: 5px 13px;
        border-radius: 50px;
        border: 1.5px solid #b2e8ea;
        background: #fff;
        color: var(--text-muted);
        font-size: 0.76rem;
        font-weight: 500;
        cursor: pointer;
        transition: all .18s;
        white-space: nowrap;
    }

    .filter-price-btn:hover {
        border-color: var(--green-main);
        color: var(--green-dark);
        background: var(--green-pale);
    }

    .filter-price-btn.active {
        background: var(--green-main);
        border-color: var(--green-main);
        color: #fff;
        font-weight: 600;
    }

    .filter-price-custom {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-price-custom .form-control {
        text-align: center;
        font-size: 0.82rem;
    }

    .filter-price-custom span {
        font-size: 0.75rem;
        color: var(--text-muted);
        flex-shrink: 0;
    }

    /* ─── TÌNH TRẠNG: pill group ─── */
    .filter-stock-group {
        display: flex;
        gap: 6px;
    }

    .filter-stock-btn {
        flex: 1;
        padding: 7px 0;
        border-radius: 10px;
        border: 1.5px solid #b2e8ea;
        background: #fff;
        color: var(--text-muted);
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        transition: all .18s;
    }

    .filter-stock-btn:hover {
        border-color: var(--green-main);
        background: var(--green-pale);
        color: var(--green-dark);
    }

    .filter-stock-btn.active {
        background: var(--green-main);
        border-color: var(--green-main);
        color: #fff;
        font-weight: 600;
    }

    /* ─── NỔI BẬT: toggle switch ─── */
    .filter-featured-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--green-pale);
        border-radius: 12px;
        padding: 10px 14px;
    }

    .filter-featured-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-dark);
    }

    .filter-featured-label small {
        display: block;
        font-size: 0.72rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .toggle-switch {
        position: relative;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }

    .toggle-switch input {
        display: none;
    }

    .toggle-track {
        position: absolute;
        inset: 0;
        border-radius: 50px;
        background: #d0ecee;
        cursor: pointer;
        transition: background .2s;
    }

    .toggle-track::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #fff;
        transition: transform .2s;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .15);
    }

    .toggle-switch input:checked+.toggle-track {
        background: var(--green-main);
    }

    .toggle-switch input:checked+.toggle-track::after {
        transform: translateX(18px);
    }

    /* ─── SẮP XẾP ─── */
    .filter-sort-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .filter-sort-btn {
        padding: 5px 13px;
        border-radius: 50px;
        border: 1.5px solid #b2e8ea;
        background: #fff;
        color: var(--text-muted);
        font-size: 0.78rem;
        cursor: pointer;
        transition: all .18s;
    }

    .filter-sort-btn:hover {
        border-color: var(--green-main);
        background: var(--green-pale);
        color: var(--green-dark);
    }

    .filter-sort-btn.active {
        background: var(--green-main);
        border-color: var(--green-main);
        color: #fff;
        font-weight: 600;
    }

    /* ─── DIVIDER ─── */
    .filter-divider {
        border: none;
        border-top: 1.5px solid #e8f5f5;
        margin: 4px 0 18px;
    }

    /* hidden inputs */
    #filterCategoryInput,
    #filterStockInput,
    #filterSortInput,
    #filterMinPrice,
    #filterMaxPrice {
        display: none;
    }
</style>

<header class="site-header">
    <div class="container py-3">
        <div class="d-flex align-items-center gap-3">

            {{-- Logo --}}
            <a href="{{ route('frontend.home.index') }}" class="brand-name me-3 flex-shrink-0">
                <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Mộc Hương"
                    style="height:52px;width:52px;object-fit:cover;border-radius:50%;">
                <span class="brand-text">Mộc <em>Hương</em></span>
            </a>

           <form action="{{ route('frontend.product.index') }}" method="GET">
                @foreach(request()->except('keyword', 'page') as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $item)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="search-wrapper d-none d-lg-block">
                    <div class="input-group">
                        <input 
                            type="text" 
                            name="keyword" 
                            value="{{ request('keyword') }}" 
                            class="form-control"
                            placeholder="Tên sản phẩm, mã sản phẩm..."
                        >

                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            

            {{-- Icons --}}
            <div class="d-flex align-items-center gap-3 ms-auto">
                <button type="button" class="header-icon-btn header-filter-btn d-none d-sm-flex"
                    onclick="openFilterDrawer()">
                    <i class="bi bi-sliders2"></i>
                    <span>Bộ lọc</span>
                </button>
                <a href="#" class="header-icon-btn d-none d-sm-flex">
                    <i class="bi bi-geo-alt"></i>
                    <span>Cửa hàng</span>
                </a>


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
                {{-- Hamburger - chỉ hiện mobile --}}
                <button class="hamburger-btn d-flex d-lg-none" id="mobileMenuBtn" aria-label="Mở menu">
                    <span></span><span></span><span></span>
                </button>

            </div>
        </div>
    </div>

 

   <nav class="mega-nav d-none d-lg-block">
    <div class="container">
        <ul class="nav align-items-center" id="mainNav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.home.index') }}">
                    <i class="fa-solid fa-house me-1"></i>
                    Trang chủ
                </a>
            </li>

            @foreach ($menuCategories ?? collect() as $parent)
                @php
                    $children = $parent->children ?? collect();

                    $megaGroups = $parent->mega_groups
                        ?? $children->groupBy(fn ($child) => $child->mega_section_resolved_key);
                @endphp

                @if ($children->isNotEmpty())
                    <li class="nav-item dropdown mega-item">
                        <a class="nav-link dropdown-toggle fw-600"
                           href="#"
                           data-bs-toggle="dropdown"
                           data-bs-auto-close="outside">
                            @if ($parent->icon)
                                <i class="{{ $parent->icon }} me-1"></i>
                            @endif

                            {{ $parent->name }}
                        </a>

                        <div class="dropdown-menu mega-panel">
                            <div class="mega-panel-inner">

                                @foreach ($megaGroups as $items)
                                    @continue($items->isEmpty())

                                    @php
                                        $firstItem = $items->first();
                                        $sectionLabel = $firstItem?->mega_section_resolved_label ?? 'Khác';
                                    @endphp

                                    <div class="mega-col">
                                        <div class="mega-col-title">
                                            {{ $sectionLabel }}
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

                                        <div class="mega-feature-title">
                                            Thiết kế theo yêu cầu
                                        </div>

                                        <div class="mega-feature-desc">
                                            Tùy chỉnh màu, kiểu, lời nhắn theo ý muốn
                                        </div>

                                        <a href="#" class="mega-feature-btn">
                                            Đặt ngay →
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-600"
                           href="{{ route('frontend.category.show', ['id' => $parent->id, 'slug' => $parent->slug]) }}">
                            @if ($parent->icon)
                                <i class="{{ $parent->icon }} me-1"></i>
                            @endif

                            {{ $parent->name }}
                        </a>
                    </li>
                @endif
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.blog.index') }}">
                    <i class="fa-solid fa-newspaper"></i>
                    Cẩm nang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.contact.index') }}">
                    <i class="fa-utility fa-semibold fa-phone-arrow-down-left"></i>
                    Liên hệ
                </a>
            </li>
        </ul>
    </div>
</nav>

</header>

<!-- bộc lọc -->
<div class="cart-drawer filter-drawer" id="filterDrawer">
    <div class="cart-backdrop" onclick="closeFilterDrawer()"></div>

    <div class="cart-panel">
        <div class="cart-header">
            <div class="cart-header-title">
                <i class="bi bi-sliders2"></i>
                Bộ lọc sản phẩm
            </div>
            <button class="cart-close" onclick="closeFilterDrawer()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <form action="{{ route('frontend.product.index') }}" method="GET" class="filter-box d-flex flex-column"
            style="flex:1;min-height:0;">

            {{-- Hidden inputs --}}
            <input type="hidden" name="category_id" id="filterCategoryInput" value="{{ request('category_id') }}">
            <input type="hidden" name="min_price" id="filterMinPrice" value="{{ request('min_price') }}">
            <input type="hidden" name="max_price" id="filterMaxPrice" value="{{ request('max_price') }}">
            <input type="hidden" name="stock_status" id="filterStockInput" value="{{ request('stock_status') }}">
            <input type="hidden" name="sort" id="filterSortInput" value="{{ request('sort', 'random') }}">

            <div class="cart-body">

                {{-- Tìm kiếm --}}
                <div class="mb-4">
                    <label class="filter-label">Tìm kiếm</label>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                        placeholder="Tên sản phẩm, mã sản phẩm...">
                </div>

                <hr class="filter-divider">

                {{-- Danh mục có tìm kiếm --}}
                <div class="mb-4">
                    <label class="filter-label">Danh mục</label>
                    <div class="filter-cat-wrap">
                        <i class="bi bi-search filter-cat-search-icon"></i>
                        <input type="text" class="filter-cat-search" id="catSearchInput" placeholder="Tìm danh mục...">

                        <div class="filter-cat-list" id="catOptionList">
                            {{-- Tất cả --}}
                            <div class="filter-cat-option {{ !request('category_id') ? 'active' : '' }}" data-value=""
                                data-label="Tất cả danh mục">
                                Tất cả danh mục
                            </div>

                            @foreach (($menuCategories ?? collect()) as $parent)
                                {{-- Tên nhóm cha --}}
                                <div class="filter-cat-option parent-label" data-search="{{ strtolower($parent->name) }}">
                                    @if($parent->icon)<i class="{{ $parent->icon }} me-1"></i>@endif
                                    {{ $parent->name }}
                                </div>

                                {{-- Danh mục con --}}
                                @foreach ($parent->children as $child)
                                    <div class="filter-cat-option child {{ request('category_id') == $child->id ? 'active' : '' }}"
                                        data-value="{{ $child->id }}" data-label="{{ $child->name }}"
                                        data-search="{{ strtolower($child->name . ' ' . $parent->name) }}">
                                        {{ $child->name }}
                                    </div>
                                @endforeach
                            @endforeach

                            <div class="filter-cat-empty" id="catEmpty">Không tìm thấy danh mục</div>
                        </div>
                    </div>
                </div>

                <hr class="filter-divider">

                {{-- Khoảng giá --}}
                <div class="mb-4">
                    <label class="filter-label">Khoảng giá</label>
                    <div class="filter-price-presets">
                        <button type="button"
                            class="filter-price-btn {{ !request('min_price') && !request('max_price') ? 'active' : '' }}"
                            data-min="" data-max="">Tất cả</button>
                        <button type="button"
                            class="filter-price-btn {{ request('min_price') == 0 && request('max_price') == 100000 ? 'active' : '' }}"
                            data-min="0" data-max="100000">Dưới 100k</button>
                        <button type="button"
                            class="filter-price-btn {{ request('min_price') == 100000 && request('max_price') == 300000 ? 'active' : '' }}"
                            data-min="100000" data-max="300000">100k – 300k</button>
                        <button type="button"
                            class="filter-price-btn {{ request('min_price') == 300000 && request('max_price') == 500000 ? 'active' : '' }}"
                            data-min="300000" data-max="500000">300k – 500k</button>
                        <button type="button"
                            class="filter-price-btn {{ request('min_price') == 500000 && request('max_price') == 1000000 ? 'active' : '' }}"
                            data-min="500000" data-max="1000000">500k – 1tr</button>
                        <button type="button"
                            class="filter-price-btn {{ request('min_price') == 1000000 && !request('max_price') ? 'active' : '' }}"
                            data-min="1000000" data-max="">Trên 1tr</button>
                    </div>
                    <div class="filter-price-custom">
                        <input type="number" id="customMinPrice" class="form-control" placeholder="Từ" min="0"
                            value="{{ request('min_price') }}">
                        <span>—</span>
                        <input type="number" id="customMaxPrice" class="form-control" placeholder="Đến" min="0"
                            value="{{ request('max_price') }}">
                    </div>
                </div>

                <hr class="filter-divider">

                {{-- Tình trạng kho --}}
                <div class="mb-4" hidden>
                    <label class="filter-label">Tình trạng</label>
                    <div class="filter-stock-group">
                        <button type="button" class="filter-stock-btn {{ !request('stock_status') ? 'active' : '' }}"
                            data-value="">Tất cả</button>
                        <button type="button"
                            class="filter-stock-btn {{ request('stock_status') === 'in_stock' ? 'active' : '' }}"
                            data-value="in_stock">✅ Còn hàng</button>
                        <button type="button"
                            class="filter-stock-btn {{ request('stock_status') === 'out_of_stock' ? 'active' : '' }}"
                            data-value="out_of_stock">❌ Hết hàng</button>
                    </div>
                </div>

                <hr class="filter-divider">

                {{-- Nổi bật --}}
                <div class="mb-4" hidden>
                    <div class="filter-featured-row">
                        <div class="filter-featured-label">
                            Sản phẩm nổi bật
                            <small>Chỉ hiện sản phẩm được đánh dấu nổi bật</small>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="featured" value="1" @checked(request('featured') == 1)>
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                </div>

                <hr class="filter-divider">

                {{-- Sắp xếp --}}
                <div class="mb-4">
                    <label class="filter-label">Sắp xếp</label>
                    <div class="filter-sort-list">
                        @foreach ([
                                'random' => 'Ngẫu nhiên',
                                'newest' => ' Mới nhất',
                                'price_asc' => 'Giá tăng',
                                'price_desc' => 'Giá giảm',
                                'name_asc' => 'Tên A-Z',
                            ] as $val => $label)
                                <button type="button" class="filter-sort-btn {{ request('sort', 'random') === $val ? 'active' : '' }}" data-value="{{ $val }}">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="cart-actions d-grid gap-2">
                <button type="submit" class="btn btn-green">
                    <i class="bi bi-check2-circle me-1"></i>Lọc sản phẩm
                </button>
                <a href="{{ route('frontend.product.index') }}" class="btn btn-outline-green">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Xóa bộ lọc
                </a>
                </div>
        </form>
        </div>
    </div>
    
    <script>
    (function () {
    
    // ── Danh mục: tìm kiếm + chọn ──
        const catSearch  = document.getElementById('catSearchInput');
        const catInput   = document.getElementById('filterCategoryInput');
        const catOptions = Array.from(document.querySelectorAll('#catOptionList .filter-cat-option:not(.parent-label)'));
        const catParents = Array.from(document.querySelectorAll('#catOptionList .filter-cat-option.parent-label'));
        const catEmpty   = document.getElementById('catEmpty');
    
        catOptions.forEach(function (opt) {
            opt.addEventListener('click', function () {
                catOptions.forEach(function (o) { o.classList.remove('active'); });
            this.classList.add('active');
                catInput.value = this.dataset.value;
                catSearch.value = this.dataset.label || '';
                // filter lại để chỉ hiện option được chọn hoặc reset
        });
        });
    
        catSearch.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let anyVisible = false;

            catOptions.forEach(function (opt) {
                const match = !q || (opt.dataset.search || '').includes(q);
                opt.style.display = match ? '' : 'none';
                if (match) anyVisible = true;
            });
    
            // Ẩn/hiện parent label dựa trên con có hiện không
            catParents.forEach(function (parent) {
                const parentSearch = parent.dataset.search || '';
                // Tìm các con ngay sau parent label
                let el = parent.nextElementSibling;
                let hasVisibleChild = false;
            while (el && el.classList.contains('child')) {
                    if (el.style.display !== 'none') hasVisibleChild = true;
                el = el.nextElementSibling;
                }
                parent.style.display = hasVisibleChild ? '' : 'none';
            });
    
            catEmpty.style.display = anyVisible ? 'none' : 'block';
    
            // Nếu xóa search → reset về "Tất cả"
        if (!q) {
                catOptions.forEach(function (o) { o.style.display = ''; });
                catParents.forEach(function (p) { p.style.display = ''; });
                catEmpty.style.display = 'none';
            }
        });
    
        // ── Khoảng giá preset ──
        document.querySelectorAll('.filter-price-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-price-btn').forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');
            document.getElementById('filterMinPrice').value = this.dataset.min;
                document.getElementById('filterMaxPrice').value = this.dataset.max;
                document.getElementById('customMinPrice').value = this.dataset.min;
                document.getElementById('customMaxPrice').value = this.dataset.max;
            });
        });
    
        ['customMinPrice', 'customMaxPrice'].forEach(function (id) {
        document.getElementById(id).addEventListener('input', function () {
                document.querySelectorAll('.filter-price-btn').forEach(function (b) { b.classList.remove('active'); });
                document.getElementById('filterMinPrice').value = document.getElementById('customMinPrice').value;
                document.getElementById('filterMaxPrice').value = document.getElementById('customMaxPrice').value;
            });
        });
    
        // ── Tình trạng kho ──
        document.querySelectorAll('.filter-stock-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-stock-btn').forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');
                document.getElementById('filterStockInput').value = this.dataset.value;
            });
        });
    
        // ── Sắp xếp ──
        document.querySelectorAll('.filter-sort-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-sort-btn').forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');
            document.getElementById('filterSortInput').value = this.dataset.value;
        });
    });

})();
</script>
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

    function openFilterDrawer() {
        const drawer = document.getElementById('filterDrawer');
        if (!drawer) return;

        drawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeFilterDrawer() {
        const drawer = document.getElementById('filterDrawer');
        if (!drawer) return;

        drawer.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeFilterDrawer();
        }
    });
</script>
