@extends('layouts.super-admin.app')

@section('title', 'Đơn vị tính')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Đơn vị tính')

@section('page-actions')
    <a href="{{ route('admin.warehouse.units.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Thêm đơn vị
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách đơn vị tính</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th class="w-1">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($units as $unit)
                    <tr>
                        <td>{{ $unit->id }}</td>
                        <td class="fw-semibold">{{ $unit->name }}</td>
                        <td>{{ Str::limit($unit->description, 60) }}</td>
                        <td>
                            @if ($unit->is_active)
                                <span class="badge bg-success-lt">Hoạt động</span>
                            @else
                                <span class="badge bg-danger-lt">Tắt</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.units.edit', $unit) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.warehouse.units.destroy', $unit) }}" method="POST"
                                      onsubmit="return confirm('Xóa đơn vị này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-secondary py-4">Chưa có dữ liệu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($units->hasPages())
        <div class="card-footer">{{ $units->links() }}</div>
    @endif
</div>
@endsection
