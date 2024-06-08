@extends('user.layouts.master')
@section('content')
<!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<form action="{{route('user.onloading.driverdetails')}}" method="POST">
    @csrf
  <div class="modal fade" id="onloadingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Start Onloading</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            @csrf
        <div class="modal-body" style="height:200px">
            <input type="text" id="salesmanid" name="salesmanid" value="{{Auth::user()->id}}" hidden>
            <input id="onloadingid" name="onloadingid" hidden>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Salesman Name</label>
                    <input type="text" class="form-control" id="salesmanname" name="salesmanname" value="{{Auth::user()->name}}" disabled>
                    
                </div>
                <div class="col-md-6">
                    <label>Driver Name</label>
                    <input type="text" class="form-control" id="drivername" name="drivername" value="{{old('drivername')}}">
                    <span class="text-danger">
                        @error('drivername')
                            {{$message}}
                        @enderror
                    </span>

                </div>

            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Vehicle No.</label>
                    <input type="text" class="form-control" id="vehicleno" name="vehicleno" value="{{old('vehicleno')}}">
                    <span class="text-danger">
                        @error('vehicleno')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="col-md-6">
                    <label>Start Km</label>
                    <input type="text" class="form-control" id="startkm" name="startkm" value="{{old('startkm')}}">
                    <span class="text-danger">
                        @error('startkm')
                            {{$message}}
                        @enderror
                    </span>
                </div>

            </div>
        </div>
    
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </div>
</div>
</div>
</form>

  {{-- ---------------- --}}
<div class="page-title-box">
    <div class="row align-items-center">
        {{-- <button class="btn btn-primary" > Test</button> --}}
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.loading') }}</h4> -->
            
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('user.onloading.create')}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="fas fa-plus"></i> {{ __('l.add') }} {{ __('l.onloading')}}
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
<span class="text-danger text-center">Please fill all the required fields</span>
        @endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title m-b-30">{{ __('l.onloading') }} {{ __('l.list') }}</h4>
                @include('user.partials.messages')
                <div class="table-responsive table-full-width">
                    <div style="overflow: auto;">
                        <form action="{{ route('user.onloading.search') }}" method="GET">                        
                            <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <div class="col-md-3" style="float:left;">
                                        <div class="form-group">
                                            <input type="text" name="name" maxlength="250" class="form-control" placeholder="Name"
                                            @if(isset($name)) value="{{ $name }}" @endif autocomplete="off">
                                        </div>
                                    </div>                                
                                </div>                            
                                <div class="col-md-2" style="float:left;">
                                <div class="form-group">
                                    <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light"
                                    type="submit"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('l.#') }}</th>
                                    <th>{{ __('l.product').' '.__('l.sap_id') }}</th>
                                    <th>{{ __('l.product').' '. __('l.name') }}</th>
                                    <th>{{ __('l.group') }}</th>
                                    <th>{{ __('l.batch_no') }}</th>
                                    <th>{{ __('l.product').' '. __('l.qty') }}</th>
                                    <th>{{ __('l.status') }}</th>
                                    <th>Creation Date</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @include('user.modules.loading.on-loading.tbody')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('lazyloading.loading')
<script type="text/javascript" src="{{ asset('public/admin/js/send-data.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    function deleteItem(custId){
        event.preventDefault();
        $('.loading').show();
        let token = $('meta[name="csrf_token"]').attr('content');
        axios({
            method: 'post',
            url: "{{ url('/admin/customer-delete/') }}"+'/'+custId,
            data:{ _token: token }
        })
        .then(function (response){  
            $('.loading').hide();          
            if(response.data){
                if(response.data.success){
                    location.reload();
                    toastr.success(response.data.message);          
                }else {
                    toastr.error(response.data.message);
                }
            }
            })
            .catch(function (error) { 
            $('.loading').hide();           
            if (error.response) {
                var errors =  error.response.data.errors;
                jQuery.each(errors, function(i, _msg) {
                toastr.error(_msg[0]);
                });
            }
            }); 
        return false; 
    };


function onloaddata(id){

$('#onloadingmodal').modal('show');
$.ajax({
    type: "GET",
    url: "./startonload/"+id,
    success: function (response) {
    // console.log(response) ;
    $("#onloadingid").val(response.onloadid.id);
    }
});
}


</script>

@endsection