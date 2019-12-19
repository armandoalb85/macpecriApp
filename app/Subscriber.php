<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
    *This method define an asociation between Subscriber with IpRecord
    */
    public function ipRecords (){
      return $this->hasMany('App\IpRecord');
    }

    /**
    *This method define an asociation between Subscriber with PaymentMethodRecord
    */
    public function paymentMethodRecords (){
      return $this->hasMany('App\PaymentMethodRecord');
    }

    /**
    *This method define an asociation many to many between Subscriber with Newsletter
    */
    public function newsletters()
    {
        return $this->belongsToMany('App\Newsletter','newsletter_subscriber')->withPivot('subscriber_id','startdate', 'closedate','status');
    }

    /**
    *This method define an asociation many to many between Subscriber with SubscriptionType
    */
    public function subscribers(){
      return $this->belongsToMany('\App\SubscriptionType','subscriber_subscription_type')->withPivot('subscriber_id', 'startdate', 'closedate','status', 'limit');
    }

    /**
    *This method define an asociation between Subscriber with SubscriberHistory
    */
    public function subscriberHistories(){
      return $this->hasMany('App\SubscriberHistory');
    }

    /**
    *This method define an asociation between Subscriber with User
    */
    public function user(){
      return $this->hasOne('App\User');
    }
}
