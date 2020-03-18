<?php

namespace Vendor\Package\Providers;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Vendor\Package\Commands\PackageCommand;
use Vendor\Package\Listeners\PackageEventSubscriber;
use Vendor\Package\Middleware\PackageMiddleware;


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
    public function boot(\Illuminate\Routing\Router $router)
    {
        // load configuration
        $configFile = realpath(__DIR__.'/../../config/package.php');

        if (!$this->app instanceof LaravelApplication) {
            return;
        } 

        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom($configFile, 'detaillog');
        }

        // register midleware for all requests
        //App::make(Kernel::class)->pushMiddleware(PackageMiddleware::class);

        // register named midleware
        $router->aliasMiddleware('package', PackageMiddleware::class);

        // register event subscriberert 
        Event::subscribe(PackageEventSubscriber::class);

        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'package');

        $this->loadViewsFrom(__DIR__.'/../Views', 'VendorPackage');

        // load routes
        Route::middleware('web')
            ->namespace('Vendor\Package\Controllers')
            ->group(__DIR__.'/../Routes/routes.php');

        // only from console
        if (!$this->app->runningInConsole()) {
            return;
        } 

        // publis configuration to application (php artisan vendor:publish)
        $this->publishes([$configFile => config_path('package.php')]);

        // publish views to application (php artisan vendor:publish)
        $this->publishes([
            __DIR__.'/../Views' => resource_path('views/vendor/package'),
        ]);

        // publish resources to public path (php artisan vendor:publish --tag=public)
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('vendor/package'),
        ], 'public');

        // publish seeds to main seed directory (php artisan vendor:publish --tag=seeds)
        $this->publishes([
            __DIR__.'/../../database/seeds' => base_path('database/seeds')
        ], 'seeds');

        // publish seeds to main seed directory (php artisan vendor:publish --tag=lang)
        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('resources/lang')
        ], 'lang');

        $this->loadFactoriesFrom(__DIR__.'/../../database/factories');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // register commands
        $this->commands([
            PackageCommand::class,
        ]);

    }
}
