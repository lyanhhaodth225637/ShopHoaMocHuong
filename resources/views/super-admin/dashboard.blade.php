@extends('layouts.super-admin.app')

@section('title', 'Dashboard')
@section('pretitle', 'Tổng quan')
@section('page-title', 'Super Admin Dashboard')

@section('content')
    <div class="row row-deck row-cards">

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Tổng SKU</div>
                    <div class="h1 mb-3">0</div>
                    <div class="text-secondary">Mã hàng trong kho</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Phiếu nhập</div>
                    <div class="h1 mb-3">0</div>
                    <div class="text-secondary">Tổng phiếu nhập</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Phiếu xuất</div>
                    <div class="h1 mb-3">0</div>
                    <div class="text-secondary">Tổng phiếu xuất</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Sắp hết hàng</div>
                    <div class="h1 mb-3 text-warning">0</div>
                    <div class="text-secondary">SKU dưới tồn tối thiểu</div>
                </div>
            </div>
        </div>

    </div>
@endsection