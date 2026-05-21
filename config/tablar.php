<?php

return [
    'title' => 'Mộc Hương',           // Tên shop
    'logo' => '<img src="/assets/img/logo.png" height="38" alt="Mộc Hương">',
    'logo_mini' => '<img src="/assets/img/logo.png" height="38" alt="MH">',
    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'assets/img/logo.png',
            'alt' => 'Moc Huong Flower Shop',
            'class' => 'navbar-brand-image',
            'width' => 110,
            'height' => 32,
        ],
    ],

    // Màu sắc chính (primary)
    'primary_color' => '#2BAAAD',                 // Màu xanh chủ đạo của bạn

    // Dark mode (bật/tắt)
    'dark_mode' => true,

    // Các tùy chọn khác
    'show_version' => false,
    'show_right_sidebar' => false,
    'menu' => [
        // Header
        ['header' => 'BẢNG ĐIỀU KHIỂN'],

        [
            'text' => 'Dashboard',
            'url' => '/admin',
            'icon' => 'ti ti-home',
        ],

        ['header' => 'QUẢN LÝ SẢN PHẨM'],

        [
            'text' => 'Sản phẩm',
            'url' => '/admin/products',
            'icon' => 'ti ti-package',
        ],

        [
            'text' => 'Danh mục',
            'url' => 'admin/danh-muc',
            'icon' => 'ti ti-category',
        ],

        ['header' => 'BÁN HÀNG & ĐƠN HÀNG'],

        [
            'text' => 'Đơn hàng',
            'url' => '/admin/orders',
            'icon' => 'ti ti-shopping-cart',
        ],

        [
            'text' => 'Khách hàng',
            'url' => '/admin/customers',
            'icon' => 'ti ti-users',
        ],

        ['header' => 'MARKETING'],

        [
            'text' => 'Khuyến mãi',
            'url' => '/admin/promotions',
            'icon' => 'ti ti-discount',
        ],

        ['header' => 'BÁO CÁO'],

        [
            'text' => 'Doanh thu',
            'url' => '/admin/reports/revenue',
            'icon' => 'ti ti-chart-bar',
        ],

        [
            'text' => 'Thống kê',
            'url' => '/admin/reports',
            'icon' => 'ti ti-chart-pie',
        ],

        ['header' => 'CÀI ĐẶT'],

        [
            'text' => 'Cài đặt chung',
            'url' => '/admin/settings',
            'icon' => 'ti ti-settings',
        ],

        [
            'text' => 'Đăng xuất',
            'url' => '/admin/logout',
            'icon' => 'ti ti-logout',
        ],
    ],
];
