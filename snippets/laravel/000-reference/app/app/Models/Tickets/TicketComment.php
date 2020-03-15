<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketComment extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_comments';

    protected $fillable = [
        'user_id', 'ticket_id', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relation 1:N (inverse)
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
