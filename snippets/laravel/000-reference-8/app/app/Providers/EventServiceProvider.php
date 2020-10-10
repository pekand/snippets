<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\NewTicket' => [
            'App\Listeners\TicketNotification',
        ],
    ];

    /**
     * The subscriber classes to register.
     * - listen to multiple events
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\TicketEventSubscriber'
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // manual definition of event listener (override other listeners)
        Event::listen('App\Events\NewTicket', function (\App\Events\NewTicket $newTicket) {
            Log::info("Event new ticket");
        });

        //catch multiple events with wildcard 
        // - wilcard match all fired events '*'
        Event::listen('App\Events\*', function ($eventName, array $data) {
            Log::info("App Event: ".$eventName);
        });
    }

    /**
     * Get the listener directories that should be used to discover events.
     * - set directories where scan for event listeners
     * - optional method 
     *
     * @return array
     */
    protected function discoverEventsWithin()
    {
        return [
            $this->app->path('Listeners'),
        ];
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     * - allow automatic scan for event listeners instead of manual registration
     * - optional method
     * - default value false
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
