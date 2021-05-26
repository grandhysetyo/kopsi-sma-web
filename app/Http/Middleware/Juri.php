<?php

namespace App\Http\Middleware;

use Closure;

class Juri
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
        if(auth()->user()->role == 2){
            return $next($request);
        }
   
        return redirect('dashboard')->with('error',"Only asistant can access!");
    }
}