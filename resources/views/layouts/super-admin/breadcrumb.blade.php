<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    @yield('pretitle', 'Super Admin')
                </div>
                <h2 class="page-title">
                    @yield('page-title', 'Dashboard')
                </h2>
            </div>

            <div class="col-auto ms-auto d-print-none">
                @yield('page-actions')
            </div>
        </div>
    </div>
</div>