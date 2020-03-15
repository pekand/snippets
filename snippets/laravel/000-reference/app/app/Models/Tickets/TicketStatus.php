<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketStatus extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_status';

    public function tickets()
    {
        return $this->hasMany('App\Model\Ticket', 'ticket_status_id');
    }
}
