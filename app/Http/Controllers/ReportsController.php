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

      $totalPay = $this->totalPayAccount();
      $totalFree = $this->totalFreeAccount();

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

      return view ('reportpublicconversionaccount', compact('queryResults', 'totalPay', 'totalFree'));
    }

    /*
    *This method show a view report for public conversion account
    */
    public function filterCreatedAccount(){
      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree'));
    }

    /*
    *This method allows generate a  created account report
    */
    public function reportCreatedAccount(Request $request){

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;

      $totalPay = $this->totalPayAccount();
      $totalFree = $this->totalFreeAccount();

      $queryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscribers.created_at', '>=', $this->dateFormat($request->startdate))
            ->where('subscribers.created_at', '<=', $this->dateFormat($request->closedate))
            ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscriber_subscription_type.startdate as suscripcion', 'subscription_types.name as type' )
            ->get();

      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree'));

    }

    /*
    *This method show filters for report
    */
    public function filterPaymentUses(){
      $queryResults = null;
      $listUses = null;

      return view ('reportpaymentuses', compact('queryResults','listUses'));

    }
    /*
    *This method allows generate a  payment uses report
    */
    public function reportPaymentUses(Request $request){

      $listUses[] = array();
      $i=0;

      $queryResults = DB::table('payment_methods')
        ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
        ->where('payment_method_records.startdate', '>=', $this->dateFormat($request->startdate))
        ->where('payment_method_records.startdate', '<=', $this->dateFormat($request->closedate))
        ->select('payment_methods.name')->distinct()->get();

      foreach ($queryResults as $queryResult) {

        $totalPay = DB::table('payment_methods')
              ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
              ->where('payment_methods.name', '=', $queryResult->name )
              ->count('payment_method_records.id');
        $listUses[$i] = $totalPay;
        $i ++;

      }

      //echo $queryResults;
      return view ('reportpaymentuses', compact('queryResults','listUses'));

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
    * This method return the total subscribed accounts pay
    */
    private function totalPayAccount(){

      $totalPay = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscription_types.type', '=', 'Pago')
            ->count('subscriber_subscription_type.id');

      return $totalPay;

    }

    /*
    * This method return the total subscribed accounts free
    */
    private function totalFreeAccount(){

      $totalFree = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscription_types.type', '=', 'Gratuita')
            ->count('subscriber_subscription_type.id');

      return $totalFree;

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
