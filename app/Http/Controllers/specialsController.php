<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;
use DB;

class specialsController extends Controller
{
  public function listSubscribersByFilterWihtParams($type, $startdate, $closedate){

    $queryResults = null;
    $typeSubscribers = "Total";
    $startDate = $startdate;
    $closeDate = $closedate;

    if ($type > 0){

      $typeSubscribers=SubscriptionType::find($type);

      $queryResults = DB::table('subscribers')
        //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->join('users','users.id', '=', 'subscribers.user_id')
        ->join('status','status.id', '=', 'users.status_id')
        ->join('paises','paises.id', '=', 'subscribers.country_id')
        ->where('subscribers.created_at','>=', $startdate)
        ->where('subscribers.created_at','<=', $closedate)
        ->where('subscription_types.id', '=', $type)
        //->whereNull('subscriber_subscription_type.closedate')
        ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'paises.country', 'status.name as status', 'subscription_types.name as types', 'subscribers.created_at')
        ->get();
    }else{
      $queryResults = DB::table('subscribers')
        //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->join('users','users.id', '=', 'subscribers.user_id')
        ->join('status','status.id', '=', 'users.status_id')
        ->join('paises','paises.id', '=', 'subscribers.country_id')
        ->where('subscribers.created_at','>=', $startdate)
        ->where('subscribers.created_at','<=', $closedate)
        //->whereNull('subscriber_subscription_type.closedate')
        ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'paises.country', 'status.name as status', 'subscription_types.name as types', 'subscribers.created_at')
        ->get();
    }

    //echo $queryResults.'<br>';

    return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
  }

}
