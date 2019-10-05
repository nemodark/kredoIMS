<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role === 'manager' || Auth::user()->role === 'admin') {
            return $next($request);
        }
        else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }
}
