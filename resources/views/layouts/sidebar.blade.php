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
        @if(in_array($access, [0, 1]))
            <li><a href="/user/show" class="{{ ($sub_active == 2) ? "active" : "" }}">ثبت کاربر</a></li>
            <li><a href="/user/list" class="{{ ($sub_active == 3) ? "active" : "" }}">لیست کاربر</a></li>
            <li><a href="/product/show" class="{{ ($sub_active == 4) ? "active" : "" }}">ثبت کالا</a></li>
            <li><a href="/product/list" class="{{ ($sub_active == 5) ? "active" : "" }}">لیست کالا</a></li>
        @endif
    </ul>
</div>


