@php
    $page_title = $page_title ?? "فست فود پک";
    $cash = $cash ?? 0;
@endphp

    <!-- begin::header logo -->
<div class="header-logo">
    <a href="/">
        <img class="large-logo" src="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png" alt="image">
        <img class="small-logo" src="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png" alt="image">
        <img class="dark-logo" src="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png" alt="image">
        <p class="d-none d-lg-block d-md-block h4 ml-2">
            {{ Auth::user()->name . " " . Auth::user()->family }}
        </p>
    </a>
</div>
<!-- end::header logo -->

<!-- begin::header body -->
<div class="header-body">

    <div class="header-body-left">

        <h3 class="page-title">{{ $page_title }}</h3>

        <!-- begin::breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <!-- end::breadcrumb -->

    </div>

    <div class="header-body-right">
        <!-- begin::navbar main body -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a target="_blank" href="https://ffpack.com" class="nav-link w-100 p-1">
                    مشاهده سایت
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="profile" class="nav-link bg-none">
                    <div>
                        <figure class="avatar avatar-state-success avatar-sm">
                            <img style=" border-radius: 50%;" src="https://ffpack.com/wp-content/uploads/2019/07/favffpack.png" class="rounded-circle" alt="image">
                        </figure>
                    </div>
                </a>
            </li>
        </ul>
        <!-- end::navbar main body -->

        <div class="d-flex align-items-center">
            <!-- begin::navbar navigation toggler -->
            <div class="d-xl-none d-lg-none d-sm-block navigation-toggler">
                <a href="#">
                    <i class="ti-menu"></i>
                </a>
            </div>
            <!-- end::navbar navigation toggler -->

            <!-- begin::navbar toggler -->
            <div class="d-xl-none d-lg-none d-sm-block navbar-toggler">
                <a href="#">
                    <i class="ti-arrow-down"></i>
                </a>
            </div>
            <!-- end::navbar toggler -->
        </div>
    </div>

</div>
<!-- end::header body -->
