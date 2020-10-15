<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;


class TicketEventSubscriber
{
    /**
     * Handle new ticket event
     */
    public function handleNewTicket($event) {
        Log::notice("TicketEventSubscriber: NewTicket event occured in subscriber");
    }

    /**
     * Handle closed ticket event
     */
    public function handleClosedTicket($event) {
        Log::notice("TicketEventSubscriber: ClosedTicket event occured in subscriber");
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\NewTicket',
            'App\Listeners\TicketEventSubscriber@handleNewTicket'
        );

        $events->listen(
            'App\Events\ClosedTicket',
            'App\Listeners\TicketEventSubscriber@handleClosedTicket'
        );
    }
}
