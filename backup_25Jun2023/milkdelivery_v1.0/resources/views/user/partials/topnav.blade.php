<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <p> {{Auth::user()->full_name}} <br />
                ({{Auth::user()->role->name}})
            </p>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <p> {{Auth::user()->full_name}} <br />
                ({{Auth::user()->role->name}})
            </p>
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{-- <li>
                    <a href="https://{{$settings->shopify_site_url}}" target="_blank"><i class="fa fa-globe"></i> Visit
                Website
                </a></li> --}}
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{{ asset('public/images/admin.png')}}" class="user-image"
                        alt="User Image"> --}}
                        <span class="hidden-xs">{{Auth::user()->full_name}}
                            ({{Auth::user()->role->name}})

                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            {{-- <img src="{{ asset('public/images/admin.png')}}" class="img-circle"
                            alt="User Image"> --}}
                            <p> {{Auth::user()->full_name}}
                                ({{Auth::user()->role->name}})
                            </p>
                        </li>
                        <li class="user-footer">
                            {{-- <div class="pull-left">
                                <a href="{{route('admin.password.change')}}" class="btn btn-default btn-flat">Change
                            Password</a>
        </div> --}}
        <div class="pull-right">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-default btn-flat">Sign out</a>
        </div>
        </li>
        </ul>
        </li>
        </ul>
        </div>
    </nav>
</header>
{{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>--}}