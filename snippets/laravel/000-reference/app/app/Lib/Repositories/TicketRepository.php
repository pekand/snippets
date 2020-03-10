<?php

namespace App\Lib\Repositories;

class TicketRepository implements Repository
{
    public function __construct($param = "") {

    }

    public function getTickets() {
        $tickets = \App\Models\Ticket::with(['status'])->get();
        return $tickets;
    }

}
