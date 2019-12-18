<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;

class SubscriptionTypesController extends Controller
{
    public function indexSubscriptionType(){
      return view('subscriptiontype');
    }

    public function newSubscriptionType(){
      return view('createsubscriptiontype');
    }

    public function saveSubscriptionType(Request $request){

      $SubscriptionType = new SubscriptionType();
      $SubscriptionType->name = $request->tipo;
      $SubscriptionType->description = $request->description;
      $SubscriptionType->cost = $request->cost;
      $SubscriptionType->limit = $request->limit;
      $SubscriptionType->status = $request->status;
      $SubscriptionType->save();

      return redirect('suscripciones');

    }

}
