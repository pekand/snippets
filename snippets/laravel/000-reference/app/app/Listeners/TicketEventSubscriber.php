<?php

namespace App\Listeners;

class TicketEventSubscriber
{
    /**
     * Handle new ticket event
     */
    public function handleNewTicket($event) {
        echo "NewTicket event occured in subscriber<br>\n";
    }

    /**
     * Handle closed ticket event
     */
    public function handleClosedTicket($event) {
        echo "ClosedTicket event occured in subscriber<br>\n";
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
