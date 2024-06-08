@extends('user.layouts.master')
@push('styles')
@endpush

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title">h</h4> -->
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('onloading.index')}}">
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
                    @lang('l.onloading')</h4>
                @include('user.partials.messages')
                <form action="{{route('onloading.store')}}" method="POST" onsubmit="return saveOnloading(this)">
                @csrf
                    @if($onloading)
                    <input type="hidden" name="id" id="id" value="{{ $onloading->id }}">
                    @endif                   
                    <div class="row"> 
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>@lang('l.user')</label><span class="req">*</span>
                                <select name="salesman" id="salesman" class="form-control">
                                    <option value="">Select Salesman</option>
                                    @if(Salesmans())
                                        @foreach(Salesmans() as $salesman)
                                        <option value="{{ $salesman->id }}" {{isset($onloading->salesman_id) && ($onloading->salesman_id == $salesman->id) ? "selected" :''}}>{{ strtoupper($salesman->name) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                
                                <div class="help-block"></div>
                            </div>
                        </div>                        
                    </div> 
                                        
                    <div id="dynamic_field">                   
                        <!-- add  more start -->
                        @if($item) 
                            @php $j = 1; @endphp             
                                @foreach($item as $feature)
                                    @if($loop->iteration == 1)
                                    <div class="row"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.product')</label><span class="req">*</span>
                                                <select name="product[{{$loop->iteration}}]" class="form-control options" id="product[{{$loop->iteration}}]">
                                                    <option value="">Select Product</option>
                                                    @if(products())
                                                        @foreach(products() as $product)
                                                        <option value="{{$product->id}}" {{isset($feature->product_id) && ($feature->product_id == $product->id) ? "selected" :''}}>{{ strtoupper($product->name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                
                                                <div class="product_{{$loop->iteration}} help-block"></div>
                                            </div>
                                        </div>                        
                                    
                                        <div class="col-md-5">
                                            <div class="p-20">
                                                <div class="form-group">
                                                    <label>{{ __('l.product')}} {{__('l.qty') }}<span class="req"> *</span></label>
                                                    <input value="{{$feature->qty ?? ''}}" type="number" name="qty[{{ $loop->iteration }}]" id="qty[{{ $loop->iteration }}]"
                                                        class="form-control options" placeholder="{{ __('l.quantity') }}">
                                                    <div class="qty_{{ $loop->iteration }} help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                        </div>
                                    </div>


                                    {{-- <div class="row"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.holiday') </label><span class="required">*</span>
                                                <input type="text" name="feature[{{$loop->iteration}}]" placeholder="Enter Option" class="form-control options name_list" value = "{{$feature->feature_name}}" />                                     
                                                <div class="feature_{{$loop->iteration}} help-block"></div>
                                            </div>
                                        </div>                           
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.holiday') @lang('l.date')</label><span class="required">*</span>
                                                <input type="date" name="date[{{$loop->iteration}}]" value="{{ $feature->date }}" id="customRadioInline1" class="form-control options" > 
                                                <div class="date_{{$loop->iteration}} help-block"></div>
                                            </div>                              
                                        </div>                                                      
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>  
                                            </div>                              
                                        </div>                                                      
                                    </div> --}}
                                    @else

                                    <div id="row{{$loop->iteration}}" class="row dynamic-added"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.product')</label><span class="req">*</span>
                                                <select name="product[{{$loop->iteration}}]" class="form-control options" id="product[{{$loop->iteration}}]">
                                                    <option value="">Select Product</option>
                                                    @if(products())
                                                        @foreach(products() as $product)
                                                        <option value="{{$product->id}}" {{isset($feature->product_id) && ($feature->product_id == $product->id) ? "selected" :''}}>{{ strtoupper($product->name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                
                                                <div class="product_{{$loop->iteration}} help-block"></div>
                                            </div>
                                        </div>                        
                                    
                                        <div class="col-md-5">
                                            <div class="p-20">
                                                <div class="form-group">
                                                    <label>{{ __('l.product')}} {{__('l.qty') }}<span class="req"> *</span></label>
                                                    <input value="{{$feature->qty ?? ''}}" type="number" name="qty[{{ $loop->iteration }}]" id="qty[{{ $loop->iteration }}]"
                                                        class="form-control options" placeholder="{{ __('l.quantity') }}">
                                                    <div class="qty_{{ $loop->iteration }} help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                            <button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove">X</button>                              
                                        </div> 
                                    </div>


                                    {{--<div id="row{{$loop->iteration}}" class="row dynamic-added"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.holiday') </label><span class="required">*</span>
                                                <input type="text" name="feature[{{$loop->iteration}}]" placeholder="Enter Option" class="form-control options name_list" value = "{{$feature->feature_name}}" />
                                                <div class="feature_{{$loop->iteration}} help-block"></div> 
                                            </div>
                                        </div>                           
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>@lang('l.holiday') @lang('l.date')</label><span class="required">*</span>
                                                <input type="date" name="date[{{$loop->iteration}}]" value="{{$feature->date}}" id="customRadioInline{{$loop->iteration}}" class="form-control options" />                                                                     
                                                <div class="date_{{$loop->iteration}} help-block"></div>
                                            </div>                              
                                        </div>                                                      
                                        <div class="col-md-2">
                                            <button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove">X</button>                              
                                        </div>                                                      
                                    </div>--}}
                                    @endif    
                                @php $j++ ; @endphp 
                                @endforeach
                        @else                       
                        <div class="row"> 
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>@lang('l.product')</label><span class="req">*</span>
                                    <select name="product[1]" class="form-control options" id="product[1]">
                                        <option value="">Select Product</option>
                                        @if(products())
                                            @foreach(products() as $product)
                                            <option value="{{$product->id}}" {{isset($item->loadingProductRelation->product_id) && ($item->loadingProductRelation->product_id == $product->id) ? "selected" :''}}>{{ strtoupper($product->name) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    <div class="product_1 help-block"></div>
                                </div>
                            </div>                        
                        
                            <div class="col-md-5">
                                <div class="p-20">
                                    <div class="form-group">
                                        <label>{{ __('l.product')}} {{__('l.qty') }}<span class="req"> *</span></label>
                                        <input value="{{$item->loadingProductRelation->qty ?? ''}}" type="number" name="qty[1]" id="qty[1]"
                                            class="form-control options" placeholder="{{ __('l.quantity') }}">
                                        <div class="qty_1 help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>

                    @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">{{ __('l.save') }}</button>
                                <a href="{{ route('onloading.index') }}">
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
<script type="text/javascript">   
    $(document).ready(function(){ 
        var postURL = "<?php echo url('addmore'); ?>";
        var i=1;
        <?php if(isset($j)){ ?>  
        var i = '{{ ($j-1) }}'  ; 
        <?php } ?>  
        $('#add').click(function(){
            var k = $('.options').length;
            if(k < 200){
                i++;  
            $('#dynamic_field').append('<div id="row'+i+'" class="row dynamic-added"><div class="col-md-5"><div class="form-group multi-field"><select name="product['+i+']" class="form-control options" id="product_'+i+'" >'+
            '<option value="">Select Product</option><?php if(products()){ foreach(products() as $product){ ?> <option value="{{$product->id}}" >{{ strtoupper($product->name) }}</option> <?php } } ?></select><div class="product_'+i+' help-block"></div></div></div><div class="col-md-5"><div class="form-group"><input type="number" name="qty['+i+']" placeholder="Quantity" value="" id="qty'+i+'" step="01" class="form-control options"><div class="qty_'+i+' help-block"></div></div></div>'+
            '<div class="col-md-2"><div class="form-group"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div><div>');  
            } 
        });  
        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });
    });
</script>
@endpush