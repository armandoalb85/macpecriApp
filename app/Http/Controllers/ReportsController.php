<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportsController extends Controller
{
    private $codeMessage;
    private $message;

    public function __construct()
    {
        $this->middleware('auth');
        $codeMessage = 'warning';
        $message = 'Ocurrio un problema con la operación, intentlo de nuevo.';
    }

    /*
    *This method show a view report for public conversion account
    */
    public function filterPublicConversionAccount(){
      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      return view ('reportpublicconversionaccount', compact('queryResults', 'totalPay', 'totalFree'));
    }

    /*
    *This method allows generate a  conversion account report free for pay
    */
    public function reportPublicConversionAccount(Request $request){

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;

      $subQueryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscriber_subscription_type.subscription_id', '=', 'subscription_types.id')
            ->where('subscription_types.type', '=', 'Gratuita')
            ->whereNotNull('subscriber_subscription_type.closedate')
            ->select('subscribers.id')
            ->get();

      $values = array();
      $i=0;
      foreach ($subQueryResults as $subQueryResult){
        $values[$i] = $subQueryResult->id;
        $i++;
      }

      $queryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscriber_subscription_type.subscription_id', '=', 'subscription_types.id')
            ->where('subscription_types.type', '=', 'Pago')
            ->whereIn('subscriber_subscription_type.subscriber_id', $values )
            ->where('subscriber_subscription_type.startdate', '>=', $this->dateFormat($request->startdate))
            ->where('subscriber_subscription_type.startdate', '<=', $this->dateFormat($request->closedate))
            ->select('subscription_types.name as type', 'subscriber_subscription_type.startdate', 'subscribers.created_at', 'subscribers.name', 'subscribers.lastname')
            ->get();

      //echo $queryResults;
      return view ('reportpublicconversionaccount', compact('queryResults', 'totalPay', 'totalFree'));
    }

    /*
    *This method allows generate a  created account report
    */
    public function reportCreatedAccount(){

    }

    /*
    *This method allows generate a  payment uses report
    */
    public function reportPaymentUses(){

    }

    /*
    *This method allows generate a  payments received report
    */
    public function reportPaymentsReceived(){

    }

    /*
    *This method allows generate an account  expire report
    */
    public function reportAccountExpire(){

    }

    /*
    This method allow aplicate format on date parameter
    */
    private function dateFormat($value){
        $date;

        if($value != ''){
          $date = explode('/', $value);
          return $date[2].'-'.$date[0].'-'.$date[1];
        }else{
          return date("Y").'-'.date("m").'-'.date("d");
        }
    }

}
