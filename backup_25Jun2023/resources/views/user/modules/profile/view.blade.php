@extends('user.layouts.master')
@section('content')
<div class="page-title-box">
    @php $item = Auth::user(); 
   
    @endphp
    <div class="row align-items-center">
        <div class="col-sm-6">
            <!-- <h4 class="page-title"> {{ __('l.member_detail') }}</h4> -->
            <h4 class="page-title"> &nbsp;</h4>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{route('adminprofile.edit',[$item->id])}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="far fa-edit"></i> Edit
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
                <h4 class="mt-0 header-title m-b-30">My Profile</h4>
                @include('user.partials.messages')
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=2>User Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($item->first_name != '')
                                    
                                    <tr>
                                        <td><b>Name :</b></td>
                                        <td> {{ isset($item->first_name) ? $item->full_name : '' }}</td>
                                    </tr>
                                    @endif
                                     
                                    <tr>
                                        <td><b>Contact No. :</b></td>
                                        <td>{{ isset($item->country_code) ? $item->country_code : '' }} {{ isset($item->mobile) ? $item->mobile : '' }}</td>
                                    </tr> 
                                    <tr>
                                        <td><b>Address :</b></td>
                                        <td>{!! isset($item->address) ? $item->address : ''
                                            !!}<br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=2>Other Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                    <tr>
                                        <td><b>Email :</b></td>
                                        <td>{{ isset($item->email) ? $item->email : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Designation :</b></td>
                                        <td>{{ isset($item->role->name) ? $item->role->name : '' }}</td>
                                    </tr> 
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