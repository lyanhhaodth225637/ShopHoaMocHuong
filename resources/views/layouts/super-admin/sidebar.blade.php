<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('admin.dashboard') }}">
                <span class="fw-bold">Mộc Hương</span>
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ request()->routeIs('admin.warehouse.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-warehouse" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-building-warehouse"></i>
                        </span>
                        <span class="nav-link-title">Quản lý kho</span>
                    </a>

                    <div class="dropdown-menu {{ request()->routeIs('admin.warehouse.*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.units.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.units.index') }}">
                            Đơn vị tính
                        </a>

                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.suppliers.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.suppliers.index') }}">
                            Nhà cung cấp
                        </a>

                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.customers.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.customers.index') }}">
                            Khách hàng
                        </a>

                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.skus.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.skus.index') }}">
                            Tồn kho (SKU)
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.input-slips.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.input-slips.index') }}">
                            Phiếu nhập
                        </a>

                        <a class="dropdown-item {{ request()->routeIs('admin.warehouse.output-slips.*') ? 'active' : '' }}"
                           href="{{ route('admin.warehouse.output-slips.index') }}">
                            Phiếu xuất
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-chart-bar"></i>
                        </span>
                        <span class="nav-link-title">Báo cáo</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="nav-link-title">Người dùng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.2fa.setup') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-shield-lock"></i>
                        </span>
                        <span class="nav-link-title">Bảo mật 2FA</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
