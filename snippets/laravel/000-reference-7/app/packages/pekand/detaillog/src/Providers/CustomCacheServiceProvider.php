<?php

namespace Pekand\DetailLog\Providers;


use Illuminate\Support\ServiceProvider;
use Pekand\DetailLog\Services\DetailLog;

class CustomCacheServiceProvider extends ServiceProvider
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
    public function boot(\Illuminate\Container\Container $container, DetailLog $detailLog)
    {
        $detailLog->cacheBoot($container);
    }
}
