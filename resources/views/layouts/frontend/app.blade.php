<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">

<head>
    @php
        $siteName = 'Hoa Gỗ Mộc Hương';
        $defaultTitle = 'Hoa Gỗ Mộc Hương - Hoa tươi, sen đá, cây cảnh tại Long Xuyên';
        $pageTitle = trim($__env->yieldContent('title'));
        $seoTitle = $pageTitle !== '' ? $pageTitle . ' - ' . $siteName : $defaultTitle;
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: 'Hoa Gỗ Mộc Hương chuyên hoa tươi, sen đá, cây cảnh, hoa sự kiện và quà tặng tại Long Xuyên.';
        $metaKeywords = trim($__env->yieldContent('meta_keywords')) ?: 'hoa tươi Long Xuyên, sen đá Long Xuyên, cây cảnh mini, Hoa Gỗ Mộc Hương';
        $canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current();
        $ogTitle = trim($__env->yieldContent('og_title')) ?: $seoTitle;
        $ogDescription = trim($__env->yieldContent('og_description')) ?: $metaDescription;
        $ogImage = trim($__env->yieldContent('og_image')) ?: asset('assets/img/logo/logo.jpeg');
        $ogType = trim($__env->yieldContent('og_type')) ?: 'website';
        $twitterCard = trim($__env->yieldContent('twitter_card')) ?: 'summary_large_image';
    @endphp

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seoTitle }}</title>

    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="author" content="{{ $siteName }}">

    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="{{ $ogType }}">

    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" href="{{ asset('assets/img/logo/logo.jpeg') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/icons/cartzilla-icons.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/home.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/all.min.css') }}">
</head>

<body>

    @include('layouts.frontend.topbar')

    @include('layouts.frontend.header-nav')

    <div>
        @yield('content')
    </div>

    @include('layouts.frontend.footer')

    <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
        style="position:fixed;bottom:24px;right:24px;width:44px;height:44px;border-radius:50%;background:var(--green-main);color:#fff;border:none;box-shadow:0 4px 16px rgba(0,0,0,.2);font-size:1.1rem;cursor:pointer;z-index:999;display:flex;align-items:center;justify-content:center;"
        title="Len dau trang">
        <i class="bi bi-chevron-up"></i>
    </button>

    <a href="https://zalo.me/0888796364" target="_blank"
        style="position:fixed;bottom:80px;right:24px;width:50px;height:50px;border-radius:50%;background:#0068ff;color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.5rem;box-shadow:0 4px 16px rgba(0,0,0,.2);text-decoration:none;z-index:999;"
        title="Chat Zalo">💬</a>

    @include('layouts.frontend.nav-mobile')

    @include('layouts.frontend.cart')

    <script src="{{ asset('assets/js/frontend/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartSummaryUrl = @json(route('user.cart.summary'));
            const csrfToken = @json(csrf_token());

            function escapeHtml(value) {
                return String(value ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function renderCartDrawer(summaryData) {
                if (!summaryData?.success) {
                    return;
                }

                const cartBody = document.getElementById('cartBody');
                const pill = document.getElementById('cartCountPill');
                const subtotal = document.getElementById('cartSubtotal');
                const total = document.getElementById('cartTotal');
                const count = summaryData.cart?.count ?? 0;
                const items = summaryData.items ?? [];

                document.querySelectorAll('[data-cart-count]').forEach(el => {
                    el.textContent = count;
                });

                if (pill) {
                    pill.textContent = count + ' sản phẩm';
                }

                if (subtotal) {
                    subtotal.textContent = summaryData.cart?.subtotal_format ?? '0đ';
                }

                if (total) {
                    total.textContent = summaryData.cart?.total_format ?? '0đ';
                }

                if (!cartBody) {
                    return;
                }

                if (!items.length) {
                    cartBody.innerHTML = `
                        <div class="text-center py-5 px-3">
                            <i class="bi bi-bag-x" style="font-size: 44px; color: #999;"></i>
                            <p class="mt-3 mb-0">Giỏ hàng của bạn đang trống.</p>
                        </div>
                    `;
                    return;
                }

                cartBody.innerHTML = items.map(item => `
                    <div class="cart-item" data-cart-item="${item.id}">
                        <div class="cart-item-img">
                            <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}">
                        </div>
                        <div class="cart-item-info">
                            <div class="cart-item-name">${escapeHtml(item.name)}</div>
                            <div class="cart-item-price">${escapeHtml(item.price_format)}</div>
                            <div class="cart-item-qty">
                                <form action="${escapeHtml(item.decrease_url)}" method="POST">
                                    <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="qty-btn">-</button>
                                </form>
                                <span class="qty-val">${item.quantity}</span>
                                <form action="${escapeHtml(item.increase_url)}" method="POST">
                                    <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="qty-btn">+</button>
                                </form>
                            </div>
                            <div class="cart-item-line-total">${escapeHtml(item.line_total_format)}</div>
                        </div>
                        <form action="${escapeHtml(item.remove_url)}" method="POST">
                            <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="cart-item-remove" aria-label="Xoa">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                `).join('');
            }

            function showCartToast(message, productName) {
                let toast = document.getElementById('cartToast');

                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'cartToast';
                    Object.assign(toast.style, {
                        position: 'fixed',
                        top: '90px',
                        right: '20px',
                        zIndex: '9999',
                        background: '#198754',
                        color: '#fff',
                        padding: '14px 18px',
                        borderRadius: '12px',
                        boxShadow: '0 10px 30px rgba(0,0,0,.18)',
                        maxWidth: '320px',
                    });
                    document.body.appendChild(toast);
                }

                toast.innerHTML = `
                    <strong>${escapeHtml(message)}</strong>
                    <div style="font-size:13px;margin-top:4px;">${escapeHtml(productName)}</div>
                `;
                toast.style.display = 'block';

                setTimeout(() => {
                    toast.style.display = 'none';
                }, 2500);
            }

            document.querySelectorAll('.ajax-add-cart-form').forEach(function (form) {
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();

                    const button = form.querySelector('.btn-add-cart, .btn-cart-main, button[type="submit"]');

                    if (!button) {
                        form.submit();
                        return;
                    }

                    const oldButtonHtml = button.innerHTML;

                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Dang them...';

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                            body: new FormData(form),
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            alert(data.message || 'Khong the them vao gio hang.');
                            return;
                        }

                        button.innerHTML = '<i class="bi bi-check-circle me-1"></i> Da them';

                        const summaryResponse = await fetch(cartSummaryUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                        });

                        if (summaryResponse.ok) {
                            const summaryData = await summaryResponse.json();
                            renderCartDrawer(summaryData);
                        }

                        showCartToast(data.message, data.product_name);

                        if (typeof openCart === 'function') {
                            openCart();
                        }

                        setTimeout(function () {
                            button.innerHTML = oldButtonHtml;
                            button.disabled = false;
                        }, 1000);

                    } catch (error) {
                        console.error(error);
                        alert('Co loi xay ra khi them vao gio hang.');
                        button.innerHTML = oldButtonHtml;
                        button.disabled = false;
                    }
                });
            });
        });
    </script>

</body>

</html>
