<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketInfo extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_info';

    // relation 1:1 (inverse)
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
