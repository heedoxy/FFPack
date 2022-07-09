@php
    $menu_active = 1;
    $sub_active = 1;
@endphp

@extends('layouts.master')

@section('title', 'داشبورد')

@section('main')
    <main class="main-content">
        <div class="row">
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
                                        <h4 class="m-b-0 primary-font line-height-28">1,958,104 تومان</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center m-b-20">
                                    <div class="icon-block m-r-15 icon-block-lg icon-block-outline-danger  text-danger">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-size-13 primary-font">7 روز اخیر</h6>
                                        <h4 class="m-b-0 primary-font line-height-28">234,769 تومان</h4>
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
                                        <h4 class="m-b-0 primary-font line-height-28">1,608,469 تومان</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-center p-20">
                            <i class="fa fa-user font-size-40"></i>
                        </div>
                        <div class="p-l-20">
                            <h2 class="mb-2 font-weight-bold primary-font line-height-32">2.5K</h2>
                            <p class="m-0 font-size-13 text-warning">کاربران</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger text-center p-20">
                            <i class="fa fa-users font-size-28"></i>
                        </div>
                        <div class="p-l-20">
                            <h2 class="mb-2 font-weight-bold primary-font line-height-32">2.5K</h2>
                            <p class="m-0 font-size-13 text-danger">تولید کنندگان</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-center p-20">
                            <i class="fa fa-sticky-note font-size-40"></i>
                        </div>
                        <div class="p-l-20">
                            <h2 class="mb-2 font-weight-bold primary-font line-height-32">5.8K</h2>
                            <p class="m-0 font-size-13 text-primary">فاکتور های ثبت شده</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
