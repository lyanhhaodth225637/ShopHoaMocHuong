@if (session('success'))
    <div id="success-alert" class="alert alert-success" role="alert">
        <div class="d-flex">
            <div class="alert-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </div>

            <div>
                <h4 class="alert-heading">Thành công</h4>
                <div class="alert-description">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error-alert" class="alert alert-danger" role="alert">
        <div class="d-flex">
            <div class="alert-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon alert-icon icon-2">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </div>

            <div>
                <h4 class="alert-heading">Có lỗi</h4>
                <div class="alert-description">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endif
<script>
    setTimeout(function () {
        const alert = document.getElementById('success-alert');

        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';

            setTimeout(function () {
                alert.remove();
            }, 500);
        }
    }, 3000);
</script>