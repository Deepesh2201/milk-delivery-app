<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware\SalesmanControl;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin/modules/reports/salesreport');
        
    }
    public function search(Request $request)
    {
        
        
        // $query = $request->input('startdate');
        // dd($query);
        
        $data = array(
			'customerid' => $request->input('customerselectid'),
			'salesmanid' => $request->input('salesmanselect'),
			'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate')
		);
        return view('admin/modules/reports/searched-sales-results')->with($data);

    }
    public function salesreturnlist(){
        return view('admin/modules/reports/salesreturnreport');
    }
    public function salesreturnsearchsearch(Request $request)
    {
        
        
        // $query = $request->input('startdate');
        // dd($query);
        
        $data = array(
			'customerid' => $request->input('customerselectid'),
			'salesmanid' => $request->input('salesmanselect'),
			'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate')
		);
        return view('admin/modules/reports/searched-sales-return-results')->with($data);

    }
    public function salestargetlist(){
        return view('admin/modules/reports/salestargetreport');
    }
    public function salestargetsearch(Request $request)
    {
        
        
        // $query = $request->input('startdate');
        // dd($query);
        
        $data = array(
			'salesmanid' => $request->input('salesmanselect'),
			'year' => $request->input('yearid'),
            'month' => $request->input('monthid')
		);
        return view('admin/modules/reports/searched-target-sales-results')->with($data);

    }
    // Onloading Report
    public function onloadinglist(){
        return view('admin/modules/reports/onloadingreport');
    }
    public function onloadingsearch(Request $request)
    {
        
        
        // $query = $request->input('startdate');
        // dd($query);
        
        $data = array(
			'salesmanid' => $request->input('salesmanselect'),
			'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate')
		);
        return view('admin/modules/reports/searched-onloading-results')->with($data);

    }
    // Offloading Report
    public function offloadinglist(){
        return view('admin/modules/reports/offloadingreport');
    }
    public function offloadingsearch(Request $request)
    {
        
        
        // $query = $request->input('startdate');
        // dd($query);
        
        $data = array(
			'salesmanid' => $request->input('salesmanselect'),
			'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate')
		);
        return view('admin/modules/reports/searched-offloading-results')->with($data);

    }
}
