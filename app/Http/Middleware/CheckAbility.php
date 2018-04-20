<?php

namespace Asgard\Http\Middleware;

use Closure;

class CheckAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null|string $ability
     * @return mixed
     */
    public function handle($request, Closure $next, ?string $ability = null)
    {

        if(auth()->user()->can($ability)) {
            return $next($request);
        }

        //@todo: log unauthorized access or smth

        return abort(403);
    }
}
