<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    protected $fillable = ['name', 'description', 'cost','limit','status', 'daysforpaying'];

    /**
    *This method define an asociation between SubscriptionType with Subscriber
    */
    public function subscribers(){
      return $this->belongsToMany('\App\Subscriber','subscriber_subscription_type')->withPivot('subscription_id', 'startdate', 'closedate','status', 'limit');
    }
}
