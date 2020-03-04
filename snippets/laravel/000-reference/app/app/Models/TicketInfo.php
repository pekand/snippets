<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketInfo extends Model
{
    protected $table = 'ticket_info';

    // relation 1:1 (inverse)
    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id');
    }
}
