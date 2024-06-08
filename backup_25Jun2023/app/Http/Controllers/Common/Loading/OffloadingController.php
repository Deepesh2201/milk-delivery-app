<?php

namespace App\Http\Controllers\Common\Loading;
use App\Http\Controllers\Controller;
use App\Models\Onloading;
use App\Models\Offloading;
use App\Models\ProductOffloadingRelation;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OffloadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {

        $from = date('Y:m:d'); $to = date('Y:m:d 23:59:59');
        $items = Onloading::where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(mypagination());
        $sales = Sale::where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();
       
        /* $loadingsData = $items->toArray();
        $salesData = $sales->toArray();
// dd($loadingsData, $salesData);
$data = [];
foreach($loadingsData[0] as $k => $val){
    if($k == 'lines'){
        if(count($salesData) >=1 ){
            $salesArr = $salesData[0][$k];
        }
        foreach($val as $key => $value){
            dd($value);
        }
    } 
    // dd($val);
}*/
        // $items = Offloading::orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('user.modules.loading.off-loading.tbody', compact('items', 'sales'));
        }

        return view('user.modules.loading.off-loading.list', [
            'items' => $items,
            'sales' => $sales,
        ]);
    }

    public function search(Request $request)
    {
        $items = Onloading::query();
        $from = date('Y:m:d'); $to = date('Y:m:d 23:59:59');
        $items->where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(mypagination());
        $sales = Sale::where('salesman_id', Auth::id())->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();
      
       
        if ($request->name != null && $request->name != '') {            
            $items->whereHas('lines', function ($q) use ($request) {
                $q->whereRaw("batch_no like '$request->name%' ");
                        
               /*  $q->whereHas('onloadingProducts', function ($q) use ($request){
                    $q->whereRaw("name like '$request->name%' ")
                    ->orWhere('sap_id', 'like', $request->name . '%')
                    ->orWhere('group', 'like', $request->name . '%')
                    ->orWhere('batch_no', 'like', $request->name . '%');
                });  */               
            });
        }

        $newitem = $items->orderBy('id', 'desc')->paginate(mypagination());

        if (request()->ajax()) {
           return view('user.modules.loading.off-loading.tbody', ['items' => $newitem, 'sales'=>$sales]);
        }
        
        return view('user.modules.loading.off-loading.list', [
            'items' => $newitem,
            'sales' => $sales,
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
        return view('user.modules.loading.off-loading.add', [
            "offloading" => false,
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
            'salesman' => 'required|integer|exists:users,id',
            'onloading' => 'required|integer|exists:onloadings,id',
            'product.*' => 'required|integer|required_with:qty.*', 
            'qty.*'    =>  'required|required_with:product.*|numeric', 
        ],[],
        [
            'product.*' => 'Product',
            'qty.*' => 'Quantity',
        ]); 
        
        DB::beginTransaction();
        try {
            if ($request->id){
                $item =  Offloading::find($request->id);
                $msg =  "Offloading Updated";
                
            } else {
                $item = new Offloading();
                $msg =  "Offloading Added" ;
                
            } 
            $item->salesman_id = $request->salesman;
            $item->onloading_id = $request->onloading;
            $item->save();
            if($request->id){
                ProductOffloadingRelation::where('offloading_id', $request->id)->delete();
            }
            foreach($request->product as $key => $product){
                $line = new ProductOffloadingRelation();   
                $line->offloading_id    = $item->id;        
                $line->onloading_id     = $item->onloading_id;        
                $line->product_id       = $product;
                $line->qty              = $request->qty[$key];
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
            'redirect' => route('offloading.index'),
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
        return view('user.modules.loading.off-loading.add', [
            "onloading" => Onloading::get(),
            "offloading" => Offloading::find($id),
            "item" =>  ProductOffloadingRelation::where('offloading_id', $id)->get(),
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
            $offloading = Offloading::find($id);
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
    
}
