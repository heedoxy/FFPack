@php
    $menu_active = 1;
    $sub_active = 2;
    $edit = isset($id);
    $action = "/factor/" . ($edit ? "edit" : "add");
    $factor = false;
    $total = 0;
@endphp

@extends('layouts.master')

@section('title', 'مدیریت فاکتور')

@section('main')
    <main class="main-content">
        @if($errors->any())
            @foreach($errors->all() as $message)
                <p class="text-left text-danger">{{ $message }}</p>
            @endforeach
        @endif

        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            صدور فاکتور
                            <ul class="list-inline">
                                <li class="list-inline-item mb-0">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-light btn-uppercase" style="margin-left: -10px">
                                            پیام ها
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item mb-0 ml-1">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-success" style="margin-left: -10px; color: white"
                                           data-toggle="modal" data-target="#addModal">
                                            افزودن کالا
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body pt-2">
                            <ul class="list-group list-group-flush">
                                @foreach ($details as $detail)
                                    <li class="list-group-item d-flex align-items-center p-l-r-0">
                                        <figure class="avatar avatar-sm m-r-15">
                                    <span class="avatar-title bg-light rounded-circle">
                                        <i class="fa fa-chevron-left"></i>
                                    </span>
                                        </figure>
                                        <div>
                                            <h6 class="m-b-0 primary-font">{{ $detail->name }}</h6>
                                            <small class="text-muted">
                                                {{ $detail->number }} عدد
                                                |
                                                {{ number_format($detail->price) }} تومان
                                            </small>
                                            @php($total += $detail->price)
                                        </div>
                                        <span class="badge badge-danger ml-auto">حذف</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="row mt-3">
                                <div class="col-7 col-md-6">
                                    <div class="d-flex align-items-center m-b-20">
                                        <div
                                            class="icon-block m-r-15 icon-block-lg icon-block-outline-warning text-warning">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-size-13 primary-font">قیمت کل</h6>
                                            <h4 class="m-b-0 primary-font line-height-28">{{ number_format($total) }}
                                                تومان </h4>
                                        </div>
                                    </div>
                                </div>
                                @if($details->isNotEmpty())
                                    <div class="col-5 col-md-6 text-right mt-4">
                                        <button class="btn btn-primary" type="button"
                                                data-toggle="modal" data-target="#submitModal">
                                    <span class="spinner-border spinner-border-sm mr-2" role="status"
                                          aria-hidden="true"></span>
                                            ثبت فاکتور
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-light">ثبت فاکتور</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">یادداشت :</label>
                                <textarea class="form-control"
                                          id="message-text">{{ $edit ? $detail->comment : "" }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="button" class="btn btn-success">ثبت نهایی</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-light">افزودن کالا</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                            <i class="ti-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">محصول :</label>
                                <select class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">قیمت :</label>
                                <input type="text" class="form-control" id="recipient-name">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">تعداد :</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="button" class="btn btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
