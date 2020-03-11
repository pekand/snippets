<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class LogRequestServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        if (App::environment('local')) {
            $this->app->make(\Illuminate\Contracts\Http\Kernel::class)
            ->pushMiddleware(\App\Http\Middleware\LogRequestMiddleware::class);
        }
    }
}
