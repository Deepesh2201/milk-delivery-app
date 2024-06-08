<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\EmpGrade;
use App\Models\Designation;
use App\Models\Calendar;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //showing listing
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('user.index')->with('message', __('l.auth-error'));
        }
        $items = User::where('role_id','!=', Auth::user()->role_id)->orderBy('id', 'desc')->paginate(mypagination());
       //dd($items);
        if (request()->ajax()) {
            return view('admin.modules.users.tbody', compact('items'));
        }
        return view('admin.modules.users.list', [
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {     
        if (Auth::user()->role_id != 1) {
            return redirect()->route('user.index')->with('message', __('l.auth-error'));
        }
        $items = User::query();
        $items->where('role_id', '!=', Auth::user()->role_id);

        if ($request->name != null && $request->name != '') {

            $items->where(function ($query1) use ($request) {
                $query1->whereRaw("concat(first_name, ' ', last_name) like '%$request->name%' ")
                ->orWhere('email', 'like', '%' . $request->name . '%')
                ->orWhere('mobile_number', 'like', '%' . $request->name . '%');
            });
        } 
       
        $newItem =  $items->orderBy('first_name')->paginate(mypagination());         

        if (request()->ajax()) {
            return view('admin.modules.users.tbody',[
                'items' => $newItem,
            ]); 
        }
        return view('admin.modules.users.list', [
            'items' => $newItem,
            'name' => $request->name,
        ]);
    }

    //add list
    public function create()
    {
        return view('admin.modules.users.add', [
            "item" => false,  
            "users" => User::where('status', 1)->get(['id','first_name', 'last_name']),  
            "grades" => EmpGrade::get(['id','name']),            
            "designations" => Designation::get(['id','name']),       
            "calendars" => Calendar::get(['id','name', 'calendar_year']),       
        ]);  
    }

    //strore data
    public function store(Request $request)
    { 
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('message', 'Sorry, you are not allowed to create any user.');
        } 
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id . ',id,deleted_at,NULL',
            'first_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'last_name' => 'nullable|regex:/^[a-zA-Z ]+$/u|max:255',
            'designation' => 'required|numeric',
            'grade' => 'required|numeric',
            'country_code' => 'required|string|max:25',             
            'mobile' => 'required|numeric|digits:10',             
            'reporting_manager' => 'required|numeric',             
            'address' => 'nullable|max:255',  
            'joining_date' => 'required|date|date_format:Y-m-d|before_or_equal:today', 
            'calendar' => 'nullable|integer', 

        ],[
             'mobile.required' => 'Mobile number is required',
             'mobile.numeric' => 'Mobile number is must be numeric',
        ],
           [
               'grade' => 'Employee Grade'
           ]
        );
        
        if(!$request->id){
            $this->validate($request, [
                'password' => 'required|string|min:8|max:20|confirmed',
                'password_confirmation' => 'required|string|min:8|max:20',
            ],[
                'password.min' => 'Your password must be more than 8 characters',
            ]);
        }

        if ($request->id) {
            $item = User::find($request->id);
            
            if (empty($item)) {
                return redirect()->route('user.index')->with('message', 'Employee not found!');
            } 
            if($item->email_verified_at == '') { 
                $item->email_verified_at =  date('Y-m-d H:i:s');
            }
            $msg = 'Employee Updated.';

        } else {             
            $users = User::withTrashed()->count() + 1;
            $item = new User();            
            $item->emp_id       = 'PPN00'.$users;
            $item->role_id      = 2;
            $item->status       = 1;
            $item->email_verified_at = date('Y-m-d H:i:s');
            
            $item->password     = Hash::make($request->password);
            $msg = 'Employee Added.';
        }
        $item->joining_date = $request->joining_date;
        $item->calendar_id = $request->calendar;
        $item->first_name   = $request->first_name;
        $item->last_name    = $request->last_name;
        $item->designation_id  = $request->designation;
        $item->emp_grade_id    = $request->grade;
        $item->email        = $request->email;
        $item->reporting_to = $request->reporting_manager;
        $item->mobile_number  = $request->mobile;
        $item->country_code = $request->country_code;
        
        $item->save(); 
        if(!$request->id){
            $item['org_password'] = $request->password;
            \Mail::to($item->email)->send(new \App\Mail\WelcomeMail($item));
        }
        \Session::flash('message', $msg);
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'redirect' => route('user.index'),
        ]);
    }

    //edit list
    public function edit($id)
    { 
        if (Auth::user()->role_id != 1) {
            return redirect()->route('user.index')->with('message', __('l.auth-error'));
        }
        $item = User::find($id); 
        return view('admin.modules.users.add', [
            "item" => $item,            
            "users" => User::where('status', 1)->get(['id','first_name', 'last_name']),            
            "grades" => EmpGrade::get(['id','name']),            
            "designations" => Designation::get(['id','name']),  
            "calendars" => Calendar::get(['id','name', 'calendar_year']),           
        ]);
    }
    public function status($id, $status)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('user.index')->with('message', __('l.auth-error'));
        }
        $item = User::find($id);
        if (empty($item)) {
            return redirect()->route('user.index')->with('message', 'Employee not found!');
        }
        
        if ($status == 1) {
            $item->status = '0';
            $item->termination_date = null;
            
        } else {
            $item->status = '1';
            $item->termination_date = date('Y-m-d');
        }
        $item->save();
        $message1 = $item->status == 1 ? 'Activated' : 'Deactivated';

        $key = $item->device_token;
        return redirect()->back()->with('message', 'User '.$message1);
    }
    //delete list
    public function delete($id)
    {  
        if (Auth::user()->role_id != 1) {
            return redirect()->route('user.index')->with('message', __('l.auth-error'));
        } 
        $item = User::find($id);

        if (empty($item)) {
            return redirect()->route('user.index')->with('message', 'Employee not found!');
        }  

        $item->delete();

        return redirect()->back()->with('message', 'Employee Deleted');
    }

    public function show($id)
    { 
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->route('user.index')->with('message', 'Employee not found!');
        } 
        return view('admin.modules.users.view', [
            "item" => $user,
        ]);
    }

}
