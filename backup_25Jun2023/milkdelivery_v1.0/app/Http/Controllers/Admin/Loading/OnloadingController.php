<?php

namespace App\Http\Controllers\Admin\Loading;
use App\Http\Controllers\Controller;
use App\Models\Onloading;
use App\Models\ProductOnloadingRelation;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnloadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = Onloading::orderBy('created_at', 'desc')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.loading.on-loading.tbody', compact('items'));
        }

        return view('admin.modules.loading.on-loading.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = Onloading::query();
        if ($request->name != null && $request->name != '') {            
            $item->whereHas('salesman', function ($query1) use ($request) {
                $query1->whereRaw("name like '$request->name%' ")
                ->orWhere('email', 'like', $request->name . '%')
                ->orWhere('contact_number', 'like', $request->name . '%');
            });
        }

        $newitem = $item->orderBy('id', 'desc')->paginate(mypagination());

        if (request()->ajax()) {
           return view('admin.modules.loading.on-loading.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.loading.on-loading.list', [
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
        return view('admin.modules.loading.on-loading.add', [
            "onloading" => false,
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
                $item =  Onloading::find($request->id);
                $msg =  "Onloading Updated";
                
            } else {
                $item = new Onloading();
                $msg =  "Onloading Added" ;
                
            } 
            $item->salesman_id = $request->salesman;
            $item->save();
            if($request->id){
                ProductOnloadingRelation::where('onloading_id', $request->id)->delete();
            }
            foreach($request->product as $key => $product){
                $line = new ProductOnloadingRelation();   
                $line->onloading_id = $item->id;        
                $line->product_id   = $product;
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
            'redirect' => route('onloading.index'),
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
        return view('admin.modules.loading.on-loading.add', [
            "onloading" => Onloading::find($id),
            "item" =>  ProductOnloadingRelation::where('onloading_id', $id)->get(),
        ]);
    }     

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $onloading = Onloading::find($id);
            $onloading->lines()->delete();
            $onloading->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('message',  $ex->getMessage());            

        }
       return back()->with('message', __('l.onloading').' '.__('l.deleted'));
              
    } 
    
}
