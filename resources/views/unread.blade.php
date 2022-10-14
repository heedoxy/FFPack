@php
    $menu_active = 1;
    $access = $access ?? 1;

    if ($access == 3) $sub_active = 10;
    elseif ($access == 2) $sub_active = 12;
    elseif ($access == 1) $sub_active = 7;
    else $sub_active = 0;

    $counter = 1;
@endphp

@extends('layouts.master')

@section('title', 'پیام های جدید')

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
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(! count($users))
                                    <p class="text-secondary text-center">
                                        پیامی وجود ندارد !
                                    </p>
                                @endif
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <a href="/message/{{ $user->id }}">
                                                {{ $user->name . " " . $user->family }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/message/{{ $user->id }}">
                                                <span class="badge badge-danger">پیام خوانده نشده</span>
                                            </a>
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
