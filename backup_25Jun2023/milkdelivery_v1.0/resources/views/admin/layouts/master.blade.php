<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>MilkDelivery</title>
        <meta content="@MilkDelivery Dashboard" name="description" />
        <meta content="@MilkDelivery" name="author" />
       
        <!-- <link rel="stylesheet"
            href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
             -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        @include('admin.layouts.head')
        <style type="text/css">
           .help-block {color: red;}
           .req {color: red;}
        
        </style>
    </head>
<body>
    <div id="wrapper">
         @include('admin.layouts.header')
         @include('admin.layouts.sidebar')
         <div class="content-page">  
            <div class="content">
                <div class="container-fluid">
                  {{-- @include('admin.layouts.settings')--}}
                   @yield('content')
                </div> 
            </div> 
        </div> 
        {{--@include('admin.layouts.footer')--}}  
        @include('admin.layouts.footer-script')  
    </div> 
       @stack('appendJs')  
       @stack('javascript')  
       
    </body>

</html>
