<?php

namespace Asgard\Http\Middleware;

use Closure;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission = null)
    {

        if(auth()->user()->can('permission')) {
            return $next($request);
        }

        //@todo: log unauthorized access or smth

        return abort(403);
    }
}
