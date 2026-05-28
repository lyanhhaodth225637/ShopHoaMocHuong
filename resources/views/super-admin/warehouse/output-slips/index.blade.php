@extends('layouts.super-admin.app')

@section('title', 'Phiếu xuất')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Phiếu xuất')

@section('page-actions')
    <a href="{{ route('admin.warehouse.output-slips.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Tạo phiếu xuất
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách phiếu xuất</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Khách hàng</th>
                    <th>Ngày xuất</th>
                    <th>Loại xuất</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th class="w-1">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outputSlips as $outputSlip)
                    <tr>
                        <td><span class="badge bg-blue-lt">{{ $outputSlip->code }}</span></td>
                        <td>{{ $outputSlip->customer?->name ?? 'Không có' }}</td>
                        <td>{{ optional($outputSlip->output_date)->format('d/m/Y') }}</td>
                        <td>{{ $outputSlip->output_type }}</td>
                        <td>{{ number_format($outputSlip->total_amount, 0, ',', '.') }}đ</td>
                        <td>
                            @if ($outputSlip->status === 'draft')
                                <span class="badge bg-secondary-lt">Nháp</span>
                            @elseif ($outputSlip->status === 'completed')
                                <span class="badge bg-success-lt">Hoàn tất</span>
                            @else
                                <span class="badge bg-danger-lt">Đã hủy</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.output-slips.show', $outputSlip) }}" class="btn btn-sm btn-outline-info">Xem</a>

                                @if ($outputSlip->status === 'draft')
                                    <a href="{{ route('admin.warehouse.output-slips.edit', $outputSlip) }}" class="btn btn-sm btn-outline-primary">Sửa</a>

                                    <form action="{{ route('admin.warehouse.output-slips.complete', $outputSlip) }}" method="POST"
                                          onsubmit="return confirm('Hoàn tất phiếu xuất và trừ kho?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">Hoàn tất</button>
                                    </form>

                                    <form action="{{ route('admin.warehouse.output-slips.destroy', $outputSlip) }}" method="POST"
                                          onsubmit="return confirm('Xóa phiếu xuất này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-secondary py-4">Chưa có dữ liệu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($outputSlips->hasPages())
        <div class="card-footer">{{ $outputSlips->links() }}</div>
    @endif
</div>
@endsection
