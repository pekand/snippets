<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\User;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'tickets';

    protected $with = ['status']; // alweys preload status relation

    protected $fillable = [
        'name', 'description', 'ticket_status_id', 'assigned_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); //foregin_key in current table
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_id'); //foregin_key in current table
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_status_id'); //foregin_key in current table
    }

    // relation 1:1
    public function info()
    {
        return $this->hasOne(TicketInfo::class, 'ticket_id'); //foregin_key in other table
    }

    // relation 1:N
    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id'); //foregin_key in other table
    }

    // relation M:N
    public function watchers()
    {
        return $this->belongsToMany(User::class, 'ticket_watchers', 'ticket_id', 'watcher_id')
            ->wherePivot('active', 1) // filters (wherePivotIn, wherePivotNotIn)
            ->as('subscription') // rename 'pivot' variable  to 'subscription'
            ->withPivot('active') // columns on pivot table
            ->withTimestamps();
    }
}
