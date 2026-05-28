@extends('layouts.super-admin.app')

@section('title', 'Chi tiết phiếu xuất')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Chi tiết phiếu xuất ' . $outputSlip->code)

@section('page-actions')
    <a href="{{ route('admin.warehouse.output-slips.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>

    @if ($outputSlip->status === 'draft')
        <form action="{{ route('admin.warehouse.output-slips.complete', $outputSlip) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Hoàn tất phiếu xuất và trừ kho?')">
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
                <div class="mb-2"><strong>Mã phiếu:</strong> {{ $outputSlip->code }}</div>
                <div class="mb-2"><strong>Khách hàng:</strong> {{ $outputSlip->customer?->name ?? 'Không có' }}</div>
                <div class="mb-2"><strong>Ngày xuất:</strong> {{ optional($outputSlip->output_date)->format('d/m/Y') }}</div>
                <div class="mb-2"><strong>Loại xuất:</strong> {{ $outputSlip->output_type }}</div>
                <div class="mb-2"><strong>Người tạo:</strong> {{ $outputSlip->creator?->name }}</div>
                <div class="mb-2">
                    <strong>Trạng thái:</strong>
                    @if ($outputSlip->status === 'draft')
                        <span class="badge bg-secondary-lt">Nháp</span>
                    @elseif ($outputSlip->status === 'completed')
                        <span class="badge bg-success-lt">Hoàn tất</span>
                    @else
                        <span class="badge bg-danger-lt">Đã hủy</span>
                    @endif
                </div>
                <div class="mb-2"><strong>Ghi chú:</strong> {{ $outputSlip->note }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Danh sách hàng xuất</h3></div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Tên hàng</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outputSlip->items as $item)
                            <tr>
                                <td><span class="badge bg-blue-lt">{{ $item->sku?->sku }}</span></td>
                                <td>{{ $item->sku?->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->sale_price, 0, ',', '.') }}đ</td>
                                <td>{{ number_format($item->total_price, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng cộng</th>
                            <th>{{ number_format($outputSlip->total_amount, 0, ',', '.') }}đ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
