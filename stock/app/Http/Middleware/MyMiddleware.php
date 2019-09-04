<?php

namespace stock\Http\Middleware;

use Closure;
use Auth;

class MyMiddleware
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
        return (Auth::guest()) ? redirect("auth/login") : $next($request);
    }
}
