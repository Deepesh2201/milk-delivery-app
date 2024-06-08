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
                <a href="{{ url()->previous() }}">
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
                <h4 class="mb-0 mt-0 header-title"> @if($item){{ __('l.edit') }} @else @lang('l.add') @endif @lang('l.calendar') Feature </h4>
                @include('admin.partials.messages')
                <form action="{{route('set-calendar.feature.store')}}" method="POST" onsubmit="return saveQuiz(this)" autocomplete="off" enctype="multipart/form-data" >
                    @csrf
                    <div id="feature_hide" style="Display:none"></div>
                    <div id="feature_date" style="Display:none"></div>
                    @if($calendar)
                    <input type="hidden" name="calendar_id" id="id" value="{{ $calendar->id }}">
                    @endif

                    <div class="p-20">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.calendar') @lang('l.name')</label><span class="required">*</span>
                                    <input value="{{$calendar ? $calendar->name.' '.$calendar->calendar_year : old('name')}}" type="text"
                                        maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.name')*" readonly>
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div>
                        {{--
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.holiday') </label><span class="required">*</span>
                                    <input value="{{$item ? $item->feature_name : old('holiday')}}" type="text"
                                        name="holiday" maxlength="50" id="holiday" class="form-control"
                                        placeholder="@lang('l.holiday')*" >
                                    <div class="help-block"></div>
                                </div>
                            </div>                           
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.holiday') @lang('l.date')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->date : old('date')}}" type="date"
                                        name="date" maxlength="50" id="date" class="form-control"
                                        placeholder="@lang('l.date')*" >                                    
                                    <div class="help-block"></div>
                                </div>                              
                            </div>                                                      
                        </div>--}}

                    <div id="dynamic_field">                   
                        <!-- add  more start -->
                        @if($item) 
                            @php $j = 1; @endphp             
                                @foreach($item as $feature)
                                    @if($loop->iteration == 1)
                                    <div class="row"> 
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
                                    </div>
                                    @else
                                    <div id="row{{$loop->iteration}}" class="row dynamic-added"> 
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
                                    </div>
                                    @endif    
                                @php $j++ ; @endphp 
                                @endforeach
                        @else
                       
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                <label>@lang('l.holiday') </label><span class="required">*</span>
                                <input type="text" name="feature[1]" placeholder="Enter Option" class="form-control name_list options" />
                                <div class="feature_1 help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>@lang('l.holiday') @lang('l.date')</label><span class="required">*</span>
                                    <input type="date" name="date[1]" id="customRadioInline1" class="form-control name_list options">
                                    <div class="date_1 help-block"></div>
                                </div>
                            </div>                
                            <div class="col-md=2">
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>
                        @endif
                    </div>
                                                
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-20">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light saveBtn">@lang('l.save')</button>
                                <a href="{{ route('set-calendar.index') }}">
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
    <!-- <script type="text/javascript" src="{{ asset('public/admin/js/send-data.js')}}"></script> -->
    <script src="{{ URL::asset('public/admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>    
    <script src="{{ URL::asset('public/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#manger').select2();
            $('#country_code').select2();
            $('#year').select2();
            $('#grade').select2();
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){ 
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;
      <?php if(isset($j)){ ?>  
      var i = {{ ($j-1) }}  ; 
      <?php } ?>  
      $('#add').click(function(){
         var k = $('.options').length;
          if(k < 200){
            i++;  
           $('#dynamic_field').append('<div id="row'+i+'" class="row dynamic-added"><div class="col-md-5"><div class="form-group"><input type="text" name="feature['+i+']" placeholder="Enter Holiday" class="form-control options name_list" /><div class="feature_'+i+' help-block"></div></div></div>'+
           '<div class="col-md-5"><div class="form-group"><input type="date" name="date['+i+']" value="" id="customRadioInline'+i+'" class="form-control options"><div class="date_'+i+' help-block"></div></div></div>'+
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