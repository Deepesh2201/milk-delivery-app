    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title m-b-30">Update Profile</h4>

                    @include('user.partials.messages')
                    @include('user.modules.profile._partials._profile_image')
                    <form action="{{route('adminprofile.store')}}" id="userForm" name="userForm" class="form-horizontal"
                        onsubmit="return saveData(this)" method="post">
                        @if($item)
                        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                        @endif  
                        <h6>Basic Details</h6> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--  <label>@lang('l.first_name')</label><span class="required">*</span> -->
                                    <input value="{{$item ? $item->first_name : old('first_name')}}" type="text"
                                        name="first_name" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.first_name')*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--  <label>@lang('l.last_name')</label><span class="required">*</span> -->
                                    <input value="{{$item ? $item->last_name : old('last_name')}}" type="text"
                                        name="last_name" maxlength="50" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.last_name')*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <h6>Contact Info</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <label>@lang('l.country_code')</label> -->
                                    <select name="country_code" id="country_code" class="form-control country_code">
                                        <option value="">Select Country Code</option>
                                        @if(CountryCodes())
                                            @foreach(CountryCodes() as $code)
                                            <option value="{{$code->dial_code}}" {{isset($item->country_code) && ($item->country_code == $code->dial_code) ? "selected" :''}}>{{$code->dial_code}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input value="{{$item ? $item->mobile : old('mobile')}}" type="text" name="mobile" maxlength="25"
                                        id="inputEmail" class="form-control" placeholder="@lang('l.mobile') No.*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--  <label for="useremail">Email address</label><span class="required">*</span> -->
                                    <input type="email" name="email" maxlength="70" id="useremail"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{$item ? $item->email : old('email')}}" {{$item ? 'readonly' : ''}}
                                        placeholder="Email address*">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <h6>@lang('l.address')</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input value="{{$item && $item->address ? $item->address : old('address')}}"
                                        type="text" name="address" maxlength="250" id="inputEmail" class="form-control"
                                        placeholder="@lang('l.address')">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div> 
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <small class="form-text text-muted">(<b>Hint: </b> Your password must be equal or more than 8 characters.)</small>
                                    <!--  <label for="userpassword">Password</label><span class="required">*</span> -->
                                    <input type="password" name="password" maxlength="250" id="userpassword"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{old('password')}}" placeholder="Password">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <small class="form-text text-muted">&nbsp;</small>
                                    <!--   <label for="password_confirmation" >Confirm Password</label><span class="required">*</span> -->
                                    <input type="password" name="password_confirmation" maxlength="250" id="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{old('password_confirmation')}}" placeholder="Confirm Password">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="p-20">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light saveBtn">@lang('l.save')</button>
                                    <a href="{{URL::previous()}}">
                                        <button type="button"
                                            class="btn btn-secondary waves-effect m-l-5">@lang('l.cancel')</button>
                                    </a>
                                    <div id="ajaxloader" style="display: none;"><img
                                            src="{{ asset('public/admin/images/ajax-loader.gif')}}" /> Processing...
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        @push('appendJs')
        <script>
            $(document).ready(function () {
                //alert("hg");
                $('input').attr('autocomplete', 'off');
            });
        </script> 
        @endpush