<?php

namespace Vendor\Package\Middleware;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Closure;

/*
    Log all requsts and responsies
*/
class PackageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        echo "Middleware: bewfore request<br>";

        $response = $next($request);

        echo "Middleware: after request<br>";
                
        return $response;
    }
}
