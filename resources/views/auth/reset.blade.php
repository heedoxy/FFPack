@extends('layouts.auth')

@section('title', 'فست فوت پک | ورود')

@section('main')
    <div class="container">

        @error('danger')
        <p class="text-center text-danger">{{ $message }}</p>
        @enderror

        @error('success')
        <p class="text-center text-success">{{ $message }}</p>
        @enderror

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 text-center">
                <div class="login-wrap p-4 p-md-5">

                    <img src="assets/image/FastFoodPack.png" style="width: 150px">

                    <h3 class="text-center my-4">فراموشی رمز عبور</h3>
                    <div class="form-group">
                        <p>
                            کاربر گرامی
                            <br>
                            تغیر رمز عبور فقط از طریق پشتیبانی سامانه مقدور میباشد.
                            چنانچه رمز عبور خود را فراموش کرده اید کافیست به پشتیبانی ما از طریق واتساپ پیام دهید.
                            <br>
                            <br>
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="/login" class="btn btn-primary rounded p-3 px-5">ورود</a>
                        <a target="_blank" href="https://wa.me/989218248954" class="btn btn-whatsapp rounded p-3 px-5">پشتیبانی</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
