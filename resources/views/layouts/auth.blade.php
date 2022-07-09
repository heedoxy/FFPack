<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png">
    <title>@yield('title')</title>
    <!-- App styles -->
    <link rel="stylesheet" href="assets/css/app.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://preview.colorlib.com/theme/bootstrap/login-form-18/css/A.style.css.pagespeed.cf.EsokhafFue.css">

    <style>

        .ftco-section {
            padding: unset;
        }

        body {
            font-family: "secondary-font", serif !important;
            padding-top: 20px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: "secondary-font", serif !important;
        }
        input {
            text-align: right !important;
        }
        .checkmark {
            right: 0;
            left: unset;
        }
        .checkbox-wrap {
            padding-right: 30px;
        }

        .btn.btn-primary {
            background: #643e81 !important;
            border: 1px solid #643e81 !important;
        }

        .login-wrap h3 {
            color: #643e81;
        }

        .checkbox-primary {
            color: #643e81;
        }

        .checkbox-primary input:checked ~ .checkmark::after {
            color: #643e81;
        }

        .login-wrap .icon {
            background: #643e81;
        }

        footer {
            width: 100%;
            position: fixed;
            bottom: 5px;
            text-align: center;
        }

    </style>

</head>
<body>
<section class="ftco-section">
    @yield('main')
</section>
<footer>
    <p class="text-center text-muted">
        توسعه داده شده توسط هادبورد :)
    </p>
</footer>
</body>
</html>
