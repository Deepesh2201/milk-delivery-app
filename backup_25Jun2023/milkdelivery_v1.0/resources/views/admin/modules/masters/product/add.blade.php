@extends('admin.layouts.master')
@push('styles')
@endpush

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.products') }}</h4> -->
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('product.index')}}">
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
                    @lang('l.product')</h4>
                @include('admin.partials.messages')
                <form action="{{route('product.store')}}" method="POST" onsubmit="return saveData(this)">
                @csrf
                    @if($item)
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{ __('l.name') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->name : ''}}" type="text" name="name" id="inputEmail"
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
                                    <label>{{ __('l.sap_id') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->sap_id : ''}}" type="text" name="sap_id" id="inputEmail"
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
                                    <label>{{ __('l.unit_price') }}<span class="req"> *</span></label>
                                    <input value="{{$item ? $item->unit_price : ''}}" type="number" name="unit_price" step="0.01" 
                                        class="form-control" placeholder="{{ __('l.unit_price') }}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-20">
                                <div class="form-group">
                                    <label>{{ __('l.description') }}</label>
                                    <input value="{{$item ? $item->description : ''}}" type="text" name="description" id="description"
                                        class="form-control" placeholder="{{ __('l.description') }}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">{{ __('l.save') }}</button>
                                <a href="{{ route('product.index') }}">
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