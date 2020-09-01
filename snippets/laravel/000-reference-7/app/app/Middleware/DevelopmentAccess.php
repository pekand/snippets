<?php

namespace App\Middleware;

use Closure;

class DevelopmentAccess
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
        if (app()->environment() === 'production') {
            return abort(403, 'You are not authorized to access this');
        }

        return $next($request);
    }
}
