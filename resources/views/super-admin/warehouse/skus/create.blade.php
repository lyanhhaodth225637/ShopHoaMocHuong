@extends('layouts.super-admin.app')

@section('title', 'Thêm SKU')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Thêm SKU kho')

@section('page-actions')
    <a href="{{ route('admin.warehouse.skus.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>
@endsection

@section('content')
<form action="{{ route('admin.warehouse.skus.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        @include('super-admin.warehouse.skus._form')
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Lưu</button>
    </div>
</form>
@endsection
