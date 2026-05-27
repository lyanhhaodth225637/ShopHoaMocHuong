@extends('layouts.admin.app')

@section('title', 'Tìm Icon Font Awesome')

@section('admin-content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Quản trị</div>
                    <h2 class="page-title">Tìm Icon Font Awesome</h2>
                </div>

                <div class="col-auto ms-auto">
                    <a href="https://fontawesome.com/search?ic=pro-plus-collection" target="_blank" class="btn btn-primary">
                        Mở tab mới
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-0">
                    <iframe src="https://fontawesome.com/search?ic=pro-plus-collection"
                        style="width: 100%; height: 80vh; border: 0;" title="Font Awesome Search">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection