@extends('layouts.admin.app')

@section('title', 'Chi tiet san pham')

@section('admin-content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Quan ly san pham</div>
                        <h2 class="page-title">Chi tiet san pham</h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lai</a>
                            <button
                                type="button"
                                class="btn btn-primary btn-edit-product"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-edit-product"
                                data-update-url="{{ route('admin.product.update', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                data-name="{{ e($product->name) }}"
                                data-sku="{{ e($product->sku) }}"
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
                                data-video-url="{{ e($product->video_url) }}"
                                data-is-active="{{ $product->is_active ? 1 : 0 }}"
                                data-is-featured="{{ $product->is_featured ? 1 : 0 }}"
                                data-category-ids='@json($product->categories->pluck("id")->values())'
                                data-main-image-url="{{ $product->main_image ? asset('storage/' . $product->main_image) : '' }}"
                                data-og-image-url="{{ $product->og_image ? asset('storage/' . $product->og_image) : '' }}"
                                data-gallery-image-urls='@json($product->images->map(fn($image) => asset("storage/" . $image->image))->values())'>
                                Cap nhat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thong tin san pham</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ma san pham</div>
                                        <div class="fw-bold">{{ $product->sku ?? 'Chua co ma' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ten san pham</div>
                                        <div class="fw-bold">{{ $product->name }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Slug</div>
                                        <div>{{ $product->slug }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Gia</div>
                                        <div class="fw-bold text-primary">{{ number_format($product->price, 0, ',', '.') }}d</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ton kho</div>
                                        <div>{{ $product->stock_quantity }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Thu tu</div>
                                        <div>{{ $product->sort_order }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Link video</div>
                                        <div>
                                            @if ($product->video_url)
                                                <a href="{{ $product->video_url }}" target="_blank" rel="noopener noreferrer">
                                                    {{ $product->video_url }}
                                                </a>
                                            @else
                                                Chua co
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Trang thai</div>
                                        <div>
                                            @if ($product->is_active)
                                                <span class="badge bg-green-lt">Dang hien thi</span>
                                            @else
                                                <span class="badge bg-red-lt">Dang an</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Noi bat</div>
                                        <div>
                                            @if ($product->is_featured)
                                                <span class="badge bg-yellow-lt">San pham noi bat</span>
                                            @else
                                                <span class="badge bg-secondary-lt">San pham thuong</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ngay tao</div>
                                        <div>{{ $product->created_at?->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-secondary">Ngay cap nhat</div>
                                        <div>{{ $product->updated_at?->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <div class="text-secondary mb-1">Mo ta ngan</div>
                                        <div>{{ $product->short_description ?: 'Chua co mo ta ngan.' }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-secondary mb-1">Mo ta chi tiet</div>
                                        <div class="border rounded p-3 bg-light">
                                            {!! $product->description ?: '<span class="text-secondary">Chua co mo ta chi tiet.</span>' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Anh chinh</h3>
                            </div>
                            <div class="card-body p-0">
                                @if ($product->main_image)
                                    <div class="product-img-wrap ratio ratio-4x3">
                                        <img
                                            src="{{ asset('storage/' . $product->main_image) }}"
                                            alt="{{ $product->name }}"
                                            class="product-img-cover rounded-bottom">
                                    </div>
                                @else
                                    <div class="empty py-4">
                                        <div class="empty-title">Chua co anh chinh</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh muc ap dung</h3>
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
                                    <span class="text-secondary">San pham chua thuoc danh muc nao.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Anh phu san pham</h3>
                            </div>
                            <div class="card-body">
                                @if ($product->images->count())
                                    <div class="row g-2">
                                        @foreach ($product->images as $image)
                                            <div class="col-4">
                                                <div class="ratio ratio-1x1">
                                                    <img
                                                        src="{{ asset('storage/' . $image->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="product-img-cover rounded border">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-secondary">Chua co anh phu.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thong tin SEO</h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-4">Meta title</dt>
                                    <dd class="col-8">{{ $product->meta_title ?: 'Chua co' }}</dd>

                                    <dt class="col-4">Meta description</dt>
                                    <dd class="col-8">{{ $product->meta_description ?: 'Chua co' }}</dd>

                                    <dt class="col-4">Meta keywords</dt>
                                    <dd class="col-8">{{ $product->meta_keywords ?: 'Chua co' }}</dd>

                                    <dt class="col-4">Canonical URL</dt>
                                    <dd class="col-8">{{ $product->canonical_url ?: 'Chua co' }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Open Graph</h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-4">OG title</dt>
                                    <dd class="col-8">{{ $product->og_title ?: 'Chua co' }}</dd>

                                    <dt class="col-4">OG description</dt>
                                    <dd class="col-8">{{ $product->og_description ?: 'Chua co' }}</dd>

                                    <dt class="col-4">OG image</dt>
                                    <dd class="col-8">
                                        @if ($product->og_image)
                                            <div class="ratio ratio-16x9" style="max-width: 200px;">
                                                <img
                                                    src="{{ asset('storage/' . $product->og_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="product-img-cover rounded border">
                                            </div>
                                        @else
                                            Chua co
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
        .product-img-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
    </style>
@endsection
