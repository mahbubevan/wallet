<?php

namespace App\Http\Middleware;

use Closure;

class IfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (auth()->guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
