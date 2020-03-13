<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class LogEventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('*', function ($eventName, array $data) {   
            // skip log event (prevent infinite loop)
            if($eventName === 'Illuminate\Log\Events\MessageLogged'){
                return;
            }

            $requestUid = config('requestUid');

            Log::channel('events')->info("Event", [
                'requestUid' => $requestUid,
                'eventName' => $eventName,
            ]);

        });
    }
}
