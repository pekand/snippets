<?php

namespace App\Providers;

use App\Lib\MongoStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Lib\Cache\CustomCacheStore;

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
    public function boot(\Illuminate\Container\Container $container)
    {
        Cache::extend('custom', function ($app) use ($container) {
            $connection = $container->make('db')->connection(config('session.connection'));
            $store = config('cache.stores');
            $prefix = config('cache.prefix');
            return Cache::repository(new CustomCacheStore($connection, $store['custom']['table'], $prefix));
        });
    }
}
