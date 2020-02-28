<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test3 extends Model
{
    /**
     * The table associated with the model. (optional)
     *
     * @var string
     */
    protected $table = 'test3';

    /**
     * The primary key associated with the table. (optional)
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing. (optional)
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID. (optional)
     *
     * @var string
     */
    protected $keyType = 'int';


    /**
     * The connection name for the model. (optional)
     *
     * @var string
     */
    protected $connection; // specifi db connection for model

    /**
     * The model's default values for attributes. (optional)
     *
     * @var array
     */
    protected $attributes = [
        'name' => '',
        'status' => 'new',

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
