@extends('admin.layouts.master')
@push('styles')
@endpush

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.users') }}</h4> -->
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('salesman.index')}}">
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
                <h4 class="mt-0 header-title m-b-30">@if($item) @lang('l.edit') @else @lang('l.add') @endif
                    @lang('l.user')</h4>
                @include('admin.partials.messages')
                <form action="{{route('salesman.store')}}" method="POST" onsubmit="return saveData(this)">
                @csrf
                    @if($item)
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{ __('l.sap_id') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->sap_id : ''}}" type="text" name="sap_id" id="sap"
                                        class="form-control" placeholder="{{ __('l.sap_id') }}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{ __('l.user')}} {{__('l.name') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->name : ''}}" type="text" name="name" id="user"
                                        class="form-control" placeholder="{{ __('l.name') }}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{__('l.email') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->email : ''}}" type="email" name="email" id="inputEmail"
                                        class="form-control" placeholder="{{ __('l.email') }}" {{$item ? 'readonly' : ''}}>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{ __('l.contact')}} {{__('l.number') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->contact_number : ''}}" type="text" name="snumber" id="phone"
                                        class="form-control" placeholder="{{ __('l.contact')}} {{ __('l.number') }}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--@if(!$item)--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="password" >Password</label><span class="req">*</span>
                                <small class="form-text text-muted">(<b>Hint: </b> Your password must be equal or more than 8 characters.)</small>                                
                                    <input value="" type="password" name="password" maxlength="250" id="password"
                                        class="form-control showpass" placeholder="@lang('l.password')*"
                                        autocomplete="off">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" >Confirm Password</label><span class="req">*</span>
                                    <small class="form-text text-muted">&nbsp</small>                                
                                    <input type="password" name="password_confirmation" maxlength="250" id="password_confirmation"
                                        class="form-control showpass @error('password_confirmation') is-invalid @enderror"
                                        value="{{old('password_confirmation')}}" placeholder="Confirm Password*">
                                    <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        {{--@endif--}}
                        <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">{{ __('l.save') }}</button>
                                <a href="{{ route('salesman.index') }}">
                                    <button type="button"
                                        class="btn btn-secondary waves-effect m-l-5">{{ __('l.cancel') }}</button>
                                </a>
                                <div id="ajaxloader" style="display: none;"><img
                                        src="{{ asset('public/admin/images/ajax-loader.gif')}}" />{{ __('l.processing') }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
            </div>


        </div>
        </form>
    </div>
</div>
@endsection
@push('appendJs')
<script type="text/javascript" src="{{ asset('public/admin/js/send-data.js')}}"></script>
@endpush