<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ButtonRecord;
use DB;

class ButtonRecordsController extends Controller
{
    public function index(){

      $buttonRecord = DB::table('button_records')
        ->whereNull('button_records.closedate')
        ->select('button_records.startdate', 'button_records.closedate', 'button_records.status')
        ->get();
      $vezuelaAccounts = DB::table('subscriber_subscription_type')
        ->where('subscriber_subscription_type.subscription_id', '=', '3')
        ->count();
      $subscriptionConfigs = DB :: table ('subscription_types')
        ->whereIn('id', [1, 3])
        ->select('subscription_types.id','subscription_types.type', 'subscription_types.limit', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscription_types.status')
        ->get();
      return view('buttonadmin', compact('buttonRecord','vezuelaAccounts','subscriptionConfigs'));
    }

    public function modifyButton($action){
      if($action == 'enable'){
        echo 'Activo boton';
      }elseif($action == 'disabled'){
        echo 'Inactivo Boton';
      }

    }


}
