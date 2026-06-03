@extends('layouts.frontend.app')
@section('title', $category->meta_title ?? $category->name)
@section('meta_description', $category->meta_description ?? $category->description ?? ('Danh mục ' . $category->name . ' tại Hoa Gỗ Mộc Hương với nhiều mẫu hoa và quà tặng đẹp, giao nhanh tại Long Xuyên.'))
@section('meta_keywords', $category->name . ', danh mục hoa, hoa tươi Long Xuyên, shop hoa Mộc Hương')
@section('canonical', route('frontend.category.show', ['id' => $category->id, 'slug' => $category->slug]))

@section('content')
    <section class="section-py bg-pale">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Danh mục sản phẩm</div>
                    <h2 class="section-title mb-0">{{ $category->name }}</h2>
                    <div class="divider-leaf"></div>

                    @if (!empty($category->description))
                        <p class="text-muted mt-2 mb-0">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="text-muted">
                    Tìm thấy <strong>{{ $products->total() }}</strong> sản phẩm
                </div>

                <button class="btn btn-green" onclick="openFilterDrawer()">
                    <i class="bi bi-sliders2 me-2"></i>Bộ lọc
                </button>
            </div>

            <div class="row g-3">
                @forelse ($products as $product)
                    <div class="col-6 col-md-3">
                        <div class="product-card h-100">

                            <a href="{{ route('frontend.product.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                class="img-wrap d-block">
                                @if ($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->name }}">
                                @endif

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
                            </a>

                            <button class="product-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>

                            <div class="product-body">
                                <div class="product-stars mb-1">
                                    ★★★★★
                                    <span style="color:#aaa;font-size:.75rem">(0)</span>
                                </div>

                                <a href="{{ route('frontend.product.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                    class="product-name text-decoration-none">
                                    {{ $product->name }}
                                </a>

                                <div class="mt-2 mb-3">
                                    <span class="product-price">
                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                    </span>
                                </div>

                                @if ($product->stock_quantity > 0)
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
                                @else
                                    <button type="button" class="btn-add-cart" disabled>
                                        <i class="bi bi-x-circle me-1"></i>
                                        Hết hàng
                                    </button>
                                @endif
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
