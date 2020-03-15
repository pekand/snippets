<?php

namespace App\Lib\Repositories;

use App\Models\Tickets\Ticket;

class TicketRepository implements Repository
{
    public function __construct($param = "") {

    }

    public function getTickets() {
        $tickets = Ticket::with(['status'])->get();
        return $tickets;
    }

}
