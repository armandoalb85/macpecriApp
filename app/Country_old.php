<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_old extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'country',
    ];

}
