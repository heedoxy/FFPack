@php
    $menu_active = 1;
    $sub_active = 3;
@endphp

@extends('layouts.master')

@section('title', 'لیست کاربران')

@section('main')
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
                                    <th scope="col">نام</th>
                                    <th scope="col">دسترسی</th>
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $user->name . " " . $user->family }}</td>
                                        <td>
                                            @if($user->name == 0)
                                                <span class="badge badge-danger">مدیر کل</span>
                                            @elseif($user->name == 1)
                                                <span class="badge badge-success">فروشنده</span>
                                            @elseif($user->name == 2)
                                                <span class="badge badge-warning">تولید کننده</span>
                                            @else
                                                <span class="badge badge-info">مشتری</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="/user/show/{{ $user->id }}" class="dropdown-item" type="button">ویرایش</a>
                                                    <a class="dropdown-item text-danger" type="button">حذف</a>
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
