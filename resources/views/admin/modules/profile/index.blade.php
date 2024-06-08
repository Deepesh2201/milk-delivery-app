@extends('admin.layouts.master')
@section('css')
<style>
    .required {
        color: red;
    }

    .help-block {
        color: red;
    }
</style>
<link href="{{ URL::asset('public/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@php $item = Auth::user(); @endphp
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"> &nbsp</h4>
            <!-- <h4 class="page-title"> {{ __('l.profile') }}</h4> -->
        </div>
        <div class="col-sm-6">
            <div class="float-right d-md-block">
                <a href="{{ route('adminprofile.index')}}">
                    <button class="btn btn-primary arrow-none waves-effect waves-light" type="button">
                        <i class="fas fa-arrow-left"></i> {{ __('l.back') }}
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

@include('admin.modules.profile._partials._general_details')

@include('admin.modules.profile._partials._upload_modal')

@endsection

@push('appendJs')
<script src="{{ URL::asset('public/admin/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.country_code').select2();
    });
</script>
<script>
    //Edit profile pic
    $(".profile_users_img").hover(function () {
        // alert("Df")
        $(this).disable = true;
    })
    $(".profile_users_img").click(function () {
        $('#img-modal').modal('show');
    })
    $('#upload_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "{{route('change_profile_pic')}}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('.ajaxmsg').css('display', 'block');
                $(".ajaxmsg").html("<div class='alert alert-info'><p>Please wait...</p></div>");
                $('#upload').prop('disabled', true);
            },
            success: function (data) {
                $('.ajaxmsg').empty();
                $('.ajaxmsg').css('display', 'none');
                // $('#uploaded_image').html(data.uploaded_image);
                if (data.status == 200) {
                    $('#message').css('display', 'none');
                    $('.ajaxmsg').css('display', 'block');
                    $('.ajaxmsg').html(data.message);
                    $('.ajaxmsg').addClass(data.class_name);
                    location.reload();
                } else {
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $('#message').fadeOut(8000);
                    //$('#message').css('display', 'none');                                              
                    $('#upload').prop('disabled', false);
                }

            },
            error: function (data) {
                $('#upload').prop('disabled', false);
                var toAppend = '';
                $(".ajaxmsg").empty();
                console.log(data.responseJSON.errors);
                //alert(data.errors);
                $.each(data.responseJSON.errors, function (key, error) {
                    toAppend += '<div class="alert alert-success bg-danger">' + error +
                        '</div>';
                });
                $(".ajaxmsg").append(toAppend).fadeOut(5000);

                // $('.help-block').css('display','block');
                //  var  change=data.responseJSON.errors['change'];
                // $("#err_change").html(change);country_code

            }
        })
    });

    $(function () {
        $("#select_file").on('change', function () {
            // Display image on the page for viewing
            readURL(this, "preview");

        });
    });

    function readURL(input, tar) {
        if (input.files && input.files[0]) { // got sth

            // Clear image container
            $("#" + tar).removeAttr('src');

            $.each(input.files, function (index, ff) // loop each image 
                {

                    var reader = new FileReader();

                    // Put image in created image tags
                    reader.onload = function (e) {
                        $('#' + tar).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(ff);

                });
        }
    }
</script>
<script src="{{ URL::asset('public/admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
@endpush