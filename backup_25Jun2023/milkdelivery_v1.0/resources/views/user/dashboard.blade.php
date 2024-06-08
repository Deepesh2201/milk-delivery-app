@php
use App\Models\User;
use App\Models\Product;
@endphp
@extends('admin.layouts.master')
@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/public/admin/plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Dashboard
            </h4>
        </div>
    </div>
</div>
<div style="padding-top:17px;">
    @include('admin.partials.messages')
</div>
<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat bg-primary text-white sales-man">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">@lang('l.users')</h5>
                    @php $users = User::where('role_id', config('constants.userTypes.salesman'))->count(); @endphp
                    <h4 class="font-500"> {{ $users }} </h4>
                </div>
                <a href="{{ route('salesman.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>           
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat text-white suppl---iers">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Product</h5>
                    @php $product = Product::where('status', '0')->count(); @endphp
                    <h4 class="font-500"> {{ $product }} </h4>
                </div>
                <a href="{{ route('product.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>            
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat text-white divi---sii--oonn">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">@lang("l.customers")</h5>
                    @php $customer = User::where('role_id', config('constants.userTypes.customer'))->count(); @endphp
                    <h4 class="font-500"> {{ $customer }} </h4>
                </div>
                <a href="{{ route('customer.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>            
        </div>
    </div>
  </div>
<!-- end row -->

<!-- end row -->
@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('assets/public/admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('assets/public/admin/plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('assets/public/admin/plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/public/admin/pages/dashboard.js') }}"></script>
@endsection