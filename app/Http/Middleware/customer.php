<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()&&Auth::user()->membership ==="customer"){
            return $next($request);
        }else{
            return redirect('/login')->with("error","you don't have permissions to perform this action");
        }/*elseif (Auth::check()&&Auth::user()->membership === "customer"){

        }*/
        return $next($request);
    }
}
