@extends('admin.layouts.master')
@section('content')
<!-- <div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                 
        <a href="{{ route('user.create')}}">
                <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                    <i class="fas fa-plus"></i> @lang('l.add') @lang('l.user')
                </button>
            </a>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">                    
                        <h4 class="mt-0 header-title m-b-30">{{ __('l.user') }} {{ __('l.list') }}</h4>
                        <div class="float-right d-md-block">
                 
                 <a href="{{ route('user.create')}}">
                         <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                             <i class="fas fa-plus"></i> @lang('l.add') @lang('l.user')
                         </button>
                     </a>
                     </div>
                        @include('admin.partials.messages')
                    </div>
                </div>
                <div class="row" >
                <div class="col-md-2">
                </div>
                <div class="col-md-10" >
                <!-- <div class="table-responsive table-full-width">
                    <div style="overflow: auto;"> -->
                        
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
                                   <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @if(!empty($items))
                                @foreach($items as $item) 
                                <tr>
                                    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
                                    <td ><a href="{{ route('user.show',  $item->id)}}" class="link" title="See Details">{{$item->full_name}}</a></td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->mobile_number}}</td> 
                                    <td><?php if($item->status == 1) { echo '<span class="badge-success badge mr-2">Verified</span>'; } elseif($item->status == 0){ echo '<span class="badge-danger badge mr-2">Unverified</span>'; } ?>
                                    </td> 
                                    
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            @if($item->id != Auth::user()->id)

                                            @if($item->status == 1)
                                            <i class="fas fa-check text-success"></i>
                                            @else
                                            <i class="fas fa-times text-danger"></i>
                                            @endif 
                                            <a href="{{ route('user.edit',$item->id)}}" class="btn btn-default" title="Delete"><i
                                                    class="far fa-edit"></i></a>
                                            <a href="{{ route('user.delete',$item->id)}}" class="btn btn-default" title="Delete"><i
                                                    class="far fa-trash-alt"></i></a>
                                        
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @endif
                               </tbody>
                        </table>
                    <!-- </div>
                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
 </script>
 @endsection 