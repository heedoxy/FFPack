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
                        <div class="ml-auto d-flex">
                            <button type="button" class="mx-2 btn btn-sm btn-primary btn-floating" id="down">
                                <i class="fa fa-arrow-circle-down"></i>
                            </button>
                            <button type="button" class="ml-2 btn btn-sm btn-danger btn-floating" id="refresh">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="chat-body-messages">
                        <div class="message-items">
                            @foreach ($messages as $message)

                                @php
                                    $me = false;
                                    $user_access = \Illuminate\Support\Facades\Auth::user()->access;
                                    $user_id = \Illuminate\Support\Facades\Auth::id();
                                    if ($user_access != 1 && $user_id == $message->user) $me = true;
                                    elseif ($user_access == 1 && $message->user == 0) $me = true;
                                    elseif ($user_access == 0 && $message->user == 0) $me = true;
                                @endphp

                                @if($message->file)
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
                                @else
                                    <div class="message-item {{ $me ? ' text-left' : 'outgoing-message  text-right' }}">
                                        {{ $message->content }}
                                        <small class="message-item-date text-muted">
                                            {{ (new \Hekmatinasser\Verta\Verta($message->created_at))->format('Y-n-j') }}
                                        </small>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="chat-body-footer">
                        <form method="post" action="/factor/message/text" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="factor" value="{{ $factor }}">
                            <input type="text" name="text" class="form-control" placeholder="پیام ...">
                            <div class="d-flex">
                                <button type="submit" class="ml-3 btn btn-primary btn-floating">
                                    <i class="fa fa-send"></i>
                                </button>
                                <div class="dropup">
                                    <button type="button" data-toggle="dropdown"
                                            class="ml-3 btn btn-success btn-floating">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>

        let elem = document.querySelector(".chat-body-messages");

        $(document).ready(function () {
            elem.scrollTop = elem.scrollHeight;
        });

        $("#down").click(function () {
            elem.scrollTop = elem.scrollHeight;
        });

        $("#refresh").click(function () {
            location.reload();
        });

    </script>

@endsection
