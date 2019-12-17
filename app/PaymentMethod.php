<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function paymentMethodRecords(){
      return $this->->hasMany('App\PaymentMethodRecord');
    }
}
