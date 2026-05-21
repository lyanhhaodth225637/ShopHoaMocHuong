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
        'khac' => 'Khác',
    ];
@endphp

<div id="mobileNavModal" class="mobile-nav-modal" role="dialog" aria-modal="true" aria-label="Menu điều hướng">
    <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>

    <div class="mobile-nav-drawer">
        <div class="mobile-nav-header">
            <div class="d-flex align-items-center gap-2">
                <img src="assets/img/logo.png" alt="Mộc Hương"
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
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm hoa, giỏ quà..." />
                <button class="btn" style="background:var(--green-main);color:#fff;border:none;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="mobile-nav-quick">
            <a href="#" class="mobile-quick-link">
                <i class="bi bi-person-circle"></i>
                <span>Tài khoản</span>
            </a>
            <a href="#" class="mobile-quick-link">
                <i class="bi bi-heart"></i>
                <span>Yêu thích</span>
                <span class="mnq-badge">3</span>
            </a>
            <button id="cartOpenBtnMobile" class="mobile-quick-link"
                style="background:none;border:none;flex:1;cursor:pointer;">
                <i class="bi bi-bag"></i>
                <span>Giỏ hàng</span>
                <span class="mnq-badge">5</span>
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
