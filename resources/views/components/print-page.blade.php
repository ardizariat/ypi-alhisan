<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/print/dashlite.css') }}">
    {{-- <link id="skin-default" rel="stylesheet" href="{{ asset('assets/vendors/print/theme.css') }}"> --}}
    {{ $css ?? '' }}
</head>

<body class="bg-white" onload="printPromot()">

    {{ $slot }}

    {{ $js ?? '' }}
</body>

</html>
