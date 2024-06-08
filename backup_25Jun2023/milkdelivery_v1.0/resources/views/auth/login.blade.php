@extends('admin.layouts.master_blank')

@section('content')
<!--  <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
 -->
<div class="wrapper-page">
    <div class="card overflow-hidden account-card mx-3">
        <div class="bg-primary p-4 text-white text-center position-relative">
            <h4 class="font-20 m-b-5">Welcome</h4>
            <p class="text-white-50 mb-4" style="color:rgb(255, 255, 255) !important;">Sign in to continue to Milk Delivery App.</p>
            <a href="{{ URL::to('/') }}" class="logo logo-admin"><img
                    src="{{ URL::asset('public/admin/images/logo-placeholder-image.png') }}" style="height: 66px;border-radius: 100%;" alt="logo"></a>
        </div>
        <div class="account-card-content">

            @if(Session::has('message'))
            <div class="alert alert-dismissible alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <a href="#" class="alert-link">{{Session::get('message')}}</a>
            </div>
            @endif
            @if(Session::has('login_error'))
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <a href="#" class="alert-link">{{Session::get('login_error')}}</a>
            </div>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <a href="#" class="alert-link">{{Session::get('success')}}</a>
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <a href="#" class="alert-link">{{Session::get('error')}}</a>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif

            <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="tz" id="tz">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input id="email" type="email" class="form-control" name="email" maxlength="70" value="{{ old('email') }}" required
                        autocomplete="email" placeholder="Enter email" autofocus>
                </div>
                <!--  @error('email')
                              <span class="help-block" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                            @enderror -->

                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input type="password" name="password" maxlength="250" class="form-control" id="userpassword"
                        placeholder="Enter password">
                </div>
                <!--  @error('password')
                                <span class="help-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->

                <div class="form-group row m-t-20">
                    <div class="col-sm-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="customControlInline"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit" id="loginButton" >Log In</button>
                    </div>

                </div>
                @if (Route::has('password.request'))
                <div class="form-group m-t-10 mb-0 row">
                    <div class="col-12 m-t-20">
                        <a href="{{route('password.request') }}"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="m-t-40 text-center">       
        <!-- <p>Facing any problem? Please<a href=" " class="font-500 text-primary"> Contact Us</a> </p> -->
        <p>© {{date('Y')}} MilkDelivery</p>
    </div>

</div>
<!-- end wrapper-page -->
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        var email = $("#email").val().length;
        var pass  = $("#userpassword").val().length;
                
        if(email == 0 || pass == 0){
            $("#loginButton").prop( "disabled", true );
        }
        $("#userpassword").keyup(function(){           
            var email1 = $("#email").val().length;
            var pass1  = $("#userpassword").val().length;  
            
            if(email1 != 0 && pass1 != 0){
                $("#loginButton").prop( "disabled", false);
            }else{
                $("#loginButton").prop( "disabled", true );
            }
        });
        $("#email").keyup(function(){            
            var email2 = $("#email").val().length;
            var pass2  = $("#userpassword").val().length;  
           
            if(email2 != 0 && pass2 != 0){
                $("#loginButton").prop( "disabled", false);
            }else{
                $("#loginButton").prop( "disabled", true );
            }
        });
        $("#loginButton").click(function(){
            var email2 = $("#email").val().length;
            var pass2  = $("#userpassword").val().length;
            if(email2 != 0 && pass2 != 0){
                $("form").submit();
            }
        });

    });
</script>

@endsection
