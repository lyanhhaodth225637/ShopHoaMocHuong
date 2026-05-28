@extends('layouts.super-admin.app')

@section('title', 'Tạo phiếu xuất')
@section('pretitle', 'Quản lý kho')
@section('page-title', 'Tạo phiếu xuất')

@section('page-actions')
    <a href="{{ route('admin.warehouse.output-slips.index') }}" class="btn btn-outline-secondary">
        <i class="ti ti-arrow-left"></i> Quay lại
    </a>
@endsection

@section('content')
<form action="{{ route('admin.warehouse.output-slips.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        @include('super-admin.warehouse.output-slips._form')
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Lưu phiếu nháp</button>
    </div>
</form>
@endsection
