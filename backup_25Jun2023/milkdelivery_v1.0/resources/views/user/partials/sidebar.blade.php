<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            {{-- <div class="pull-left image">
                <img src="{{ asset('public/images/logo.png')}}" class="img-circle" alt="User Image">
        </div> --}}
        <div class="pull-left info" style="position:initial !important">
            <p>{{Auth::user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </div>

        @if(!canRead(3) || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 1)
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            @if(canRead(1))
            <li class="{{ areActiveRoutes(['roles.index'],'active') }}">
                <a href="{{ route('roles.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>{{privilegeName(1)}}</span>
                </a>
            </li>

            @foreach($header_roles as $rol)
            <li class="{{ areActiveRoutes(['roles.index'],'active') }}">
                <a href="{{ route('members.roles', $role->id) }}">
                    <i class="fa fa-list-alt"></i>
                    <span>{{privilegeName($role->id)}}</span>
                </a>
            </li>
            @endforeach
            @endif

            @if(canRead(2))
            <li class="{{ isActiveRoute('members.index','active') }}">
                <a href="{{ route('members.index') }}">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(2)}}</span>
                </a>
            </li>
            @endif

            @if(canRead(4))
            <li class="">
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(4)}} (Read,
                        {{canWrite(4) ? 'Add, ' : ''}}{{canUpdate(4) ? 'Update, ' : ''}}{{canDelete(4) ? 'Delete' : ''}})</span>
                </a>
            </li>
            @endif

            @if(canRead(5))
            <li class="">
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(5)}} (Read,
                        {{canWrite(5) ? 'Add, ' : ''}}{{canUpdate(5) ? 'Update, ' : ''}}{{canDelete(5) ? 'Delete' : ''}})</span>
                </a>
            </li>
            @endif

            @if(canRead(6))
            <li class="">
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(6)}} (Read,
                        {{canWrite(6) ? 'Add, ' : ''}}{{canUpdate(6) ? 'Update, ' : ''}}{{canDelete(6) ? 'Delete' : ''}})</span>
                </a>
            </li>
            @endif

            @if(canRead(7))
            <li class="">
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(7)}}{{privilegeName(7)}} (Read,
                        {{canWrite(7) ? 'Add, ' : ''}}{{canUpdate(7) ? 'Update, ' : ''}}{{canDelete(7) ? 'Delete' : ''}})</span>
                </a>
            </li>
            @endif

            @if(canRead(8))
            <li class="">
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i>
                    <span>{{privilegeName(8)}} (Read,
                        {{canWrite(8) ? 'Add, ' : ''}}{{canUpdate(8) ? 'Update, ' : ''}}{{canDelete(8) ? 'Delete' : ''}})</span>
                </a>
            </li>
            @endif

        </ul>
        @endif

    </section>
    <!-- /.sidebar -->
</aside>