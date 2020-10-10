<?php

namespace Pekand\DetailLog\Providers;


use Illuminate\Support\ServiceProvider;
use Pekand\DetailLog\Services\DetailLog;

/*
    Custom Database Session provider
    - set by .env SESSION_DRIVER=custom
*/
class CustomSessionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Container\Container $container, \Illuminate\Http\Request $request, DetailLog $detailLog)
    {
        $detailLog->sessionBoot($container, $request);
    }
}
