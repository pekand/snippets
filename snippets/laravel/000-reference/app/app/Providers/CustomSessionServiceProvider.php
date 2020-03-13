<?php

namespace App\Providers;

use App\Lib\Session\CustomSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
    public function boot(\Illuminate\Container\Container $container, \Illuminate\Http\Request $request)
    {
        Session::extend('custom', function ($app) use ($container, $request) {
            $connection = $container->make('db')->connection(config('session.connection'));
            $table = config('session.table');
            $lifetime = config('session.lifetime');
            return new CustomSessionHandler($connection, $table, $lifetime, $container, $request);
        });
    }
}
