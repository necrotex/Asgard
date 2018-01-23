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
        if(count(Auth::user()->characters) == 0) {
            flash('Please add a character!')->important()->warning();

            return redirect()->route('characters.index', Auth::user()->id);
        }

        if(!Auth::user()->main_character) {
            flash('Please select your main character!')->important()->warning();

            return redirect()->route('profile.show', Auth::user()->id);
        }

        return $next($request);
    }
}
