@extends('admin.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">&nbsp</h4>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
               
               <a href="{{ route('set-calendar.edit', $item->id)}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="far fa-edit"></i> {{ __('l.edit') }} {{ __('l.calendar') }}
                    </button>
                </a> 
               <a href="{{ route('set-calendar.add_feature', $item->id)}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="far fa-edit"></i> {{ __('l.edit') }} {{ __('l.calendar') }} {{ __('l.feature') }}
                    </button>
                </a> 
                
                <a href="{{ route('set-calendar.index') }}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="fa fa-arrow-left"></i> @lang("l.back")
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
                <h4 class="mt-0 header-title">{{ __('l.calendar') }} Details</h4>
                <small class="form-text text-muted m-b-30" style="color: #9ca8b3 !important;  font-size: 15px;">{{ $item ? $item->name.' '.$item->calendar_year : ''}}</small>
                @include('admin.partials.messages')
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=2>Calendar Features</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><h6> Weekly Holiday  :</h6></td>
                                        <td> {{ $item->weekly_holiday }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><h6> Other Holidays </h6></td>                                       
                                    </tr>
                                @forelse($item->features as $feature)
                                    <tr>
                                        <td><b>{{ $feature->feature_name }} :</b></td>
                                        <td> {{ date('d M Y', strtotime($feature->date)) }}</td>
                                    </tr>
                                @empty   
                                    <tr>
                                    <td colspan="2" align="center"> {{ __('l.feature') }} {{ __('l.not_found') }}</td>
                                    </tr>
                                @endforelse                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection