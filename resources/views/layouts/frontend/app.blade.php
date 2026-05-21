<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mộc Hương Flower Shop</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <!-- Cartzilla Theme -->
    <link rel="stylesheet" href="assets/css/theme.min.css" />
    <!-- Cartzilla Icons -->
    <link rel="stylesheet" href="assets/icons/cartzilla-icons.min.css" />
    <!-- Bootstrap Icons fallback -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/frontend/home.css') }}">
</head>

<body>

    @include('layouts.frontend.topbar')

    @include('layouts.frontend.header-nav')

    <div>
        @yield('content')
    </div>


    @include('layouts.frontend.footer')



    <!-- Scroll to top -->
    <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
        style="position:fixed;bottom:24px;right:24px;width:44px;height:44px;border-radius:50%;background:var(--green-main);color:#fff;border:none;box-shadow:0 4px 16px rgba(0,0,0,.2);font-size:1.1rem;cursor:pointer;z-index:999;display:flex;align-items:center;justify-content:center;"
        title="Lên đầu trang">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- Zalo float button -->
    <a href="https://zalo.me/0888796364" target="_blank"
        style="position:fixed;bottom:80px;right:24px;width:50px;height:50px;border-radius:50%;background:#0068ff;color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.5rem;box-shadow:0 4px 16px rgba(0,0,0,.2);text-decoration:none;z-index:999;"
        title="Chat Zalo">💬</a>

    <!-- ═══════════════════════════════════════
     MOBILE NAV MODAL
    ═══════════════════════════════════════ -->

    @include('layouts.frontend.nav-mobile')


    <!-- ═══════════════════════════════════════
     CART DRAWER
    ═══════════════════════════════════════ -->

    @include('layouts.frontend.cart')


    <script src="{{ asset('assets/js/frontend/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>