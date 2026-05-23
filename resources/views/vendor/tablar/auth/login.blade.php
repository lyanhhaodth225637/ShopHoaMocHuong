@extends('tablar::auth.layout')
@section('title', 'Login')
@section('content')
    <style>
        /* ─── Biến màu lấy từ frontend CSS ─── */
        :root {
            --green-main: #2BAAAD;
            --green-dark: #1d7f82;
            --green-light: #3dc4c8;
            --green-pale: #e6f7f7;
            --green-accent: #5dd3d6;
            --cream: #f6fcfc;
            --text-dark: #0f2e2f;
            --text-muted: #4a7c7e;
            --gold: #c49a3c;
        }

        /* ─── NỀN TRANG ─── */
        body {
            background: var(--green-pale) !important;
            font-family: 'Be Vietnam Pro', system-ui, sans-serif !important;
        }

        /* ─── LOGO / BRAND ─── */
        .navbar-brand-autodark {
            display: inline-block;
            margin-bottom: 8px;
        }

        /* ─── CARD ─── */
        .card.card-md {
            border: 1.5px solid #b2e8ea !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 32px rgba(43, 170, 173, .1) !important;
            overflow: hidden;
        }

        /* ─── TIÊU ĐỀ ─── */
        .card-body .h2 {
            font-family: 'Playfair Display', Georgia, serif;
            color: var(--text-dark);
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* ─── LABEL ─── */
        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-label-description a {
            color: var(--green-main);
            text-decoration: none;
            font-size: 0.8rem;
        }

        .form-label-description a:hover {
            color: var(--green-dark);
            text-decoration: underline;
        }

        /* ─── INPUT ─── */
        .form-control {
            border: 1.5px solid #b2e8ea !important;
            border-radius: 10px !important;
            font-size: 0.875rem;
            color: var(--text-dark);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus {
            border-color: var(--green-main) !important;
            box-shadow: 0 0 0 3px rgba(43, 170, 173, .15) !important;
        }

        .form-control.is-invalid {
            border-color: #e74c3c !important;
        }

        /* Input group (password) */
        .input-group.input-group-flat {
            border: 1.5px solid #b2e8ea;
            border-radius: 10px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-group.input-group-flat:focus-within {
            border-color: var(--green-main);
            box-shadow: 0 0 0 3px rgba(43, 170, 173, .15);
        }

        .input-group.input-group-flat .form-control {
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .input-group-text {
            background: #fff !important;
            border: none !important;
        }

        .input-group-text a {
            color: var(--text-muted) !important;
        }

        .input-group-text a:hover {
            color: var(--green-main) !important;
        }

        /* ─── CHECKBOX ─── */
        .form-check-input:checked {
            background-color: var(--green-main) !important;
            border-color: var(--green-main) !important;
        }

        .form-check-label {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        /* ─── NÚT ĐĂNG NHẬP ─── */
        .btn.btn-primary {
            background: var(--green-main) !important;
            border: none !important;
            border-radius: 50px !important;
            padding: 12px 0 !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            letter-spacing: 0.3px;
            transition: all .25s !important;
        }

        .btn.btn-primary:hover {
            background: var(--green-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(43, 170, 173, .3) !important;
        }

        /* ─── DIVIDER "or" ─── */
        .hr-text {
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 600;
        }

        .hr-text::before,
        .hr-text::after {
            background: #b2e8ea !important;
        }

        /* ─── NÚT SOCIAL (Github / Twitter) ─── */
        .btn.btn-white {
            border: 1.5px solid #b2e8ea !important;
            border-radius: 10px !important;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark) !important;
            transition: all .2s !important;
        }

        .btn.btn-white:hover {
            background: var(--green-pale) !important;
            border-color: var(--green-main) !important;
            color: var(--green-dark) !important;
        }

        /* ─── LINK ĐĂNG KÝ ─── */
        .text-center.text-muted {
            font-size: 0.83rem;
            color: var(--text-muted) !important;
        }

        .text-center.text-muted a {
            color: var(--green-main);
            font-weight: 600;
            text-decoration: none;
        }

        .text-center.text-muted a:hover {
            color: var(--green-dark);
            text-decoration: underline;
        }

        /* ─── INVALID FEEDBACK ─── */
        .invalid-feedback {
            font-size: 0.78rem;
        }
    </style>
    <div class="container container-tight py-4">

        <div class="card card-md">
            <div class="text-center mb-1 mt-5">
                <a href="" class="navbar-brand navbar-brand-autodark">
                    <img src="{{asset(config('tablar.auth_logo.img.path', 'assets/logo.svg'))}}" width="150" alt=""></a>
            </div>
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Đăng nhập</h2>
                <form action="{{route('login')}}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="your@email.com" autocomplete="off">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Mật khẩu
                            <span class="form-label-description">
                                <a href="{{route('password.request')}}">Quên mật khẩu</a>
                            </span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Your password"
                                autocomplete="off">
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password"
                                    data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path
                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                    </svg>
                                </a>
                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div> -->
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </div>
                </form>
            </div>
            <div class="hr-text">Hoặc</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="#" class="btn btn-white w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            Google
                        </a>
                    </div>

                    <div class="col">
                        <a href="#" class="btn btn-white w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                fill="#1877F2">
                                <path
                                    d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z" />
                            </svg>
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if(Route::has('register'))
            <div class="text-center text-muted mt-3">
                Bạn chưa có tài khoản? <a href="{{route('register')}}" tabindex="-1">Đăng ký</a>
            </div>
        @endif
    </div>
@endsection