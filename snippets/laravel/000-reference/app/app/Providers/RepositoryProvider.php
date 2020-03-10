<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Lib\Repositories\UserRepository;
use App\Lib\Repositories\UserRepositoryContract;
use App\Lib\Repositories\TicketRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Http\Controllers\Dev\Services;
use App\Lib\Repositories\TaggedRepository;

/*
 *
 * created by: php artisan make:provider FruitProvider
 * -must by registred in config/app.php
 *
 * */
class RepositoryProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepositoryContract::class => UserRepository::class, // mass simple bindings without constructors
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        TicketRepository::class => TicketRepository::class, // mass simple bindings without constructor
    ];


    /**
     * Get the services provided by the provider.
     * - deferred to first use of class
     * - provider must implement DeferrableProvider
     * @return array
     */
    public function provides()
    {
        return [
            UserRepository::class,
            UserRepositoryContract::class,
            TicketRepository::class,
            TaggedRepository::class,
            Services::class,
        ];
    }

    /**
     * Register services. (before other object as routes, events, ... )
     *
     * @return void
     */
    public function register()
    {

        /*Binding Basics*/

        // bind object
        $this->app->bind('App\Lib\Repositories\UserRepository', function ($app) {
            return new \App\Lib\Repositories\UserRepository("name1");
        });

        // bind object as singleton
        $this->app->singleton('App\Lib\Repositories\TicketRepository', function ($app) {
            return new \App\Lib\Repositories\TicketRepository("name2");
        });

        /* Binding Interfaces To Implementations */

        $this->app->bind(
            'App\Lib\Repositories\UserRepositoryContract', function ($app) {
                return new \App\Lib\Repositories\UserRepository("name3");
            }
        );

        /* Contextual Binding */

        // overide object injection to constructor for specific class
        $this->app->when(['App\Http\Controllers\Dev\Services'])
            ->needs('App\Lib\Repositories\TicketRepository')
            ->give(function () {
                return new \App\Lib\Repositories\TicketRepository("name4");
            });

        // bind primitive value to constructor
        $this->app->when(['App\Http\Controllers\Dev\Services'])
            ->needs('$primitiveValue')
            ->give(5);


        /* Tagging */

        $this->app->tag([
            'App\Lib\Repositories\UserRepository',
            'App\Lib\Repositories\TicketRepository'
        ], 'repositories');

        $this->app->bind('App\Lib\Repositories\TaggedRepository', function ($app) {
            $tagged = $app->tagged('repositories');

            $services = [];
            foreach ($tagged as $service) {
                $services[] = $service;
            }

            return new \App\Lib\Repositories\TaggedRepository($services[0], $services[1]);
        });

        /* Extending Bindings */

        //  do samthink extra wit object (decorate)
        $this->app->extend('App\Lib\Repositories\TaggedRepository', function ($service, $app) {
            $service->setParam("Decorated :");
            return $service;
        });
    }

    /**
     * Bootstrap services.
     * -called after all other service providers have been registered
     * - support dependency injection
     *
     * @return void
     */
    public function boot(UserRepository $users)
    {
        // after
    }
}
