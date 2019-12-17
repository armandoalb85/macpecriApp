<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpRecord extends Model
{
    public function subscriber(){
      return $this->belongsTo('App\Subscriber');
    }
}
