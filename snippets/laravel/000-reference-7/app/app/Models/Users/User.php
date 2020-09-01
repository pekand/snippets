<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tickets\Ticket;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relation M:N
    public function watching()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_watchers', 'watcher_id' , 'ticket_id')
            ->as('subscription')
            ->withPivot('active')
            ->withTimestamps();
    }

    // relation 1:N
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_id'); //foregin_key in other table
    }

    // relation 1:N
    public function ownedTickets()
    {
        return $this->hasMany(Ticket::class, 'owner_id'); //foregin_key in other table
    }
}
