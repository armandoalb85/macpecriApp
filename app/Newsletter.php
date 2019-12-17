<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
  public function subscribers()
  {
    return $this->belongsToMany('App\Subscriber','newsletter_subscriber')->withPivot('newsletter_id','startdate', 'closedate','status');;
  }
}
