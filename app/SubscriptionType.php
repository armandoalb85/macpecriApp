<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    public function subscribers(){
      return $this->belongsToMany('\App\Subscriber','subscriber_subscription_type')->withPivot('subscription_id', 'startdate', 'closedate','status', 'limit'); 
    }
}
