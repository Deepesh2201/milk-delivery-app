<?php

namespace App\Http\Middleware;

use App\Models\Offloading;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SalesmanControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if (Auth::check()) {            
            if(Auth::user()->role_id != config('constants.userTypes.salesman')){
                Auth::logout(); 
                return redirect()->intended(route('login'))->with('message', 'Sorry, you are not authorized to access this page.');
            }
            else{
                if($request->route()->named("sale.*")){
                   $todaysOffloading = Offloading::where('salesman_id', Auth::id())->whereBetween('created_at',[date('Y-m-d'), date('Y-m-d 23:59:59')])->count();
                    if($todaysOffloading >= 1){
                        return redirect()->back()->with('message', 'Sorry, you are not authorized to do more sales for today.');
                    }
                }
                return $next($request);
            } 
        }else {
            return redirect()->to('login');
        } 
        return $next($request);
    }
}
