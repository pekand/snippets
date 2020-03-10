<?php

namespace App\Lib\Repositories;

class TaggedRepository implements Repository
{
    private $param = null;
    private UserRepository $users;
    private TicketRepository $tisckets;

    public function __construct(UserRepository $users, TicketRepository $tisckets) {
        $this->users = $users;
        $this->tisckets = $tisckets;
    }

    public function setParam($param) {
        $this->param = $param;
    }

    public function dump() {
        return $this->param.$this->users->dump() . " " . $this->tisckets->dump();
    }
}
