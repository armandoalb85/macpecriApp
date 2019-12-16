<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;

class SubscribersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    This method show a subscribers dashboard
    */
    public function indexSubscribers(){

      return view ('subscribers');
    }

    /*
    This method show a dashboard for check payments by subscribers
    */
    public function checkPaymentsBySubscribers(){
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('paymentsbysubscribers',compact('subscriptionTypes'));
    }

    /*
    This method show a dashboard for check subscribers with depts
    */
    public function checkSubscribersWithDebts(){
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('subscriberswithdepts', compact('subscriptionTypes'));
    }

}
