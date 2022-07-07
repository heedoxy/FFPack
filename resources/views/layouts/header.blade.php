@php
    $factor = $factor ?? true;
@endphp

    <!-- begin::navigation -->
<div class="navigation">
    @include('layouts.sidebar')
</div>
<!-- end::navigation -->

<!-- begin::header -->
<div class="header">
    @include('layouts.navbar')
</div>
<!-- end::header -->

<!--loading start-->
<div id="animation-page-loader" style="display: none">
    <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!--loading end-->

<div class="container mt-5" id="alert-onlydesktop" style="display: none">
    <h3 class="alert alert-danger text-center">لطفا با دسکتاپ وارد شوید</h3>
</div>

@if($factor)

    <style>
        #factor {
            width: 50px;
            height: 50px;
            bottom: 10px;
            border-radius: 1000px;
            position: fixed;
            left: 10px;
            background-color: #643E81;
            text-align: center;
            justify-content: center;
            padding-top: 10px;
            cursor: pointer;
            z-index: 1000;
            color: white;
        }
    </style>

    <a href="/factor/show">
        <div id="factor">
            <i class="fa fa-plus-circle"></i>
        </div>
    </a>

@endif
