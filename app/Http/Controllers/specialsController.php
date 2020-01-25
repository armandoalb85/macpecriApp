<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class specialsController extends Controller
{
  public function listSubscribersByFilterWihtParams($type, $startdate, $closedate){

    $queryResults = null;
    $typeSubscribers = $type;
    $startDate = $startdate;
    $closeDate = $closedate;

    if ($typeSubscribers != 'Todos'){
      $queryResults = DB::table('subscribers')
        ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
        ->join('users','users.id', '=', 'subscribers.user_id')
        ->where('subscriber_subscription_type.startdate','>=', $startdate)
        ->where('subscriber_subscription_type.startdate','<=', $closedate)
        ->where('subscription_types.type', '=', $type)
        ->whereNull('subscriber_subscription_type.closedate')
        ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
        ->get();
    }else{
      $queryResults = DB::table('subscribers')
        ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
        ->join('users','users.id', '=', 'subscribers.user_id')
        ->where('subscriber_subscription_type.startdate','>=', $startdate)
        ->where('subscriber_subscription_type.startdate','<=', $closedate)
        ->whereNull('subscriber_subscription_type.closedate')
        ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
        ->get();
    }

    return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
  }

}
