<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // manual definition of event listener (override other listeners)
        Event::listen('App\Events\NewTicket', function (\App\Events\NewTicket $newTicket) {
            echo "NewTicket event occured<br>\n";
        });

        //catch multiple events with wildcard 
        // - wilcard match all fired events '*'
        Event::listen('App\Events\*', function ($eventName, array $data) {
            echo "NewTicket event occured<br>\n";
        });

        /* Event::listen('*', function ($eventName, array $data) { 
            echo "Event: [". $eventName."]<br>\n"; // TODO move to log
        });
        */

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
