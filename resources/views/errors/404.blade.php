@php
    $factorBTN = false;
@endphp

@extends('layouts.master')

@section('title', 'پیدا نشد !')

@section('main')
    <main class="main-content">
        <div class="error-page">
            <div class="text-center">
                <div class="row mb-5">
                    <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                        <img src="/assets/image/404.png" class="img-fluid" alt="image" style="width: 80%">
                    </div>
                </div>
                <h1 class="mb-3 font-weight-bold">این صفحه یافت نشد :(</h1>
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <a href="/" class="btn btn-outline-behance">بازگشت به خانه</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
