<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // $this->auth = auth()->user() ? (auth()->user()->role === 'admin') : false;

        // if($this->auth === true)
        // {
        //     return $next($request);
        // }

        // return redirect()->back()->with('error', 'Access denied. Login to continue.');
        if(Auth::user()->role === 'admin') {
            return $next($request);
        }
        else {
            return response()->json(['error' => 'Unauthorized']);
        }
        
    }
}
