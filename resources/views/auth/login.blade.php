<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png">
    <title>فست فوت پک | ورود</title>
    <!-- Theme Color -->
    <meta name="theme-color" content="#5867dd">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="assets/vendors/bundle.css" type="text/css">
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
            background: #AF2629 !important;
            border: 1px solid #AF2629 !important;
        }

        .login-wrap h3 {
            color: #AF2629;
        }

        .checkbox-primary {
            color: #AF2629;
        }

        .checkbox-primary input:checked ~ .checkmark::after {
            color: #AF2629;
        }

        .login-wrap .icon {
            background: #AF2629;
        }

    </style>

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img src="https://ffpack.com/wp-content/uploads/2019/07/logo-fastfood.png">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 text-center">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">اطلاعات کاربری</h3>
                    <form action="/login" class="login-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control rounded-left" autocomplete="off"
                                   placeholder="شماره تماس" required>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" name="password" class="form-control rounded-left" autocomplete="off"
                                   placeholder="رمز عبور" required>
                        </div>
                        <div class="form-group d-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">مرا به خاطر بسپار
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-left">
                                <a>فراموشی رمز عبور</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary rounded submit p-3 px-5">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
