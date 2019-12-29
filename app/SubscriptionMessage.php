<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMessage extends Model
{
    /**
    *This method define an asociation between User with subscription now
    */
    public function subscriber(){
      return $this->belongsTo('App\SubscribeNow ');
    }
}
