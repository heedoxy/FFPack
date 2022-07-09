@php
    $menu_active = 1;
    $sub_active = 1;
    $access = \Illuminate\Support\Facades\Auth::user()->access;
@endphp

@extends('layouts.master')

@section('title', 'داشبورد')

@section('main')
    <main class="main-content">
        <div class="row">
            @if(in_array($access, [0, 1]))
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">مجموع فاکتور های صادر شده اخیر</h6>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center m-b-20">
                                        <div
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-success text-success">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-size-13 primary-font">امروز</h6>
                                            <h4 class="m-b-0 primary-font line-height-28">
                                                {{ number_format($today) }}
                                                تومان
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center m-b-20">
                                        <div
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-danger  text-danger">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-size-13 primary-font">7 روز اخیر</h6>
                                            <h4 class="m-b-0 primary-font line-height-28">
                                                {{ number_format($week) }}
                                                تومان
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center m-b-20">
                                        <div
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-warning text-warning">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-size-13 primary-font">30 روز اخیر</h6>
                                            <h4 class="m-b-0 primary-font line-height-28">
                                                {{ number_format($month) }}
                                                تومان
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(in_array($access, [3]))
                <div class="col-xl-4">
                    <div class="card">
                        <img src="/assets/image/profile-background.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center m-t-70-minus">
                            <figure class="avatar avatar-xl m-b-20">
                                <img src="/assets/image/profile.webp" class="rounded-circle" alt="...">
                            </figure>
                            <h5>{{ Auth::user()->name . " " . Auth::user()->family }}</h5>
                            <p class="text-muted small">خوش آمدید</p>
                            <a href="/profile" class="btn btn-outline-primary">
                                <i class="fa fa-pencil m-r-5"></i> ویرایش پروفایل
                            </a>
                        </div>
                        <hr class="m-0">
                    </div>
                </div>
            @endif
            <div class="col-xl-4">
                @if(in_array($access, [0, 1]))
                    <a href="/user/list">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning text-center p-20">
                                    <i class="fa fa-user font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $user }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-warning">کاربران</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
                @if(in_array($access, [0, 1]))
                    <a href="/user/list">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger text-center p-20">
                                    <i class="fa fa-users font-size-28"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $producer }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-danger">تولید کنندگان</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
                @if(in_array($access, [0, 1, 3]))
                    <a href="/factor/list">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-sticky-note font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $factor }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">فاکتور های ثبت شده</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </main>
@endsection
