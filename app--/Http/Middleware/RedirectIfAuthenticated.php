<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('customer')->check() && Auth::guard('web')->check()) {
            return $next($request);
        }
        if (Auth::guard($guard)->check()) {
            if (auth()->guard('web')->user()) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
