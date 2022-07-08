@php
    $menu_active = 1;
    $sub_active = 3;
@endphp

@extends('layouts.master')

@section('title', 'لیست فاکتور ها')

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
                                    <th scope="col">کد</th>
                                    <th scope="col">قیمت</th>
                                    <th scope="col">کاربر</th>
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($factors as $factor)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $factor->code }}</td>
                                        <td>{{ number_format($factor->price) }}</td>
                                        <td>{{ $factor->name . " " . $factor->family }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="/factor/show/{{ $factor->id }}" class="dropdown-item"
                                                       type="button">ویرایش</a>
                                                    <button type="button" class="dropdown-item text-danger"
                                                            data-toggle="modal"
                                                            data-target=".bd-example-modal-sm">حذف
                                                    </button>
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
                                                            <form method="post" action="/factor/remove/{{ $factor->id }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">بستن
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-primary text-light">حذف</button>
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
