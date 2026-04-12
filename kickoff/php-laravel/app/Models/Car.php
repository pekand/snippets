<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Part;

class Car extends Model
{
    protected $fillable = ['name', 'registration_number', 'is_registered'];

    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}
