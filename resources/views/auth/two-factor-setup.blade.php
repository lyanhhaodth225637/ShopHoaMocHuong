@extends('layouts.admin.app')

@section('admin-content')
    <div class="container-xl py-4">

        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Bảo mật tài khoản</h2>
                    <div class="text-muted mt-1">Quản lý xác thực 2 lớp cho tài khoản của bạn</div>
                </div>
            </div>
        </div>

        <div class="card">
           

            <div class="card-body p-0">
                <div class="row g-0">

                    {{-- ===================== CỘT TRÁI ===================== --}}
                    <div class="col-md-5 border-end">
                        <div class="p-4 h-100 d-flex flex-column align-items-center justify-content-center text-center">

                            @if ($user->hasTwoFactorEnabled())

                                {{-- Đã bật: hiện icon shield lớn --}}
                                <div class="mb-3">
                                    <span class="avatar avatar-xl bg-success-lt text-success"
                                        style="width:96px;height:96px;font-size:2.5rem;">
                                        <i class="ti ti-shield-check"></i>
                                    </span>
                                </div>
                                <h3 class="h4 mb-1">Tài khoản được bảo vệ</h3>
                                <p class="text-muted small mb-0">
                                    Xác thực 2 lớp đang bật.<br>
                                    Mỗi lần đăng nhập cần nhập mã từ app.
                                </p>

                            @else

                                {{-- Chưa bật: hiện QR + secret --}}
                                <div class="mb-3">
                                    {!! $qrCodeUrl !!}
                                </div>

                                <p class="text-muted small mb-2">
                                    Quét mã bằng <strong>Google Authenticator</strong>
                                </p>

                                <div class="w-100">
                                    <label class="form-label text-muted small fw-medium"
                                        style="text-transform:uppercase;letter-spacing:.06em;">
                                        Hoặc nhập thủ công
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control font-monospace text-center" id="google2fa-secret"
                                            value="{{ $user->google2fa_secret }}" readonly>
                                        <button class="btn btn-outline-secondary" type="button" onclick="copySecret(this)"
                                            title="Sao chép">
                                            <i class="ti ti-copy"></i>
                                        </button>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>

                    {{-- ===================== CỘT PHẢI ===================== --}}
                    <div class="col-md-7">
                        <div class="p-4">

                            @if ($user->hasTwoFactorEnabled())

                                {{-- Form tắt 2FA --}}
                                <h4 class="mb-1">Tắt xác thực 2 lớp</h4>
                                <p class="text-muted small mb-4">
                                    Nhập mã 6 số từ app Google Authenticator để xác nhận tắt 2FA.
                                </p>

                                <div class="alert alert-warning d-flex gap-2 align-items-start mb-4">
                                    <i class="ti ti-alert-triangle mt-1 flex-shrink-0"></i>
                                    <div class="small">
                                        Sau khi tắt, tài khoản sẽ chỉ yêu cầu mật khẩu khi đăng nhập.
                                        Bạn có thể bật lại bất cứ lúc nào.
                                    </div>
                                </div>

                                <form action="{{ route('admin.2fa.disable') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Mã xác thực từ app</label>
                                        <input type="text" name="code"
                                            class="form-control font-monospace text-center @error('code') is-invalid @enderror"
                                            style="font-size:1.6rem;letter-spacing:.45em;height:56px;" maxlength="6"
                                            placeholder="· · · · · ·" autocomplete="one-time-code" autofocus required>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="ti ti-shield-off me-1"></i>
                                        Tắt xác thực 2 lớp
                                    </button>
                                </form>

                            @else

                                {{-- Form bật 2FA + hướng dẫn --}}
                                <h4 class="mb-1">Bật xác thực 2 lớp</h4>
                                <p class="text-muted small mb-4">
                                    Làm theo các bước để liên kết app với tài khoản của bạn.
                                </p>

                                <div class="list-group list-group-flush mb-4">
                                    <div class="list-group-item px-0 py-2 d-flex gap-3 align-items-start">
                                        <span class="avatar avatar-sm bg-blue-lt text-blue fw-bold flex-shrink-0">1</span>
                                        <div class="small text-muted pt-1">
                                            Tải app <strong>Google Authenticator</strong> (iOS / Android) nếu chưa có.
                                        </div>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex gap-3 align-items-start">
                                        <span class="avatar avatar-sm bg-blue-lt text-blue fw-bold flex-shrink-0">2</span>
                                        <div class="small text-muted pt-1">
                                            Mở app, nhấn <strong>+</strong> rồi chọn <em>Quét mã QR</em> và quét mã bên trái.
                                        </div>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex gap-3 align-items-start">
                                        <span class="avatar avatar-sm bg-blue-lt text-blue fw-bold flex-shrink-0">3</span>
                                        <div class="small text-muted pt-1">
                                            Nhập mã 6 số hiển thị trong app vào ô bên dưới để hoàn tất.
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('admin.2fa.enable') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Mã xác thực từ app</label>
                                        <input type="text" name="code"
                                            class="form-control font-monospace text-center @error('code') is-invalid @enderror"
                                            style="font-size:1.6rem;letter-spacing:.45em;height:56px;" maxlength="6"
                                            placeholder="· · · · · ·" autocomplete="one-time-code" autofocus required>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ti ti-shield-check me-1"></i>
                                        Bật xác thực 2 lớp
                                    </button>
                                </form>

                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function copySecret(btn) {
            navigator.clipboard.writeText(document.getElementById('google2fa-secret').value).then(() => {
                btn.innerHTML = '<i class="ti ti-check"></i>';
                btn.classList.replace('btn-outline-secondary', 'btn-outline-success');
                setTimeout(() => {
                    btn.innerHTML = '<i class="ti ti-copy"></i>';
                    btn.classList.replace('btn-outline-success', 'btn-outline-secondary');
                }, 2000);
            });
        }
    </script>
@endpush