<div class="topbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3">
                <span><i class="bi bi-telephone-fill me-1"></i> 08.88.79.63.64</span>
                <span class="d-none d-md-inline"><i class="bi bi-envelope-fill me-1"></i> hochuong@florist.vn</span>
                <span class="d-none d-md-inline"><i class="bi bi-alarm-fill"></i>
                    <span id="live-clock">{{ now()->format('H:i:s d/m/Y') }}</span></span>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <span class="d-none d-md-inline"><i class="bi bi-bicycle"></i> Giao hoa miễn phí nội thành</span>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    function updateClock() {
        const now = new Date();

        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('live-clock').textContent =
            `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>