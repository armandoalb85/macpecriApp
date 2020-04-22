<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'name', 'email', 'password', 'type', 'remember_token', 'status_id', 'provider_id', 
        'provider_token'
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
    *This method define an asociation between User with Subscriber
    */
    public function subscriber(){
      return $this->belongsTo('App\Subscriber');
    }
}
