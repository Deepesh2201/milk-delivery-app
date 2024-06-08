<style>
/*#sidebar-menu > ul > li > a:hover, #sidebar-menu > ul > li > a:focus, #sidebar-menu > ul > li > a:active {
    color: #383838 !important;
    text-decoration: none;
}
.submenu li a {
    color: #fff !important;    
}
.submenu li a:hover {
    background-color: #626ed3 !important;
    color: rgba(255, 255, 255, 0.8) !important;
}
.submenu li.mm-active > a {
    color: #b4c9de !important;
    background-color: #626ed3 !important;
}
#sidebar-menu > ul li .mm-active:hover {
    background-color: #ececf1  !important;
}
.submenu .submenu {
    background-color: #e4e4e4 !important;
}
.submenu li.mm-active > a {
    color: #b4c9de !important;
    background-color: #626ed4  !important;
}
.text-muted{
    color:#2f2f2f !important;
}
.form-control.is-invalid, .was-validated .form-control:invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + .75rem);
    background-image: none;
    background-repeat: no-repeat;
    background-position: center right calc(.375em + .1875rem);
    background-size: calc(.75em + .375rem) calc(.75em + .375rem);
}*/
.submenu li a {
    color: black !important;
}
</style>

   <!-- Top Bar Start -->
   <div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="{{ URL::to('/').'/home' }}" class="logo">
        <span>
            <img src="{{ URL::asset('public/admin/images/milkDelivery.png') }}" alt="" height="65" width="150">
        </span>
        <i>
            <img src="{{ URL::asset('public/admin/images/milkDelivery_small.png') }}" alt="" height="30">
        </i>
    </a>
</div>

<nav class="navbar-custom">
    <ul class="navbar-right d-flex list-inline float-right mb-0">
        <!-- <li class="dropdown notification-list d-none d-md-block">
            <form role="search" class="app-search">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" placeholder="Search..">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li> -->

        <!-- language-->
        <!-- <li class="dropdown notification-list d-none d-md-block">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ URL::asset('public/admin/images/flags/us_flag.jpg') }}" class="mr-2" height="12" alt=""/> English <span class="mdi mdi-chevron-down"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right language-switch">
                <a class="dropdown-item" href="#"><img src="{{ URL::asset('public/admin/images/flags/germany_flag.jpg') }}" alt="" height="16" /><span> German </span></a>
                <a class="dropdown-item" href="#"><img src="{{ URL::asset('public/admin/images/flags/italy_flag.jpg') }}" alt="" height="16" /><span> Italian </span></a>
                <a class="dropdown-item" href="#"><img src="{{ URL::asset('public/admin/images/flags/french_flag.jpg') }}" alt="" height="16" /><span> French </span></a>
                <a class="dropdown-item" href="#"><img src="{{ URL::asset('public/admin/images/flags/spain_flag.jpg') }}" alt="" height="16" /><span> Spanish </span></a>
                <a class="dropdown-item" href="#"><img src="{{ URL::asset('public/admin/images/flags/russia_flag.jpg') }}" alt="" height="16" /><span> Russian </span></a>
            </div>
        </li> -->

        <!-- full screen -->
        <li class="dropdown notification-list d-none d-md-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-fullscreen noti-icon"></i>
            </a>
        </li>

        <!-- notification -->
        <li class="dropdown notification-list">
            {{-- <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-bell-outline noti-icon"></i>
                <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
            </a> --}}
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                <!-- item-->
                <h6 class="dropdown-item-text">
                        Notifications (258)
                    </h6>
                <div class="slimscroll notification-item-list">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                    </a>
                </div>
                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
            </div>
        </li>
        @php $user = Auth()->user(); @endphp
        <li class="dropdown notification-list">
            <div class="dropdown notification-list nav-pro-img">
                {{--<!-- <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ @fopen(\Url('assets/profileimages/').'/'.$item->profile_image, 'r') ? \Url('assets/profileimages/').'/'.$item->profile_image : asset('public/nobody_user.jpg') }}" alt="user" class="rounded-circle">
                </a> -->--}}
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Profile</a>
                    {{-- <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="collapsible-header waves-effect arrow-r">
               <i class="mdi mdi-power"></i>Logout</a>

               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
        <!-- <li class="d-none d-sm-block">
            <div class="dropdown pt-3 d-inline-block">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Create
                    </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
        </li> -->
    </ul>

</nav>

</div>
<!-- Top Bar End -->
