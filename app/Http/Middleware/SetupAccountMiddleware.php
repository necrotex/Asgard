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
        /*if($request->session()->has('recuritment_code')) {

        }


        if(count(Auth::user()->characters) == 0) {
            flash('Please add a character!')->warning();

            return redirect()->route('characters.index', Auth::user()->id);
        }

        if(!Auth::user()->main_character) {
            $message = "Please select your <a href=" . route('profile.show', Auth::user()) . ">main character!</a>";

            flash($message)->important()->warning();

            return redirect()->route('profile.show', Auth::user()->id);
        }


        */
        return $next($request);
    }
}
