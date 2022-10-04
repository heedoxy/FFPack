@php
    $access = \Illuminate\Support\Facades\Auth::user()->access;
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
                                    <th class="text-left" scope="col">کد</th>
                                    <th class="text-center" scope="col">قیمت (تومان)</th>
                                    @if(in_array($access, [0, 1]))
                                        <th class="text-center" scope="col">کاربر</th>
                                    @endif
                                    <th class="text-center" scope="col">تاریخ ثبت</th>
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($factors as $factor)
                                    <tr>
                                        <th scope="row">{{ $counter++ }}</th>
                                        <td class="text-left">
                                            <a href="/factor/show/{{ $factor->id }}">
                                                {{ $factor->code }}
                                                <br>
                                                <small class="form-text text-{{ $statuses[$factor->status - 1]->label }}">
                                                    {{ $statuses[$factor->status - 1]->text }}
                                                </small>
                                            </a>
                                        </td>
                                        <td class="text-center">{{ number_format($factor->price) }}</td>
                                        @if(in_array($access, [0, 1]))
                                            <td class="text-center">{{ $factor->name . " " . $factor->family }}</td>
                                        @endif
                                        <td class="text-center">
                                            {{ (new \Hekmatinasser\Verta\Verta($factor->created_at))->format('Y-n-j') }}
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if(in_array($access, [0, 1]))
                                                    <a href="/factor/show/{{ $factor->id }}" class="dropdown-item"
                                                       type="button">ویرایش</a>
                                                    <a href="/factor/invoice/{{ $factor->id }}" class="dropdown-item"
                                                       type="button">صورتحساب</a>
                                                    <a href="/message/{{ $factor->user }}" class="dropdown-item"
                                                       type="button">پیام مشتری</a>
                                                    <button type="button" class="dropdown-item text-danger"
                                                            data-toggle="modal"
                                                            data-target=".bd-example-modal-sm">حذف
                                                    </button>
                                                    @else
                                                        <a href="/factor/show/{{ $factor->id }}" class="dropdown-item"
                                                           type="button">مشاهده</a>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-light">اخطار</h6>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="بستن">
                                                                <i class="ti-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            آیا مورد حذف شود ؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                  action="/factor/remove/{{ $factor->id }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">بستن
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-primary text-light">حذف
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
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
