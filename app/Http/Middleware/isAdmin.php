<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); 
         if($user && $user->role == 'admin'){ 
             return $next($request); 
            } 
        return redirect(route('dashboard')); 

    }
    
    /*
    public function handle(Request $request, Closure $next) { 
        $user = Auth::user(); 
        if($user && $user->role == 'admin'){ 
            return $next($request); 
           } 
            return redirect(route('dashboard')); 
    } */

}
