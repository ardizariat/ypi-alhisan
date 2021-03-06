<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Alhisan' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/alhisanLogo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/alhisanLogo.png') }}" type="image/png">
    <x-custom-css></x-custom-css>
    {{ $css ?? '' }}
</head>

<body>
    <div id="app">

        <!-- Sidebar -->
        <x-admin-app-sidebar></x-admin-app-sidebar>
        <!-- Sidebar -->

        <div id="main" class='layout-navbar'>
            <!-- Navbar -->
            <x-admin-app-navbar></x-admin-app-navbar>
            <!-- Navbar -->

            <!-- Content -->
            <div id="main-content">

                {{ $slot }}

                <!-- Footer -->
                <x-admin-app-footer></x-admin-app-footer>
                <!-- Footer -->
            </div>
            <!-- Content -->
        </div>
    </div>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <x-custom-js></x-custom-js>

    {{ $js ?? '' }}
</body>

</html>
