<?php

namespace App\Lib\Repositories;

class TicketRepository implements Repository
{
    private $param = null;

    public function __construct($param = "name0") {
        $this->param = $param;
    }

    public function dump() {
        return $this->param;
    }

}
