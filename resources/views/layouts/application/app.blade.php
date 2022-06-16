<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="title" content="yayasan pendidikan islam alhisan bekasi">
    <meta name="description"
        content="yayasan pendidikan islam alhisan bekasi, kajian, tkq, tpq, alquran, islam, tauhid,  pendidikan">
    <meta name="keywords"
        content="yayasan pendidikan islam alhisan bekasi, kajian, tkq, tpq, alquran, islam, tauhid,  pendidikan, hijrah, alhadist">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">


    <title>{{ $title }}</title>

    <x-app-css></x-app-css>

    {{ $css ?? '' }}

    <!-- =======================================================
  * Template Name: Company - v4.7.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <x-app-navbar></x-app-navbar>
    <!-- End Header -->

    <!-- ======= Main ======= -->
    {{ $slot }}
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-app-footer></x-app-footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <x-app-js></x-app-js>

    {{ $js ?? '' }}

</body>

</html>
