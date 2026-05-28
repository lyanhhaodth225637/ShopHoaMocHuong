@extends('layouts.super-admin.app')

@section('title', 'Nhà cung cấp')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Nhà cung cấp')

@section('page-actions')
    <a href="{{ route('admin.warehouse.suppliers.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Thêm nhà cung cấp
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách nhà cung cấp</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th class="w-1">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td class="fw-semibold">{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ Str::limit($supplier->address, 50) }}</td>
                        <td>
                            @if ($supplier->is_active)
                                <span class="badge bg-success-lt">Hoạt động</span>
                            @else
                                <span class="badge bg-danger-lt">Tắt</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.warehouse.suppliers.destroy', $supplier) }}" method="POST"
                                      onsubmit="return confirm('Xóa nhà cung cấp này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-secondary py-4">Chưa có dữ liệu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($suppliers->hasPages())
        <div class="card-footer">{{ $suppliers->links() }}</div>
    @endif
</div>
@endsection
