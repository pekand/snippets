<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $with = ['status']; // alweys preload status relation

    public function assigned()
    {
        return $this->belongsTo('App\Models\User', 'assigned_id'); //foregin_key in current table
    }

    public function status()
    {
        return $this->belongsTo('App\Models\TicketStatus', 'ticket_status_id'); //foregin_key in current table
    }

    // relation 1:1
    public function info()
    {
        return $this->hasOne('App\Models\TicketInfo', 'ticket_id'); //foregin_key in other table
    }    

    // relation 1:N
    public function comments()
    {
        return $this->hasMany('App\Models\TicketComment', 'ticket_id'); //foregin_key in other table
    }

    // relation M:N
    public function watchers()
    {
        return $this->belongsToMany('App\Models\User', 'ticket_watchers', 'ticket_id', 'watcher_id')
            ->wherePivot('active', 1) // filters (wherePivotIn, wherePivotNotIn)
            ->as('subscription') // rename pivot to subscription
            ->withPivot('active') // columns on pivot table
            ->withTimestamps(); 
    }
}
