<div id="cartDrawer" class="cart-drawer" role="dialog" aria-modal="true" aria-label="Giỏ hàng">
    <div class="cart-backdrop" id="cartBackdrop"></div>
    <div class="cart-panel">

        <!-- Header -->
        <div class="cart-header">
            <div class="cart-header-title">
                <i class="bi bi-bag me-2"></i> Giỏ hàng
                <span class="cart-count-pill" id="cartCountPill">5 sản phẩm</span>
            </div>
            <button class="cart-close" id="cartCloseBtn" aria-label="Đóng giỏ hàng">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Items -->
        <div class="cart-body" id="cartBody">

            <div class="cart-item" data-id="1">
                <div class="cart-item-img"><img src="assets/img/shop/01.png" alt="Hoa hồng đỏ"></div>
                <div class="cart-item-info">
                    <div class="cart-item-name">Bó hoa hồng đỏ tình yêu – 30 bông</div>
                    <div class="cart-item-price">380.000đ</div>
                    <div class="cart-item-qty">
                        <button class="qty-btn" data-action="minus" data-id="1">−</button>
                        <span class="qty-val" id="qty-1">1</span>
                        <button class="qty-btn" data-action="plus" data-id="1">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" data-id="1" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
            </div>

            <div class="cart-item" data-id="2">
                <div class="cart-item-img"><img src="assets/img/shop/02.png" alt="Giỏ hoa sinh nhật"></div>
                <div class="cart-item-info">
                    <div class="cart-item-name">Giỏ hoa sinh nhật pastel dễ thương</div>
                    <div class="cart-item-price">450.000đ</div>
                    <div class="cart-item-qty">
                        <button class="qty-btn" data-action="minus" data-id="2">−</button>
                        <span class="qty-val" id="qty-2">2</span>
                        <button class="qty-btn" data-action="plus" data-id="2">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" data-id="2" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
            </div>

            <div class="cart-item" data-id="3">
                <div class="cart-item-img"><img src="assets/img/shop/03.png" alt="Lan hồ điệp"></div>
                <div class="cart-item-info">
                    <div class="cart-item-name">Chậu lan hồ điệp trắng – 3 cành</div>
                    <div class="cart-item-price">750.000đ</div>
                    <div class="cart-item-qty">
                        <button class="qty-btn" data-action="minus" data-id="3">−</button>
                        <span class="qty-val" id="qty-3">1</span>
                        <button class="qty-btn" data-action="plus" data-id="3">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" data-id="3" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
            </div>

            <div class="cart-item" data-id="4">
                <div class="cart-item-img"><img src="assets/img/shop/04.png" alt="Hộp hoa cưới"></div>
                <div class="cart-item-info">
                    <div class="cart-item-name">Hộp hoa cưới cao cấp – hồng phấn & trắng</div>
                    <div class="cart-item-price">680.000đ</div>
                    <div class="cart-item-qty">
                        <button class="qty-btn" data-action="minus" data-id="4">−</button>
                        <span class="qty-val" id="qty-4">1</span>
                        <button class="qty-btn" data-action="plus" data-id="4">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" data-id="4" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
            </div>

        </div>

        <!-- Promo code -->
        <div class="cart-promo">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Mã giảm giá..." id="promoInput" />
                <button class="btn cart-promo-btn" id="promoApplyBtn">Áp dụng</button>
            </div>
            <div class="cart-promo-msg" id="promoMsg"></div>
        </div>

        <!-- Summary -->
        <div class="cart-summary">
            <div class="cart-summary-row">
                <span>Tạm tính</span>
                <span id="cartSubtotal">2.260.000đ</span>
            </div>
            <div class="cart-summary-row" id="discountRow" style="display:none;color:#e74c3c;">
                <span>Giảm giá</span>
                <span id="cartDiscount">−0đ</span>
            </div>
            <div class="cart-summary-row">
                <span>Phí giao hàng</span>
                <span style="color:var(--green-main);font-weight:600;">Miễn phí</span>
            </div>
            <div class="cart-summary-row cart-total">
                <span>Tổng cộng</span>
                <span id="cartTotal">2.260.000đ</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="cart-actions">
            <a href="#" class="btn-green w-100 text-center d-block mb-2" style="padding:14px;">
                <i class="bi bi-credit-card me-1"></i> Thanh toán ngay
            </a>
            <button class="btn-outline-green w-100" id="continueShoppingBtn" style="padding:12px;">
                ← Tiếp tục mua sắm
            </button>
        </div>

    </div>
</div>