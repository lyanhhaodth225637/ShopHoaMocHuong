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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <style>
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

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Playfair Display', serif;
        }

        /* ─── TOP BAR ─── */
        .topbar {
            background: var(--green-dark);
            color: #fff;
            font-size: 0.8rem;
            padding: 6px 0;
        }

        .topbar a {
            color: #b2e8ea;
            text-decoration: none;
        }

        .topbar a:hover {
            color: #fff;
        }

        /* ─── HEADER / NAVBAR ─── */
        .site-header {
            background: #fff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            color: var(--green-dark) !important;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .brand-name span {
            color: var(--green-accent);
        }

        .brand-name em {
            color: var(--green-main);
            font-style: italic;
        }

        .brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--green-dark);
            letter-spacing: -0.5px;
        }

        .search-wrapper {
            max-width: 420px;
            flex: 1;
        }

        .search-wrapper .input-group {
            border: 1.5px solid #b2e8ea;
            border-radius: 50px;
            overflow: hidden;
        }

        .search-wrapper input {
            border: none;
            outline: none;
            box-shadow: none !important;
            font-size: 0.875rem;
            padding-left: 18px;
        }

        .search-wrapper .btn {
            background: var(--green-main);
            border: none;
            color: #fff;
            padding: 0 18px;
            border-radius: 0 50px 50px 0 !important;
        }

        .header-icon-btn {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.72rem;
            gap: 3px;
            transition: color .2s;
        }

        .header-icon-btn i {
            font-size: 1.35rem;
        }

        .header-icon-btn:hover {
            color: var(--green-main);
        }

        .header-icon-btn .badge {
            position: absolute;
            top: -4px;
            right: -6px;
            background: var(--green-main);
            color: #fff;
            font-size: 0.6rem;
            min-width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ─── MEGA MENU NAV ─── */
        .mega-nav {
            background: var(--green-main);
        }

        .mega-nav .nav-link {
            color: #fff !important;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 10px 14px !important;
            white-space: nowrap;
            transition: background .2s;
            border-radius: 4px;
        }

        .mega-nav .nav-link:hover,
        .mega-nav .nav-link.active {
            background: rgba(255, 255, 255, .15);
        }

        .mega-nav .dropdown-menu {
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .12);
            border-radius: 8px;
            margin-top: 0;
            padding: 12px 0;
            min-width: 200px;
        }

        .mega-nav .dropdown-item {
            font-size: 0.84rem;
            padding: 7px 20px;
            color: var(--text-dark);
        }

        .mega-nav .dropdown-item:hover {
            background: var(--green-pale);
            color: var(--green-dark);
        }

        .mega-nav .dropdown-item i {
            width: 20px;
            color: var(--green-main);
            font-size: 0.9rem;
        }

        /* ─── HERO SLIDER ─── */
        .hero-section {
            background: linear-gradient(135deg, #1a6b6e 0%, #2BAAAD 50%, #3dc4c8 100%);
            min-height: 460px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .hero-badge {
            background: var(--gold);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 50px;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 14px;
        }

        .hero-title {
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: #fff;
            line-height: 1.2;
            font-weight: 700;
        }

        .hero-title em {
            color: #8dd5d7;
            font-style: italic;
        }

        .hero-subtitle {
            color: #b2e8ea;
            font-size: 1rem;
            max-width: 440px;
        }

        .hero-cta .btn-primary-hero {
            background: #fff;
            color: var(--green-dark);
            border: none;
            padding: 13px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all .25s;
        }

        .hero-cta .btn-primary-hero:hover {
            background: var(--gold);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
        }

        .hero-cta .btn-outline-hero {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255, 255, 255, .5);
            padding: 13px 28px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all .25s;
        }

        .hero-cta .btn-outline-hero:hover {
            background: rgba(255, 255, 255, .12);
            border-color: #fff;
        }

        .hero-img-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-img-wrapper .flower-circle {
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, .2);
        }

        .hero-img-wrapper img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, .3);
        }

        .hero-float-badge {
            position: absolute;
            background: #fff;
            border-radius: 12px;
            padding: 10px 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            font-size: 0.8rem;
        }

        .hero-float-badge.top-right {
            top: 30px;
            right: -20px;
        }

        .hero-float-badge.bottom-left {
            bottom: 40px;
            left: -20px;
        }

        .hero-float-badge strong {
            color: var(--green-main);
            font-size: 1.1rem;
            display: block;
        }

        /* ─── CATEGORY PILLS ─── */
        .section-label {
            font-size: 0.75rem;
            color: var(--green-main);
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: clamp(1.5rem, 3vw, 2.1rem);
            color: var(--text-dark);
            font-weight: 700;
        }

        .divider-leaf {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--green-main), var(--green-accent));
            border-radius: 2px;
            margin: 10px 0 0;
        }

        .cat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            transition: all .3s;
            border: 1.5px solid transparent;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .cat-card:hover {
            border-color: var(--green-main);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(45, 106, 45, .12);
        }

        .cat-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 1.6rem;
            transition: background .3s;
        }

        .cat-card:hover .cat-icon {
            background: var(--green-main);
            color: #fff;
        }

        .cat-card span {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* ─── PRODUCT CARDS ─── */
        .product-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #f0f0f0;
            transition: all .3s;
        }

        .product-card:hover {
            border-color: var(--green-main);
            box-shadow: 0 12px 32px rgba(45, 106, 45, .12);
            transform: translateY(-4px);
        }

        .product-card .img-wrap {
            position: relative;
            overflow: hidden;
            height: 220px;
            background: #f9f9f9;
        }

        .product-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .product-card:hover .img-wrap img {
            transform: scale(1.06);
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
        }

        .product-wishlist {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 34px;
            height: 34px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            cursor: pointer;
            border: none;
            color: #ccc;
            transition: color .2s;
        }

        .product-wishlist:hover {
            color: #e74c3c;
        }

        .product-body {
            padding: 16px;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-stars {
            color: var(--gold);
            font-size: 0.75rem;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--green-main);
        }

        .product-price-old {
            font-size: 0.8rem;
            color: #aaa;
            text-decoration: line-through;
            margin-left: 6px;
        }

        .btn-add-cart {
            background: var(--green-main);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 0;
            width: 100%;
            font-size: 0.82rem;
            font-weight: 600;
            transition: background .25s;
        }

        .btn-add-cart:hover {
            background: var(--green-dark);
            color: #fff;
        }

        /* ─── PROMO BANNERS ─── */
        .promo-banner {
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            min-height: 180px;
            display: flex;
            align-items: center;
        }

        .promo-banner-content {
            position: relative;
            z-index: 2;
            padding: 32px;
        }

        .promo-banner-1 {
            background: linear-gradient(135deg, #1a6b6e, #2BAAAD);
        }

        .promo-banner-2 {
            background: linear-gradient(135deg, #5c3a1e, #8b5e3c);
        }

        .promo-banner-3 {
            background: linear-gradient(135deg, #2d3a6a, #4a5c8c);
        }

        /* ─── SERVICE FEATURES ─── */
        .feature-box {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--green-main);
            flex-shrink: 0;
        }

        .feature-title {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .feature-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* ─── BLOG CARDS ─── */
        .blog-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #f0f0f0;
            transition: all .3s;
        }

        .blog-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            transform: translateY(-3px);
        }

        .blog-card .img-wrap {
            height: 200px;
            overflow: hidden;
        }

        .blog-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .blog-card:hover .img-wrap img {
            transform: scale(1.05);
        }

        .blog-card-body {
            padding: 18px;
        }

        .blog-tag {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--green-main);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .blog-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 600;
            margin: 6px 0 10px;
        }

        .blog-title a {
            text-decoration: none;
            color: inherit;
        }

        .blog-title a:hover {
            color: var(--green-main);
        }

        .blog-meta {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ─── TESTIMONIAL ─── */
        .testimonial-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1.5px solid #f0f0f0;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            font-family: 'Playfair Display', serif;
            font-size: 5rem;
            color: var(--green-pale);
            position: absolute;
            top: -10px;
            left: 20px;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-style: italic;
            line-height: 1.7;
        }

        .testimonial-author {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-dark);
        }

        .testimonial-role {
            font-size: 0.76rem;
            color: var(--text-muted);
        }

        /* ─── FOOTER ─── */
        .site-footer {
            background: var(--green-dark);
            color: #b2e8ea;
        }

        .site-footer h6 {
            color: #fff;
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            margin-bottom: 16px;
        }

        .site-footer a {
            color: #7ec8ca;
            text-decoration: none;
            font-size: 0.84rem;
            transition: color .2s;
        }

        .site-footer a:hover {
            color: #fff;
        }

        .footer-bottom {
            background: var(--green-main);
            font-size: 0.8rem;
            color: #b2e8ea;
        }

        .social-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: background .2s;
            font-size: 0.9rem;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, .25);
            color: #fff;
        }

        /* ─── MISC ─── */
        .section-py {
            padding-top: 64px;
            padding-bottom: 64px;
        }

        .bg-pale {
            background: var(--green-pale);
        }

        .text-green {
            color: var(--green-main);
        }

        .btn-green {
            background: var(--green-main);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all .25s;
        }

        .btn-green:hover {
            background: var(--green-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-outline-green {
            background: transparent;
            color: var(--green-main);
            border: 1.5px solid var(--green-main);
            border-radius: 50px;
            padding: 9px 26px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all .25s;
        }

        .btn-outline-green:hover {
            background: var(--green-main);
            color: #fff;
        }

        /* Tab filters */
        .filter-tabs .nav-link {
            color: var(--text-muted);
            font-size: 0.84rem;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 50px;
            border: none;
            transition: all .2s;
        }

        .filter-tabs .nav-link.active {
            background: var(--green-main);
            color: #fff;
        }

        .filter-tabs .nav-link:hover:not(.active) {
            background: var(--green-pale);
            color: var(--green-dark);
        }

        /* Newsletter */
        .newsletter-section {
            background: linear-gradient(135deg, var(--green-dark), var(--green-main));
            border-radius: 24px;
        }

        .newsletter-input {
            border: none;
            border-radius: 50px 0 0 50px;
            padding: 14px 24px;
            font-size: 0.88rem;
            outline: none;
        }

        .newsletter-btn {
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 0 50px 50px 0;
            padding: 0 28px;
            font-weight: 600;
            font-size: 0.88rem;
            white-space: nowrap;
        }

        .newsletter-btn:hover {
            background: #b88a30;
            color: #fff;
        }

        @media (max-width: 767px) {
            .hero-img-wrapper {
                display: none;
            }

            .hero-section {
                min-height: 320px;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .topbar .d-md-block {
                display: none !important;
            }
        }

        /* ── MEGA PANEL ── */
        .mega-nav .nav-link {
            font-size: 0.83rem;
            padding: 10px 13px !important;
        }

        .mega-panel {
            padding: 0 !important;
            border-radius: 12px !important;
            min-width: 700px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, .14) !important;
            border: none !important;
            overflow: hidden;
        }

        .mega-panel-inner {
            display: flex;
            gap: 0;
            padding: 20px;
            gap: 8px;
        }

        .mega-col {
            flex: 1;
            /* min-width: 130px; */
            padding: 0 12px;
            border-right: 1px solid #f0f0f0;
        }

        .mega-col:last-child {
            border-right: none;
        }

        .mega-col-title {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--green-main);
            margin-bottom: 8px;
        }

        .mega-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: #333d4c;
            text-decoration: none;
            padding: 5px 4px;
            border-radius: 6px;
            transition: background .15s, color .15s, padding-left .15s;
            white-space: nowrap;
        }

        .mega-link:hover {
            background: var(--green-pale);
            color: var(--green-dark);
            padding-left: 8px;
        }

        .color-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Feature box inside mega panel */
        .mega-feature {
            background: linear-gradient(135deg, var(--green-dark), var(--green-main));
            border-radius: 10px;
            padding: 18px 14px;
            min-width: 140px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
        }

        .mega-feature-img {
            font-size: 2rem;
        }

        .mega-feature-title {
            font-weight: 700;
            color: #fff;
            font-size: 0.85rem;
            line-height: 1.3;
        }

        .mega-feature-desc {
            font-size: 0.75rem;
            color: #b2e8ea;
            line-height: 1.4;
        }

        .mega-feature-btn {
            margin-top: auto;
            background: rgba(255, 255, 255, .15);
            color: #fff;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }

        .mega-feature-btn:hover {
            background: rgba(255, 255, 255, .3);
            color: #fff;
        }

        /* dropdown-header style */
        .mega-nav .dropdown-header {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--green-main);
            padding: 8px 16px 4px;
        }

        .mega-nav .dropdown-divider {
            margin: 4px 0;
            border-color: #f0f0f0;
        }

        .text-green {
            color: var(--green-main) !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .mt-2 {
            margin-top: 10px !important;
        }

        /* Fix dropdown click trên desktop */
        .mega-nav .dropdown-menu {
            pointer-events: auto;
        }

        .mega-nav .nav-item.dropdown {
            position: relative;
        }
    </style>
</head>

<body>

    <!-- ═══════════════════════════════════════
     TOP BAR
═══════════════════════════════════════ -->
    <div class="topbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-3">
                    <span><i class="bi bi-telephone-fill me-1"></i> 08.88.79.63.64</span>
                    <span class="d-none d-md-inline"><i class="bi bi-envelope-fill me-1"></i> hochuong@florist.vn</span>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <span class="d-none d-md-inline">🚚 Giao hoa miễn phí nội thành</span>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════
     HEADER
═══════════════════════════════════════ -->
    <header class="site-header">
        <div class="container py-3">
            <div class="d-flex align-items-center gap-3">
                <!-- Logo -->
                <a href="#" class="brand-name me-3 flex-shrink-0">
                    <img src="assets/img/logo.png" alt="Mộc Hương"
                        style="height:52px;width:52px;object-fit:cover;border-radius:50%;"> <span class="brand-text">Mộc
                        <em>Hương</em></span>
                </a>

                <!-- Search -->
                <div class="search-wrapper d-none d-lg-block">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm hoa, giỏ quà, dịch vụ..." />
                        <button class="btn"><i class="bi bi-search"></i></button>
                    </div>
                </div>

                <!-- Icons -->
                <div class="d-flex align-items-center gap-3 ms-auto">
                    <a href="#" class="header-icon-btn d-none d-sm-flex">
                        <i class="bi bi-geo-alt"></i>
                        <span>Cửa hàng</span>
                    </a>
                    <a href="#" class="header-icon-btn d-none d-sm-flex">
                        <i class="bi bi-person"></i>
                        <span>Tài khoản</span>
                    </a>
                    <a href="#" class="header-icon-btn">
                        <i class="bi bi-heart"></i>
                        <span class="badge">3</span>
                        <span class="d-none d-sm-inline">Yêu thích</span>
                    </a>
                    <button id="cartOpenBtn" class="header-icon-btn" style="background:none;border:none;padding:0;">
                        <i class="bi bi-bag"></i>
                        <span class="badge" id="cartBadge">5</span>
                        <span class="d-none d-sm-inline">Giỏ hàng</span>
                    </button>
                    <!-- Hamburger - chỉ hiện mobile -->
                    <button class="hamburger-btn d-flex d-lg-none" id="mobileMenuBtn" aria-label="Mở menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- MEGA MENU NAV – ẩn trên mobile, dùng modal thay thế -->
        <nav class="mega-nav d-none d-lg-block">
            <div class="container">
                <ul class="nav align-items-center" id="mainNav">

                    <!-- ── HOA TƯƠI – mega panel ── -->
                    <li class="nav-item dropdown mega-item">
                        <a class="nav-link dropdown-toggle fw-600" href="#" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside">
                            🌸 Hoa tươi
                        </a>
                        <div class="dropdown-menu mega-panel">
                            <div class="mega-panel-inner">

                                <div class="mega-col">
                                    <div class="mega-col-title">Kiểu dáng</div>
                                    <a class="mega-link" href="#">🎀 Bó hoa</a>
                                    <a class="mega-link" href="#">📦 Hộp hoa</a>
                                    <a class="mega-link" href="#">🧺 Giỏ hoa</a>
                                    <a class="mega-link" href="#">🪴 Hoa để bàn</a>
                                    <a class="mega-link" href="#">🏆 Hoa kệ đứng</a>
                                    <a class="mega-link" href="#">💐 Bình hoa</a>
                                </div>

                                <div class="mega-col">
                                    <div class="mega-col-title">Loại hoa</div>
                                    <a class="mega-link" href="#">🌹 Hoa Hồng</a>
                                    <a class="mega-link" href="#">🌸 Lan hồ điệp</a>
                                    <a class="mega-link" href="#">🌻 Hướng Dương</a>
                                    <a class="mega-link" href="#">💐 Hoa Cúc</a>
                                    <a class="mega-link" href="#">🌷 Tulip</a>
                                    <a class="mega-link" href="#">🌺 Cẩm Chướng</a>
                                    <a class="mega-link" href="#">🪷 Ly – Loa Kèn</a>
                                    <a class="mega-link" href="#">🌼 Baby – Cát Tường</a>
                                </div>

                                <div class="mega-col">
                                    <div class="mega-col-title">Theo dịp</div>
                                    <a class="mega-link" href="#">🎂 Sinh nhật</a>
                                    <a class="mega-link" href="#">💍 Tình yêu / Valentine</a>
                                    <a class="mega-link" href="#">🎉 Khai trương</a>
                                    <a class="mega-link" href="#">🎓 Tốt nghiệp</a>
                                    <a class="mega-link" href="#">🌸 8/3 · 20/10</a>
                                    <a class="mega-link" href="#">🕊️ Chia buồn / Tang lễ</a>
                                    <a class="mega-link" href="#">🏢 Sự kiện công ty</a>
                                </div>

                                <div class="mega-col">
                                    <div class="mega-col-title">Theo màu sắc</div>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#e74c3c"></span> Hoa đỏ</a>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#e91e8c"></span> Hoa hồng</a>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#f9a825"></span> Hoa vàng</a>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#9c27b0"></span> Hoa tím</a>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#fff;border:1px solid #ccc"></span> Hoa trắng</a>
                                    <a class="mega-link" href="#"><span class="color-dot"
                                            style="background:#ff7043"></span> Hoa cam</a>
                                    <div class="mega-col-title mt-2">Đặc biệt</div>
                                    <a class="mega-link" href="#">🕯️ Hoa sáp vĩnh cửu</a>
                                    <a class="mega-link" href="#">✨ Hoa độc đáo</a>
                                </div>

                                <!-- Feature box -->
                                <div class="mega-feature">
                                    <div class="mega-feature-img">🌹</div>
                                    <div class="mega-feature-title">Thiết kế theo yêu cầu</div>
                                    <div class="mega-feature-desc">Tùy chỉnh màu, kiểu, lời nhắn theo ý muốn</div>
                                    <a href="#" class="mega-feature-btn">Đặt ngay →</a>
                                </div>

                            </div>
                        </div>
                    </li>

                    <!-- ── HOA CƯỚI – mega panel ── -->
                    <li class="nav-item dropdown mega-item">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">💍 Hoa cưới</a>
                        <div class="dropdown-menu mega-panel" style="min-width:520px">
                            <div class="mega-panel-inner">
                                <div class="mega-col">
                                    <div class="mega-col-title">Cô dâu & chú rể</div>
                                    <a class="mega-link" href="#">Hoa cầm tay cô dâu</a>
                                    <a class="mega-link" href="#">Hoa cài áo chú rể</a>
                                    <a class="mega-link" href="#">Vòng hoa đội đầu</a>
                                    <a class="mega-link" href="#">Hoa cài tóc</a>
                                </div>
                                <div class="mega-col">
                                    <div class="mega-col-title">Trang trí</div>
                                    <a class="mega-link" href="#">Cổng hoa cưới</a>
                                    <a class="mega-link" href="#">Trang trí xe hoa</a>
                                    <a class="mega-link" href="#">Hoa bàn tiệc</a>
                                    <a class="mega-link" href="#">Trang trí phòng cưới</a>
                                    <a class="mega-link" href="#">Hoa backdrop chụp ảnh</a>
                                </div>
                                <div class="mega-col">
                                    <div class="mega-col-title">Dịch vụ trọn gói</div>
                                    <a class="mega-link" href="#">Gói cưới cơ bản</a>
                                    <a class="mega-link" href="#">Gói cưới sang trọng</a>
                                    <a class="mega-link" href="#">Tư vấn cưới miễn phí</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ── CÂY & LAN ── -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🪴 Cây & Lan</a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="dropdown-header">Lan hồ điệp</div>
                            </li>
                            <li><a class="dropdown-item" href="#">Lan đơn cành</a></li>
                            <li><a class="dropdown-item" href="#">Lan chậu 2–3 cành</a></li>
                            <li><a class="dropdown-item" href="#">Lan hộp quà cao cấp</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <div class="dropdown-header">Cây xanh</div>
                            </li>
                            <li><a class="dropdown-item" href="#">Cây để bàn văn phòng</a></li>
                            <li><a class="dropdown-item" href="#">Cây phong thủy</a></li>
                            <li><a class="dropdown-item" href="#">Cây treo – cây leo</a></li>
                            <li><a class="dropdown-item" href="#">Cây ngoài trời</a></li>
                            <li><a class="dropdown-item" href="#">Chậu cây quà tặng</a></li>
                        </ul>
                    </li>

                    <!-- ── QUÀ TẶNG ── -->
                    <li class="nav-item dropdown mega-item">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🎁 Quà tặng</a>
                        <div class="dropdown-menu mega-panel" style="min-width:560px">
                            <div class="mega-panel-inner">
                                <div class="mega-col">
                                    <div class="mega-col-title">Combo hoa + quà</div>
                                    <a class="mega-link" href="#">🐻 Gấu bông + hoa</a>
                                    <a class="mega-link" href="#">🍫 Chocolate + hoa</a>
                                    <a class="mega-link" href="#">🍷 Rượu vang + hoa</a>
                                    <a class="mega-link" href="#">🫶 Mỹ phẩm + hoa</a>
                                </div>
                                <div class="mega-col">
                                    <div class="mega-col-title">Giỏ & hộp quà</div>
                                    <a class="mega-link" href="#">🧺 Giỏ quà tết</a>
                                    <a class="mega-link" href="#">🍓 Giỏ trái cây tươi</a>
                                    <a class="mega-link" href="#">🎀 Hộp quà cao cấp</a>
                                    <a class="mega-link" href="#">🍱 Giỏ đặc sản vùng miền</a>
                                </div>
                                <div class="mega-col">
                                    <div class="mega-col-title">Phụ kiện & khác</div>
                                    <a class="mega-link" href="#">🕯️ Set nến thơm</a>
                                    <a class="mega-link" href="#">🧴 Set spa – dưỡng da</a>
                                    <a class="mega-link" href="#">☕ Set trà – cà phê</a>
                                    <a class="mega-link" href="#">🪆 Quà lưu niệm thủ công</a>
                                    <a class="mega-link" href="#">💌 Thiệp & phong bì</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ── THỰC PHẨM ── -->
                    <li class="nav-item dropdown mega-item">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🍰 Thực phẩm</a>
                        <div class="dropdown-menu mega-panel" style="min-width:500px">
                            <div class="mega-panel-inner">
                                <div class="mega-col">
                                    <div class="mega-col-title">Bánh kem</div>
                                    <a class="mega-link" href="#">🎂 Bánh sinh nhật</a>
                                    <a class="mega-link" href="#">🌸 Bánh hoa tươi</a>
                                    <a class="mega-link" href="#">💍 Bánh cưới</a>
                                    <a class="mega-link" href="#">🎨 Bánh in ảnh</a>
                                    <a class="mega-link" href="#">🌿 Bánh thuần chay</a>
                                </div>
                                <div class="mega-col">
                                    <div class="mega-col-title">Combo đặc biệt</div>
                                    <a class="mega-link" href="#">🎁 Combo hoa + bánh</a>
                                    <a class="mega-link" href="#">🫐 Bánh trái cây tươi</a>
                                    <a class="mega-link" href="#">🍩 Bánh mousse – tiramisu</a>
                                    <div class="mega-col-title mt-2">Đồ uống</div>
                                    <a class="mega-link" href="#">🧃 Nước ép trái cây</a>
                                    <a class="mega-link" href="#">🍵 Trà hoa – trà thảo mộc</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ── SỰ KIỆN ── -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🎪 Sự kiện</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">🏢 Khai trương – khánh thành</a></li>
                            <li><a class="dropdown-item" href="#">🎭 Hội nghị – hội thảo</a></li>
                            <li><a class="dropdown-item" href="#">🎓 Lễ tốt nghiệp</a></li>
                            <li><a class="dropdown-item" href="#">🎊 Tiệc sinh nhật trọn gói</a></li>
                            <li><a class="dropdown-item" href="#">🏆 Trao giải – vinh danh</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-green fw-600" href="#">📞 Nhận báo giá</a></li>
                        </ul>
                    </li>

                    <!-- ── DỊCH VỤ ── -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">⚙️ Dịch vụ</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">🚚 Giao hoa nhanh 2h</a></li>
                            <li><a class="dropdown-item" href="#">📅 Đặt hoa định kỳ</a></li>
                            <li><a class="dropdown-item" href="#">🎨 Thiết kế theo yêu cầu</a></li>
                            <li><a class="dropdown-item" href="#">🏠 Trang trí không gian</a></li>
                            <li><a class="dropdown-item" href="#">🤝 Hợp tác doanh nghiệp B2B</a></li>
                            <li><a class="dropdown-item" href="#">📸 Cho thuê hoa – phụ kiện</a></li>
                        </ul>
                    </li>

                    <!-- ── Plain links ── -->
                    <li class="nav-item"><a class="nav-link" href="#">📰 Tin tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">📞 Liên hệ</a></li>

                </ul>
            </div>
        </nav>

    </header>


    <!-- ═══════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════ -->
    <section class="hero-section">
        <div class="container py-5">
            <div class="row align-items-center min-vh-auto g-4" style="min-height:400px">
                <div class="col-lg-6 py-4">
                    <div class="hero-badge">🌿 Shop hoa tươi uy tín</div>
                    <h1 class="hero-title mb-3">
                        Gửi trọn <em>yêu thương</em><br>qua từng đóa hoa
                    </h1>
                    <p class="hero-subtitle mb-4">
                        Hoa tươi mỗi ngày – giao hàng nhanh trong 2 giờ – thiết kế theo yêu cầu.
                        Hơn 500 mẫu hoa cho mọi dịp đặc biệt.
                    </p>
                    <div class="hero-cta d-flex gap-3 flex-wrap">
                        <a href="#" class="btn-primary-hero">Đặt hoa ngay <i class="bi bi-arrow-right ms-1"></i></a>
                        <a href="#" class="btn-outline-hero"><i class="bi bi-whatsapp me-1"></i> Tư vấn miễn phí</a>
                    </div>
                    <div class="d-flex gap-4 mt-4">
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">500+</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Mẫu hoa</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">10K+</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Khách hàng</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:700;color:#fff;">8 năm</div>
                            <div style="font-size:0.78rem;color:#7ec8ca;">Kinh nghiệm</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <div class="hero-img-wrapper">
                        <div class="flower-circle">
                            <img src="assets/img/shop/01.png" alt="Hoa tươi" />
                        </div>
                        <div class="hero-float-badge top-right">
                            <strong>⭐ 4.9/5</strong>
                            <span style="font-size:.72rem;color:#666;">3,200 đánh giá</span>
                        </div>
                        <div class="hero-float-badge bottom-left">
                            <strong>🚚 2h</strong>
                            <span style="font-size:.72rem;color:#666;">Giao hàng nội thành</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     FEATURES / USP
═══════════════════════════════════════ -->
    <section style="background:#fff;padding:28px 0;border-bottom:1px solid #f0f0f0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🌿</div>
                        <div>
                            <div class="feature-title">Hoa tươi mỗi ngày</div>
                            <div class="feature-desc">Nhập hoa trực tiếp từ vườn Đà Lạt</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🚚</div>
                        <div>
                            <div class="feature-title">Giao hàng nhanh</div>
                            <div class="feature-desc">Trong vòng 2 giờ nội thành</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🎨</div>
                        <div>
                            <div class="feature-title">Thiết kế theo yêu cầu</div>
                            <div class="feature-desc">Tùy chỉnh màu sắc & kiểu dáng</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">💬</div>
                        <div>
                            <div class="feature-title">Tư vấn 24/7</div>
                            <div class="feature-desc">Hỗ trợ qua Zalo & điện thoại</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     CATEGORY SECTION
═══════════════════════════════════════ -->
    <section class="section-py">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Danh mục</div>
                <h2 class="section-title">Khám phá theo dịp</h2>
                <div class="divider-leaf mx-auto"></div>
            </div>
            <div class="row g-3">
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">💍</div>
                        <span>Hoa cưới</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎂</div>
                        <span>Sinh nhật</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🏪</div>
                        <span>Khai trương</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎓</div>
                        <span>Tốt nghiệp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🌸</div>
                        <span>Lan hồ điệp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🎁</div>
                        <span>Quà tặng</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🪴</div>
                        <span>Cây văn phòng</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🧺</div>
                        <span>Giỏ quà tết</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🍰</div>
                        <span>Bánh kem</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🍓</div>
                        <span>Giỏ trái cây</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🕯️</div>
                        <span>Hoa sáp</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="cat-card">
                        <div class="cat-icon">🌹</div>
                        <span>Hoa độc đáo</span>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     FEATURED PRODUCTS
═══════════════════════════════════════ -->
    <section class="section-py bg-pale">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Bán chạy nhất</div>
                    <h2 class="section-title mb-0">Sản phẩm nổi bật</h2>
                    <div class="divider-leaf"></div>
                </div>
                <a href="#" class="btn-outline-green d-none d-md-inline-block">Xem tất cả <i
                        class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <!-- Filter tabs -->
            <ul class="nav filter-tabs mb-4 gap-2 flex-wrap">
                <li class="nav-item"><a class="nav-link active" href="#">Tất cả</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hoa hồng</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hoa cưới</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sinh nhật</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Lan hồ điệp</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Giỏ quà</a></li>
            </ul>

            <div class="row g-3">
                <!-- Product 1 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/01.png" alt="Bó hoa hồng đỏ" />
                            <span class="product-badge bg-danger text-white">Bán chạy</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(128)</span>
                            </div>
                            <div class="product-name">Bó hoa hồng đỏ tình yêu – 30 bông nhung</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">380.000đ</span>
                                <span class="product-price-old">480.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/02.png" alt="Giỏ hoa sinh nhật" />
                            <span class="product-badge bg-warning text-dark">Mới</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(94)</span>
                            </div>
                            <div class="product-name">Giỏ hoa sinh nhật pastel dễ thương</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">450.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/03.png" alt="Hoa lan hồ điệp" />
                            <span class="product-badge" style="background:var(--green-main);color:#fff;">Phổ biến</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★☆ <span style="color:#aaa;font-size:.75rem">(76)</span>
                            </div>
                            <div class="product-name">Chậu lan hồ điệp trắng – 3 cành sang trọng</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">750.000đ</span>
                                <span class="product-price-old">900.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/04.png" alt="Hộp hoa cưới" />
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(211)</span>
                            </div>
                            <div class="product-name">Hộp hoa cưới cao cấp – hồng phấn & trắng</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">680.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/01.png" alt="Kệ hoa khai trương" />
                            <span class="product-badge bg-info text-white">Hot</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(63)</span>
                            </div>
                            <div class="product-name">Kệ hoa khai trương đứng – màu đỏ may mắn</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">1.200.000đ</span>
                                <span class="product-price-old">1.500.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/02.png" alt="Bó hoa hướng dương" />
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★☆ <span style="color:#aaa;font-size:.75rem">(47)</span>
                            </div>
                            <div class="product-name">Bó hoa hướng dương rực rỡ – 15 bông tươi</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">290.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/03.png" alt="Giỏ quà tết" />
                            <span class="product-badge bg-danger text-white">-20%</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(88)</span>
                            </div>
                            <div class="product-name">Giỏ quà tết cao cấp – lan + quà + bánh</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">980.000đ</span>
                                <span class="product-price-old">1.200.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/shop/04.png" alt="Hoa sáp thơm" />
                            <span class="product-badge" style="background:var(--gold);color:#fff;">Độc đáo</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="product-body">
                            <div class="product-stars mb-1">★★★★★ <span style="color:#aaa;font-size:.75rem">(155)</span>
                            </div>
                            <div class="product-name">Bó hoa sáp thơm – lưu giữ mãi mãi</div>
                            <div class="mt-2 mb-3">
                                <span class="product-price">550.000đ</span>
                            </div>
                            <button class="btn-add-cart"><i class="bi bi-bag-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="#" class="btn-green">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     PROMO BANNERS
═══════════════════════════════════════ -->
    <section class="section-py">
        <div class="container">
            <div class="row g-3">
                <!-- Big banner -->
                <div class="col-md-6">
                    <div class="promo-banner promo-banner-1" style="min-height:240px;">
                        <div class="promo-banner-content">
                            <div
                                style="font-size:.75rem;color:#8dd5d7;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                Ưu đãi đặc biệt</div>
                            <h3 style="color:#fff;font-family:'Playfair Display',serif;margin:10px 0;">Hoa cưới trọn
                                gói<br><em>Giảm
                                    25%</em></h3>
                            <p style="color:#b2e8ea;font-size:.85rem;margin-bottom:18px;">Dịch vụ trang trí đám cưới từ
                                A-Z. Đặt lịch
                                trước 30 ngày.</p>
                            <a href="#" class="btn-primary-hero" style="padding:10px 24px;font-size:.85rem;">Xem ngay
                                →</a>
                        </div>
                    </div>
                </div>
                <!-- Two small banners -->
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="promo-banner promo-banner-2" style="min-height:110px;">
                                <div class="promo-banner-content" style="padding:20px 24px;">
                                    <div
                                        style="font-size:.72rem;color:#f0c8a0;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                        Mỗi ngày</div>
                                    <h5 style="color:#fff;font-family:'Playfair Display',serif;margin:6px 0 8px;">Combo
                                        hoa + bánh
                                        kem<br>chỉ từ <span style="color:#f0c88c;">599.000đ</span></h5>
                                    <a href="#"
                                        style="color:#f0c88c;font-size:.82rem;font-weight:600;text-decoration:none;">Đặt
                                        ngay
                                        →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="promo-banner promo-banner-3" style="min-height:110px;">
                                <div class="promo-banner-content" style="padding:20px 24px;">
                                    <div
                                        style="font-size:.72rem;color:#a0b8f0;font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                                        Tặng kèm</div>
                                    <h5 style="color:#fff;font-family:'Playfair Display',serif;margin:6px 0 8px;">Thiệp
                                        & ruy-băng miễn
                                        phí<br>cho mọi đơn từ <span style="color:#a0c8f0;">200.000đ</span></h5>
                                    <a href="#"
                                        style="color:#a0c8f0;font-size:.82rem;font-weight:600;text-decoration:none;">Tìm
                                        hiểu
                                        →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════ -->
    <section class="section-py bg-pale">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Khách hàng nói gì</div>
                <h2 class="section-title">Đánh giá từ trái tim</h2>
                <div class="divider-leaf mx-auto"></div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Hoa rất tươi và đẹp, đúng như hình ảnh. Giao hàng nhanh chóng, gói
                            hàng cẩn
                            thận. Mình rất hài lòng và sẽ tiếp tục ủng hộ shop!"</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--green-main);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                T</div>
                            <div>
                                <div class="testimonial-author">Thảo Nguyên</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng thân thiết
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Đặt hoa cưới tại đây, phục vụ rất chuyên nghiệp. Nhân viên tư vấn
                            nhiệt tình,
                            mẫu hoa đẹp không thua gì nước ngoài. Cảm ơn team Mộc Hương!"</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                M</div>
                            <div>
                                <div class="testimonial-author">Minh Khoa</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng cưới 2024
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <p class="testimonial-text">"Mua hoa tươi mỗi tuần tại đây từ 2 năm nay. Giá cả hợp lý, chất
                            lượng ổn định.
                            Đặc biệt dịch vụ đặt theo yêu cầu rất linh hoạt và sáng tạo."</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:#e74c3c;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                                L</div>
                            <div>
                                <div class="testimonial-author">Lan Phương</div>
                                <div class="testimonial-role" style="color:var(--gold);">★★★★★ · Khách hàng VIP</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     BLOG / TIN TỨC
═══════════════════════════════════════ -->
    <section class="section-py">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <div class="section-label">Tin tức & cẩm nang</div>
                    <h2 class="section-title mb-0">Bí quyết chọn hoa</h2>
                    <div class="divider-leaf"></div>
                </div>
                <a href="#" class="btn-outline-green d-none d-md-inline-block">Xem thêm <i
                        class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/05.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Cẩm nang hoa</div>
                            <h5 class="blog-title"><a href="#">10 loại hoa tặng mẹ ý nghĩa nhất nhân dịp 20/10</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 15/10/2024 · 5 phút đọc</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/06.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Hoa cưới</div>
                            <h5 class="blog-title"><a href="#">Xu hướng hoa cưới 2025: minimalist & tự nhiên</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 08/10/2024 · 7 phút đọc</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card h-100">
                        <div class="img-wrap">
                            <img src="assets/img/blog/07.jpg" alt="Blog" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-tag">Mẹo hay</div>
                            <h5 class="blog-title"><a href="#">Cách bảo quản hoa tươi lâu hơn tại nhà</a></h5>
                            <div class="blog-meta"><i class="bi bi-calendar3 me-1"></i> 01/10/2024 · 4 phút đọc</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     NEWSLETTER
═══════════════════════════════════════ -->
    <section class="py-5">
        <div class="container">
            <div class="newsletter-section p-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div style="font-size:2rem;margin-bottom:8px;">🌸</div>
                        <h3 style="color:#fff;font-family:'Playfair Display',serif;margin-bottom:10px;">Đăng ký nhận ưu
                            đãi</h3>
                        <p style="color:#b2e8ea;font-size:.88rem;margin-bottom:24px;">Nhận thông báo khuyến mãi và mẹo
                            cắm hoa mỗi
                            tuần qua email</p>
                        <div class="d-flex" style="max-width:420px;margin:0 auto;">
                            <input type="email" class="newsletter-input flex-grow-1" placeholder="Email của bạn..." />
                            <button class="newsletter-btn">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ -->
    <footer class="site-footer pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- Brand -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3"><img src="assets/img/logo.png" alt="Mộc Hương"
                            style="height:48px;width:48px;object-fit:cover;border-radius:50%;"><span
                            style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;color:#fff;">Mộc
                            <em style="color:#b2e8ea;">Hương</em></span></div>
                    <p style="font-size:.84rem;line-height:1.7;color:#7ec8ca;">Shop hoa tươi uy tín tại TP.HCM. Hơn 8
                        năm kinh
                        nghiệm phục vụ khách hàng với chất lượng hoa đảm bảo.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Danh mục -->
                <div class="col-lg-2 col-md-6">
                    <h6>Danh mục hoa</h6>
                    <ul class="list-unstyled" style="display:flex;flex-direction:column;gap:8px;">
                        <li><a href="#">Hoa hồng</a></li>
                        <li><a href="#">Hoa lan</a></li>
                        <li><a href="#">Hoa cưới</a></li>
                        <li><a href="#">Hoa sinh nhật</a></li>
                        <li><a href="#">Hoa khai trương</a></li>
                        <li><a href="#">Hoa sáp</a></li>
                    </ul>
                </div>

                <!-- Dịch vụ -->
                <div class="col-lg-2 col-md-6">
                    <h6>Dịch vụ</h6>
                    <ul class="list-unstyled" style="display:flex;flex-direction:column;gap:8px;">
                        <li><a href="#">Thiết kế theo yêu cầu</a></li>
                        <li><a href="#">Đặt hoa định kỳ</a></li>
                        <li><a href="#">Trang trí sự kiện</a></li>
                        <li><a href="#">Giao hoa tận nơi</a></li>
                        <li><a href="#">Tư vấn miễn phí</a></li>
                    </ul>
                </div>

                <!-- Hỗ trợ -->
                <div class="col-lg-2 col-md-6">
                    <h6>Hỗ trợ</h6>
                    <ul class="list-unstyled" style="display:flex;flex-direction:column;gap:8px;">
                        <li><a href="#">Hướng dẫn đặt hàng</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Câu hỏi thường gặp</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Liên hệ -->
                <div class="col-lg-3 col-md-6">
                    <h6>Liên hệ</h6>
                    <ul class="list-unstyled"
                        style="display:flex;flex-direction:column;gap:10px;font-size:.84rem;color:#7ec8ca;">
                        <li><i class="bi bi-geo-alt me-2"></i>123 Đường Hoa, Q. Tân Bình, TP.HCM</li>
                        <li><a href="tel:0888796364"><i class="bi bi-telephone me-2"></i>08.88.79.63.64</a></li>
                        <li><a href="mailto:hochuong@florist.vn"><i
                                    class="bi bi-envelope me-2"></i>hochuong@florist.vn</a></li>
                        <li><i class="bi bi-clock me-2"></i>7:00 – 21:00 mỗi ngày</li>
                    </ul>
                    <div class="mt-3" style="font-size:.8rem;color:#7ec8ca;">
                        <div style="font-weight:600;color:#fff;margin-bottom:6px;">Nhận thanh toán</div>
                        <div class="d-flex gap-2 flex-wrap">
                            <span
                                style="background:rgba(255,255,255,.1);padding:3px 10px;border-radius:6px;font-size:.75rem;">COD</span>
                            <span
                                style="background:rgba(255,255,255,.1);padding:3px 10px;border-radius:6px;font-size:.75rem;">Chuyển
                                khoản</span>
                            <span
                                style="background:rgba(255,255,255,.1);padding:3px 10px;border-radius:6px;font-size:.75rem;">Momo</span>
                            <span
                                style="background:rgba(255,255,255,.1);padding:3px 10px;border-radius:6px;font-size:.75rem;">VNPay</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-4 py-3">
            <div class="container text-center">
                © 2025 Mộc Hương Flower Shop. Mọi quyền được bảo lưu. | Được thiết kế với 💚 tại TP.HCM
            </div>
        </div>
    </footer>

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
    <div id="mobileNavModal" class="mobile-nav-modal" role="dialog" aria-modal="true" aria-label="Menu điều hướng">
        <!-- Backdrop -->
        <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>

        <!-- Drawer -->
        <div class="mobile-nav-drawer">
            <!-- Header -->
            <div class="mobile-nav-header">
                <div class="d-flex align-items-center gap-2"><img src="assets/img/logo.png" alt="Mộc Hương"
                        style="height:44px;width:44px;object-fit:cover;border-radius:50%;border:2px solid rgba(255,255,255,.3);"><span
                        style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#fff;">Mộc
                        <em style="color:#b2e8ea;">Hương</em></span></div>
                <button class="mobile-nav-close" id="mobileNavClose" aria-label="Đóng menu">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Search bar -->
            <div class="mobile-nav-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm hoa, giỏ quà..." />
                    <button class="btn" style="background:var(--green-main);color:#fff;border:none;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <!-- Quick links + Giỏ hàng -->
            <div class="mobile-nav-quick">
                <a href="#" class="mobile-quick-link">
                    <i class="bi bi-person-circle"></i>
                    <span>Tài khoản</span>
                </a>
                <a href="#" class="mobile-quick-link">
                    <i class="bi bi-heart"></i>
                    <span>Yêu thích</span>
                    <span class="mnq-badge">3</span>
                </a>
                <button id="cartOpenBtnMobile" class="mobile-quick-link"
                    style="background:none;border:none;flex:1;cursor:pointer;">
                    <i class="bi bi-bag"></i>
                    <span>Giỏ hàng</span>
                    <span class="mnq-badge">5</span>
                </button>
                <a href="#" class="mobile-quick-link">
                    <i class="bi bi-geo-alt"></i>
                    <span>Cửa hàng</span>
                </a>
            </div>

            <!-- Accordion menu – đồng bộ với desktop nav -->
            <div class="mobile-nav-body">
                <div class="mobile-nav-section-label">Danh mục sản phẩm</div>
                <div class="mobile-accordion" id="mobileAccordion">

                    <!-- 🌸 HOA TƯƠI -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-hoa">
                            <span>🌸 Hoa tươi</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-hoa">
                            <div class="mac-sub-label">Kiểu dáng</div>
                            <a href="#">🎀 Bó hoa</a>
                            <a href="#">📦 Hộp hoa</a>
                            <a href="#">🧺 Giỏ hoa</a>
                            <a href="#">🪴 Hoa để bàn</a>
                            <a href="#">🏆 Hoa kệ đứng</a>
                            <a href="#">💐 Bình hoa</a>
                            <div class="mac-sub-label">Loại hoa</div>
                            <a href="#">🌹 Hoa Hồng</a>
                            <a href="#">🌸 Lan hồ điệp</a>
                            <a href="#">🌻 Hướng Dương</a>
                            <a href="#">💐 Hoa Cúc</a>
                            <a href="#">🌷 Tulip</a>
                            <a href="#">🌺 Cẩm Chướng</a>
                            <a href="#">🪷 Ly – Loa Kèn</a>
                            <a href="#">🌼 Baby – Cát Tường</a>
                            <div class="mac-sub-label">Theo dịp</div>
                            <a href="#">🎂 Sinh nhật</a>
                            <a href="#">💍 Tình yêu / Valentine</a>
                            <a href="#">🎉 Khai trương</a>
                            <a href="#">🎓 Tốt nghiệp</a>
                            <a href="#">🌸 8/3 · 20/10</a>
                            <a href="#">🕊️ Chia buồn / Tang lễ</a>
                            <a href="#">🏢 Sự kiện công ty</a>
                            <div class="mac-sub-label">Theo màu & Đặc biệt</div>
                            <a href="#"><span class="color-dot" style="background:#e74c3c"></span> Đỏ &nbsp;<span
                                    class="color-dot" style="background:#e91e8c"></span> Hồng &nbsp;<span
                                    class="color-dot" style="background:#f9a825"></span> Vàng &nbsp;<span
                                    class="color-dot" style="background:#9c27b0"></span> Tím</a>
                            <a href="#">🕯️ Hoa sáp vĩnh cửu</a>
                            <a href="#">✨ Hoa độc đáo</a>
                        </div>
                    </div>

                    <!-- 💍 HOA CƯỚI -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-cuoi">
                            <span>💍 Hoa cưới</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-cuoi">
                            <div class="mac-sub-label">Cô dâu & chú rể</div>
                            <a href="#">Hoa cầm tay cô dâu</a>
                            <a href="#">Hoa cài áo chú rể</a>
                            <a href="#">Vòng hoa đội đầu</a>
                            <a href="#">Hoa cài tóc</a>
                            <div class="mac-sub-label">Trang trí</div>
                            <a href="#">Cổng hoa cưới</a>
                            <a href="#">Trang trí xe hoa</a>
                            <a href="#">Hoa bàn tiệc</a>
                            <a href="#">Hoa backdrop chụp ảnh</a>
                            <div class="mac-sub-label">Dịch vụ trọn gói</div>
                            <a href="#">Gói cưới cơ bản</a>
                            <a href="#">Gói cưới sang trọng</a>
                            <a href="#" style="color:var(--green-main);font-weight:600;">Tư vấn cưới miễn phí →</a>
                        </div>
                    </div>

                    <!-- 🪴 CÂY & LAN -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-cay">
                            <span>🪴 Cây & Lan</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-cay">
                            <div class="mac-sub-label">Lan hồ điệp</div>
                            <a href="#">Lan đơn cành</a>
                            <a href="#">Lan chậu 2–3 cành</a>
                            <a href="#">Lan hộp quà cao cấp</a>
                            <div class="mac-sub-label">Cây xanh</div>
                            <a href="#">Cây để bàn văn phòng</a>
                            <a href="#">Cây phong thủy</a>
                            <a href="#">Cây treo – cây leo</a>
                            <a href="#">Cây ngoài trời</a>
                            <a href="#">Chậu cây quà tặng</a>
                        </div>
                    </div>

                    <!-- 🎁 QUÀ TẶNG -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-qua">
                            <span>🎁 Quà tặng</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-qua">
                            <div class="mac-sub-label">Combo hoa + quà</div>
                            <a href="#">🐻 Gấu bông + hoa</a>
                            <a href="#">🍫 Chocolate + hoa</a>
                            <a href="#">🍷 Rượu vang + hoa</a>
                            <a href="#">🫶 Mỹ phẩm + hoa</a>
                            <div class="mac-sub-label">Giỏ & hộp quà</div>
                            <a href="#">🧺 Giỏ quà tết</a>
                            <a href="#">🍓 Giỏ trái cây tươi</a>
                            <a href="#">🎀 Hộp quà cao cấp</a>
                            <a href="#">🍱 Giỏ đặc sản vùng miền</a>
                            <div class="mac-sub-label">Phụ kiện</div>
                            <a href="#">🕯️ Set nến thơm</a>
                            <a href="#">🧴 Set spa – dưỡng da</a>
                            <a href="#">☕ Set trà – cà phê</a>
                            <a href="#">💌 Thiệp & phong bì</a>
                        </div>
                    </div>

                    <!-- 🍰 THỰC PHẨM -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-thucpham">
                            <span>🍰 Thực phẩm</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-thucpham">
                            <div class="mac-sub-label">Bánh kem</div>
                            <a href="#">🎂 Bánh sinh nhật</a>
                            <a href="#">🌸 Bánh hoa tươi</a>
                            <a href="#">💍 Bánh cưới</a>
                            <a href="#">🎨 Bánh in ảnh</a>
                            <a href="#">🌿 Bánh thuần chay</a>
                            <div class="mac-sub-label">Combo & Đồ uống</div>
                            <a href="#">🎁 Combo hoa + bánh</a>
                            <a href="#">🫐 Bánh mousse – tiramisu</a>
                            <a href="#">🧃 Nước ép trái cây</a>
                            <a href="#">🍵 Trà hoa – trà thảo mộc</a>
                        </div>
                    </div>

                    <!-- 🎪 SỰ KIỆN -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-sukien">
                            <span>🎪 Sự kiện</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-sukien">
                            <a href="#">🏢 Khai trương – khánh thành</a>
                            <a href="#">🎭 Hội nghị – hội thảo</a>
                            <a href="#">🎓 Lễ tốt nghiệp</a>
                            <a href="#">🎊 Tiệc sinh nhật trọn gói</a>
                            <a href="#">🏆 Trao giải – vinh danh</a>
                            <a href="#" style="color:var(--green-main);font-weight:600;">📞 Nhận báo giá →</a>
                        </div>
                    </div>

                    <!-- ⚙️ DỊCH VỤ -->
                    <div class="mac-item">
                        <button class="mac-toggle" data-target="acc-dichvu">
                            <span>⚙️ Dịch vụ</span><i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="mac-body" id="acc-dichvu">
                            <a href="#">🚚 Giao hoa nhanh 2h</a>
                            <a href="#">📅 Đặt hoa định kỳ</a>
                            <a href="#">🎨 Thiết kế theo yêu cầu</a>
                            <a href="#">🏠 Trang trí không gian</a>
                            <a href="#">🤝 Hợp tác doanh nghiệp B2B</a>
                            <a href="#">📸 Cho thuê hoa – phụ kiện</a>
                        </div>
                    </div>

                    <div class="mobile-nav-section-label" style="margin-top:4px;">Thông tin</div>
                    <a href="#" class="mac-plain">📰 Tin tức & Cẩm nang</a>
                    <a href="#" class="mac-plain">📞 Liên hệ</a>
                    <a href="#" class="mac-plain">❓ Câu hỏi thường gặp</a>
                </div>
            </div>

            <!-- Footer CTA -->
            <div class="mobile-nav-footer">
                <a href="#" class="btn-green w-100 text-center d-block mb-2">
                    <i class="bi bi-bag-heart me-1"></i> Đặt hoa ngay
                </a>
                <a href="https://zalo.me/0888796364" class="btn-outline-green w-100 text-center d-block">
                    💬 Chat Zalo tư vấn
                </a>
            </div>
        </div>
    </div>

    <style>
        /* ─── HAMBURGER BUTTON ─── */
        .hamburger-btn {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 40px;
            height: 40px;
            background: var(--green-pale);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            padding: 8px;
            flex-shrink: 0;
            transition: background .2s;
        }

        .hamburger-btn:hover {
            background: #b2e8ea;
        }

        .hamburger-btn span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--green-dark);
            border-radius: 2px;
            transition: all .3s;
        }

        .hamburger-btn.is-open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger-btn.is-open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .hamburger-btn.is-open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ─── MOBILE NAV MODAL ─── */
        .mobile-nav-modal {
            position: fixed;
            inset: 0;
            z-index: 2000;
            pointer-events: none;
            visibility: hidden;
        }

        .mobile-nav-modal.is-open {
            pointer-events: auto;
            visibility: visible;
        }

        /* Backdrop */
        .mobile-nav-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            transition: background .35s ease;
        }

        .mobile-nav-modal.is-open .mobile-nav-backdrop {
            background: rgba(0, 0, 0, .55);
        }

        /* Drawer */
        .mobile-nav-drawer {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: min(85vw, 360px);
            background: #fff;
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            transition: transform .35s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 4px 0 32px rgba(0, 0, 0, .15);
            overflow: hidden;
        }

        .mobile-nav-modal.is-open .mobile-nav-drawer {
            transform: translateX(0);
        }

        /* Drawer header */
        .mobile-nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            background: var(--green-main);
            flex-shrink: 0;
        }

        .mobile-nav-header .brand-name {
            color: #fff !important;
            font-size: 1.25rem !important;
        }

        .mobile-nav-header .brand-name span {
            color: #8dd5d7 !important;
        }

        .mobile-nav-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: background .2s;
            flex-shrink: 0;
        }

        .mobile-nav-close:hover {
            background: rgba(255, 255, 255, .3);
        }

        /* Search */
        .mobile-nav-search {
            padding: 14px 16px 10px;
            flex-shrink: 0;
            background: var(--green-pale);
        }

        .mobile-nav-search .input-group {
            border-radius: 50px;
            overflow: hidden;
            border: 1.5px solid #b2e8ea;
        }

        .mobile-nav-search input {
            border: none;
            background: #fff;
            font-size: 0.85rem;
            padding: 10px 16px;
            box-shadow: none !important;
        }

        .mobile-nav-search .btn {
            padding: 0 16px;
            border-radius: 0 !important;
        }

        /* Quick links strip */
        .mobile-nav-quick {
            display: flex;
            gap: 0;
            border-bottom: 1px solid #eee;
            flex-shrink: 0;
        }

        .mobile-quick-link {
            flex: 1;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 10px 6px;
            font-size: 0.72rem;
            color: var(--text-muted);
            text-decoration: none;
            text-align: center;
            border-right: 1px solid #eee;
            transition: background .2s, color .2s;
        }

        .mobile-quick-link:last-child {
            border-right: none;
        }

        .mobile-quick-link i {
            font-size: 1.2rem;
            color: var(--green-main);
        }

        .mobile-quick-link span:not(.mnq-badge) {
            font-size: 0.7rem;
        }

        .mobile-quick-link:hover {
            background: var(--green-pale);
            color: var(--green-dark);
        }

        /* Section label */
        .mobile-nav-section-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--green-main);
            padding: 14px 16px 6px;
        }

        /* Scrollable body */
        .mobile-nav-body {
            flex: 1;
            overflow-y: auto;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-nav-body::-webkit-scrollbar {
            width: 3px;
        }

        .mobile-nav-body::-webkit-scrollbar-thumb {
            background: #b2e8ea;
            border-radius: 2px;
        }

        /* Accordion */
        .mobile-accordion {
            padding-bottom: 8px;
        }

        /* Accordion toggle item */
        .mac-item {
            border-bottom: 1px solid #f0f0f0;
        }

        .mac-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 16px;
            background: none;
            border: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            text-align: left;
            transition: background .15s;
        }

        .mac-toggle:hover {
            background: var(--green-pale);
        }

        .mac-toggle i {
            font-size: 0.75rem;
            color: var(--green-main);
            transition: transform .3s;
            flex-shrink: 0;
        }

        .mac-toggle.is-open i {
            transform: rotate(180deg);
        }

        .mac-toggle.is-open {
            color: var(--green-main);
        }

        /* Accordion body */
        .mac-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease;
            background: #f9fbf9;
        }

        .mac-body.is-open {
            max-height: 1200px;
        }

        .mac-body a {
            display: block;
            padding: 10px 16px 10px 28px;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-decoration: none;
            border-bottom: 1px solid #eef0ee;
            transition: background .15s, color .15s, padding-left .15s;
        }

        .mac-body a:last-child {
            border-bottom: none;
        }

        .mac-body a:hover {
            background: var(--green-pale);
            color: var(--green-dark);
            padding-left: 32px;
        }

        /* Plain (no-child) links */
        .mac-plain {
            display: flex;
            align-items: center;
            padding: 13px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: background .15s, color .15s;
        }

        .mac-plain:hover {
            background: var(--green-pale);
            color: var(--green-main);
        }

        /* Footer CTA */
        .mobile-nav-footer {
            padding: 16px;
            border-top: 1px solid #eee;
            background: #fff;
            flex-shrink: 0;
        }

        /* ─── Ẩn mega-nav hẳn khi < lg ─── */
        /* ─── Sub-label inside accordion body ─── */
        .mac-sub-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--green-main);
            padding: 10px 16px 4px 28px;
            background: #f9fbf9;
        }

        /* ─── Sub-label inside accordion body ─── */
        .mac-sub-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--green-main);
            padding: 10px 16px 4px 28px;
            background: #f9fbf9;
            display: block;
        }

        /* ─── Badge trên quick links ─── */
        .mnq-badge {
            position: absolute;
            top: 4px;
            right: calc(50% - 18px);
            background: #e74c3c;
            color: #fff;
            font-size: 0.58rem;
            font-weight: 700;
            min-width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            pointer-events: none;
        }

        @media (max-width: 991px) {
            .mega-nav {
                display: none !important;
            }
        }
    </style>

    <!-- ═══════════════════════════════════════
     CART DRAWER
═══════════════════════════════════════ -->
    <div id="cartDrawer" class="cart-drawer" role="dialog" aria-modal="true" aria-label="Giỏ hàng">
        <div class="cart-backdrop" id="cartBackdrop"></div>
        <div class="cart-panel">

            <!-- Header -->
            <div class="cart-header">
                <div class="cart-header-title">
                    <i class="bi bi-bag me-2"></i> Giỏ hàng
                    <span class="cart-count-pill" id="cartCountPill">5 sản phẩm</span>
                </div>
                <button class="cart-close" id="cartCloseBtn" aria-label="Đóng giỏ hàng">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Items -->
            <div class="cart-body" id="cartBody">

                <div class="cart-item" data-id="1">
                    <div class="cart-item-img"><img src="assets/img/shop/01.png" alt="Hoa hồng đỏ"></div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">Bó hoa hồng đỏ tình yêu – 30 bông</div>
                        <div class="cart-item-price">380.000đ</div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" data-action="minus" data-id="1">−</button>
                            <span class="qty-val" id="qty-1">1</span>
                            <button class="qty-btn" data-action="plus" data-id="1">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" data-id="1" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
                </div>

                <div class="cart-item" data-id="2">
                    <div class="cart-item-img"><img src="assets/img/shop/02.png" alt="Giỏ hoa sinh nhật"></div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">Giỏ hoa sinh nhật pastel dễ thương</div>
                        <div class="cart-item-price">450.000đ</div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" data-action="minus" data-id="2">−</button>
                            <span class="qty-val" id="qty-2">2</span>
                            <button class="qty-btn" data-action="plus" data-id="2">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" data-id="2" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
                </div>

                <div class="cart-item" data-id="3">
                    <div class="cart-item-img"><img src="assets/img/shop/03.png" alt="Lan hồ điệp"></div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">Chậu lan hồ điệp trắng – 3 cành</div>
                        <div class="cart-item-price">750.000đ</div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" data-action="minus" data-id="3">−</button>
                            <span class="qty-val" id="qty-3">1</span>
                            <button class="qty-btn" data-action="plus" data-id="3">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" data-id="3" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
                </div>

                <div class="cart-item" data-id="4">
                    <div class="cart-item-img"><img src="assets/img/shop/04.png" alt="Hộp hoa cưới"></div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">Hộp hoa cưới cao cấp – hồng phấn & trắng</div>
                        <div class="cart-item-price">680.000đ</div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" data-action="minus" data-id="4">−</button>
                            <span class="qty-val" id="qty-4">1</span>
                            <button class="qty-btn" data-action="plus" data-id="4">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" data-id="4" aria-label="Xóa"><i class="bi bi-trash3"></i></button>
                </div>

            </div>

            <!-- Promo code -->
            <div class="cart-promo">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mã giảm giá..." id="promoInput" />
                    <button class="btn cart-promo-btn" id="promoApplyBtn">Áp dụng</button>
                </div>
                <div class="cart-promo-msg" id="promoMsg"></div>
            </div>

            <!-- Summary -->
            <div class="cart-summary">
                <div class="cart-summary-row">
                    <span>Tạm tính</span>
                    <span id="cartSubtotal">2.260.000đ</span>
                </div>
                <div class="cart-summary-row" id="discountRow" style="display:none;color:#e74c3c;">
                    <span>Giảm giá</span>
                    <span id="cartDiscount">−0đ</span>
                </div>
                <div class="cart-summary-row">
                    <span>Phí giao hàng</span>
                    <span style="color:var(--green-main);font-weight:600;">Miễn phí</span>
                </div>
                <div class="cart-summary-row cart-total">
                    <span>Tổng cộng</span>
                    <span id="cartTotal">2.260.000đ</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="cart-actions">
                <a href="#" class="btn-green w-100 text-center d-block mb-2" style="padding:14px;">
                    <i class="bi bi-credit-card me-1"></i> Thanh toán ngay
                </a>
                <button class="btn-outline-green w-100" id="continueShoppingBtn" style="padding:12px;">
                    ← Tiếp tục mua sắm
                </button>
            </div>

        </div>
    </div>

    <style>
        /* ── CART DRAWER ── */
        .cart-drawer {
            position: fixed;
            inset: 0;
            z-index: 2100;
            pointer-events: none;
            visibility: hidden;
        }

        .cart-drawer.is-open {
            pointer-events: auto;
            visibility: visible;
        }

        .cart-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            transition: background .35s ease;
        }

        .cart-drawer.is-open .cart-backdrop {
            background: rgba(0, 0, 0, .55);
        }

        .cart-panel {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: min(92vw, 420px);
            background: #fff;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4, 0, .2, 1);
            box-shadow: -4px 0 32px rgba(0, 0, 0, .12);
        }

        .cart-drawer.is-open .cart-panel {
            transform: translateX(0);
        }

        /* Header */
        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            background: var(--green-main);
            flex-shrink: 0;
        }

        .cart-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cart-count-pill {
            background: rgba(255, 255, 255, .2);
            color: #fff;
            font-family: 'Be Vietnam Pro', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
        }

        .cart-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: background .2s;
        }

        .cart-close:hover {
            background: rgba(255, 255, 255, .3);
        }

        /* Items */
        .cart-body {
            flex: 1;
            overflow-y: auto;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
            padding: 12px 0;
        }

        .cart-body::-webkit-scrollbar {
            width: 3px;
        }

        .cart-body::-webkit-scrollbar-thumb {
            background: #b2e8ea;
            border-radius: 2px;
        }

        .cart-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #f5f5f5;
            transition: background .15s;
        }

        .cart-item:hover {
            background: #fafcfa;
        }

        .cart-item-img {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: #f0f0f0;
        }

        .cart-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-info {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cart-item-price {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--green-main);
            margin-bottom: 8px;
        }

        .cart-item-qty {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            width: fit-content;
        }

        .qty-btn {
            width: 30px;
            height: 28px;
            background: #f9f9f9;
            border: none;
            font-size: 1rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: background .15s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--green-pale);
            color: var(--green-dark);
        }

        .qty-val {
            width: 32px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 600;
            border-left: 1px solid #e0e0e0;
            border-right: 1px solid #e0e0e0;
            padding: 4px 0;
        }

        .cart-item-remove {
            background: none;
            border: none;
            color: #ccc;
            cursor: pointer;
            padding: 4px;
            font-size: 0.9rem;
            transition: color .2s;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .cart-item-remove:hover {
            color: #e74c3c;
        }

        /* Promo */
        .cart-promo {
            padding: 12px 16px;
            border-top: 1px solid #f0f0f0;
            flex-shrink: 0;
        }

        .cart-promo .input-group {
            border-radius: 8px;
            overflow: hidden;
            border: 1.5px solid #e0e0e0;
        }

        .cart-promo input {
            border: none;
            font-size: 0.85rem;
            padding: 10px 14px;
            box-shadow: none !important;
        }

        .cart-promo-btn {
            background: var(--green-pale);
            color: var(--green-dark);
            border: none;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0 16px;
            transition: background .2s;
        }

        .cart-promo-btn:hover {
            background: var(--green-main);
            color: #fff;
        }

        .cart-promo-msg {
            font-size: 0.78rem;
            margin-top: 6px;
            min-height: 18px;
        }

        /* Summary */
        .cart-summary {
            padding: 14px 16px 8px;
            border-top: 1px solid #f0f0f0;
            flex-shrink: 0;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--text-muted);
            padding: 4px 0;
        }

        .cart-total {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            padding-top: 10px;
            margin-top: 6px;
            border-top: 1.5px solid #eee;
        }

        .cart-total span:last-child {
            color: var(--green-main);
            font-size: 1.1rem;
        }

        /* Actions */
        .cart-actions {
            padding: 14px 16px 20px;
            flex-shrink: 0;
            border-top: 1px solid #f0f0f0;
        }
    </style>

    <script>
        // ── CART DATA ──
        const cartData = {
            1: { price: 380000, qty: 1 },
            2: { price: 450000, qty: 2 },
            3: { price: 750000, qty: 1 },
            4: { price: 680000, qty: 1 },
        };
        let discount = 0;

        function fmt(n) {
            return n.toLocaleString('vi-VN') + 'đ';
        }

        function updateCartUI() {
            let subtotal = 0;
            let totalQty = 0;
            Object.keys(cartData).forEach(id => {
                const d = cartData[id];
                subtotal += d.price * d.qty;
                totalQty += d.qty;
                const el = document.getElementById('qty-' + id);
                if (el) el.textContent = d.qty;
            });

            document.getElementById('cartSubtotal').textContent = fmt(subtotal);
            document.getElementById('cartTotal').textContent = fmt(subtotal - discount);
            document.getElementById('cartCountPill').textContent = totalQty + ' sản phẩm';
            document.getElementById('cartBadge').textContent = totalQty;

            if (discount > 0) {
                document.getElementById('discountRow').style.display = 'flex';
                document.getElementById('cartDiscount').textContent = '−' + fmt(discount);
            }
        }

        // ── OPEN / CLOSE ──
        const cartDrawer = document.getElementById('cartDrawer');
        const cartBackdrop = document.getElementById('cartBackdrop');

        function openCart() {
            cartDrawer.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }
        function closeCart() {
            cartDrawer.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        document.getElementById('cartOpenBtn').addEventListener('click', openCart);
        document.getElementById('cartOpenBtnMobile').addEventListener('click', () => {
            // close nav first, then open cart
            document.getElementById('mobileNavModal').classList.remove('is-open');
            document.getElementById('mobileMenuBtn').classList.remove('is-open');
            openCart();
        });
        document.getElementById('cartCloseBtn').addEventListener('click', closeCart);
        document.getElementById('cartBackdrop').addEventListener('click', closeCart);
        document.getElementById('continueShoppingBtn').addEventListener('click', closeCart);

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && cartDrawer.classList.contains('is-open')) closeCart();
        });

        // ── QTY BUTTONS ──
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const action = this.dataset.action;
                if (action === 'plus') {
                    cartData[id].qty++;
                } else {
                    if (cartData[id].qty > 1) cartData[id].qty--;
                }
                updateCartUI();
            });
        });

        // ── REMOVE ITEM ──
        document.querySelectorAll('.cart-item-remove').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const item = document.querySelector(`.cart-item[data-id="${id}"]`);
                item.style.transition = 'opacity .25s, transform .25s';
                item.style.opacity = '0';
                item.style.transform = 'translateX(30px)';
                setTimeout(() => {
                    item.remove();
                    delete cartData[id];
                    updateCartUI();
                }, 250);
            });
        });

        // ── PROMO CODE ──
        document.getElementById('promoApplyBtn').addEventListener('click', () => {
            const code = document.getElementById('promoInput').value.trim().toUpperCase();
            const msg = document.getElementById('promoMsg');
            if (code === 'HOCHUONG10') {
                discount = 226000;
                msg.style.color = 'var(--green-main)';
                msg.textContent = '✓ Áp dụng thành công! Giảm 10%';
            } else if (code === '') {
                msg.style.color = '#e74c3c';
                msg.textContent = 'Vui lòng nhập mã giảm giá';
            } else {
                discount = 0;
                msg.style.color = '#e74c3c';
                msg.textContent = '✗ Mã không hợp lệ hoặc đã hết hạn';
            }
            updateCartUI();
        });

        // Init
        updateCartUI();
    </script>
    <script>
        // ── Filter tabs ──
        document.querySelectorAll('.filter-tabs .nav-link').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.filter-tabs .nav-link').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // ── Wishlist toggle ──
        document.querySelectorAll('.product-wishlist').forEach(btn => {
            btn.addEventListener('click', function () {
                const icon = this.querySelector('i');
                if (icon.classList.contains('bi-heart')) {
                    icon.classList.replace('bi-heart', 'bi-heart-fill');
                    this.style.color = '#e74c3c';
                } else {
                    icon.classList.replace('bi-heart-fill', 'bi-heart');
                    this.style.color = '';
                }
            });
        });

        // ── Mobile Nav Modal ──
        const modal = document.getElementById('mobileNavModal');
        const backdrop = document.getElementById('mobileNavBackdrop');
        const openBtn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('mobileNavClose');
        const body = document.body;

        function openNav() {
            modal.classList.add('is-open');
            openBtn.classList.add('is-open');
            body.style.overflow = 'hidden';
        }

        function closeNav() {
            modal.classList.remove('is-open');
            openBtn.classList.remove('is-open');
            body.style.overflow = '';
        }

        openBtn.addEventListener('click', openNav);
        closeBtn.addEventListener('click', closeNav);
        backdrop.addEventListener('click', closeNav);

        // Close on Escape
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) closeNav();
        });

        // ── Accordion ──
        document.querySelectorAll('.mac-toggle').forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.dataset.target;
                const accBody = document.getElementById(targetId);
                const isOpen = this.classList.contains('is-open');

                // Close all
                document.querySelectorAll('.mac-toggle').forEach(b => b.classList.remove('is-open'));
                document.querySelectorAll('.mac-body').forEach(b => b.classList.remove('is-open'));

                // Toggle clicked
                if (!isOpen) {
                    this.classList.add('is-open');
                    accBody.classList.add('is-open');
                    setTimeout(() => accBody.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 50);
                }
            });
        });
    </script>
    <!-- Bootstrap 5 JS Bundle (bắt buộc cho dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>