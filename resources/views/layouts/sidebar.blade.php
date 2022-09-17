@php
    $menu_active = $menu_active ?? 1;
    $sub_active = $sub_active ?? 1;
    $access = Auth::user()->access;
@endphp

<style>
    .navigation-icon-menu a {
        text-align: right;
        margin-top: 10px;
        font-size: 12px;
    }
</style>

<div class="navigation-icon-menu">
    <ul>
        <li class="custom-toggle-menu">
            <div href="#">
                <i class="ti-menu"></i>
            </div>
        </li>
        <li data-toggle="tooltip" class="{{ ($menu_active == 1) ? "active" : "" }}">
            <a href="#navigationDashboards">
                <i class="icon ti-pie-chart"></i>
                <span class="badge badge-warning">*</span>
            </a>
        </li>
        <li data-toggle="tooltip">
            <a href="/profile" class="go-to-page" title="پروفایل">
                <i class="icon ti-user"></i>
            </a>
        </li>
        <li data-toggle="tooltip">
            <a href="/logout" class="go-to-page" title="خروج">
                <i class="icon ti-power-off"></i>
            </a>
        </li>
    </ul>
</div>


<div class="navigation-menu-body">
    <ul id="navigationDashboards" class="{{ ($menu_active == 1) ? "navigation-active" : "" }}">
        <li><a href="/" class="{{ ($sub_active == 1) ? "active" : "" }}">داشبورد</a></li>

        @if($access == 0)
            <li><a href="/user/show/1" class="{{ ($sub_active == 6) ? "active" : "" }}">ثبت کارشناس</a></li>
            <li><a href="/user/list/1" class="{{ ($sub_active == 7) ? "active" : "" }}">لیست کارشناسان</a>
            <li><a href="/user/show/2" class="{{ ($sub_active == 11) ? "active" : "" }}">ثبت تامین کننده</a></li>
            <li><a href="/user/list/2" class="{{ ($sub_active == 12) ? "active" : "" }}">لیست تامین کنندگان</a></li>
            <li><a href="/user/show/3" class="{{ ($sub_active == 9) ? "active" : "" }}">ثبت مشتری</a></li>
            <li><a href="/user/list/3" class="{{ ($sub_active == 10) ? "active" : "" }}">لیست مشتریان</a></li>
            <li><a href="/product/show" class="{{ ($sub_active == 4) ? "active" : "" }}">ثبت محصول جدید</a></li>
            <li><a href="/product/list" class="{{ ($sub_active == 5) ? "active" : "" }}">محصولات</a></li>
            <li><a href="/factor/show" class="{{ ($sub_active == 2) ? "active" : "" }}">ثبت فاکتور</a></li>
            <li><a href="/factor/list" class="{{ ($sub_active == 3) ? "active" : "" }}">لیست فاکتور ها</a></li>
            <li><a href="/factor/temp" class="{{ ($sub_active == 30) ? "active" : "" }}">لیست پیش فاکتور ها</a></li>
            <li><a href="/factor/status/0">همه سفارشات</a></li>
            <li><a href="/factor/status/3">انتقال سفارش به تامین کننده</a></li>
        @elseif($access == 1)
            <li><a href="/user/show/3" class="{{ ($sub_active == 9) ? "active" : "" }}">ثبت مشتری</a></li>
            <li><a href="/user/list/3" class="{{ ($sub_active == 10) ? "active" : "" }}">لیست مشتریان</a></li>
            <li><a href="/product/show" class="{{ ($sub_active == 4) ? "active" : "" }}">ثبت محصول جدید</a></li>
            <li><a href="/product/list" class="{{ ($sub_active == 5) ? "active" : "" }}">محصولات</a></li>
            <li><a href="/factor/show" class="{{ ($sub_active == 2) ? "active" : "" }}">ثبت فاکتور</a></li>
            <li><a href="/factor/list" class="{{ ($sub_active == 3) ? "active" : "" }}">لیست فاکتور ها</a></li>
            <li><a href="/factor/temp" class="{{ ($sub_active == 30) ? "active" : "" }}">لیست پیش فاکتور ها</a></li>
            <li><a href="/factor/status/0">همه سفارشات</a></li>
            {{--            <li><a href="/factor/detail/list" class="{{ ($sub_active == 8) ? "active" : "" }}">لیست موارد</a></li>--}}
        @elseif($access == 2)
            @php($user_id = \Illuminate\Support\Facades\Auth::id())
            <li><a href="/message/{{ $user_id }}" class="{{ ($sub_active == 80) ? "active" : "" }}">چت پشتیبانی</a></li>
            <li><a href="/factor/status/4" class="{{ ($sub_active == 80) ? "active" : "" }}">در انتظار تایید</a></li>
            <li><a href="/factor/status/5" class="{{ ($sub_active == 80) ? "active" : "" }}">رد شده</a></li>
            <li><a href="/factor/status/6" class="{{ ($sub_active == 80) ? "active" : "" }}">درحال تولید</a></li>
            <li><a href="/factor/status/7" class="{{ ($sub_active == 80) ? "active" : "" }}">در انتظار ارسال</a></li>
        @elseif($access == 3)
            <li><a href="/factor/list" class="{{ ($sub_active == 3) ? "active" : "" }}">لیست فاکتور</a></li>
        @endif

    </ul>
</div>


