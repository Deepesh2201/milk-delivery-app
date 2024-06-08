@php
use App\Models\User;
use App\Models\Product;
@endphp
@extends('admin.layouts.master')
@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/public/admin/plugins/chartist/css/chartist.min.css') }}">
<style>
    #chartdiv {
      width: 100%;
      height: 600px;
    }
    </style>
@endsection

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Dashboard
            </h4>
        </div>
    </div>
</div>
<div style="padding-top:17px;">
    @include('admin.partials.messages')
</div>
<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat bg-primary text-white sales-man">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">@lang('l.users')</h5>
                    @php $users = User::where('role_id', config('constants.userTypes.salesman'))->count(); @endphp
                    <h4 class="font-500"> {{ $users }} </h4>
                </div>
                <a href="{{ route('salesman.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>           
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat text-white suppl---iers">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">@lang('l.products')</h5>
                    @php $product = Product::where('status', '0')->count(); @endphp
                    <h4 class="font-500"> {{ $product }} </h4>
                </div>
                <a href="{{ route('product.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>            
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat text-white divi---sii--oonn">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <h5 class="font-16 text-uppercase mt-0 text-white-50">@lang("l.customers")</h5>
                    @php $customer = User::where('role_id', config('constants.userTypes.customer'))->count(); @endphp
                    <h4 class="font-500"> {{ $customer }} </h4>
                </div>
                <a href="{{ route('customer.index') }}" class="text-white-50">
                    <div class="pt-2">
                        <div class="float-right">
                            <i class="mdi mdi-arrow-right h5"></i>
                        </div>
                        <p class="text-white-50 mb-0">@lang("l.view")</p>
                    </div>
                </a>
            </div>            
        </div>
    </div>
    
  </div>
  <div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card mini-stat text-white">
            <div class="card-body">
                <div id="dynamic_chartdiv"></div>
                
            </div>            
        </div>
    </div>
  </div>
<!-- end row -->

<!-- end row -->
@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('assets/public/admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('assets/public/admin/plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('assets/public/admin/plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/public/admin/pages/dashboard.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


<?php
$phpArray = array(
    array('month'=>'January', 'amount'=>'1000'),
    array('month'=>'February', 'amount'=>'1020'),
    array('month'=>'March', 'amount'=>'1200'),
    array('month'=>'April', 'amount'=>'1220'),
    array('month'=>'May', 'amount'=>'1300'),
    array('month'=>'June', 'amount'=>'1410'),
    array('month'=>'July', 'amount'=>'1120'),
    array('month'=>'August', 'amount'=>'1220'),
    array('month'=>'September', 'amount'=>'1090'),
    array('month'=>'October', 'amount'=>'1080'),
    array('month'=>'November', 'amount'=>'1120'),
    array('month'=>'December', 'amount'=>'1020'),
);
?>

<script>



    $(document).ready(function(){
    expense_report();
    });
         
    function expense_report()
    {
        $.ajax({
        url:"https://app.shinerweb.com/index.php/chart/get_expense_report",
        type:"POST",
        dataType: 'json',
        success:function(response){
        if(response.status == true)
        {
        var html="";
        $("#dynamic_chartdiv").html('');
        $("#dynamic_chartdiv").html('<div id="chartdiv" ></div>');
    
        am5.ready(function() {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");
    
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
        am5themes_Animated.new(root)
        ]);
    
    
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX:true
        }));
    
        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);
    
    
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
        });
    
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation: 0.3,
        categoryField: "category", //add your field name
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
        }));
    
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.3,
        //min: 0,
        renderer: am5xy.AxisRendererY.new(root, {})
        }));
    
    
        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value", //add your field name
        sequencedInterpolation: true,
        categoryXField: "category", //add your field name
        tooltip: am5.Tooltip.new(root, {
        labelText:"{valueY}"
        })
        }));
    
        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
        series.columns.template.adapters.add("fill", function(fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
    
        series.columns.template.adapters.add("stroke", function(stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
        
        // Set data
        //static data
        /*
        var data = [{
          country: "USA",
          value: 2025
        }, {
          country: "China",
          value: 1882
        }, {
          country: "Japan",
          value: 1809
        }];
        */
    
        //dynamic data pass
        var chart_data = [];
        var person = [{firstName:"January", lastName:"Doe", age:46}];
        getUserInfo(<?php echo json_encode($phpArray); ?>)
    function getUserInfo(userObj){
        // alert(userObj[1].name);

        for(var i = 0; i < userObj.length; i++)
        {
        chart_data.push({ 
        "category" : userObj[i].month,
        "value"  : parseInt(userObj[i].amount)
        });
        }
        console.log(chart_data);

    }
        
    
        xAxis.data.setAll(chart_data);
        series.data.setAll(chart_data);
    
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);
    
        }); // end am5.ready()
    
        }
        else
        {
        alert(response.msg);
        }
        },
        error: function (xhr, status) {
        console.log('ajax error = ' + xhr.statusText);
        alert(response.msg);
        }
        });
    
    }
    //--- END
    </script>
@endsection