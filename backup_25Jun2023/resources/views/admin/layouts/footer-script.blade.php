<!-- App's Basic Js  -->
<script type="text/javascript"> 
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
<script>
    window.Laravel = {!! json_encode([ "siteUrl" => url("/"), 'csrfToken' => csrf_token()]) !!}
</script>
<script src="{{ URL::asset('public/admin/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/waves.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/pages/lightbox.js') }}"></script>
<!-- Plz dont try to add http or https befor // in the below link -->
<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>

<script>
    $(function() {
        // guess user timezone 
        $('#tz').val(moment.tz.guess());
    })
</script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!-- App js-->
<script src="{{ URL::asset('public/admin/js/app.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/send-data.js') }}"></script>
@yield('script-bottom')