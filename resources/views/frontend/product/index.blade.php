@extends('layouts.frontend.app')

@section('title', 'Tất cả sản phẩm')

@section('content')
    <style>
        .filter-box .card {
            border-radius: 18px;
        }

        .filter-box .form-control,
        .filter-box .form-select {
            border-radius: 12px;
        }



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

        /* ── Filter modal dùng lại cart-drawer từ CSS đi kèm ── */
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

                <button class="btn btn-green" onclick="openFilterDrawer()">
                    <i class="bi bi-sliders2 me-2"></i>Bộ lọc
                </button>
            </div>

            <div class="row g-3">
                @forelse ($products as $product)
                    <div class="col-6 col-md-3">
                        <div class="product-card h-100">
                            <div class="img-wrap">
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

                                <button class="product-wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>

                            <div class="product-body">
                                <div class="product-stars mb-1">
                                    ★★★★★
                                    <span style="color:#aaa;font-size:.75rem">(0)</span>
                                </div>

                                <div class="product-name">
                                    {{ $product->name }}
                                </div>

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

    {{-- ── Filter Drawer (dùng lại cấu trúc cart-drawer) ── --}}
    <div class="cart-drawer filter-drawer" id="filterDrawer">
        <div class="cart-backdrop" onclick="closeFilterDrawer()"></div>

        <div class="cart-panel">
            {{-- Header --}}
            <div class="cart-header">
                <div class="cart-header-title">
                    <i class="bi bi-sliders2"></i>
                    Bộ lọc sản phẩm
                </div>
                <button class="cart-close" onclick="closeFilterDrawer()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            {{-- Body: toàn bộ form gốc giữ nguyên --}}
            <form action="{{ route('frontend.product.index') }}" method="GET" class="filter-box d-flex flex-column"
                style="flex:1;min-height:0;">
                <div class="cart-body">
                    <div class="mb-3">
                        <label class="form-label">Tìm kiếm</label>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                            placeholder="Tên sản phẩm, mã sản phẩm...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">Tất cả danh mục</option>

                            @foreach ($categories as $parent)
                                <option value="{{ $parent->id }}" @selected(request('category_id') == $parent->id)>
                                    {{ $parent->name }}
                                </option>

                                @foreach ($parent->children as $child)
                                    <option value="{{ $child->id }}" @selected(request('category_id') == $child->id)>
                                        — {{ $child->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Khoảng giá</label>

                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                    class="form-control" min="0" placeholder="Từ">
                            </div>

                            <div class="col-6">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                    class="form-control" min="0" placeholder="Đến">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tình trạng kho</label>
                        <select name="stock_status" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="in_stock" @selected(request('stock_status') === 'in_stock')>
                                Còn hàng
                            </option>
                            <option value="out_of_stock" @selected(request('stock_status') === 'out_of_stock')>
                                Hết hàng
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" name="featured" value="1" class="form-check-input"
                                @checked(request('featured') == 1)>
                            <span class="form-check-label">
                                Chỉ sản phẩm nổi bật
                            </span>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sắp xếp</label>
                        <select name="sort" class="form-select">
                            <option value="random" @selected(request('sort') === 'random')>
                                Ngẫu nhiên
                            </option>
                            <option value="newest" @selected(request('sort') === 'newest')>
                                Mới nhất
                            </option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>
                                Giá tăng dần
                            </option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>
                                Giá giảm dần
                            </option>
                            <option value="name_asc" @selected(request('sort') === 'name_asc')>
                                Tên A-Z
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Footer actions --}}
                <div class="cart-actions d-grid gap-2">
                    <button type="submit" class="btn btn-green">
                        Lọc sản phẩm
                    </button>

                    <a href="{{ route('frontend.product.index') }}" class="btn btn-outline-green">
                        Xóa bộ lọc
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openFilterDrawer() {
            const d = document.getElementById('filterDrawer');
            d.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeFilterDrawer() {
            const d = document.getElementById('filterDrawer');
            d.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeFilterDrawer();
        });
    </script>
@endsection