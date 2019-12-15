<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{

  protected $fillable = ['name', 'description', 'startdate','closedate'];

  /**
  *This method define an asociation many to many between Newsletter with Subscriber
  */
  public function subscribers()
  {
    return $this->belongsToMany('App\Subscriber','newsletter_subscriber')->withPivot('newsletter_id','startdate', 'closedate','status');;
  }
}
