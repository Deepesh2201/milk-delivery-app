<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu fixed">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                    @php $user = Auth::user(); @endphp
                    <li class="menu-title" style="text-align:left;">
                        <a href="#" style="font-size:12px;text-align:left;"><i class="fa fa-circle text-success"></i>{{ $user->name ?? ''}}</a>
                    </li>
                    <li><a  href="{{ route('dashboard') }}" class="waves-effect"><i class="ti-home"></i> <span>Dashboard</span></a></li>                    
                    <li class=""><a href="{{ route('salesman.index') }}" class="waves-effect {{ Request::is('admin/salesman/*') ? 'mm-active': '' }}"><i class="fa fa-users"></i> <span>Salesmans</span></a></li>
                   
                    {{--<!-- <li>
                        <a href="javascript: void(0);" class="waves-effect" >                            
                         <i class="fas fa-clock" aria-hidden="true"></i> <span> Manage Sales  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        </a>
                        <ul class="submenu" aria-expanded="false">
                            <li class="#"><a href="{{ route('sale.index') }}" class="waves-effect {{ Request::is('admin/sale/*') ? 'mm-active': '' }}"><i class="fas fa-shopping-bag"></i> <span>Sales</span></a></li>
                            <li class="#"><a href="{{ route('return-product.index') }}" class="waves-effect {{ Request::is('admin/return-product/*') ? 'mm-active': '' }}"><i class="fas fa-money-check"></i> <span>Return</span></a></li>
                        </ul>   
                    </li> -->--}}
                    <li>
                        <a href="javascript: void(0);" class="waves-effect" >                            
                         <i class="fas fa-truck" aria-hidden="true"></i> <span> Manage Loading  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        </a>
                        <ul class="submenu" aria-expanded="false">
                            <li class="#"><a href="{{ route('onloading.index') }}" class="waves-effect {{ Request::is('admin/onloading/*') ? 'mm-active': '' }}"><i class="fas fa-truck-loading"  aria-hidden="true"></i> <span>Onloadings</span></a></li>
                            <!-- <li class="#"><a href="{{ route('offloading.index') }}" class="waves-effect {{ Request::is('admin/offloading/*') ? 'mm-active': '' }}"><i class="fas fa-truck-unloading"  aria-hidden="true"></i> <span>Offloadings</span></a></li> -->
                        </ul>   
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect" >                            
                            <i class="ti-book"></i> <span> Masters <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        </a>
                        <ul class="submenu" aria-expanded="false">
                            <li class="#"><a href="{{ route('product.index') }}" class="waves-effect {{ Request::is('admin/product/*') ? 'mm-active': '' }}"><i class="fa fa-product-hunt"></i> @lang('l.products')</a></li>
                            <li class="#"><a href="{{ route('customer.index') }}" class="waves-effect {{ Request::is('admin/customer/*') ? 'mm-active': '' }}"><i class="fa fa-users"></i> Customers</a></li>
                        </ul>   
                    </li>
                    
                    <li>  
                        <a href="javascript: void(0);" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="collapsible-header waves-effect arrow-r">
                        <i class="fas fa-power-off"></i><span> Logout </span></a>
                    </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
