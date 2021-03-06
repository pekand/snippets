<?php

namespace App\Listeners;

use App\Events\NewTicket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/*
 *
 * -listener generated by 'php artisan event:generate'
 * - no parameters for command,  code is generated from EventServiceProvider settings
 *
 * */
class TicketNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewTicket  $event
     * @return void
     */
    public function handle(NewTicket $event)
    {
        echo "NewTicket event occured:".$event->ticket->name."<br>\n";
    }
}
