<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use App\Imports\BrandImport;
// use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = User::where('role_id', 1)->orderBy('name')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.masters.customer.tbody', compact('items'));
        }

        return view('admin.modules.masters.customer.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = User::query();
        $item->where('role_id', config('constants.userTypes.customer'));
        if ($request->name != null && $request->name != '') {

            $item->where(function ($query1) use ($request) {
                $query1->whereRaw("name like '%$request->name%' ")
                ->orWhere('contact_name', 'like', '%' . $request->name . '%')
                ->orWhere('contact_number', 'like', '%' . $request->name . '%');
            });
        } 
              
        $newitem = $item->orderBy('name')->paginate(mypagination());

        if (request()->ajax()) {
           return view('admin.modules.masters.customer.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.masters.customer.list', [
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
        return view('admin.modules.masters.customer.add', [
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
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255|unique:users,contact_number,' . $request->id . ',id,deleted_at,NULL',
            'sap_id' => 'required|string|max:255',
            'cname' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'cnumber' => 'required|string|max:20', 
        ],[],
        [
            'name' => 'Customer name',
            'cname' => 'Contact name',
            'cnumber' => 'Contact number',
        ]);

        if ($request->id){
            $item =  User::find($request->id);
            $msg =  "Customer Updated";
            
        } else {
            $item = new User();
            $msg =  "Customer Added" ;
            
        } 
        $item->name = $request->name;
        $item->contact_name = $request->cname;
        $item->contact_number = $request->cnumber;
        $item->role_id = 1; //customer
        $item->sap_id = $request->sap_id;
        $item->status = 1;
        
        $item->save();
        \Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('customer.index'),
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
        return view('admin.modules.masters.customer.add', [
            "item" =>  User::find($id),
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
            'redirect' => route('customer.index'),
        ]); 
        //
    }

    public function delete($id)
    {
        $delete = User::find($id)->delete();
        if($delete){
            return back()->with('message', 'Customer '.__('l.deleted'));
        }else{
            return back()->with('message',  'Something went wrong please try again.');
             
        }        
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
