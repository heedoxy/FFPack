@php
    $menu_active = 1;
    $sub_active = 3;
    $factorBTN = false;
@endphp

@extends('layouts.master')

@section('title', 'پیام ها')

@section('main')

    <style>
        .message-item {
            font-size: 14px;
        }
    </style>

    <main class="main-content">
        <div class="card chat-app-wrapper">
            <div class="row chat-app">
                <div class="col-xl-12 col-md-12 chat-body">

                    <div class="chat-body-header">
                        <div>
                            <figure class="avatar avatar-sm m-r-10 bg-light text-center">
                                <i class="fa fa-user mt-2"></i>
                            </figure>
                        </div>
                        <div>
                            <h6 class="mb-1 primary-font line-height-18">صورتحساب</h6>
                        </div>
                    </div>

                    <div class="chat-body-messages">
                        <div class="message-items">
                            <div class="message-item">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item message-item-media">
                                <div class="m-b-0 text-muted text-left">
                                    <a href="#"
                                       class="btn btn-outline-light text-left align-items-center justify-content-center">
                                        <i class="fa fa-download font-size-18 m-r-10"></i>
                                        <div class="small">
                                            <div class="mb-2">example test.txt</div>
                                            <div dir="ltr">10 KB</div>
                                        </div>
                                    </a>
                                </div>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message">
                                لورم ایپسوم متن ساختگی با تولید
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                            <div class="message-item outgoing-message message-item-media">
                                <div class="m-b-0 text-muted text-left media-file">
                                    <a href="#"
                                       class="btn btn-outline-light text-left align-items-center justify-content-center">
                                        <i class="fa fa-download font-size-18 m-r-10"></i>
                                        <div class="small">
                                            <div class="mb-2">example file.txt</div>
                                            <div class="font-size-13" dir="ltr">5 KB</div>
                                        </div>
                                    </a>
                                </div>
                                <small class="message-item-date text-muted">22.30</small>
                            </div>
                        </div>
                    </div>

                    <div class="chat-body-footer">
                        <form class="d-flex align-items-center">
                            <input type="text" class="form-control" placeholder="پیام ...">
                            <div class="d-flex">
                                <button type="button" class="ml-3 btn btn-primary btn-floating">
                                    <i class="fa fa-send"></i>
                                </button>
                                <div class="dropup">
                                    <button type="button" data-toggle="dropdown"
                                            class="ml-3 btn btn-success btn-floating">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-menu-body">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="icon fa fa-picture-o"></i> تصویر
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="icon fa fa-video-camera"></i> ویدئو
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
