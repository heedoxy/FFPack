@php
    $menu_active = 1;
    $sub_active = 4;
    $edit = isset($id);
    $action = "/product/" . ($edit ? "edit" : "add");
@endphp

@extends('layouts.master')

@section('title', 'مدیریت محصول')

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
                    <div class="card-body">
                        <h6 class="card-title text-primary">{{ $edit ? "ویرایش محصول" : "ثبت محصول" }}</h6>
                        <form method="post" action="{{ $action }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $edit ? $id : 0 }}">
                            <small class="form-text text-danger">
                                ابتدا تولید کننده های مرتبط را ثبت کنید !
                            </small>
                            <div class="form-group">
                                <label for="name">نام محصول</label>
                                <input type="text" class="form-control text-left" name="name" id="name"
                                       value="{{ $edit ? $product->name : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="barcode">کد محصول</label>
                                <input type="text" class="form-control text-left" name="barcode" id="barcode"
                                       value="{{ $edit ? $product->barcode : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">قیمت محصول</label>
                                <input type="text" class="form-control text-left" name="price" id="price"
                                       value="{{ $edit ? $product->price : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="producer">تولید کننده ها</label>
                                <select class="js-example-basic-single" name="producer[]" id="producer" multiple required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($producers as $producer)
                                        <option value="{{ $producer->id }}" {{ $producer->selected ? 'selected' : ''  }}>
                                            {{ $producer->name . ' ' . $producer->family }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <textarea class="form-control text-left" name="description" id="description"
                                >{{ $edit ? $product->description : '' }}</textarea>
                                <small class="form-text text-warning">
                                    توضیحات محصول اختیاری میباشد !
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
