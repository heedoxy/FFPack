@php
    $menu_active = 1;
    $sub_active = 4;
    $edit = isset($id);
    $action = "/user/" . ($edit ? "edit" : "add");
@endphp

@extends('layouts.master')

@section('title', 'مدیریت کاربر')

@section('main')
    <main class="main-content">
        @if($errors->any())
            @foreach($errors->all() as $message)
                <p class="text-left text-danger">{{ $message }}</p>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-primary">{{ $edit ? "ویرایش کاربر" : "ثبت کاربر" }}</h6>
                        <form method="post" action="{{ $action }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $edit ? $id : 0 }}">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" class="form-control text-left" name="name" id="name"
                                       placeholder="نام" value="{{ $edit ? $user->name : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="family">نام خانوادگی</label>
                                <input type="text" class="form-control text-left" name="family" id="family"
                                       placeholder="نام خانوادگی" value="{{ $edit ? $user->family : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">شماره همراه</label>
                                <input type="text" class="form-control text-left" name="phone" id="phone"
                                       placeholder="شماره همراه" value="{{ $edit ? $user->phone : '' }}" required>
                                <small class="form-text text-danger">
                                    از شماره همراه به عنوان نام کاربری استفاده میشود !
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="password">رمز عبور</label>
                                <input type="password" class="form-control text-left" name="password" id="password"
                                       placeholder="رمز عبور" {{ $edit ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="access"
                                           id="access1" value="1" checked>
                                    <label class="form-check-label" for="access1">
                                        دسترسی فروشنده
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="access"
                                           id="access2" value="2" {{ $edit && $user->access == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="access2">
                                        دسترسی تولید کننده
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="access"
                                           id="access3" value="3" {{ $edit && $user->access == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="access3">
                                        دسترسی مشتری
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
