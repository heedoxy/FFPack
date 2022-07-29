<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>@yield('title')</title>
    <meta name="token" content="{{ csrf_token() }}">

    <!-- Plugin styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- Slick -->
    <link rel="stylesheet" href="/assets/vendors/slick/slick.css">
    <link rel="stylesheet" href="/assets/vendors/slick/slick-theme.css">
    <!-- Vmap -->
    <link rel="stylesheet" href="/assets/vendors/vmap/jqvmap.min.css">
    <!-- Morris -->
    <link rel="stylesheet" href="/assets/vendors/charts/morris/morris.css" type="text/css">
    <!-- DataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/dataTables.bootstrap4.min.css" type="text/css">
    <!-- fixedHeader  -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/fixedHeader.bootstrap4.min.css" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- Clockpicker -->
    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

    <!--  -->
    <link rel="stylesheet" href="https://rawcdn.githack.com/easylogic/colorpicker/main/dist/EasyLogicColorPicker.css">
    <!-- Light Box -->
    <link rel="stylesheet" href="/assets/vendors/lightbox/magnific-popup.css" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- selectize -->
    <!-- Plugin styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

    <!-- Range slider -->
    <link rel="stylesheet" href="/assets/vendors/range-slider/css/ion.rangeSlider.min.css" type="text/css">

    <!-- Tagsinput -->
    <link rel="stylesheet" href="/assets/vendors/tagsinput/bootstrap-tagsinput.css" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"-->
    <!--            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <!-- Dropzone -->
    <link rel="stylesheet" href="/assets/vendors/dropzone/dropzone.css" type="text/css">

    <!--    font awesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script>
        const loading = true;
        const onlyDesktop = false;
        const menuButton = true;
    </script>
</head>


<body>

@include('layouts.header')

@yield('main')

@include('layouts.footer')

<!-- Plugin scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- Chartjs -->
<script src="/assets/vendors/charts/chartjs/chart.min.js"></script>
<!-- Circle progress -->
<script src="/assets/vendors/circle-progress/circle-progress.min.js"></script>
<!-- Peity -->
<script src="/assets/vendors/charts/peity/jquery.peity.min.js"></script>
<script src="/assets/js/examples/charts/peity.js"></script>
<!-- Datepicker -->
<script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
<script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
<script src="/assets/vendors/datepicker/daterangepicker.js"></script>
<script src="/assets/js/examples/datepicker.js"></script>
<script src="/assets/js/examples/datatable.js"></script>
<!--<script src="public/js/examples/datatable-init.js"></script>-->
<!-- Slick -->
<script src="/assets/vendors/slick/slick.min.js"></script>
<!-- Vamp -->
<script src="/assets/vendors/vmap/jquery.vmap.min.js"></script>
<script src="/assets/vendors/vmap/maps/jquery.vmap.usa.js"></script>
<script src="/assets/js/examples/vmap.js"></script>
<!-- Dashboard scripts -->
<script src="/assets/js/examples/dashboard.js"></script>
<!-- App scripts -->
<script src="/assets/js/app.js"></script>
<script src="/assets/vendors/select2/js/select2.min.js"></script>
<script src="/assets/js/examples/select2.js"></script>
<script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendors/dataTable/dataTables.fixedHeader.min.js"></script>
<script src="/assets/vendors/dataTable/export/dataTables.buttons.min.js"></script>
<script src="/assets/vendors/dataTable/export/jszip.min.js"></script>
<script src="/assets/vendors/dataTable/export/pdfmake.min.js"></script>
<script src="/assets/vendors/dataTable/export/vfs_fonts.js"></script>
<script src="/assets/vendors/dataTable/export/buttons.html5.min.js"></script>
<script src="/assets/vendors/dataTable/export/buttons.print.min.js"></script>
<script src="/assets/js/jquery.nice-select.min.js"></script>
<script src="/assets/js/croppie.js"></script>

</body>

</html>
