@extends('layouts.super-admin.app')

@section('title', 'Thêm đơn vị tính')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Thêm đơn vị tính')

@section('page-actions')
    <a href="{{ route('admin.warehouse.units.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>
@endsection

@section('content')
<form action="{{ route('admin.warehouse.units.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        @include('super-admin.warehouse.units._form')
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Lưu</button>
    </div>
</form>
@endsection
