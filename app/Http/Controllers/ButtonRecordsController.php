<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ButtonRecord;
//use App\SubscriptionType;
use DB;

class ButtonRecordsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

      $buttonRecord = DB::table('button_records')
        ->join('status','status.id','=','button_records.status_id')
        ->whereNull('button_records.closedate')
        ->select('button_records.startdate', 'button_records.closedate', 'button_records.status_id','status.name')
        ->get();
        //dd($buttonRecord);
      $venezuelaAccounts = DB::table('subscribers')
        ->where('subscribers.country_id', '=', 231)
        ->count();
      $subscriptionConfigs = "";/*DB :: table ('subscription_types')
        ->whereIn('id', [1, 3])
        ->select('subscription_types.id','subscription_types.type', 'subscription_types.limit', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscription_types.typeswap')
        ->get();*/
      return view('buttonadmin', compact('buttonRecord','venezuelaAccounts','subscriptionConfigs'));
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
          DB::insert('insert into button_records (startdate, status_id, created_at, updated_at) values (?, ?, ?, ?) ', [$button->closedate,'1', $button->closedate, $button->closedate]);
          $value = 'activado';
          $this->updateActiveButton();
        }elseif($action == 'disabled'){
          DB::insert('insert into button_records (startdate, status_id, created_at, updated_at) values (?, ?, ?, ?) ', [$button->closedate,'0', $button->closedate, $button->closedate]);
          $value = 'Inactivado';
          $this->updateInactiveButton();
        }
        $codeMessage = 'info';
        $message = 'Boton de pago: '.$value;
      }

      $buttonRecord = DB::table('button_records')
        ->join('status','status.id','=','button_records.status_id')
        ->whereNull('button_records.closedate')
        ->select('button_records.startdate', 'button_records.closedate', 'button_records.status_id','status.name')
        ->get();
        $venezuelaAccounts = DB::table('subscribers')
        ->where('subscribers.country_id', '=', 231)
        ->count();
      $subscriptionConfigs = "";/*DB :: table ('subscription_types')
        ->whereIn('id', [1, 3])
        ->select('subscription_types.id','subscription_types.type', 'subscription_types.limit', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscription_types.typeswap')
        ->get();*/

      return view('buttonadmin', compact('buttonRecord','venezuelaAccounts','subscriptionConfigs'));
    }

    private function updateActiveButton(){

      DB::table('subscribers')
      ->where('subscription_types_id', '=', 3)
      ->where('country_id', '=', 231)
      ->update(['subscription_types_id' => 1]);

    }

    private function updateInactiveButton(){

      DB::table('subscribers')
      ->where('country_id', '=', 231)
      ->whereIn('subscription_types_id', [1,2])
      ->update(['subscription_types_id' => 3]);

    }

}
