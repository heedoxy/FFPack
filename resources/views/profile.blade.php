@php
    $menu_active = 1;
    $sub_active = 1;
    $user = \Illuminate\Support\Facades\Auth::user();
@endphp

@extends('layouts.master')

@section('title', 'پروفایل')

@section('main')
    <main class="main-content">
        @if($errors->any())
            @foreach($errors->all() as $message)
                <p class="text-left text-success">{{ $message }}</p>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-primary">پروفایل کاربر</h6>
                        <form method="post" action="/profile">
                            @csrf
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" class="form-control text-left" name="name" id="name"
                                       placeholder="نام" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="family">نام خانوادگی</label>
                                <input type="text" class="form-control text-left" name="family" id="family"
                                       placeholder="نام خانوادگی" value="{{ $user->family }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">شماره همراه</label>
                                <input type="text" class="form-control text-left" name="phone" id="phone"
                                       placeholder="شماره همراه" value="{{ $user->phone }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password">رمز عبور</label>
                                <input type="password" class="form-control text-left" name="password" id="password"
                                       placeholder="رمز عبور">
                                <small class="form-text text-danger">
                                    تنها درصورت نیاز به تغییر رمز عبور این فیلد تکمیل شود !
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">به روز رسانی</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
