@extends('layouts.super-admin.app')

@section('title', 'Chi tiết phiếu nhập')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Chi tiết phiếu nhập ' . $inputSlip->code)

@section('page-actions')
    <a href="{{ route('admin.warehouse.input-slips.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>

    @if ($inputSlip->status === 'draft')
        <form action="{{ route('admin.warehouse.input-slips.complete', $inputSlip) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Hoàn tất phiếu nhập và cộng kho?')">
            @csrf
            <button class="btn btn-success">
                <i class="ti ti-check"></i> Hoàn tất
            </button>
        </form>
    @endif
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Thông tin phiếu</h3></div>
            <div class="card-body">
                <div class="mb-2"><strong>Mã phiếu:</strong> {{ $inputSlip->code }}</div>
                <div class="mb-2"><strong>Nhà cung cấp:</strong> {{ $inputSlip->supplier?->name ?? 'Không có' }}</div>
                <div class="mb-2"><strong>Ngày nhập:</strong> {{ optional($inputSlip->input_date)->format('d/m/Y') }}</div>
                <div class="mb-2"><strong>Người tạo:</strong> {{ $inputSlip->creator?->name }}</div>
                <div class="mb-2">
                    <strong>Trạng thái:</strong>
                    @if ($inputSlip->status === 'draft')
                        <span class="badge bg-secondary-lt">Nháp</span>
                    @elseif ($inputSlip->status === 'completed')
                        <span class="badge bg-success-lt">Hoàn tất</span>
                    @else
                        <span class="badge bg-danger-lt">Đã hủy</span>
                    @endif
                </div>
                <div class="mb-2"><strong>Ghi chú:</strong> {{ $inputSlip->note }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Danh sách hàng nhập</h3></div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Tên hàng</th>
                            <th>Số lượng</th>
                            <th>Giá nhập</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inputSlip->items as $item)
                            <tr>
                                <td><span class="badge bg-blue-lt">{{ $item->sku?->sku }}</span></td>
                                <td>{{ $item->sku?->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->cost_price, 0, ',', '.') }}đ</td>
                                <td>{{ number_format($item->total_price, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng cộng</th>
                            <th>{{ number_format($inputSlip->total_amount, 0, ',', '.') }}đ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
