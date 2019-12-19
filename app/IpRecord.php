<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpRecord extends Model
{
    /**
    *This method define an asociation between IpRecord with Subscriber
    */
    public function subscriber(){
      return $this->belongsTo('App\Subscriber');
    }
}
