<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $table = 'ticket_status';

    public function tickets()
    {
        return $this->hasMany('App\Model\Ticket', 'ticket_status_id');
    }
}
