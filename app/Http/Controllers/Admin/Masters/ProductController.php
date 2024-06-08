<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use App\Imports\BrandImport;
// use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = Product::orderBy('group')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.masters.product.tbody', compact('items'));
        }

        return view('admin.modules.masters.product.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = Product::query();
        if (isset($request->name)) {
            $item->where('name', 'like', '%' . $request->name . '%');
        }
       
        $newitem = $item->orderBy('name')->paginate(mypagination());

        if (request()->ajax()) {
           return view('admin.modules.masters.product.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.masters.product.list', [
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
        return view('admin.modules.masters.product.add', [
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
            'name' => 'required|string|max:255|unique:products,name,' . $request->id . ',id,deleted_at,NULL',
            'group' => 'required|string|max:255',
            'sap_id' => 'required|string|max:255',
            'unit_price' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            ]);

        if ($request->id){
            $item =  Product::find($request->id);
            $msg =  __('l.product').' Updated';
            
        } else {
            $item = new Product();
            $msg =  __('l.product').' Added' ;
            
        } 
        $item->name = $request->name;
        $item->group = $request->group;
        $item->sap_id = $request->sap_id;
        $item->unit_price = $request->unit_price;
        $item->description = $request->description;
        $item->save();
        \Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('product.index'),
        ]); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.modules.masters.product.add', [
            "item" =>  Product::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            'redirect' => route('product.index'),
        ]); 
        //
    }

    public function delete($id)
    {
        $delete = Product::find($id)->delete();
        if($delete){
            return back()->with('message', __('l.product').' '.__('l.deleted'));

            return response()->json([
                'success' => true,
                'message' =>  __('l.product').' '.__('l.deleted'),
                'redirect' => route('product.index'),
            ]); 
        }else{
            return response()->json([
                'success' => false,
                'message' =>  'Something went wrong please try again.',
                'redirect' => route('product.index'),
            ]); 
        }        
    } 

    public function status($id, $status)
    {
        $item =  Product::where('id', $id)->where('status', $status)->first();        
        if($item){
            $main_status =  ($status == 1) ? '0' : '1';

            $item->status = $main_status; 
            $item->save();

            $msg = ($main_status == 1) ? 'has been Activated.' : 'has been Deactivated.'; 
        }
        return redirect()->back()->with('message', __('l.product').' '.$msg);
    }
    
}
