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

                        @if(in_array($access, [0, 1]))
                            <form action="/factor/status/{{ $status }}/">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="input-vv" class="col-form-label mr-2">نمایش
                                                            : </label>
                                                        <div class="col-form-label">
                                                            <select class="form-control text-left" id="input-vv"
                                                                    name="s">
                                                                <option value="0" {{ $status ? '' : 'selected' }}>
                                                                    همه
                                                                </option>
                                                                @foreach($statuses as $ss)
                                                                    <option
                                                                        value="{{ $ss->id }}" {{ $ss->id == $status ? 'selected' : '' }}>
                                                                        {{ $ss->text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="input-ss" class="col-form-label mr-2">بازه زمانی
                                                            : </label>
                                                        <div class="col-form-label">
                                                            <select class="form-control text-left" id="input-ss"
                                                                    name="days">
                                                                <option value="10" {{ $days == 10 ? 'selected' : '' }}>
                                                                    بازه
                                                                    10 روزه
                                                                </option>
                                                                <option value="30" {{ $days == 30 ? 'selected' : '' }}>
                                                                    بازه
                                                                    30 روزه
                                                                </option>
                                                                <option value="60" {{ $days == 60 ? 'selected' : '' }}>
                                                                    بازه
                                                                    60 روزه
                                                                </option>
                                                                <option value="90" {{ $days == 90 ? 'selected' : '' }}>
                                                                    بازه
                                                                    90 روزه
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-row justify-content-end ">
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary mb-2">نمایش</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="text-left" scope="col">محصول</th>
                                    @if(in_array($access, [0, 1]))
                                        <th class="text-center" scope="col">تامین کننده</th>
                                    @endif
                                    <th class="text-left" scope="col">فاکتور</th>
                                    <th class="text-left" scope="col">مقدار</th>
                                    <th class="text-center" scope="col">قیمت واحد (ریال)</th>
                                    @if(in_array($access, [0, 1]))
                                        <th class="text-center" scope="col">مشتری</th>
                                        <th class="text-center" scope="col">وضعیت</th>
                                    @endif
                                    <th class="text-right" scope="col">مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <th scope="row">{{ $counter++ }}</th>
                                        <td class="text-left">

                                            <a href="" data-toggle="modal" data-target="#detailModal{{ $detail->id }}">
                                                {{ $detail->pname }}
                                            </a>

                                            @if($access == 0 && in_array($detail->status, [3]))
                                                <div class="modal fade" id="detailModal{{ $detail->id }}" tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="post" action="/factor/detail/producer" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="detail"
                                                                       value="{{ $detail->id }}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-light">انتقال به تامین
                                                                        کننده</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="بستن">
                                                                        <i class="ti-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="product-file" class="col-form-label">انتخاب فایل :</label>
                                                                        @if($detail->file)
                                                                            <a class="small text-primary" download=""
                                                                               href="/uploads/{{ $detail->file }}">
                                                                                مشاهده
                                                                            </a>
                                                                        @endif
                                                                        <input type="file" name="file" class="form-control text-left" id="product-file"
                                                                               autocomplete="off"
                                                                               required>
                                                                        <a class="small text-danger">
                                                                            تنها در صورت نیاز به تغییر فایل این فیلد تکمیل شود
                                                                        </a>
                                                                    </div>

                                                                    <div class="form-group text-left">
                                                                        <label for="producer" class="col-form-label">تامین
                                                                            کننده :</label>
                                                                        <select class="form-control" name="producer"
                                                                                id="producer" autocomplete="off"
                                                                                required>
                                                                            <option value="" data-price="" selected>
                                                                                تامین کننده مورد نظر را انتخاب فرمایید .
                                                                            </option>
                                                                            @foreach ($producers as $producer)
                                                                                <option
                                                                                    value="{{ $producer->id }}" {{ $detail->producer == $producer->id ? 'selected' : '' }}>
                                                                                    {{ $producer->name. " " . $producer->family }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    @if($detail->comment2)
                                                                        <div class="form-group  text-left">
                                                                            <label for="comment"
                                                                                   class="col-form-label">یادداشت تامین کننده
                                                                                :</label>
                                                                            <textarea class="form-control" name="comment" readonly disabled
                                                                                      id="message-text">{{ $detail->comment2 }}</textarea>
                                                                        </div>
                                                                    @endif

                                                                    <div class="form-group  text-left">
                                                                        <label for="comment"
                                                                               class="col-form-label">یادداشت
                                                                            :</label>
                                                                        <textarea class="form-control" name="comment"
                                                                                  id="message-text">{{ $detail->comment }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">بستن
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        انتقال سفارش
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($access == 2 && in_array($detail->status, [4, 5]))
                                                <div class="modal fade" id="detailModal{{ $detail->id }}" tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="post" action="/factor/detail/status">
                                                                @csrf
                                                                <input type="hidden" name="detail"
                                                                       value="{{ $detail->id }}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-light">
                                                                        اعلام وضعیت
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="بستن">
                                                                        <i class="ti-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    @if($detail->file)
                                                                        <div class="form-group  text-left">
                                                                            <label for="detail_price"
                                                                                   class="col-form-label">فایل پیوست
                                                                                :</label>
                                                                            <a class="btn btn-primary text-light" download=""
                                                                               href="/uploads/{{ $detail->file }}">
                                                                                مشاهده
                                                                            </a>
                                                                        </div>
                                                                    @endif

                                                                    <div class="form-group  text-left">
                                                                        <label for="detail_price"
                                                                               class="col-form-label">قیمت درخواستی
                                                                            :</label>
                                                                        <input type="text" class="form-control text-left" name="price2"
                                                                               value="{{ $detail->price2 ? $detail->price2 : '' }}"
                                                                                  id="detail_price">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="detail_date"
                                                                               class="col-form-label">تاریخ تحویل
                                                                            :</label>
                                                                        <input type="text" class="form-control text-left" name="jalali"
                                                                               value="{{ $detail->end_at ? verta($detail->end_at)->format("Y/m/d") : '' }}"
                                                                               id="detail_date">
                                                                    </div>
                                                                    <div class="form-group  text-left">
                                                                        <label for="comment"
                                                                               class="col-form-label">توضیحات
                                                                            :</label>
                                                                        <textarea class="form-control" name="comment2"
                                                                                  id="message-text">{{ $detail->comment2 }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">بستن
                                                                    </button>
                                                                    <button type="submit" name="status" value="5" class="btn btn-danger">
                                                                        رد سفارش
                                                                    </button>
                                                                    <button type="submit" name="status" value="6" class="btn btn-success">
                                                                        تایید سفارش
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($access == 2 && $detail->status == 6)
                                                <div class="modal fade" id="detailModal{{ $detail->id }}" tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="post" action="/factor/detail/status">
                                                                @csrf
                                                                <input type="hidden" name="detail"
                                                                       value="{{ $detail->id }}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-light">
                                                                        اتمام تولید
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="بستن">
                                                                        <i class="ti-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group  text-left">
                                                                        <label for="detail_price"
                                                                               class="col-form-label">
                                                                            آیا تولید این محصول به پایان رسیده است ؟
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">بستن
                                                                    </button>
                                                                    <button type="submit" name="status" value="7" class="btn btn-success">
                                                                        اتمام تولید
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </td>
                                        @if(in_array($access, [0, 1]))
                                            <td class="text-center">
                                                @if($detail->producer)
                                                    {{ $detail->prname . " " . $detail->prfamily }}
                                                @else
                                                    - - -
                                                @endif
                                            </td>
                                        @endif
                                        <td class="text-left">
                                            {{ $detail->code }}
                                        </td>
                                        <td class="text-center">{{ $detail->amount }}</td>
                                        <td class="text-center">{{ number_format($detail->price) }}</td>

                                        @if(in_array($access, [0, 1]))
                                            <td class="text-center">
                                                {{ $detail->name . " " . $detail->family }}
                                            </td>
                                            <td class="text-center text-{{ $statuses[$detail->status - 1]->label }}">
                                                {{ $statuses[$detail->status - 1]->text }}
                                            </td>
                                        @endif
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-light btn-floating btn-icon btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if($access  == 0)
                                                        <a href="" data-toggle="modal" data-target="#detailModal{{ $detail->id }}"
                                                           type="button" class="dropdown-item">انتقال به تامین کننده</a>
                                                    @endif
                                                    @if(in_array($access, [0, 1]))
                                                        <a href="/factor/show/{{ $detail->fid }}" class="dropdown-item"
                                                           type="button">ویرایش فاکتور</a>
                                                        <a href="/factor/invoice/{{ $detail->fid }}"
                                                           class="dropdown-item"
                                                           type="button">مشاهده صورتحساب</a>
                                                    @endif
                                                    <a href="/factor/message/{{ $detail->fid }}/{{ $detail->id }}"
                                                       class="dropdown-item"
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
