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
        if(\auth()->user()->characters->count() > 0)  {
            if(!\auth()->user()->mainCharacter) {
                flash('Please select your main character!')->warning()->important();

                if(!in_array(\Route::currentRouteName(), ['profile.show', 'profile.update'])) {
                    return redirect()->route('profile.show', auth()->user());
                }
            }

        }


        return $next($request);
    }
}
