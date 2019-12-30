<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMessage extends Model
{
    protected $fillable = ['type', 'status', 'message','configmessage_id'];

    /**
    *This method define an asociation between User with subscription now
    */
    public function subscriber(){
      return $this->belongsTo('App\SubscribeNow ');
    }
}
