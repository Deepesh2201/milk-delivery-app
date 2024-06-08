<?php use App\User; ?>
@extends('admin.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">&nbsp</h4>
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
               
               <a href="{{ route('user.edit', $item->id)}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="far fa-edit"></i> {{ __('l.edit') }}
                    </button>
                </a> 
                
                <a href="{{ route('user.index')}}">
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
                <h4 class="mt-0 header-title">{{ __('l.user') }} Details</h4>
                <small class="form-text text-muted m-b-30" style="color: #9ca8b3 !important;  font-size: 15px;">(Your's user details)</small>
                @include('admin.partials.messages')
                <div class="row">
                    <!-- <div class="col-md-4">                        
                        <img alt="User Pic" src="{{ @fopen(\Url('assets/profileimages/').'/'.$item->profile_image, 'r') ? \Url('assets/profileimages/').'/'.$item->profile_image : asset('public/nobody_user.jpg') }}" id="profile_pic" class="" width="150" height="150">                         <br><br>
                    </div> -->
                    
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=4>Documents Gallery</th>
                                    </tr>
                                </thead>
                                <tbody>
                                                                      
                                    <tr>
                                        <td><b>Aadhaar Card :</b></td>
                                        <td>                                         
                                        @php 
                                        $doc = \Url('assets/useruiddocs/').'/'.$item->adhar_doc;
                                        $exist =  @fopen($doc, 'r'); @endphp   
                                        @if($exist)
                                        <a href="{{ $doc ?? '' }}" target="blank">
                                            @php $ext = explode('.', $item->adhar_doc); @endphp
                                            @if( $ext[1] == 'png' || $ext[1] == 'jpeg' || $ext[1] == 'jpg')
                                            <img src="{{ \Url('assets/useruiddocs/').'/'.$item->adhar_doc }}" id="invoice"  width="150" height="150"></a>
                                            @elseif( $ext[1] == 'doc' || $ext[1] == 'docx')
                                            <iframe class="doc" src="{{'https://docs.google.com/gview?url='.\Url('assets/useruiddocs/').'/'.$item->adhar_doc .'&embedded=true'}}" width="150" height="120" ></iframe>view
                                            @else
                                            <embed type="application/pdf" src="{{ \Url('assets/useruiddocs/').'/'.$item->adhar_doc }}" frameborder="0" width="150" height="120" scrolling="no">See</a>
                                            @endif               
                                        <!-- <iframe src="{{ $doc ?? ''}}" type="application/pdf" frameborder="0" width="150" height="120" scrolling="no">                        
                                        </iframe>
                                        <a href="{{ $doc ?? ''}}" target="blank">Download</a> -->
                                        @endif
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>PAN CARD :</b></td>
                                        <td>                                         
                                        @php 
                                        $doc = \Url('assets/userpndocs/').'/'.$item->pan_doc;
                                        $exist =  @fopen($doc, 'r'); @endphp   
                                        @if($exist)
                                        <a href="{{ $doc ?? '' }}" target="blank">
                                            @php $ext = explode('.', $item->pan_doc); @endphp
                                            @if( $ext[1] == 'png' || $ext[1] == 'jpeg' || $ext[1] == 'jpg')
                                            <img src="{{ \Url('assets/userpndocs/').'/'.$item->pan_doc }}" id="invoice"  width="150" height="150"></a>
                                            @elseif( $ext[1] == 'doc' || $ext[1] == 'docx')
                                            <iframe class="doc" src="{{'https://docs.google.com/gview?url='.\Url('assets/userpndocs/').'/'.$item->pan_doc .'&embedded=true'}}" width="150" height="120" ></iframe>view
                                            @else
                                            <embed type="application/pdf" src="{{ \Url('assets/userpndocs/').'/'.$item->pan_doc }}" frameborder="0" width="150" height="120" scrolling="no">See</a>
                                            @endif               
                                        <!-- <iframe src="{{ $doc ?? ''}}" type="application/pdf" frameborder="0" width="150" height="120" scrolling="no">                        
                                        </iframe>
                                        <a href="{{ $doc ?? ''}}" target="blank">Download</a> -->
                                        @endif
                                        
                                        </td>
                                    </tr>
                                                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Details Table -->
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan=2>User Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Employee id :</b></td>
                                        <td> {{ isset($item->emp_id) ? $item->emp_id : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Designation :</b></td>
                                        <td>{{ isset($item->designation) ? $item->designation->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Employee Grade :</b></td>
                                        <td>{{ isset($item->emp_grade) ? $item->emp_grade->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Reporting Manager :</b></td>
                                        <td>{{ $item->manager->first_name ?? '' }} {{ $item->manager->last_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Name :</b></td>
                                        <td> {{ isset($item->first_name) ? $item->getFullNameAttribute() : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Father's Name :</b></td>
                                        <td> {{ $item->father_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Date of Birth :</b></td>
                                        <td> {{ $item->dob ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Date of Joining :</b></td>
                                        <td> {{ $item->joining_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>PAN CARD :</b></td>
                                        <td> {{ $item->pan_number ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Aadhaar Card No. :</b></td>
                                        <td> {{ $item->adhar_number ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact No. :</b></td>
                                        <td> {{ isset($item->mobile_number) ? $item->mobile_number : '' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><b>Email :</b></td>
                                        <td>{{ isset($item->email) ? $item->email : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Alternate Number :</b></td>
                                        <td>{{ $item->alternate_number ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Emergency Number :</b></td>
                                        <td>{{ $item->emergency_number ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Emergency Contact Person Name :</b></td>
                                        <td>{{ $item->emergency_contact_person ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Emergency Contact Relationship :</b></td>
                                        <td>{{ $item->emergency_contact_relationship ?? '' }}</td>
                                    </tr> 
                                    <tr>
                                        <td><b>Temp Address :</b></td>
                                        <td>{!! isset($item->temp_address) ? $item->temp_address : ''
                                            !!}<br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Permanent Address :</b></td>
                                        <td>{!! isset($item->address) ? $item->address : ''
                                            !!}<br>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td><b>Status :</b></td>
                                        <td><?php if($item->status == 1) { echo '<span class="badge-success badge mr-2">Verified</span>'; } elseif($item->status == 0){ echo '<span class="badge-danger badge mr-2">Unverified</span>'; } ?>
                                        </td>
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