<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionTypesController extends Controller
{
    public function indexSubscriptionType(){
      return view('subscriptiontype');
    }
}
