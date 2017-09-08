<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIfAdmin
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
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        } else {
            return $next($request);
        }
    }
}
