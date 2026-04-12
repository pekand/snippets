<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Part;
use App\Models\Car;

class Part extends Model
{
    protected $fillable = ['name', 'serialnumber', 'car_id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
