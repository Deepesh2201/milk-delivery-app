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
            <!-- <h4 class="page-title">@lang('l.users')</h4> -->
        </div>
         
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('user.index')}}">
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
                <h4 class="mb-0 mt-0 header-title"> @if($item){{ __('l.edit') }} @else @lang('l.add') @endif @lang('l.user') </h4>
                <small class="form-text text-muted mt-0" style="color: #9ca8b3 !important;  font-size: 15px;">@if(!$item) (New User)@endif</small>
                @include('admin.partials.messages')
                <form action="{{route('user.store')}}" method="POST" id="upload_form" autocomplete="off" enctype="multipart/form-data" >
                    @if($item)
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    @endif

                    <div class="p-20">
                        <h6>Basic Details</h6>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.first_name')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->first_name : old('first_name')}}" type="text"
                                        name="first_name" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.first_name')*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.last_name')</label>
                                    <input value="{{$item ? $item->last_name : old('last_name')}}" type="text"
                                        name="last_name" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.last_name')">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.designation')</label><span class="required">*</span>
                                    <select name="designation" id="designation" class="form-control">
                                        <option value="">Select Employee Designation</option>
                                            @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" {{isset($item->designation_id) && ($item->designation_id == $designation->id) ? "selected" :''}}>{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    
                                    <div class="help-block"></div>
                                </div>                              
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>@lang('l.grade')</label><span class="required">*</span>
                                    <select name="grade" id="grade" class="form-control">
                                        <option value="">Select Employee Grade</option>
                                            @foreach($grades as $grade)
                                            <option value="{{$grade->id}}" {{isset($item->emp_grade_id) && ($item->emp_grade_id == $grade->id) ? "selected" :''}}>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    
                                    <div class="help-block"></div>
                                </div>                              
                            </div>                            
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.joining_date')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->joining_date : old('joining_date')}}" type="date"
                                        name="joining_date" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="Date of Join*">
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.reporting_manager')</label><span class="required">*</span>
                                    <select name="reporting_manager" id="manager" class="form-control">
                                        <option value="">Select Reporting Manager</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}" {{isset($item->reporting_to) && ($item->reporting_to == $user->id) ? "selected" :''}}>{{$user->first_name .' '.$user->last_name  }}</option>
                                            @endforeach
                                        </select>
                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.holiday') @lang('l.calendar')</label><span class="required">*</span>
                                    <select name="calendar" id="calendar" class="form-control">
                                        <option value="">Select @lang('l.calendar')</option>
                                            @foreach($calendars as $calendar)
                                            <option value="{{$calendar->id}}" {{isset($item->calendar_id) && ($item->calendar_id == $calendar->id) ? "selected" :''}}>{{$calendar->name .' '.$calendar->calendar_year }}</option>
                                            @endforeach
                                        </select>
                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <h6>Contact Info</h6>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.country_code')</label><span class="required">*</span>
                                    <select name="country_code" id="country_code" class="form-control">
                                        <option value="">Select Country Code</option>
                                        @if(CountryCodes())
                                            @foreach(CountryCodes() as $code)
                                            <option value="{{$code->dial_code}}" {{isset($item->country_code) && ($item->country_code == $code->dial_code) ? "selected" :''}}>{{$code->dial_code}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>@lang('l.mobile_number')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->mobile_number : old('mobile')}}" type="text" name="mobile" maxlength="25"
                                        id="inputEmail" class="form-control" placeholder="@lang('l.mobile') No.*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div> 
                        <h6>Account Details</h6>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                     <label>@lang('l.email_add')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->email : old('email')}}" {{ $item ? "readonly" : ''}}
                                        type="email" name="email" maxlength="70" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.email_add') *">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        @if(!$item)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="password" >Password</label><span class="required">*</span>
                                <small class="form-text text-muted">(<b>Hint: </b> Your password must be equal or more than 8 characters.)</small>                                
                                    <input value="" type="password" name="password" maxlength="250" id="password"
                                        class="form-control showpass" placeholder="@lang('l.password')*"
                                        autocomplete="off">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" >Confirm Password</label><span class="required">*</span>
                                    <small class="form-text text-muted">&nbsp</small>                                
                                    <input type="password" name="password_confirmation" maxlength="250" id="password_confirmation"
                                        class="form-control showpass @error('password_confirmation') is-invalid @enderror"
                                        value="{{old('password_confirmation')}}" placeholder="Confirm Password*">
                                    <span toggle=".showpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">@lang('l.save')</button>
                                <a href="{{ route('user.index') }}">
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
            $('#calendar').select2();
            $('#country_code').select2();
            $('#designation').select2();
            $('#grade').select2();
        });
    </script>
    @endpush