<?php

namespace App\Http\Controllers\Common\Shop;
use App\Http\Controllers\Controller;
use App\Models\Returns;
use App\Models\Sale;
use App\Models\SaleReturnProductRelation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReturnProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = Returns::orderBy('id', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.shop.returns.tbody', compact('items'));
        }

        return view('admin.modules.shop.returns.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = Returns::query();
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
           return view('admin.modules.shop.returns.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.shop.returns.list', [
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
        return view('admin.modules.shop.returns.add', [
            "return" => false,
            "sales" => Sale::get(),
            "customers" => User::where('role_id', 1)->get(),
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
            'sale' => 'required|integer|exists:sales,id',
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
                $item =  Returns::find($request->id);
                $msg =  "Product Return Updated";
                
            } else {
                $item = new Returns();
                $msg =  "Product Return Added" ;
                
            } 
            $item->salesman_id = $request->salesman;
            $item->customer_id = $request->customer;
            $item->save();
            // dd($item->id);
            if($request->id){
                SaleReturnProductRelation:: where('returns_id', $request->id)->delete();
            }
            foreach($request->product as $key => $product){
                $line = new SaleReturnProductRelation();   
                $line->returns_id    = $item->id;        
                $line->sale_id       = $request->sale;        
                $line->product_id    = $product;
                $line->qty           = $request->qty[$key];
                $line->unit_price    = $request->price[$key];
                $line->total_price   = $request->qty[$key] * $request->price[$key];
                $line->save();
            } 
            $order_cost = SaleReturnProductRelation::where('returns_id', $item->id)->sum('total_price');
            Returns::where('id', $item->id)->update(['total_amount' => $order_cost]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
       
        \Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('return-product.index'),
        ]); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //dd('view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.modules.shop.returns.add', [
            "return" => Returns::find($id),
            "sales" => Sale::get(),
            "customers" => User::where('role_id', config('constants.userTypes.customer'))->get(),
            "salesmans" => User::where('role_id', 2)->get(),
            "item" =>  SaleReturnProductRelation::where('returns_id', $id)->get(),
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
            $offloading = Returns::find($id);
            $offloading->lines()->delete();
            $offloading->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('message',  $ex->getMessage());            

            // return response()->json(['error' => $ex->getMessage()], 500);
        }
       return back()->with('message', __('l.offloading').' '.__('l.deleted'));
              
    } 

    public function status($id, $status)
    {
        $item =  User::where('id', $id)->where('status', $status)->first();        
        if($item){
            $main_status =  ($status == 1) ? '0' : '1';

            $item->status = $main_status; 
            $item->save();

            $msg = ($main_status == 1) ? 'has been Activated.' : 'has been Deactivated.'; 
        }
        return redirect()->back()->with('message', 'Account '.$msg);
    }
    
}
