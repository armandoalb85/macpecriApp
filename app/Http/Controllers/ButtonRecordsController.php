<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ButtonRecord;
use DB;

class ButtonRecordsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

      $codeMessage = 'warning';
      $message = 'Ocurrio un problema con la operación, intentlo de nuevo.';

      $buttonRecord = DB::table('button_records')
        ->whereNull('button_records.closedate')
        ->select('button_records.id')
        ->get();

      $value = '';

      $button = ButtonRecord::find($buttonRecord[0]->id);
      $button->closedate = date('Y-m-d');
      $updated = $button->update();

      if($updated){
        if($action == 'enable'){
          DB::insert('insert into button_records (startdate, status, created_at, updated_at) values (?, ?, ?, ?) ', [$button->closedate,'Activo', $button->closedate, $button->closedate]);
          $value = 'activado';
        }elseif($action == 'disabled'){
          DB::insert('insert into button_records (startdate, status, created_at, updated_at) values (?, ?, ?, ?) ', [$button->closedate,'Inactivo', $button->closedate, $button->closedate]);
          $value = 'Inactivado';
        }
        $codeMessage = 'info';
        $message = 'El boton de pago se fue '.$value;
      }

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


}
