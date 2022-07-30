@php
    $access = \Illuminate\Support\Facades\Auth::user()->access;
   $menu_active = 1;
   $sub_active = 8;
   $counter = 1;
@endphp

@extends('layouts.master')

@section('title', 'لیست موارد')

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
                                    <th class="text-right" scope="col">محصول</th>
                                    @if(in_array($access, [0, 1]))
                                        <th class="text-right" scope="col">فاکتور</th>
                                    @endif
                                    <th class="text-center" scope="col">قیمت (تومان)</th>
                                    @if(in_array($access, [0, 1]))
                                        <th class="text-center" scope="col">تولید کننده</th>
                                        <th class="text-center" scope="col">کاربر</th>
                                    @endif
                                    <th class="text-center" scope="col">وضعیت</th>
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <th scope="row">{{ $counter++ }}</th>
                                        <td class="text-right">{{ $detail->pname }}</td>
                                        @if(in_array($access, [0, 1]))
                                            <td class="text-right">{{ $detail->code }}</td>
                                        @endif
                                        <td class="text-center">{{ number_format($detail->price) }}</td>
                                        @if(in_array($access, [0, 1]))
                                            <td class="text-center">{{ $detail->prname . " " . $detail->prfamily }}</td>
                                            <td class="text-center">{{ $detail->name . " " . $detail->family }}</td>
                                        @endif
                                        <td class="text-center">ثبت شده</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if(in_array($access, [0, 1]))
                                                        <a href="/factor/show/{{ $detail->fid }}" class="dropdown-item"
                                                           type="button">ویرایش فاکتور</a>
                                                        <a href="/factor/invoice/{{ $detail->fid }}"
                                                           class="dropdown-item"
                                                           type="button">مشاهده صورتحساب</a>
                                                    @endif
                                                    <a href="/factor/message/{{ $detail->fid }}/{{ $detail->id }}" class="dropdown-item"
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
