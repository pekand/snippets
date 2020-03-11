<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Events\NewTicket;
use App\Events\ClosedTicket;

class Events extends Controller
{
    public function __construct()
    {

    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    {
        $ticket = \App\Models\Ticket::find(1);
        event(new NewTicket($ticket));
        event(new ClosedTicket($ticket));
    }

}
