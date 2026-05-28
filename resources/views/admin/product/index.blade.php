@extends('layouts.admin.app')

@section('admin-content')
    <div class="container mt-4">
        <h1 class="mb-4">Sản phẩm - Mộc Hương Flower Shop</h1>

        <div>
            @include('admin.partials.alert')
        </div>

        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Sản phẩm</h2>
                    </div>
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-product">
                                Thêm sản phẩm mới
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-create-product" aria-label="Thêm sản phẩm mới">
                                +
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách sản phẩm</h3>
                            </div>

                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Hiển thị
                                        <div class="mx-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" value="{{ $products->count() }}" size="3" readonly>
                                        </div>
                                        sản phẩm
                                    </div>

                                    <div class="ms-auto text-muted">
                                        Tìm kiếm:
                                        <div class="ms-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" id="search-product">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>Mã SP</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Tồn kho</th>
                                            <th>Nổi bật</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th class="text-end">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-blue-lt">{{ $item->sku_code ?? 'Chưa có mã' }}</span>
                                                </td>
                                                <td>
                                                    @if ($item->main_image)
                                                        <span class="avatar avatar-md" style="background-image: url('{{ asset('storage/' . $item->main_image) }}')"></span>
                                                    @else
                                                        <span class="avatar avatar-md"></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.product.show', ['id' => $item->id, 'slug' => $item->slug]) }}" class="text-reset fw-semibold">
                                                        {{ $item->name }}
                                                    </a>
                                                    @if ($item->short_description)
                                                        <div class="text-muted small text-truncate" style="max-width: 280px;">
                                                            {{ $item->short_description }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td><strong>{{ number_format($item->price, 0, ',', '.') }}đ</strong></td>
                                                <td>
                                                    @if ($item->stock_quantity > 0)
                                                        <span class="badge bg-green-lt">{{ $item->stock_quantity }}</span>
                                                    @else
                                                        <span class="badge bg-red-lt">Hết hàng</span>
                                                    @endif
                                                </td>
                                                <td>{!! $item->is_featured ? '<span class="badge bg-yellow-lt">Có</span>' : '<span class="text-muted">Không</span>' !!}</td>
                                                <td>{!! $item->is_active ? '<span class="badge bg-success-lt">Hiển thị</span>' : '<span class="badge bg-secondary-lt">Ẩn</span>' !!}</td>
                                                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Thao tác</button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ route('admin.product.show', ['id' => $item->id, 'slug' => $item->slug]) }}">Chi tiết</a>
                                                            <a class="dropdown-item btn-edit-product" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-product"
                                                                data-product-id="{{ $item->id }}"
                                                                data-update-url="{{ route('admin.product.update', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                                data-name="{{ e($item->name) }}"
                                                                data-sku-id="{{ $item->sku_id }}"
                                                                data-price="{{ $item->price }}"
                                                                data-stock-quantity="{{ $item->stock_quantity }}"
                                                                data-short-description="{{ e($item->short_description) }}"
                                                                data-description="{{ e($item->description) }}"
                                                                data-meta-title="{{ e($item->meta_title) }}"
                                                                data-meta-description="{{ e($item->meta_description) }}"
                                                                data-meta-keywords="{{ e($item->meta_keywords) }}"
                                                                data-canonical-url="{{ e($item->canonical_url) }}"
                                                                data-og-title="{{ e($item->og_title) }}"
                                                                data-og-description="{{ e($item->og_description) }}"
                                                                data-sort-order="{{ $item->sort_order }}"
                                                                data-video-url="{{ e($item->video_url) }}"
                                                                data-is-active="{{ $item->is_active ? 1 : 0 }}"
                                                                data-is-featured="{{ $item->is_featured ? 1 : 0 }}"
                                                                data-category-ids='@json($item->categories->pluck("id")->values())'
                                                                data-main-image-url="{{ $item->main_image ? asset('storage/' . $item->main_image) : '' }}"
                                                                data-og-image-url="{{ $item->og_image ? asset('storage/' . $item->og_image) : '' }}"
                                                                data-gallery-image-urls='@json($item->images->map(fn($image) => asset("storage/" . $image->image))->values())'>
                                                                Cập nhật
                                                            </a>
                                                            <form action="{{ route('admin.product.destroy', $item) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-4">Chưa có sản phẩm nào.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($products->hasPages())
                                <div class="card-footer d-flex align-items-center">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.product.create')
        @include('admin.product.edit')
    </div>
@endsection

@section('js')
    @php
        $productSkuOptions = $allSkus->map(function ($sku) {
            return [
                'id' => $sku->id,
                'code' => $sku->sku,
                'name' => $sku->name,
                'price' => (float) $sku->default_sale_price,
                'stock_quantity' => (int) ($sku->inventory?->quantity ?? 0),
                'assigned_product_id' => optional($sku->products->first())->id,
            ];
        })->values();
    @endphp
    <script>
        window.productSkuOptions = @json($productSkuOptions);

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-product');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    document.querySelectorAll('.datatable tbody tr').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
@endsection
