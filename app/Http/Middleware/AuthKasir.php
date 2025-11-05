<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthKasir
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('id_user')) {
            return redirect()->route('login')->with('error','Silakan login.');
        }
        return $next($request);
    }
}
