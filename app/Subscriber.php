<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public function ipRecords (){
      return $this->hasMany('App\IpRecord');
    }

    public function paymentMethodRecords (){
      return $this->hasMany('App\PaymentMethodRecord');
    }

    public function newsletters()
    {
        return $this->belongsToMany('App\Newsletter','newsletter_subscriber')->withPivot('subscriber_id','startdate', 'closedate','status');
    }
}
