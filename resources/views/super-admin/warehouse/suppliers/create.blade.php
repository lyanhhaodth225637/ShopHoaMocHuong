@extends('layouts.super-admin.app')

@section('title', 'Thêm nhà cung cấp')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Thêm nhà cung cấp')

@section('page-actions')
    <a href="{{ route('admin.warehouse.suppliers.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>
@endsection

@section('content')
<form action="{{ route('admin.warehouse.suppliers.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        @include('super-admin.warehouse.suppliers._form')
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Lưu</button>
    </div>
</form>
@endsection
