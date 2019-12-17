<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAccountStatement extends Model
{
    public function paymentMethodRecord(){
      return $this->belongsTo('App\PaymentMethodRecord');
    }
}
