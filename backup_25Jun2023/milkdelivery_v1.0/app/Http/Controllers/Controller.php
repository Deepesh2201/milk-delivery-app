<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /* public function index(){

        if(Auth::user()){
            if(Auth::user()->role_id == 102){
                return view('admin.dashboard');
            }else if(Auth::user()->role_id == 2){
                return redirect()->intended(route('emp.profile.show', Auth::user()->id ))->with('message', "Login Successfully.");
                // return redirect()->back()->with('message', 'Sorry, you dont have permission to access this page.');
                
            }else{
                Auth::logout();
                return redirect()->back()->with('message', 'Sorry, You are not authorized to access this page.');
            }
        } else {
            return redirect()->to('/');
        }
    } */
}
