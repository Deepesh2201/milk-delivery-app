<?php

namespace App\Http\Middleware;

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
            
            if(Auth::user()->role_id != 2){
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
