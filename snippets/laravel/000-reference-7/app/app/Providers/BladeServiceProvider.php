<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
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
    public function boot()
    {
        //Blade::withoutDoubleEncoding; // disable double encoding

        Blade::component('dev/components/alert', 'alert'); // egister alert component

        Blade::include('dev/parts/header', 'header'); // create alias for template

        Blade::directive('datetime', function ($expression) { // custom function
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });

        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
    }
}
