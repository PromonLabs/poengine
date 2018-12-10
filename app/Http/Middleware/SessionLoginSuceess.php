<?php

namespace App\Http\Middleware;

use Closure;

class SessionLoginSuceess
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
        if (session()->has("loginsuccess") && $request->session()->get('loginsuccess')==true) {
            return $next($request);
        }
        return redirect('/');
    }
}
