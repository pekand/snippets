<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Configuration extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // set config
        config([
            'app.timezone' => 'UTC'
        ]);


        return [
            'environment' => App::environment(),
            'isLocal' => App::environment(['local']),
            'isLocalOrDev' => App::environment('local', 'staging'),
            'env' =>env('APP_ENV', false),
            'timezone' =>config('app.timezone'),
        ];
    }
}
