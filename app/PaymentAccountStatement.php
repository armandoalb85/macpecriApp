<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAccountStatement extends Model
{
    /**
    *This method define an asociation between PaymentAccountStatement with PaymentMethodRecord
    */
    public function paymentMethodRecord(){
      return $this->belongsTo('App\PaymentMethodRecord');
    }
}
