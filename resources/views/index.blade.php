@php
    $menu_active = 1;
    $sub_active = 1;
    $access = \Illuminate\Support\Facades\Auth::user()->access;
@endphp

@extends('layouts.master')

@section('title', 'داشبورد')

@section('main')
    <style>
        .icon-block.icon-block-outline-warning {
            border: 2px solid orange !important;
            color: orange !important;
            background: none !important;
        }
    </style>
    <main class="main-content">
        <div class="row">
            @if(in_array($access, [0, 1]))
                <div class="col-xl-4">
                    <a href="/factor/status/3">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-user font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $status_3 }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">در انتظار ارجاع به تامین کننده</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/factor/status/4">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-user font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $status_4 }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">در انتظار تایید تامین کننده</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/factor/status/6">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-users font-size-28"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $status_6 }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">در حال تولید</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/factor/status/7">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-sticky-note font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $status_7 }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">در انتظار ارسال</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/factor/status/8">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-center p-20">
                                    <i class="fa fa-sticky-note font-size-40"></i>
                                </div>
                                <div class="p-l-20">
                                    <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                        {{ $status_7 }}
                                    </h2>
                                    <p class="m-0 font-size-13 text-primary">تحویل داده شده توسط تامین کننده</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">مجموع فاکتور های صادر شده اخیر</h6>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center m-b-20">
                                        <div
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-warning text-warning">
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
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-warning  text-warning">
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
            @if(in_array($access, [2]))
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
                    <div class="col-xl-4">
                        <a href="/factor/status/4">
                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-center p-20">
                                        <i class="fa fa-user font-size-40"></i>
                                    </div>
                                    <div class="p-l-20">
                                        <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                            {{ $status_4 }}
                                        </h2>
                                        <p class="m-0 font-size-13 text-primary">در انتظار تایید</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/factor/status/6">
                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-center p-20">
                                        <i class="fa fa-users font-size-28"></i>
                                    </div>
                                    <div class="p-l-20">
                                        <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                            {{ $status_6 }}
                                        </h2>
                                        <p class="m-0 font-size-13 text-primary">در حال تولید</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/factor/status/7">
                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-center p-20">
                                        <i class="fa fa-sticky-note font-size-40"></i>
                                    </div>
                                    <div class="p-l-20">
                                        <h2 class="mb-2 font-weight-bold primary-font line-height-32">
                                            {{ $status_7 }}
                                        </h2>
                                        <p class="m-0 font-size-13 text-primary">در انتظار ارسال</p>
                                    </div>
                                </div>
                            </div>
                        </a>
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
        </div>
    </main>
@endsection
