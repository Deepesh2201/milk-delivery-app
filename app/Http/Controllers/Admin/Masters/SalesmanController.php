<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
// use App\Imports\BrandImport;
// use Maatwebsite\Excel\Facades\Excel;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $items = User::where('role_id', 2)->orderBy('name')->paginate(mypagination());
        if (request()->ajax()) {
            return view('admin.modules.salesman.tbody', compact('items'));
        }

        return view('admin.modules.salesman.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $item = User::query();
        $item->where('role_id', 2);
        if ($request->name != null && $request->name != '') {
            
            $item->where(function ($query1) use ($request) {
                $query1->whereRaw("name like '$request->name%' ")
                ->orWhere('email', 'like', $request->name . '%')
                ->orWhere('contact_number', 'like', $request->name . '%');
            });
        }

        $newitem = $item->orderBy('name')->paginate(mypagination());

        if (request()->ajax()) {
           return view('admin.modules.salesman.tbody', ['items' => $newitem]);
        }
        
        return view('admin.modules.salesman.list', [
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
        return view('admin.modules.salesman.add', [
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
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255|unique:users,email,
            ' . $request->id . ',id,deleted_at,NULL',
            'target'=>'required|integer|max:5000',
            'sap_id' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'snumber' => 'required|string|max:20', 
            'password' => 'nullable|sometimes|required_with:password_confirmation|string|min:8|max:20|confirmed',
            'password_confirmation' => 'nullable|sometimes|required_with:password|string|min:8|max:20',
        ],['password.min' => 'Your password must be more than 8 characters'],
        [
            'sname' => 'Salesman name',
            'snumber' => 'Contact number',
        ]);
        /* if(!$request->id){
            $this->validate($request, [
                'password' => 'required|string|min:8|max:20|confirmed',
                'password_confirmation' => 'required|string|min:8|max:20',
            ],[
                'password.min' => 'Your password must be more than 8 characters',
            ]);
        } */
        if ($request->id){
            $item =  User::find($request->id);
            $msg =  "Salesman Updated";
            $item->password = Hash::make($request->password);
            
        } else {
            $item = new User();
            $msg =  "Salesman Added" ;
            $item->password = Hash::make($request->password);
            
        } 
        $item->name = $request->name;
        $item->monthly_target = $request->target;
        $item->email = $request->email;
        $item->contact_number = $request->snumber;
        $item->role_id = 2; //Salesman
        $item->sap_id = $request->sap_id;
        $item->status = 1;
        
        $item->save();
        \Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' =>  $item,
            'redirect' => route('salesman.index'),
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
        return view('admin.modules.salesman.add', [
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
            'redirect' => route('salesman.index'),
        ]); 
        //
    }

    public function delete($id)
    {
        $delete = User::find($id)->delete();
        if($delete){
            return back()->with('message', 'Salesman '.__('l.deleted'));
        }else{
            return back()->with('message',  'Something went wrong please try again.');
             
        }        
    } 
       
}
