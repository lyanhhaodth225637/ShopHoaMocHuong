
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

    // <!-- Bootstrap 5 JS Bundle (bắt buộc cho dropdown) -->
    