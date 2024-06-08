<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>MilkDelivery</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="@MilkDelivery" name="author" />
        <link rel="shortcut icon" href="public/admin/images/milkDelivery.png">
        
        <!-- <link rel="stylesheet"
            href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> -->
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        @include('admin.layouts.head')
        <style type="text/css">
           .help-block {color: red;}    
           .req {color: red;}    

           .form-control.is-invalid, .was-validated .form-control:invalid {
                border-color: #dc3545;
                padding-right: calc(1.5em + .75rem);
                background-image: none;
                background-repeat: no-repeat;
                background-position: center right calc(.375em + .1875rem);
                background-size: calc(.75em + .375rem) calc(.75em + .375rem);
            }   
        </style>        
  </head>
    <body class="pb-0">
        @yield('content')
        @include('admin.layouts.footer-script')   
    </body>
</html>