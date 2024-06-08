<?php

namespace App\Http\Controllers\Common\Loading;

use App\Http\Controllers\Controller;
use App\Models\Onloading;
use App\Models\ProductOnloadingRelation;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\StartOnloading;
use Validator;
use Redirect;

class OnloadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        $items = Onloading::where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.on-loading.tbody', compact('items'));
        }

        return view('user.modules.loading.on-loading.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        // $salesmans = Onloading::whereBetween('created_at', [$from, $to])->pluck('salesman_id');

        $item = Onloading::query();
        $item->where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to]);
        if ($request->name != null && $request->name != '') {
            $item->whereHas('lines', function ($query1) use ($request) {
                $query1->orWhere('batch_no', $request->name);
                $query1->orWhereHas('onloadingProducts', function ($q) use ($request) {
                    $q->whereRaw("name like '$request->name%' ")
                        ->orWhere('group', 'like', $request->name . '%')
                        ->orWhere('sap_id', 'like', $request->name . '%');
                });
            });
        }

        $newitem = $item->orderBy('id', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.on-loading.tbody', ['items' => $newitem]);
        }

        return view('user.modules.loading.on-loading.list', [
            'items' => $newitem,
            'name'  => $request->name,
        ]);
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        $salesmans = Onloading::whereBetween('created_at', [$from, $to])->pluck('salesman_id');
        return view('user.modules.loading.on-loading.add', [
            "salesmans" => User::where('role_id', config('constants.userTypes.salesman'))->whereNotIn('id', $salesmans)->get(),
            "onloading" => false,
            "item" => false,
        ], compact('user_id', 'user_name'));
        // return view("user.modules.loading.on-loading.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datenow = date('Y-m-d'); // 2023-06-23

        $sales = Onloading::where('salesman_id', Auth::id())->whereDate('created_at', $datenow)->get();


        $this->validate(
            $request,
            [
                // 'salesman' => 'required|integer|exists:users,id',
                'warehouse' => 'required',
                'product.*' => 'required|string|required_with:qty.*',
                'batch_no.*' => 'required|string|required_with:product.*',
                'group.*' => 'required|string|required_with:group.*',
                'qty.*'    =>  'required|required_with:product.*|numeric',
            ],
            [],
            [
                'product.*' => 'Product',
                'batch_no.*' => 'Batch no.',
                'qty.*' => 'Quantity',
                'group.*' => 'Group',
            ]
        );

        DB::beginTransaction();
        try {
            if ($request->id) {
                $item =  Onloading::find($request->id);
                $msg =  "Onloading Updated";
            } else {


                $item = new Onloading();
                $msg =  "Onloading Added";
            }
            // Logged In User Id
            $item->salesman_id = Auth::user()->id;
            // ----------------
            $item->warehouse = $request->warehouse;
            $item->is_approved = 0;
            if ($sales->count() > 0) {
                $msg = "Onload already created for today";
                Session::flash('message', $msg);
                return response()->json([
                    'redirect' => route('user.onloading.index'),
                ]);
            }

            $item->save();
            if ($request->id) {
                ProductOnloadingRelation::where('onloading_id', $request->id)->delete();
            }
            foreach ($request->product as $key => $product) {
                $line = new ProductOnloadingRelation();
                $line->onloading_id = $item->id;
                $line->product_id   = $key;
                $line->batch_no   = $request->batch_no[$key];
                $line->qty   = $request->qty[$key];
                $line->save();
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('user.onloading.index'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        $salesmans = Onloading::whereBetween('created_at', [$from, $to])->pluck('salesman_id');

        return view('user.modules.loading.on-loading.add', [
            "salesmans" => User::where('role_id', config('constants.userTypes.salesman'))->whereNotIn('id', $salesmans)->get(),
            "onloading" => Onloading::find($id),
            "item" =>  ProductOnloadingRelation::where('onloading_id', $id)->get(),
        ], compact('user_id', 'user_name'));
    }


    public function startonloading($id)
    {
        $onloading = Onloading::find($id);
        $onloading->is_approved = 2;
        $onloading->save();
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        $items = Onloading::orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.on-loading.tbody', compact('items'));
        }

        return view('user.modules.loading.on-loading.list', [
            'items' => $items,
        ]);
    }

    // To pass data into javascript function
    public function startonload($id)
    {
        $onloadid = Onloading::find($id);
        return response()->json([
            'status' => 200,
            'onloadid' => $onloadid,
        ]);
    }
    public function driverdetails(Request $request)
    {
        $msg =  "Onloaded successfully";

        $request->validate(
            [
                'drivername' => 'required',
                'vehicleno' => 'required',
                'startkm' => 'required'
            ],


        );

        $soloading = new StartOnloading;
        // $soloading->onloading_id = Auth::user()->id;
        $soloading->onloading_id = $request->onloadingid;
        $soloading->offloading_id = 0;
        $soloading->driver_name = $request->drivername;
        $soloading->vehicle_no = $request->vehicleno;
        $soloading->start_km = $request->startkm;
        $soloading->end_km = 0;
        $soloading->save();




        $onloading = Onloading::find($request->onloadingid);
        $onloading->is_approved = 2;
        $onloading->save();
        Session::flash('message', $msg);
        $from = date('Y:m:d');
        $to = date('Y:m:d 23:59:59');
        $items = Onloading::orderBy('created_at', 'desc')->whereBetween('created_at', [$from, $to])->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.on-loading.tbody', compact('items'));
        }

        return view('user.modules.loading.on-loading.list', [
            'items' => $items,
        ]);
    }
}
