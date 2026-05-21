<style>
    .shop-logo {
        gap: 10px;
    }

    .shop-logo .navbar-brand-image {
        width: 42px;
        height: 42px;
        object-fit: contain;
    }

    .shop-logo-text {
        font-size: 22px;
        font-weight: 700;
        color: #2BAAAD;
        line-height: 1;
    }
</style>
<a href="#" class="navbar-brand shop-logo d-flex align-items-center text-decoration-none">
    <img src="{{ asset(config('tablar.auth_logo.img.path', 'assets/logo.svg')) }}"
        width="{{ config('tablar.auth_logo.img.width', 110) }}" height="{{ config('tablar.auth_logo.img.height', 32) }}"
        alt="{{ config('tablar.auth_logo.img.alt', config('tablar.title', 'Tablar')) }}"
        class="navbar-brand-image {{ config('tablar.auth_logo.img.class', '') }}">
    <span class="shop-logo-text">{{ config('tablar.title', 'Tablar') }}</span>
</a>
