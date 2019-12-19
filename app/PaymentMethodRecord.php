<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodRecord extends Model
{
    /**
    *This method define an asociation between PaymentMethodRecord with Subscriber
    */
    public function subscriber(){
      return $this->belongsTo('App\Subscriber');
    }

    /**
    *This method define an asociation between PaymentMethodRecord with PaymentAccountStatement
    */
    public function paymentAccountStatements(){
      return $this->hasMany('App\PaymentAccountStatement');
    }

    /**
    *This method define an asociation between PaymentMethodRecord with PaymentMethod
    */
    public function paymentMethod(){
      return $this->belongsTo('App\PaymentMethod');
    }
}
