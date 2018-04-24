<?php

namespace Asgard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetupAccountMiddleware
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
        //@todo: do we need this anymore?
        return $next($request);
    }
}
