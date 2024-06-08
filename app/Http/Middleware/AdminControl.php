<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check()) {
            
            if(Auth::user()->role_id == 2){
                return redirect()->intended(route('sale.index'));
            }
            else if(!in_array(Auth::user()->role_id, [102, 2])){
                Auth::logout(); 
                return redirect()->intended(route('login'))->with('message', 'Sorry, you are not authorized to access this page.');
            }
            else{
                return $next($request); 
            } 
        }else {
            return redirect()->to('login');
        } 
        return $next($request);
    }
}
