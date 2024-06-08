@extends('admin.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.members') }}</h4> -->
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                 
        <a href="{{ route('project.create')}}">
                <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                    <i class="fas fa-plus"></i> @lang('l.add') @lang('l.project')
                </button>
            </a>
                 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title m-b-30">{{ __('l.project') }} {{ __('l.list') }}</h4>
                @include('admin.partials.messages')
                <div class="table-responsive table-full-width">
                    <div style="overflow: auto;">
                        <!-- <form action="{{ route('project.search')}}" method="GET">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="col-md-5" style="float:left;">
                                        <div class="form-group">
                                            <input type="text" name="name" maxlength="250" class="form-control" placeholder="Enter Name or Email or Mobile"
                                                @if(isset($name)) value="{{ $name }}" @endif autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" style="float:left;">
                                        <div class="form-group">
                                            <button
                                                class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light"
                                                type="submit"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </form> -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('l.#')</th>
                                    <th>@lang('l.project_code')</th>
                                    <th>@lang('l.name')</th>
                                    <th>@lang('l.project_manager')</th>
                                    <th>@lang('l.skills')</th>
                                    <th>@lang('l.start_date')</th>
                                    <th>@lang('l.end_date')</th>
                                    <th>@lang('l.description')</th>
                                    <th>@lang('l.status')</th> 
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @include('admin.modules.projects.tbody')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if(count($items) > 0)
    @section('script')
    @include('lazyloading.loading')
    @endsection
@endif
