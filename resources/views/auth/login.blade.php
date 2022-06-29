<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فست فوت پک | ورود</title>
    <!-- Theme Color -->
    <meta name="theme-color" content="#5867dd">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="assets/vendors/bundle.css" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="assets/css/app.css" type="text/css">
</head>

<body class="form-membership">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
</div>
<!-- end::page loader -->

<div class="form-wrapper">
    <h5>پنل مدیریت</h5>
    <!-- form -->
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control text-left" name="phone" placeholder="نام کاربری" dir="ltr" required
                   autocomplete="off" autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control text-left" name="password" placeholder="رمز عبور" dir="ltr"
                   autocomplete="off" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block">ورود</button>
        <hr>
        <a href="https://ffpack.com" class="btn" style="background: #ffb300">مشاهده وب سایت</a>
    </form>
    <!-- ./ form -->

</div>

<!-- Plugin scripts -->
<script src="assets/vendors/bundle.js"></script>

<!-- App scripts -->
<script src="assets/js/app.js"></script>
</body>

</html>
