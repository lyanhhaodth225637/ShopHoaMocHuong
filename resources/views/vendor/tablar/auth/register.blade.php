@extends('tablar::auth.layout')
@section('title', 'Register')
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

        <form class="card card-md" action="{{route('register')}}" method="post" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <div class="text-center mb-1 mt-5">
                    <a href="" class="navbar-brand navbar-brand-autodark">
                        <img src="{{asset(config('tablar.auth_logo.img.path', 'assets/logo.svg'))}}" width="100" alt=""></a>
                </div>
                <h2 class="card-title text-center mb-4">Tạo tài khoản</h2>
                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" autocomplete="off">
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

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu</label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password"
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
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Agree the <a href="#" tabindex="-1">terms and policy</a>.</span>
                        </label>
                    </div> -->
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Tạo tài khoản</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Bạn đã có tài khoản? <a href="{{route('login')}}" tabindex="-1">Đăng nhập</a>
        </div>
    </div>
@endsection