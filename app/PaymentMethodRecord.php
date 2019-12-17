<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodRecord extends Model
{
    public function subscriber(){
      return $this->belongsTo('App\Subscriber');
    }

    public function paymentAccountStatements(){
      return $this->hasMany('App\PaymentAccountStatement');
    }

    public function paymentMethod(){
      return $this->belongsTo('App\PaymentMethod');
    }
}
