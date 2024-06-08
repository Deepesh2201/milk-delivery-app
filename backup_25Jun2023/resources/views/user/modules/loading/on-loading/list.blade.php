@extends('user.layouts.master')
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.loading') }}</h4> -->
        </div>        
    </div>
</div>

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
                                    <!-- <th>{{ __('l.status') }}</th> -->
                                   
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
</script>

@endsection