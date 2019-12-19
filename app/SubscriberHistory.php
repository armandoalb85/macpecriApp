<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberHistory extends Model
{
  /**
  *This method define an asociation between SubscriberHistory with Subscriber
  */
  public function subscriber(){
    return $this->belongsTo('App\Subscriber');
  }
}
