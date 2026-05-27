@extends('layouts.admin.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Xác thực 2 lớp</strong>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">
                            Nhập mã 6 số từ Google Authenticator để tiếp tục.
                        </p>

                        <form action="{{ route('admin.2fa.verify') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Mã xác thực</label>
                                <input type="text" name="code" class="form-control" maxlength="6" autofocus required>

                                @error('code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100">
                                Xác nhận
                            </button>
                        </form>

                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button class="btn btn-link w-100">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
