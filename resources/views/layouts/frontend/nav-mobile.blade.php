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
<style>
    /* Thay toàn bộ <style> trong mobile nav partial */

    .mobile-account-dropdown {
        position: relative;
        flex: 1;
        min-width: 0;
        /* quan trọng: cho phép flex item thu nhỏ */
    }

    .mobile-account-btn {
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        /* đồng bộ với .mobile-quick-link */
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        padding: 10px 6px;
        font-size: 0.7rem;
        color: var(--text-muted);
        text-align: center;
        border-right: 1px solid #eee;
        transition: background .2s, color .2s;
    }

    .mobile-account-btn i.bi-person-check {
        font-size: 1.2rem;
        color: var(--green-main);
    }

    .mobile-account-btn .acc-name {
        max-width: 60px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.7rem;
        line-height: 1;
    }

    .mobile-account-btn .bi-chevron-down {
        font-size: 0.6rem;
        color: var(--text-muted);
    }

    .mobile-account-btn:hover {
        background: var(--green-pale);
        color: var(--green-dark);
    }

    .mobile-account-menu {
        position: absolute;
        left: 150%;
        transform: translateX(-50%);
        bottom: calc(100% + 6px);
        width: 170px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 8px;
        display: none;
        z-index: 9999;
    }

    .mobile-account-dropdown.is-open .mobile-account-menu {
        display: block;
    }

    .mobile-account-menu a,
    .mobile-account-menu button {
        width: 100%;
        border: none;
        background: transparent;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-dark);
        font-size: 0.83rem;
        text-decoration: none;
        border-radius: 10px;
        cursor: pointer;
        white-space: nowrap;
    }

    .mobile-account-menu a:hover,
    .mobile-account-menu button:hover {
        background: var(--green-pale);
        color: var(--green-dark);
    }
</style>

<div id="mobileNavModal" class="mobile-nav-modal" role="dialog" aria-modal="true" aria-label="Menu điều hướng">
    <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>

    <div class="mobile-nav-drawer">
        <div class="mobile-nav-header">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('assets/tablar-logo.png') }}" alt="Mộc Hương"
                    style="height:44px;width:44px;object-fit:cover;border-radius:50%;border:2px solid rgba(255,255,255,.3);">
                <span style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#fff;">
                    Mộc <em style="color:#b2e8ea;">Hương</em>
                </span>
            </div>
            <button class="mobile-nav-close" id="mobileNavClose" aria-label="Đóng menu">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="mobile-nav-search">
            <form action="{{ route('frontend.product.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                        placeholder="Tìm hoa, giỏ quà..." />

                    <button type="submit" class="btn" style="background:var(--green-main);color:#fff;border:none;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="mobile-nav-quick">
            {{-- Thay thế đoạn @auth trong mobile-nav-quick --}}

            @auth
                <div class="mobile-account-dropdown" id="mobileAccountDropdown">
                    <button type="button" class="mobile-account-btn" id="mobileAccountBtn">
                        <i class="bi bi-person-check"></i>
                        <span class="acc-name">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div class="mobile-account-menu">
                        @role('super-admin')
                        <a href="{{ route('admin.index') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Trang quản trị</span>
                        </a>
                        @endrole
                        <a href="">
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Trang cá nhân</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Đăng xuất</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="mobile-quick-link">
                    <i class="bi bi-person-circle"></i>
                    <span>Đăng nhập</span>
                </a>
            @endguest

            <button type="button" class="mobile-quick-link" style="background:none;border:none;flex:1;cursor:pointer;"
                onclick="openFilterDrawer()">
                <i class="bi bi-sliders2"></i>
                <span>Bộ lọc</span>
            </button>

            {{-- Thêm script này vào cuối file (trước @endsection hoặc cuối partial) --}}
            <script>
                (function () {
                    const btn = document.getElementById('mobileAccountBtn');
                    const wrap = document.getElementById('mobileAccountDropdown');
                    if (!btn || !wrap) return;

                    btn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        wrap.classList.toggle('is-open');
                    });

                    document.addEventListener('click', function () {
                        wrap.classList.remove('is-open');
                    });
                })();
            </script>
            <a href="#" class="mobile-quick-link">
                <i class="bi bi-heart"></i>
                <span>Yêu thích</span>
                <span class="mnq-badge">3</span>
            </a>
            <button id="cartOpenBtnMobile" class="mobile-quick-link"
                style="background:none;border:none;flex:1;cursor:pointer;">
                <i class="bi bi-bag"></i>
                <span>Giỏ hàng</span>
                <span class="mnq-badge" data-cart-count>{{ $cartCount ?? 0 }}</span>
            </button>
            <a href="#" class="mobile-quick-link">
                <i class="bi bi-geo-alt"></i>
                <span>Cửa hàng</span>
            </a>
        </div>

        <div class="mobile-nav-body">
            <div class="mobile-nav-section-label">Danh mục sản phẩm</div>
            <div class="mobile-accordion" id="mobileAccordion">
                @foreach ($menuCategories ?? [] as $parent)
                    @php
                        $children = $parent->children ?? collect();
                        $megaGroups = $parent->mega_groups ?? $children->groupBy(fn($child) => $child->mega_section ?: 'khac');
                        $accordionId = 'acc-' . $parent->id;
                    @endphp

                    @if ($children->count())
                        <div class="mac-item">
                            <button class="mac-toggle" data-target="{{ $accordionId }}">
                                <span>
                                    @if ($parent->icon)
                                        <i class="{{ $parent->icon }} me-1"></i>
                                    @endif
                                    {{ $parent->name }}
                                </span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <div class="mac-body" id="{{ $accordionId }}">
                                @foreach ($megaGroups as $sectionKey => $items)
                                    <div class="mac-sub-label">{{ $sectionLabels[$sectionKey] ?? $sectionKey }}</div>
                                    @foreach ($items as $child)
                                        <a href="">
                                            @if ($child->icon)
                                                <i class="{{ $child->icon }} me-1"></i>
                                            @endif
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="" class="mac-plain">
                            @if ($parent->icon)
                                <i class="{{ $parent->icon }} me-1"></i>
                            @endif
                            {{ $parent->name }}
                        </a>
                    @endif
                @endforeach

                <div class="mobile-nav-section-label" style="margin-top:4px;">Thông tin</div>
                <a href="#" class="mac-plain">📰 Tin tức & Cẩm nang</a>
                <a href="#" class="mac-plain">📞 Liên hệ</a>
                <a href="#" class="mac-plain">❓ Câu hỏi thường gặp</a>
            </div>
        </div>

        <div class="mobile-nav-footer">
            <a href="#" class="btn-green w-100 text-center d-block mb-2">
                <i class="bi bi-bag-heart me-1"></i> Đặt hoa ngay
            </a>
            <a href="https://zalo.me/0888796364" class="btn-outline-green w-100 text-center d-block">
                💬 Chat Zalo tư vấn
            </a>
        </div>
    </div>
</div>