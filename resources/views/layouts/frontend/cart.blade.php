@php
    use Binafy\LaravelCart\Models\Cart;

    $headerCart = null;
    $cartItems = collect();
    $cartCount = 0;
    $cartSubtotal = 0;

    if (auth()->check()) {
        $headerCart = Cart::query()
            ->where('user_id', auth()->id())
            ->with('items.itemable')
            ->first();

        if ($headerCart) {
            $cartItems = $headerCart->items->filter(fn($item) => $item->itemable !== null);

            $cartCount = $cartItems->sum('quantity');

            $cartSubtotal = $cartItems->sum(function ($item) {
                return $item->itemable->getPrice() * $item->quantity;
            });
        }
    }
@endphp

<div id="cartDrawer" class="cart-drawer" role="dialog" aria-modal="true" aria-label="Giỏ hàng">
    <div class="cart-backdrop" id="cartBackdrop"></div>

    <div class="cart-panel">

        {{-- Header --}}
        <div class="cart-header">
            <div class="cart-header-title">
                <i class="bi bi-bag me-2"></i>
                Giỏ hàng
                <span class="cart-count-pill" id="cartCountPill">
                    {{ $cartCount }} sản phẩm
                </span>
            </div>
            <button type="button" class="cart-close" id="cartCloseBtn" aria-label="Đóng giỏ hàng">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Body --}}
        <div class="cart-body" id="cartBody">
            @auth
                @if($cartItems->count() > 0)
                    @foreach($cartItems as $item)
                        @php
                            $product = $item->itemable;
                            $price = $product->getPrice();
                            $image = $product->main_image
                                ? asset('storage/' . $product->main_image)
                                : asset('images/no-image.png');
                        @endphp

                        <div class="cart-item" data-cart-item="{{ $item->id }}">

                            <div class="cart-item-img">
                                <img src="{{ $image }}" alt="{{ $product->name }}">
                            </div>

                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $product->name }}</div>

                                <div class="cart-item-price">
                                    {{ number_format($price, 0, ',', '.') }}đ
                                </div>

                                <div class="cart-item-qty">
                                    <form
                                        action="{{ route('user.cart.decrease', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="qty-btn">−</button>
                                    </form>

                                    <span class="qty-val">{{ $item->quantity }}</span>

                                    <form
                                        action="{{ route('user.cart.increase', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="qty-btn">+</button>
                                    </form>
                                </div>

                                <div class="cart-item-line-total">
                                    {{ number_format($price * $item->quantity, 0, ',', '.') }}đ
                                </div>
                            </div>

                            <form action="{{ route('user.cart.remove', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart-item-remove" aria-label="Xóa">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>

                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5 px-3">
                        <i class="bi bi-bag-x" style="font-size: 44px; color: #999;"></i>
                        <p class="mt-3 mb-0">Giỏ hàng của bạn đang trống.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-5 px-3">
                    <i class="bi bi-person-lock" style="font-size:44px;color:#999;"></i>
                    <p class="mt-3 mb-3">Vui lòng đăng nhập để xem giỏ hàng.</p>
                    <a href="{{ route('login') }}" class="btn-green d-inline-block text-center" style="padding:10px 18px;">
                        Đăng nhập
                    </a>
                </div>
            @endauth
        </div>

        {{-- Promo --}}
        <div class="cart-promo">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Mã giảm giá..." id="promoInput" />
                <button type="button" class="btn cart-promo-btn" id="promoApplyBtn">Áp dụng</button>
            </div>
            <div class="cart-promo-msg" id="promoMsg"></div>
        </div>

        {{-- Summary --}}
        <div class="cart-summary">
            <div class="cart-summary-row">
                <span>Tạm tính</span>
                <span id="cartSubtotal">{{ number_format($cartSubtotal, 0, ',', '.') }}đ</span>
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
                <span id="cartTotal">{{ number_format($cartSubtotal, 0, ',', '.') }}đ</span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="cart-actions">
            @auth
                <a href="{{ route('user.cart.index') }}" class="btn-green w-100 text-center d-block mb-2"
                    style="padding:14px;">
                    <i class="bi bi-bag-check me-1"></i> Xem giỏ hàng
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-green w-100 text-center d-block mb-2" style="padding:14px;">
                    <i class="bi bi-person me-1"></i> Đăng nhập để mua hàng
                </a>
            @endauth

            <button type="button" class="btn-outline-green w-100" id="continueShoppingBtn" style="padding:12px;">
                ← Tiếp tục mua sắm
            </button>
        </div>

    </div>
</div>