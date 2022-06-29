@extends('layouts.auth')

@section('title', 'فست فوت پک | ورود')

@section('main')
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
                    <form action="/login" method="post" class="login-form">
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
@endsection
