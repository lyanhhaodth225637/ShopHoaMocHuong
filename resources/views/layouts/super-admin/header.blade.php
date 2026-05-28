<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                    <span class="avatar avatar-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name ?? 'Super Admin' }}</div>
                        <div class="mt-1 small text-secondary">Super Admin</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">
                        <i class="ti ti-user me-2"></i> Tài khoản
                    </a>

                    <a href="{{ route('admin.2fa.setup') }}" class="dropdown-item">
                        <i class="ti ti-shield-lock me-2"></i> Bảo mật 2FA
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="ti ti-logout me-2"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                <form action="#" method="get" autocomplete="off" novalidate>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" value="" class="form-control" placeholder="Tìm kiếm..." aria-label="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>