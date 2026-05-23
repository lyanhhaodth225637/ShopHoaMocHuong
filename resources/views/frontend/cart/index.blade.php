@extends('layouts.frontend.app')

@section('title', 'Giỏ hàng')

@section('content')
    <style>
        .cart-contact-box {
            background: var(--green-pale);
            border-radius: 14px;
            padding: 16px;
        }

        .cart-contact-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .cart-contact-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 10px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: .84rem;
            margin-bottom: 6px;
            transition: background .2s;
        }

        .cart-contact-link:last-child {
            margin-bottom: 0;
        }

        .cart-contact-link:hover {
            background: #fff;
            color: var(--text-dark);
        }

        .cart-contact-link strong {
            display: block;
            font-size: .85rem;
        }

        .cart-contact-link small {
            display: block;
            font-size: .75rem;
            color: var(--text-muted);
        }

        .cart-contact-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .cart-ci-zalo {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .cart-ci-phone {
            background: #dcfce7;
            color: #15803d;
        }

        .cart-ci-mess {
            background: #f3e8ff;
            color: #7e22ce;
        }
    </style>
    <section class="section-py bg-pale">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Mua sắm</div>
                    <h2 class="section-title mb-0">Giỏ hàng của bạn</h2>
                    <div class="divider-leaf"></div>
                </div>
            </div>

            @php
                $cartItems = $cart->items->filter(fn($item) => $item->itemable !== null)->values();
                $subtotal = $cartItems->sum(function ($item) {
                    return $item->itemable->getPrice() * $item->quantity;
                });
            @endphp

            @if ($cartItems->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                    <i class="bi bi-bag-x" style="font-size:48px;color:#999;"></i>
                    <p class="mt-3 mb-0 text-muted">Giỏ hàng của bạn đang trống.</p>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-0">
                                @foreach ($cartItems as $item)
                                    @php
                                        $product = $item->itemable;
                                        $price = $product->getPrice();
                                        $image = $product->main_image
                                            ? asset('storage/' . $product->main_image)
                                            : asset('images/no-image.png');
                                    @endphp

                                    <div class="d-flex gap-3 p-4 border-bottom">
                                        <img src="{{ $image }}" alt="{{ $product->name }}"
                                            style="width:96px;height:96px;object-fit:cover;border-radius:16px;">

                                        <div class="flex-grow-1">
                                            <h5 class="mb-2">{{ $product->name }}</h5>
                                            <div class="text-success fw-semibold mb-3">
                                                {{ number_format($price, 0, ',', '.') }}đ
                                            </div>

                                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                                <form
                                                    action="{{ route('user.cart.decrease', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                                </form>

                                                <span class="fw-semibold px-2">{{ $item->quantity }}</span>

                                                <form
                                                    action="{{ route('user.cart.increase', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                                </form>

                                                <form
                                                    action="{{ route('user.cart.remove', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                                    method="POST" class="ms-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0">Xóa</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="fw-bold text-nowrap">
                                            {{ number_format($price * $item->quantity, 0, ',', '.') }}đ
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h5 class="mb-4">Tóm tắt đơn hàng</h5>

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tạm tính</span>
                                    <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                </div>

                                <!-- <div class="d-flex justify-content-between mb-3">
                                    <span>Phí giao hàng</span>
                                    <span class="text-success"></span>
                                </div> -->

                                <hr>

                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Tổng cộng</span>
                                    <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                </div>

                                <!-- <a href="" class="btn btn-green w-100 rounded-pill py-3 mt-3">
                                            Tiến hành thanh toán
                                        </a> -->

                                <button type="button" class="btn btn-outline-green w-100 rounded-pill py-3 mt-2"
                                    data-bs-toggle="collapse" data-bs-target="#contactOrderBox">
                                    <i class="bi bi-telephone me-2"></i>Liên hệ đặt hàng
                                </button>

                                <div class="collapse mt-3" id="contactOrderBox">
                                    <div class="cart-contact-box">
                                        <p class="cart-contact-label">Chọn cách liên hệ</p>

                                        <a href="https://zalo.me/{{ config('contact.zalo') }}" target="_blank"
                                            class="cart-contact-link">
                                            <div class="cart-contact-icon cart-ci-zalo"><i class="bi bi-chat-dots-fill"></i>
                                            </div>
                                            <div>
                                                <strong>Zalo</strong>
                                                <small>Chat ngay với tư vấn viên</small>
                                            </div>
                                        </a>

                                        <a href="tel:{{ config('contact.phone') }}" class="cart-contact-link">
                                            <div class="cart-contact-icon cart-ci-phone"><i class="bi bi-telephone-fill"></i>
                                            </div>
                                            <div>
                                                <strong>Gọi điện</strong>
                                                <small>{{ config('contact.phone', '0123 456 789') }} — 8:00–21:00</small>
                                            </div>
                                        </a>

                                        <a href="https://m.me/{{ config('contact.facebook_page') }}" target="_blank"
                                            class="cart-contact-link">
                                            <div class="cart-contact-icon cart-ci-mess"><i class="bi bi-messenger"></i></div>
                                            <div>
                                                <strong>Facebook Messenger</strong>
                                                <small>Phản hồi trong vài phút</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>




@endsection