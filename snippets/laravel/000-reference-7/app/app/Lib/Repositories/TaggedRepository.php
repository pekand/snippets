<?php

namespace App\Lib\Repositories;

class TaggedRepository implements Repository
{
    private UserRepository $users;
    private TicketRepository $tisckets;

    public function __construct(UserRepository $users, TicketRepository $tisckets) {
        $this->users = $users;
        $this->tisckets = $tisckets;
    }

    public function dump() {

        $data = [
            'users' => $this->users->getUsers(),
            'tickets' => $this->tisckets->getTickets(),
        ];

        return $data;
    }
}
