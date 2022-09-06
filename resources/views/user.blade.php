@php
    $menu_active = 1;
    $access = $access ?? 1;

    if ($access == 3) $sub_active = 9;
    elseif ($access == 2) $sub_active = 11;
    elseif ($access == 1) $sub_active = 6;
    else $sub_active = 6;

    $edit = isset($id);

    if ($access == 3) $type = "مشتری";
    elseif ($access == 2) $type = "تامین کننده";
    elseif ($access == 1) $type = "کارشناس";
    elseif ($access == 0) $type = "کارشناس ارشد";
    else $type = "کارشناس";

    $action = "/user/" . ($edit ? "edit" : "add");
@endphp

@extends('layouts.master')

@section('title', " مدیریت $type ")

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
                        <h6 class="card-title text-primary">{{ $edit ? "ویرایش کاربر" : " ثبت $type " }}</h6>
                        <form method="post" action="{{ $action }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $edit ? $id : 0 }}">
                            <input type="hidden" name="access" value="{{ $access }}">

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

                            @if($access == 3)
                                <div class="form-group">
                                    <label for="title">عنوان مجموعه</label>
                                    <input type="text" class="form-control text-left" name="title" id="title"
                                           placeholder="عنوان مجموعه" value="{{ $edit ? $user->title : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-form-label">آدرس</label>
                                    <textarea class="form-control" name="address"
                                              id="address">{{ $edit ? $user->address : "" }}</textarea>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
