<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>@yield('title', 'Super Admin') | Shop Hoa Mộc Hương</title>

    {{-- Tabler CDN test --}}
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div class="page">
        @include('layouts.super-admin.sidebar')

        @include('layouts.super-admin.header')

        <div class="page-wrapper">
            @include('layouts.super-admin.breadcrumb')

            <div class="page-body">
                <div class="container-xl">
                    @include('layouts.super-admin.alert')

                    @yield('content')
                </div>
            </div>

            @include('layouts.super-admin.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>

    @stack('scripts')
</body>

</html>