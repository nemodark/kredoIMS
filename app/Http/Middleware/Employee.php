<?php

namespace App\Http\Middleware;

use Closure;

class Employee
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
        if(Auth::user()->role === 'manager' || Auth::user()->role === 'employee') {
            return $next($request);
        }
        else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }
}
