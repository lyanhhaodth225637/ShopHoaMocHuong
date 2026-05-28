@extends('layouts.super-admin.app')

@section('title', 'Phiếu nhập')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Phiếu nhập')

@section('page-actions')
    <a href="{{ route('admin.warehouse.input-slips.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Tạo phiếu nhập
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách phiếu nhập</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Nhà cung cấp</th>
                    <th>Ngày nhập</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Người tạo</th>
                    <th class="w-1">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inputSlips as $inputSlip)
                    <tr>
                        <td><span class="badge bg-blue-lt">{{ $inputSlip->code }}</span></td>
                        <td>{{ $inputSlip->supplier?->name ?? 'Không có' }}</td>
                        <td>{{ optional($inputSlip->input_date)->format('d/m/Y') }}</td>
                        <td>{{ number_format($inputSlip->total_amount, 0, ',', '.') }}đ</td>
                        <td>
                            @if ($inputSlip->status === 'draft')
                                <span class="badge bg-secondary-lt">Nháp</span>
                            @elseif ($inputSlip->status === 'completed')
                                <span class="badge bg-success-lt">Hoàn tất</span>
                            @else
                                <span class="badge bg-danger-lt">Đã hủy</span>
                            @endif
                        </td>
                        <td>{{ $inputSlip->creator?->name }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.input-slips.show', $inputSlip) }}" class="btn btn-sm btn-outline-info">Xem</a>

                                @if ($inputSlip->status === 'draft')
                                    <a href="{{ route('admin.warehouse.input-slips.edit', $inputSlip) }}" class="btn btn-sm btn-outline-primary">Sửa</a>

                                    <form action="{{ route('admin.warehouse.input-slips.complete', $inputSlip) }}" method="POST"
                                          onsubmit="return confirm('Hoàn tất phiếu nhập và cộng kho?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">Hoàn tất</button>
                                    </form>

                                    <form action="{{ route('admin.warehouse.input-slips.destroy', $inputSlip) }}" method="POST"
                                          onsubmit="return confirm('Xóa phiếu nhập này?')">
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

    @if ($inputSlips->hasPages())
        <div class="card-footer">{{ $inputSlips->links() }}</div>
    @endif
</div>
@endsection
