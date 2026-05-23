const cartDrawer = document.getElementById('cartDrawer');
const cartBackdrop = document.getElementById('cartBackdrop');
const cartOpenBtn = document.getElementById('cartOpenBtn');
const cartOpenBtnMobile = document.getElementById('cartOpenBtnMobile');
const cartCloseBtn = document.getElementById('cartCloseBtn');
const continueShoppingBtn = document.getElementById('continueShoppingBtn');

function openCart() {
    if (!cartDrawer) {
        return;
    }

    cartDrawer.classList.add('is-open');
    document.body.style.overflow = 'hidden';
}

function closeCart() {
    if (!cartDrawer) {
        return;
    }

    cartDrawer.classList.remove('is-open');
    document.body.style.overflow = '';
}

if (cartOpenBtn) {
    cartOpenBtn.addEventListener('click', openCart);
}

if (cartOpenBtnMobile) {
    cartOpenBtnMobile.addEventListener('click', () => {
        const mobileNavModal = document.getElementById('mobileNavModal');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        if (mobileNavModal) {
            mobileNavModal.classList.remove('is-open');
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.classList.remove('is-open');
        }

        openCart();
    });
}

if (cartCloseBtn) {
    cartCloseBtn.addEventListener('click', closeCart);
}

if (cartBackdrop) {
    cartBackdrop.addEventListener('click', closeCart);
}

if (continueShoppingBtn) {
    continueShoppingBtn.addEventListener('click', closeCart);
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && cartDrawer?.classList.contains('is-open')) {
        closeCart();
    }
});

document.querySelectorAll('.filter-tabs .nav-link').forEach(tab => {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.filter-tabs .nav-link').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

document.querySelectorAll('.product-wishlist').forEach(btn => {
    btn.addEventListener('click', function () {
        const icon = this.querySelector('i');

        if (!icon) {
            return;
        }

        if (icon.classList.contains('bi-heart')) {
            icon.classList.replace('bi-heart', 'bi-heart-fill');
            this.style.color = '#e74c3c';
        } else {
            icon.classList.replace('bi-heart-fill', 'bi-heart');
            this.style.color = '';
        }
    });
});

const mobileNavModal = document.getElementById('mobileNavModal');
const mobileNavBackdrop = document.getElementById('mobileNavBackdrop');
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNavClose = document.getElementById('mobileNavClose');

function openNav() {
    if (!mobileNavModal || !mobileMenuBtn) {
        return;
    }

    mobileNavModal.classList.add('is-open');
    mobileMenuBtn.classList.add('is-open');
    document.body.style.overflow = 'hidden';
}

function closeNav() {
    if (!mobileNavModal || !mobileMenuBtn) {
        return;
    }

    mobileNavModal.classList.remove('is-open');
    mobileMenuBtn.classList.remove('is-open');

    if (!cartDrawer?.classList.contains('is-open')) {
        document.body.style.overflow = '';
    }
}

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', openNav);
}

if (mobileNavClose) {
    mobileNavClose.addEventListener('click', closeNav);
}

if (mobileNavBackdrop) {
    mobileNavBackdrop.addEventListener('click', closeNav);
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && mobileNavModal?.classList.contains('is-open')) {
        closeNav();
    }
});

document.querySelectorAll('.mac-toggle').forEach(btn => {
    btn.addEventListener('click', function () {
        const targetId = this.dataset.target;
        const accBody = document.getElementById(targetId);
        const isOpen = this.classList.contains('is-open');

        document.querySelectorAll('.mac-toggle').forEach(toggle => toggle.classList.remove('is-open'));
        document.querySelectorAll('.mac-body').forEach(body => body.classList.remove('is-open'));

        if (!isOpen && accBody) {
            this.classList.add('is-open');
            accBody.classList.add('is-open');
            setTimeout(() => accBody.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 50);
        }
    });
});
