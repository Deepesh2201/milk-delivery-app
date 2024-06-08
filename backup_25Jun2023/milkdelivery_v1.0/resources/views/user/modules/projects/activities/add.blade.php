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
                <h4 class="mb-0 mt-0 header-title"> @if($item){{ __('l.edit') }} @else @lang('l.add') @endif @lang('l.project_activity') </h4>
                <small class="form-text text-muted mt-0" style="color: #9ca8b3 !important;  font-size: 15px;">@if(!$item) (New @lang('l.project_activity'))@endif</small>
                @include('admin.partials.messages')
                <form action="{{route('project-activity.store')}}" method="POST" id="upload_form" autocomplete="off" enctype="multipart/form-data" >
                    @if($item)
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    @endif

                    <div class="p-20">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.project')</label><span class="required">*</span>
                                     <select name="project_name" id="123" class="form-control">
                                        <option value="">Select @lang('l.project')</option>
                                        @foreach($projects as $val)
                                        <option value="{{ $val->id }}" @if( isset($item->project_id) && $val->id == $item->project_id) selected @endif >{{ $val->project_code .' '.$val->project_name }}</option>
                                        @endforeach
                                     </select>    
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.project_activity')</label><span class="required">*</span>
                                    <input value="{{$item ? $item->activity : old('project_activity')}}" type="text"
                                        name="project_activity" maxlength="255" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.project_activity')*">
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


                        <div id="dynamic_field">                   
                        <!-- add  more start -->
                        @if($item) 
                            @php $j = 1; @endphp             
                                @foreach($item->related_users as $employee)
                                    @if($loop->iteration == 1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('l.user')</label><span class="required">*</span>
                                                <select name="employee[{{$loop->iteration}}]" class="manager" class="form-control" multiple>
                                                    <option value="">Select @lang('l.user')</option>
                                                    @foreach($users as $val)
                                                    <option value="{{ $val->id }}" @if( isset($employee->user_id) && $val->id == $employee->user_id) selected @endif >{{ $val->emp_id .' '.$val->first_name.' '.$val->last_name }}</option>
                                                    @endforeach
                                                </select>                                    
                                                <div class="employee_{{$loop->iteration}} help-block"></div>
                                            </div>
                                        </div> 
                                                                   
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Duration</label><span class="required">*</span>
                                                <input type="time" name="duration[{{$loop->iteration}}]" value="{{ $feature->duration }}" id="customRadioInline1" class="form-control options" > 
                                                <div class="duration_{{$loop->iteration}} help-block"></div>
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
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('l.user')</label><span class="required">*</span>
                                                <select name="employee[{{$loop->iteration}}]" class="manager" class="form-control" multiple>
                                                    <option value="">Select @lang('l.user')</option>
                                                    @foreach($users as $val)
                                                    <option value="{{ $val->id }}" @if( isset($employee->user_id) && $val->id == $employee->user_id) selected @endif >{{ $val->emp_id .' '.$val->first_name.' '.$val->last_name }}</option>
                                                    @endforeach
                                                </select>                                    
                                                <div class="employee_{{$loop->iteration}} help-block"></div>
                                            </div>
                                        </div> 
                                                                   
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Duration</label><span class="required">*</span>
                                                <input type="time" name="duration[{{$loop->iteration}}]" value="{{ $feature->duration }}" id="customRadioInline1" class="form-control options" > 
                                                <div class="duration_{{$loop->iteration}} help-block"></div>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('l.user')</label><span class="required">*</span>
                                    <select name="employee[1]" class="manager" class="form-control" multiple>
                                        <option value="">Select @lang('l.user')</option>
                                        @foreach($users as $val)
                                        <option value="{{ $val->id }}" @if( isset($employee->user_id) && $val->id == $employee->user_id) selected @endif >{{ $val->emp_id .' '.$val->first_name.' '.$val->last_name }}</option>
                                        @endforeach
                                    </select>                                    
                                    <div class="employee_1 help-block"></div>
                                </div>
                            </div>                                                        
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Duration</label><span class="required">*</span>
                                    <input type="time" name="duration[1]" id="customRadioInline1" class="form-control options" > 
                                    <div class="duration_1 help-block"></div>
                                </div>                              
                            </div>
                            {{--<!-- <div class="col-md-6">
                                <div class="form-group">
                                <label>@lang('l.task') </label><span class="required">*</span>
                                <input type="text" list="taskdata" name="feature[1]" placeholder="Enter/Select Task" class="form-control name_list options" />
                                <datalist id="taskdata">
                                    @foreach($pendingTasks as $pending)
                                    <option value="{{ $pending->task_code }}">
                                    @endforeach
                                </datalist>
                                <div class="feature_1 help-block"></div>
                                </div>
                            </div> -->
              
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                    <label>Duration (<small>In Hours</small>)</label><span class="required">*</span>
                                    <input type="time" name="duration[1]" id="customRadioInline1" class="form-control name_list options">
                                    <div class="duration_1 help-block"></div>
                                </div>
                            </div>-->--}}
                            <div class="col-md=2">
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>
                        @endif
                    </div>
                        <!-- <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.user')</label><span class="required">*</span>
                                     <select name="employee" class="manager" class="form-control" multiple>
                                        <option value="">Select @lang('l.user')</option>
                                        @foreach($users as $val)
                                        <option value="{{ $val->id }}" @if( isset($item->user_id) && $val->id == $item->user_id) selected @endif >{{ $val->emp_id .' '.$val->first_name.' '.$val->last_name }}</option>
                                        @endforeach
                                     </select>                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>                            
                        </div> -->
                                                
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>@lang('l.description')</label>
                                     <textarea name="description" maxlength="255" rows="8" class="form-control" placeholder="@lang('l.description')">{{$item ? $item->description : old('description')}}</textarea>
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
            $('.manager').select2();
            $('#123').select2();
        });
    </script>
    @endpush