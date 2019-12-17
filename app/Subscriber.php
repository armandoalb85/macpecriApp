<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public function ipRecords (){
      return $this->hasMany('App\IpRecord');
    }
}
