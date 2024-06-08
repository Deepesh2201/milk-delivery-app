@extends('admin.layouts.master')
@section('css')
<style>
    .required {
        color: red;
    }

    .pad_right {
        padding-right: 0px !important;
    }

    .padd_rl {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    @media screen and (max-width: 992px) and (min-width: 768px) {
        .padd_rl {
            font-size: 11px !important;
        }
    }

    @media(max-width:767px) {
        .pad_right {
            padding-right: 15px !important;
        }
    }
</style>

<link href="{{ URL::asset('public/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>           
        </div>
         
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href=" {{ url()->previous() }} ">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="fas fa-arrow-left"></i> @lang('l.back')
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
                <h4 class="mb-0 mt-0 header-title"> @if($item){{ __('l.edit') }} @else @lang('l.add') @endif @lang('l.project') </h4>
                <small class="form-text text-muted mt-0" style="color: #9ca8b3 !important;  font-size: 15px;">@if(!$item) (New @lang('l.project'))@endif</small>
                @include('admin.partials.messages')
                <form action="{{route('project.store')}}" method="POST" id="upload_form" autocomplete="off" enctype="multipart/form-data" >
                    @if($item)
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    @endif

                    <div class="p-20">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.project') @lang('l.name')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->project_name : old('project_name')}}" type="text"
                                        name="project_name" maxlength="250" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.name')*">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.skills')</label>
                                    <input value="{{$item ? $item->required_skills : old('skills')}}" type="text"
                                        name="skills" maxlength="255" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.skills')*">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.project_manager')</label><span class="required">*</span>
                                     <select name="manager" id="manager" class="form-control">
                                        <option value="">Select @lang('l.project_manager')</option>
                                        @foreach($managers as $val)
                                        <option value="{{ $val->id }}" @if( isset($item->project_manager) && $val->id == $item->project_manager) selected @endif >{{ $val->emp_id .' '.$val->first_name.' '.$val->last_name }}</option>
                                        @endforeach
                                     </select>                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.start_date')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->start_date : old('start_date')}}" type="date"
                                        name="start_date" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="Date of Join*">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.end_date')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->end_date : old('end_date')}}" type="date"
                                        name="end_date" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="Date of Join*">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.description')</label>
                                    <input value="{{$item ? $item->description : old('description')}}" type="text"
                                        name="description" maxlength="255" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.description')">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>                                                
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">@lang('l.save')</button>
                                <a href="{{ route('project.index') }}">
                                    <button type="button"
                                        class="btn btn-secondary waves-effect m-l-5">@lang('l.cancel')</button>
                                </a>
                                <div id="ajaxloader" style="display: none;"><img
                                        src="{{ asset('public/admin/images/ajax-loader.gif')}}" /> Processing...</div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>

    @endsection
    @push('appendJs')
    <script src="{{ URL::asset('public/admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>    
    <script src="{{ URL::asset('public/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#manager').select2();
            $('#country_code').select2();
            $('#year').select2();
            $('#grade').select2();
        });
    </script>
    @endpush