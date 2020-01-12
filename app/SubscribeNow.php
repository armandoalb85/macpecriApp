<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscribeNow extends Model
{
    protected $fillable = ['name', 'description', 'status', 'category'];
    /**
    *This method define an asociation between PaymentMethod with supscriptionmessage
    */
    public function paymentMethodRecords(){
      return $this->hasMany('App\SubscriptionMessage');
    }

}
