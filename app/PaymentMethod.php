<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
    *This method define an asociation between PaymentMethod with PaymentMethodRecord
    */
    public function paymentMethodRecords(){
      return $this->hasMany('App\PaymentMethodRecord');
      //un comentario
    }
}
