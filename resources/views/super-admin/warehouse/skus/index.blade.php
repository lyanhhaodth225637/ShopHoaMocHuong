@extends('layouts.super-admin.app')

@section('title', 'SKU kho')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'SKU kho')

@section('page-actions')
    <a href="{{ route('admin.warehouse.skus.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Thêm SKU
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách SKU kho</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Tên hàng</th>
                    <th>Đơn vị</th>
                    <th>Giá vốn</th>
                    <th>Giá bán</th>
                    <th>Tồn</th>
                    <th>Trạng thái</th>
                    <th class="w-1">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($skus as $sku)
                    <tr>
                        <td>{{ $sku->id }}</td>
                        <td><span class="badge bg-blue-lt">{{ $sku->sku }}</span></td>
                        <td class="fw-semibold">{{ $sku->name }}</td>
                        <td>{{ $sku->unit?->name }}</td>
                        <td>{{ number_format($sku->default_cost_price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($sku->default_sale_price, 0, ',', '.') }}đ</td>
                        <td>
                            @if ($sku->track_inventory)
                                {{ $sku->inventory?->quantity ?? 0 }}
                            @else
                                <span class="badge bg-secondary-lt">Không theo dõi</span>
                            @endif
                        </td>
                        <td>
                            @if (! $sku->is_active)
                                <span class="badge bg-danger-lt">Tắt</span>
                            @elseif (! $sku->track_inventory)
                                <span class="badge bg-secondary-lt">Không quản lý tồn</span>
                            @elseif (($sku->inventory?->quantity ?? 0) <= 0)
                                <span class="badge bg-danger-lt">Hết hàng</span>
                            @elseif (($sku->inventory?->quantity ?? 0) <= $sku->min_quantity)
                                <span class="badge bg-warning-lt">Sắp hết</span>
                            @else
                                <span class="badge bg-success-lt">Còn hàng</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.skus.edit', $sku) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.warehouse.skus.destroy', $sku) }}" method="POST"
                                      onsubmit="return confirm('Xóa SKU này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-secondary py-4">Chưa có dữ liệu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($skus->hasPages())
        <div class="card-footer">{{ $skus->links() }}</div>
    @endif
</div>
@endsection
