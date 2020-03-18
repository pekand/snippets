<?php

namespace Vendor\Package\Providers;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/*
    -set to auto discover by composer.json

    "extra": {
        "laravel": {
            "providers": [
                "Vendor\\Package\\Providers\\PackageServiceProvider"
            ],
        }
    },

    - can be disabled in application composer.json by


    "extra": {
        "laravel": {
            "dont-discover": [
                "Vendor\\Package\\Providers\\PackageServiceProvider"
            ]
        }
    },
*/
class PackageServiceProvider extends ServiceProvider
{

    public $singletons = [
        
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
    public function boot()
    {
        $configFile = realpath(__DIR__.'/../../config/package.php');

        if (!$this->app instanceof LaravelApplication) {
            return;
        } 

        if ($this->app->runningInConsole()) {
            $this->publishes([$configFile => config_path('package.php')]);
        } 

        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom($configFile, 'detaillog');
        }
    }
}
