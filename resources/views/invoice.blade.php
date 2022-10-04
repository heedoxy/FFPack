@php
    $access = \Illuminate\Support\Facades\Auth::user()->access;
    $menu_active = 1;
    $sub_active = 3;
    $counter = 1;
    $factorBTN = false;
    $total = 0;
@endphp

@extends('layouts.master')

@section('title', 'لیست فاکتور ها')

@section('main')
    <main class="main-content">

        <div class="card">
            <div class="card-body p-50">
                <div class="invoice">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <h2 class="d-flex align-items-center">
                            <img class="m-r-20" src="/assets/image/logo.png" alt="image" style="width: 10%">
                        </h2>
                        <h3 class="text-xs-left m-b-0">
                            صورتحساب #
                            {{ $factor->code }}
                        </h3>
                    </div>
                    <hr class="m-t-b-50">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <b>صورتحساب به</b>
                            </p>
                            <p>
                                آقای / خانم
                                {{ $factor->name . " " . $factor->family }}
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table m-t-b-50">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>توضیحات</th>
                                <th class="text-right">مقدار</th>
                                <th class="text-right">واحد</th>
                                <th class="text-right">قیمت</th>
                                <th class="text-right">جمع</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                            <tr class="text-right">
                                <td class="text-left">{{ $counter++ }}</td>
                                <td class="text-left">{{ $detail->name }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td>{{ $detail->utitle }}</td>
                                <td>
                                    {{ number_format($detail->price) }}
                                    تومان
                                </td>
                                <td>
                                    @php($total += $detail->amount * $detail->price)
                                    {{ number_format($detail->amount * $detail->price) }}
                                    تومان
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <h4 class="primary-font">
                            جمع :
                            {{ number_format($total) }}
                            تومان
                        </h4>
                    </div>
                    <p class="text-center small text-muted  m-t-50">
						<span class="row">
							<span class="col-md-6 offset-md-3">
                                از اعتماد شما سپاس گذاریم .
                            </span>
						</span>
                    </p>
                </div>
                <div class="text-right d-print-none">
                    <hr class="m-t-b-50">
                    <a href="/factor/message/{{ $factor->id }}" class="btn btn-danger text-light mr-2">
                        <i class="fa fa-envelope m-r-5"></i>پیام ها
                    </a>
                    <a href="/factor/pdf/{{ $factor->id }}" download class="btn btn-primary text-light my-1">
                        <i class="fa fa-file-pdf-o m-r-5"></i>PDF
                    </a>
                    <a href="javascript:window.print()" class="btn btn-success text-light m-l-5 my-1">
                        <i class="fa fa-print m-r-5"></i> چاپ
                    </a>
                </div>
            </div>
        </div>

    </main>
@endsection
