@extends('layouts.admin.app')

@section('title', 'Chi tiết sản phẩm')

@section('admin-content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Quản lý sản phẩm</div>
                        <h2 class="page-title">Chi tiết sản phẩm</h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="button" class="btn btn-primary btn-edit-product" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-product"
                                data-update-url="{{ route('admin.product.update', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                data-name="{{ e($product->name) }}"
                                data-price="{{ $product->price }}"
                                data-stock-quantity="{{ $product->stock_quantity }}"
                                data-short-description="{{ e($product->short_description) }}"
                                data-description="{{ e($product->description) }}"
                                data-meta-title="{{ e($product->meta_title) }}"
                                data-meta-description="{{ e($product->meta_description) }}"
                                data-meta-keywords="{{ e($product->meta_keywords) }}"
                                data-canonical-url="{{ e($product->canonical_url) }}"
                                data-og-title="{{ e($product->og_title) }}"
                                data-og-description="{{ e($product->og_description) }}"
                                data-sort-order="{{ $product->sort_order }}"
                                data-is-active="{{ $product->is_active ? 1 : 0 }}"
                                data-is-featured="{{ $product->is_featured ? 1 : 0 }}"
                                data-category-ids='@json($product->categories->pluck("id")->values())'
                                data-main-image-url="{{ $product->main_image ? asset('storage/' . $product->main_image) : '' }}"
                                data-og-image-url="{{ $product->og_image ? asset('storage/' . $product->og_image) : '' }}"
                                data-gallery-image-urls='@json($product->images->map(fn($image) => asset("storage/" . $image->image))->values())'>
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">

                    {{-- Thông tin chính --}}
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="text-secondary">Mã sản phẩm</div>
                                        <div class="fw-bold">{{ $product->sku ?? 'Chưa có mã' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Tên sản phẩm</div>
                                        <div class="fw-bold">{{ $product->name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Slug</div>
                                        <div>{{ $product->slug }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Giá</div>
                                        <div class="fw-bold text-primary">
                                            {{ number_format($product->price, 0, ',', '.') }}đ
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Tồn kho</div>
                                        <div>{{ $product->stock_quantity }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Thứ tự</div>
                                        <div>{{ $product->sort_order }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Trạng thái</div>
                                        <div>
                                            @if ($product->is_active)
                                                <span class="badge bg-green-lt">Đang hiển thị</span>
                                            @else
                                                <span class="badge bg-red-lt">Đang ẩn</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Nổi bật</div>
                                        <div>
                                            @if ($product->is_featured)
                                                <span class="badge bg-yellow-lt">Sản phẩm nổi bật</span>
                                            @else
                                                <span class="badge bg-secondary-lt">Sản phẩm thường</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ngày tạo</div>
                                        <div>{{ $product->created_at?->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ngày cập nhật</div>
                                        <div>{{ $product->updated_at?->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="text-secondary mb-1">Mô tả ngắn</div>
                                        <div>{{ $product->short_description ?: 'Chưa có mô tả ngắn.' }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-secondary mb-1">Mô tả chi tiết</div>
                                        <div class="border rounded p-3 bg-light">
                                            {!! $product->description ?: '<span class="text-secondary">Chưa có mô tả chi tiết.</span>' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Ảnh chính --}}
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ảnh chính</h3>
                            </div>
                            <div class="card-body p-0">
                                @if ($product->main_image)
                                    {{-- Tỉ lệ 4:3 cố định, ảnh cover --}}
                                    <div class="product-img-wrap ratio ratio-4x3">
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}"
                                            class="product-img-cover rounded-bottom">
                                    </div>
                                @else
                                    <div class="empty py-4">
                                        <div class="empty-title">Chưa có ảnh chính</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Danh mục --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh mục áp dụng</h3>
                            </div>
                            <div class="card-body">
                                @forelse ($product->categories as $category)
                                    <span class="badge bg-blue-lt me-1 mb-1">
                                        @if ($category->parent)
                                            {{ $category->parent->name }} /
                                        @endif
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    <span class="text-secondary">Sản phẩm chưa thuộc danh mục nào.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Ảnh phụ --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ảnh phụ sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                @if ($product->images->count())
                                    <div class="row g-2">
                                        @foreach ($product->images as $image)
                                            <div class="col-4">
                                                {{-- ratio-1x1 giữ ảnh vuông đều nhau, object-fit cover không méo --}}
                                                <div class="ratio ratio-1x1">
                                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                                        class="product-img-cover rounded border">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-secondary">Chưa có ảnh phụ.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin SEO</h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-4">Meta title</dt>
                                    <dd class="col-8">{{ $product->meta_title ?: 'Chưa có' }}</dd>

                                    <dt class="col-4">Meta description</dt>
                                    <dd class="col-8">{{ $product->meta_description ?: 'Chưa có' }}</dd>

                                    <dt class="col-4">Meta keywords</dt>
                                    <dd class="col-8">{{ $product->meta_keywords ?: 'Chưa có' }}</dd>

                                    <dt class="col-4">Canonical URL</dt>
                                    <dd class="col-8">{{ $product->canonical_url ?: 'Chưa có' }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    {{-- Open Graph --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Open Graph</h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-4">OG title</dt>
                                    <dd class="col-8">{{ $product->og_title ?: 'Chưa có' }}</dd>

                                    <dt class="col-4">OG description</dt>
                                    <dd class="col-8">{{ $product->og_description ?: 'Chưa có' }}</dd>

                                    <dt class="col-4">OG image</dt>
                                    <dd class="col-8">
                                        @if ($product->og_image)
                                            {{-- tỉ lệ 16:9 chuẩn OG --}}
                                            <div class="ratio ratio-16x9" style="max-width: 200px;">
                                                <img src="{{ asset('storage/' . $product->og_image) }}"
                                                    alt="{{ $product->name }}" class="product-img-cover rounded border">
                                            </div>
                                        @else
                                            Chưa có
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.product.edit')

    <style>
        /* Ảnh cover không bị méo, lấp đầy khung ratio */
        .product-img-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
    </style>
@endsection
