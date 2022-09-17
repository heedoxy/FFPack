@php
    $menu_active = 1;
    $sub_active = 80;
    $factorBTN = false;
    $user = $user ?? 0;
    $factor = $factor ?? 0;
    $detail = $detail ?? 0;
    $access = \Illuminate\Support\Facades\Auth::user()->access;
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
                            <h6 class="mb-1 primary-font line-height-18">
                                @if($access == 2)
                                    چت پشتیبانی
                                @else
                                    {{ $user->name . " " . $user->family }}
                                @endif
                            </h6>
                        </div>
                        <div class="ml-auto d-flex">
                            <button type="button" class="mx-2 btn btn-sm btn-primary btn-floating" id="down">
                                <i class="fa fa-arrow-circle-down"></i>
                            </button>
                            <button type="button" class="ml-2 btn btn-sm btn-danger btn-floating refresh">
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

                                    if ($user_access == 3 && $message->sender == $user_id) $me = true;
                                    elseif ($user_access == 2 && $message->sender == $user_id) $me = true;
                                    elseif ($user_access == 1 && $message->sender == 0) $me = true;
                                    elseif ($user_access == 0 && $message->sender == 0) $me = true;

                                @endphp

                                @if($message->file)
                                    <div
                                        class="message-item message-item-media {{ $me ? ' text-left' : 'outgoing-message  text-right' }}">
                                        <div class="m-b-0 text-muted text-left">
                                            <a href="/uploads/{{ $message->content }}" download
                                               class="btn btn-outline-light text-left align-items-center justify-content-center">
                                                <i class="fa fa-download font-size-18 m-r-10"></i>
                                                <div class="small">
                                                    <div class="mb-2">{{ explode(' ', $message->content)[3] }}</div>
                                                </div>
                                            </a>
                                        </div>
                                        <small class="message-item-date text-muted">22.30</small>
                                    </div>
                                @else
                                    <div class="message-item {{ $me ? ' text-left' : 'outgoing-message  text-right' }}">
                                        {{ $message->content }}
                                        <small class="message-item-date text-muted" style="white-space: nowrap;">
                                            {{ (new \Hekmatinasser\Verta\Verta($message->created_at))->format('Y-n-j') }}
                                            &nbsp;
                                            {{ (new \Hekmatinasser\Verta\Verta($message->created_at))->format('H:i') }}
                                        </small>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="chat-body-footer">
                        <form method="post" action="/factor/message/text" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="user" value="{{ $user->id }}">
                            <input type="hidden" name="factor" value="{{ $factor }}">
                            <input type="hidden" name="detail" value="{{ $detail }}">
                            <input type="text" name="text" class="form-control" autocomplete="off"
                                   placeholder="پیام ...">
                            <div class="d-flex">
                                <button type="submit" class="ml-3 btn btn-primary btn-floating">
                                    <i class="fa fa-send"></i>
                                </button>
                                <div class="dropup">
                                    <button type="button"
                                            class="ml-3 btn btn-success btn-floating"
                                            data-toggle="modal" data-target="#fileModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <input type="hidden" name="factor" value="{{ $factor }}">
                                <div class="modal-header">
                                    <h5 class="modal-title text-light">ارسال فایل</h5>
                                    <button type="button" class="close refresh" data-dismiss="modal" aria-label="بستن">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/factor/message/file" enctype="multipart/form-data"
                                          class="dropzone" id="dropzone">
                                        @csrf
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        <input type="hidden" name="factor" value="{{ $factor }}">
                                        <input type="hidden" name="detail" value="{{ $detail }}">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary refresh" data-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" class="btn btn-primary refresh">ثبت</button>
                                </div>
                            </div>
                        </div>
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

        $(".refresh").click(function () {
            location.reload();
        });

    </script>

    <!-- Dropzone -->
    <script src="/assets/vendors/dropzone/dropzone.js"></script>
    <script src="/assets/js/examples/dropzone.js"></script>

@endsection
