<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    protected $table = 'ticket_comments';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // relation 1:N (inverse)
    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id');
    }
}
