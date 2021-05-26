<?php

namespace App\Http\Middleware;

use Closure;

class Leader
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
        if(auth()->user()->role == 3){
            return $next($request);
        }
   
        return redirect('dashboard')->with('error',"Only students can access!");
    }
}