@extends('layouts.frontend.app')
@section('meta_description', 'Khám phá tất cả sản phẩm tại Hoa Gỗ Mộc Hương: hoa tươi, bó hoa, giỏ hoa, quà tặng và các mẫu thiết kế dành cho nhiều dịp đặc biệt.')
@section('meta_keywords', 'tất cả sản phẩm hoa, hoa tươi Long Xuyên, bó hoa đẹp, giỏ hoa quà tặng, shop hoa Mộc Hương')

@section('title', 'Tất cả sản phẩm')

@section('content')
    <style>
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: .75rem;
            padding: 4px 8px;
            border-radius: 999px;
        }

        .product-wishlist {
            position: absolute;
            top: 12px;
            right: 12px;
            border: none;
            background: #fff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
        }

        .product-body {
            padding: 14px;
        }

        .product-name {
            font-weight: 600;
            min-height: 44px;
        }

        .product-price {
            color: #198754;
            font-weight: 700;
        }

        .btn-add-cart {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 9px 12px;
            /* background: #198754; */
            color: #fff;
        }

        .btn-add-cart:disabled {
            background: #adb5bd;
        }
    </style>

    <section class="section-py bg-pale">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Sản phẩm</div>
                    <h2 class="section-title mb-0">Tất cả sản phẩm</h2>
                    <div class="divider-leaf"></div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="text-muted">
                    Tìm thấy <strong>{{ $products->total() }}</strong> sản phẩm
                </div>
            </div>

            <div class="row g-3">
                @forelse ($products as $product)
                    <div class="col-6 col-md-3">

                        <div class="product-card h-100">
                            <div class="img-wrap">

                                <a
                                    href="{{ route('frontend.product.show', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                    @if ($product->main_image)
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->name }}">
                                    @endif
                                </a>

                                @if ($product->is_featured)
                                    <span class="product-badge bg-danger text-white">
                                        Nổi bật
                                    </span>
                                @endif

                                @if ($product->stock_quantity <= 0)
                                    <span class="product-badge bg-secondary text-white">
                                        Hết hàng
                                    </span>
                                @endif

                                <button class="product-wishlist" type="button">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>

                            <div class="product-body">
                                <div class="product-stars mb-1">
                                    ★★★★★
                                    <span style="color:#aaa;font-size:.75rem">(0)</span>
                                </div>

                                <a href="{{ route('frontend.product.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                    class="product-name text-decoration-none d-block">
                                    {{ $product->name }}
                                </a>

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
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-5">
                            Không tìm thấy sản phẩm phù hợp.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
