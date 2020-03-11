<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class LogQueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {       
        if (App::environment('local')) {
            DB::listen(function ($query) {
                $requestUid = config('requestUid', null);
                Log::channel('query')->info("Query", [
                    'requestUid' => $requestUid,
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time,
                ]);
            });
        }
    }
}
