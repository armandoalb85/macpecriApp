<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
      return view ('paymentsbysubscribers');
    }

    /*
    This method show a dashboard for check subscribers with depts
    */
    public function checkSubscribersWithDebts(){
      return view ('subscriberswithdepts');
    }

}
