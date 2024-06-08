<?php

namespace App\Http\Controllers\Common\Shop;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\ProductOnloadingRelation;
use App\Models\SalesProductRelation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Onloading;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Sale::where('salesman_id', Auth::id())->orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.shop.sales.tbody', compact('items'));
        }

        return view('user.modules.shop.sales.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = Sale::query();
        $item->where('salesman_id', Auth::id());
        if ($request->name != null && $request->name != '') {

            $item->whereHas('customer', function ($qry) use ($request) {
                $qry->whereRaw("name like '$request->name%' ")
                    ->orWhere('email', 'like', $request->name . '%')
                    ->orWhere('contact_number', 'like', $request->name . '%');
            });
        }

        $newitem = $item->orderBy('id', 'desc')->paginate(mypagination());

        if (request()->ajax()) {
            return view('user.modules.shop.sales.tbody', ['items' => $newitem]);
        }

        return view('user.modules.shop.sales.list', [
            'items' => $newitem,
            'name'  => $request->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.modules.shop.sales.add', [
            "sale" => false,
            "customers" => User::where('role_id', config('constants.userTypes.customer'))->get(),
            "item" => false,
            // "onloading" => Onloading::where('id',73),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // echo $request;
        // =====================
        $datenow = date('Y-m-d'); // 2023-06-23

        $loading = Onloading::where('salesman_id', Auth::id())->whereDate('created_at', $datenow)->where('is_approved', '2')->get();
        // echo "<pre>";
        // $mainloading = $loading->toArray();
        // foreach ($mainloading as $chkloading) {
        //     $onloadId = $chkloading['id'];
        //     // dd($chkloading['id']);
        // }

        if ($loading->count() < 1) {
            $msg = "No items to sale";
            Session::flash('message', $msg);
            return response()->json([
                'redirect' => route('sale.index'),
            ]);
        }
        // $itemsloading = ProductOnloadingRelation::where('onloading_id', $onloadId)->get();
        // foreach($request->avail as $availqty){
        //     foreach($request->qty as $qty){
        //         if($availqty > $qty){
        //             $msg = "Order quantity can't be more than available quantity";
        //             Session::flash('message', $msg);
        //             return response()->json([
        //                 'redirect' => route('sale.index'),
        //             ]);
                    
        //                         }
                
        //     }
            
        // }
        

        // ===============
        $request['salesman'] = Auth::id();
        $this->validate(
            $request,
            [
                'salesman' => 'required|integer|exists:users,id,role_id,' . config('constants.userTypes.salesman'),
                'customer' => 'required|integer|exists:users,id,role_id,' . config('constants.userTypes.customer'),
                'product.*' => 'required|string|required_with:qty.*',
                'batch_no.*' => 'required|string|required_with:product.*',
                'group.*' => 'required|string|required_with:product.*',
                'qty.*'    =>  'required|required_with:product.*|numeric',
                'price.*'    =>  'required|required_with:product.*|numeric',
            ],
            [],
            [
                'product.*' => 'Product',
                'qty.*' => 'Quantity',
                'price.*' => 'Unit Price',
                'batch_no.*' => 'Batch no.',
                'group.*' => 'Group',
            ]
        );
        DB::beginTransaction();
        try {
            if ($request->id) {
                $item =  Sale::find($request->id);
                $msg =  "Sale Updated";
            } else {
                $item = new Sale();
                $msg =  "Sale Added";
            }
            $item->salesman_id = $request->salesman;
            $item->customer_id = $request->customer;
            $item->save();
            if ($request->id) {
                SalesProductRelation::where('sale_id', $request->id)->delete();
            }
            foreach ($request->product as $key => $product) {
                $line = new SalesProductRelation();
                $line->sale_id       = $item->id;
                $line->product_id    = $key;
                $line->batch_no      = $request->batch_no[$key];
                $line->qty           = $request->qty[$key];
                $line->unit_price    = $request->price[$key];
                $line->total_price   = $request->qty[$key] * $request->price[$key];
                $line->save();
                
                // DB::table('product_onloading_relations')->where('product_id','1')->where('onloading_id','73')->decrement('qty', $request->qty[$key]); 
                // DB::table('product_onloading_relations')->where('product_id','1')->where('onloading_id','73')->decrement('qty', $request->qty[$key]); 
            
                
            
            }
            $order_cost = SalesProductRelation::where('sale_id', $item->id)->sum('total_price');
            Sale::where('id', $item->id)->update(['total_amount' => $order_cost]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('sale.index'),
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
        return view('user.modules.shop.sales.add', [
            "sale" => Sale::find($id),
            "customers" => User::where('role_id', config('constants.userTypes.customer'))->get(),
            "item" =>  SalesProductRelation::where('sale_id', $id)->get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'success' => false,
            'message' =>  'Something went wrong please try again.',
            'redirect' => route('offloading.index'),
        ]);
        //
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $sale = Sale::find($id);
            $sale->lines()->delete();
            $sale->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('message',  $ex->getMessage());

            // return response()->json(['error' => $ex->getMessage()], 500);
        }
        return back()->with('message', __('l.sale') . ' ' . __('l.deleted'));
    }
}
