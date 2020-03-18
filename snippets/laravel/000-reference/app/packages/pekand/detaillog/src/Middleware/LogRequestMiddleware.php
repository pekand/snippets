<?php

namespace Pekand\DetailLog\Middleware;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Closure;

/*
    Log all requsts and responsies
*/
class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $start = null;

        if (App::environment('local')) {
            $start = microtime(true);            
            Log::channel('access')->info("Request", [
                'uid' => config('requestUid', null),
                'time_elapsed_start' => $start,
                'request' => $request
            ]);
        }

        $response = $next($request);

        if (App::environment('local')) {
            Log::channel('access')->info("Response", [
                'uid' => config('requestUid', null),
                'time_elapsed_secs' => microtime(true) - $start,
                'response' => $response,
            ]);
        }
                
        return $response;
    }
}
