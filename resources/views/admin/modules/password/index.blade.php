@extends('admin.layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/js/trumbowyg/dist/ui/trumbowyg.min.css') }}">
<link href="{{asset('public/admin/assets/css/dropzone.min.css')}}" type="text/css" rel="stylesheet" />
<link
    href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css"
    rel="stylesheet">
@endpush
@section('content')
<section class="content-header">
    <h1>
        Change Password
        <small>Change Password</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.messages')
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    {{--  <a href="{{ route('media.index') }}" class="btn btn-default pull-right"><i
                        class="fa fa-arrow-left"></i> Media</a> --}}
                </div>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['route' => 'admin.password.change.submit' ,'method'=>'post', 'onsubmit'=>'return
            saveData(this)','class'=>'changePasswordFrm' ]) !!}

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div id="msg"></div>
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_pwd" class="form-control border-input"
                            placeholder="Current Password">
                        <div class="help-block">{{ $errors->first('current_pwd') }}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" maxlength="250" class="form-control border-input"
                            placeholder="New Password">
                        <div class="help-block">{{ $errors->first('password') }}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" maxlength="250" class="form-control border-input"
                            placeholder="Confirm Password">
                        <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-info btn-fill btn-wd saveBtn">Change</button>
                <div id="ajaxloader" class="pull-right" style="display: none;"><img
                        src="{{ asset('public/images/ajax-loader.gif')}}" /> Processing...</div>
            </div>
            <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
</section>


@endsection
@push('appendJs')
<script type="text/javascript" src="{{ asset('public/admin/js/send-data.js')}}"></script>

@endpush