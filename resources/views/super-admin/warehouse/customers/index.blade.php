@extends('layouts.super-admin.app')

@section('title', 'Khách hàng')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Khách hàng')

@section('page-actions')
    <a href="{{ route('admin.warehouse.customers.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Thêm khách hàng
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách khách hàng</h3>
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
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td class="fw-semibold">{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ Str::limit($customer->address, 50) }}</td>
                        <td>
                            @if ($customer->is_active)
                                <span class="badge bg-success-lt">Hoạt động</span>
                            @else
                                <span class="badge bg-danger-lt">Tắt</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('admin.warehouse.customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.warehouse.customers.destroy', $customer) }}" method="POST"
                                      onsubmit="return confirm('Xóa khách hàng này?')">
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

    @if ($customers->hasPages())
        <div class="card-footer">{{ $customers->links() }}</div>
    @endif
</div>
@endsection
