<?php

namespace Pekand\DetailLog\Providers;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Pekand\DetailLog\Services\DetailLog;

class DetailLogServiceProvider extends ServiceProvider
{

    public $singletons = [
        DetailLog::class => DetailLog::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(\Illuminate\Container\Container $container, \Illuminate\Http\Request $request, DetailLog $detailLog)
    {
        $configFile = realpath(__DIR__.'/../../config/detaillog.php');

        if (!$this->app instanceof LaravelApplication) {
            return;
        } 

        if ($this->app->runningInConsole()) {
            $this->publishes([$configFile => config_path('detaillog.php')]);
        } 

        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom($configFile, 'detaillog');
        }  

        $this->app->make('config')->set(
            'logging.channels.access', 
            $this->app->make('config')->get('detaillog.channels.access')
        );

        $this->app->make('config')->set(
            'logging.channels.cache', 
            $this->app->make('config')->get('detaillog.channels.cache')
        );

        $this->app->make('config')->set(
            'logging.channels.events', 
            $this->app->make('config')->get('detaillog.channels.events')
        );

        $this->app->make('config')->set(
            'logging.channels.query', 
            $this->app->make('config')->get('detaillog.channels.query')
        );

        $this->app->make('config')->set(
            'logging.channels.session', 
            $this->app->make('config')->get('detaillog.channels.session')
        );

        $detailLog->uidBoot();
        $detailLog->logRequestBoot();
        $detailLog->logQueryBoot();
        $detailLog->logEventBoot();
        $detailLog->sessionBoot($container, $request);
        $detailLog->cacheBoot($container);
    }
}
