<?php

namespace App\Http\Controllers\Common\Shop;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SalesProductRelation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = Sale::orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.shop.sales.tbody', compact('items'));
        }

        return view('admin.modules.shop.sales.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = Sale::query();
        if ($request->name != null && $request->name != '') {
            
            $item->whereHas('salesman', function ($query1) use ($request) {
                $query1->whereRaw("name like '$request->name%' ")
                ->orWhere('email', 'like', $request->name . '%')
                ->orWhere('contact_number', 'like', $request->name . '%');
            })->orWhereHas('customer', function ($qry) use ($request) {
                $qry->whereRaw("name like '$request->name%' ")
                ->orWhere('email', 'like', $request->name . '%')
                ->orWhere('contact_number', 'like', $request->name . '%');
            });
        }

        $newitem = $item->orderBy('id', 'desc')->paginate(mypagination());

        if (request()->ajax()) {
           return view('admin.modules.shop.sales.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.shop.sales.list', [
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
        return view('admin.modules.shop.sales.add', [
            "sale" => false,
            "customers" => User::where('role_id', config('constants.userTypes.customer'))->get(),
            "item" => false,
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
        
        $this->validate($request, [
            'salesman' => 'required|integer|exists:users,id,role_id,2',
            'customer' => 'required|integer|exists:users,id,role_id,1',
            'product.*' => 'required|integer|required_with:qty.*', 
            'qty.*'    =>  'required|required_with:product.*|numeric', 
            'price.*'    =>  'required|required_with:product.*|numeric', 
        ],[],
        [
            'product.*' => 'Product',
            'qty.*' => 'Quantity',
            'price.*' => 'Unit Price',
        ]); 
        DB::beginTransaction();
        try {
            if ($request->id){
                $item =  Sale::find($request->id);
                $msg =  "Sale Updated";
                
            } else {
                $item = new Sale();
                $msg =  "Sale Added" ;
                
            } 
            $item->salesman_id = $request->salesman;
            $item->customer_id = $request->customer;
            $item->save();
            if($request->id){
                SalesProductRelation:: where('sale_id', $request->id)->delete();
            }
            foreach($request->product as $key => $product){
                $line = new SalesProductRelation();   
                $line->sale_id       = $item->id;        
                $line->product_id    = $product;
                $line->qty           = $request->qty[$key];
                $line->unit_price    = $request->price[$key];
                $line->total_price   = $request->qty[$key] * $request->price[$key];
                $line->save();
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
        return view('admin.modules.shop.sales.add', [
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
       return back()->with('message', __('l.sale').' '.__('l.deleted'));
              
    } 
    
}
