@php
    $menu_active = 1;
    $sub_active = 3;
    $counter = 1;
@endphp

@extends('layouts.master')

@section('title', 'لیست فاکتور ها')

@section('main')

    <style>
        td {
            font-size: 14px !important;
        }
    </style>

    <main class="main-content">

        @error('danger')
        <p class="text-center text-danger">{{ $message }}</p>
        @enderror

        @error('success')
        <p class="text-center text-success">{{ $message }}</p>
        @enderror

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="text-right" scope="col">کد</th>
                                    <th class="text-center" scope="col">قیمت (تومان)</th>
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($factors as $factor)
                                    <tr>
                                        <th scope="row">{{ $counter++ }}</th>
                                        <td class="text-right">{{ $factor->code }}</td>
                                        <td class="text-center">{{ number_format($factor->price) }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="/factor/message/{{ $factor->id }}" class="dropdown-item"
                                                       type="button">پیام ها</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
