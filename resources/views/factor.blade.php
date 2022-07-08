@php
    $menu_active = 1;
    $sub_active = 2;
    $edit = isset($id);
    $action = "/factor/" . ($edit ? "edit" : "add");
    $factorBTN = false;
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        صدور فاکتور
                        <ul class="list-inline">
                            @if($edit)
                                <li class="list-inline-item mb-0">
                                    <div class="dropdown">
                                        <a href="/factor/message/{{ $id }}" class="btn btn-sm btn-light btn-uppercase" style="margin-left: -10px">
                                            پیام ها
                                        </a>
                                    </div>
                                </li>
                            @endif
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
                                            {{ number_format($detail->number * $detail->price) }} تومان
                                        </small>
                                        @php($total += $detail->number * $detail->price)
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger ml-auto" data-toggle="modal"
                                            data-target="#remove-detail-{{ $detail->id }}">حذف
                                    </button>
                                </li>

                                <div class="modal fade" tabindex="-1" role="dialog"
                                     aria-hidden="true" id="remove-detail-{{ $detail->id }}">
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
                                                <form method="post" action="/factor/detail/remove/{{ $detail->id }}">
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
                    <form method="post" action="{{ $action }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $edit ? $id : 0 }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class="modal-header">
                            <h5 class="modal-title text-light">ثبت فاکتور</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user" class="col-form-label">مشتری :</label>
                                <select class="form-control" name="user" id="user" autocomplete="off" required
                                    {{ $edit ? 'disabled' : '' }}>
                                    <option value="" data-price="" selected>
                                        مشتری مورد نظر را انتخاب فرمایید .
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $edit && $factor->user == $user->id ? 'selected' : '' }}>
                                            {{ $user->name . " " . $user->family }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">یادداشت :</label>
                                <textarea class="form-control" name="comment"
                                          id="message-text">{{ $edit ? $factor->comment : "" }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-success">ثبت نهایی</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="/factor/detail/add">
                        @csrf
                        <input type="hidden" name="factor" value="{{ $edit ? $id : 0 }}">
                        <div class="modal-header">
                            <h5 class="modal-title text-light">افزودن کالا</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product" class="col-form-label">محصول :</label>
                                <select class="form-control" name="product" id="product" autocomplete="off" required>
                                    <option value="" data-price="" selected>
                                        محصول مورد نظر را انتخاب فرمایید .
                                    </option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product-price" class="col-form-label">قیمت :</label>
                                <input type="text" name="price" class="form-control" id="product-price"
                                       autocomplete="off"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="product-number" class="col-form-label">تعداد :</label>
                                <input type="text" name="number" class="form-control" id="product-number"
                                       autocomplete="off"
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script>
        $('#product').change(function (e) {
            $('#product-price').val($('#product').find(":selected").data('price'));
        });
    </script>

@endsection
