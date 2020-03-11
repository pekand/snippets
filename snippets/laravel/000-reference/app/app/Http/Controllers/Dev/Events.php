<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use App\Events\NewTicket;

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
        event(new NewTicket($ticket)); // with trait SerializesModels 
    }

}
