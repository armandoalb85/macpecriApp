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
      $dateIni = null;
      $dateFin = null;
      return view ('reportpublicconversionaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni','dateFin'));
    }

    /*
    *This method allows generate a  conversion account report free for pay
    */
    public function reportPublicConversionAccount(Request $request){

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      $data = $this->dataValidator();

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

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
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payment_method_records.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->whereIn('subscriber_subscription_type.subscriber_id', $values )
            ->where('subscriber_subscription_type.startdate', '>=', $request->startdate)
            ->where('subscriber_subscription_type.startdate', '<=', $request->closedate)
            ->select('subscription_types.name as type', 'subscriber_subscription_type.startdate', 'subscribers.created_at', 'subscribers.name', 'subscribers.lastname', 'users.email', 'payment_methods.name as method')
            ->get();

      if ($queryResults != null){
        $totalPay = $this->totalPayAccount();
        $totalFree = $this->totalFreeAccount();
      }

      return view ('reportpublicconversionaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni','dateFin'));
    }

    /*
    *This method show a view report for public conversion account
    */
    public function filterCreatedAccount(){
      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      $dateIni = null;
      $dateFin = null;
      $typeAccount = SubscriptionType::all();
      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni', 'dateFin', 'typeAccount' ));
    }

    /*
    *This method allows generate a  created account report
    */
    public function reportCreatedAccount(Request $request){

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      $data = $this->dataValidator();

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $typeAccount = SubscriptionType::all();

      $queryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscribers.created_at', '>=', $request->startdate)
            ->where('subscribers.created_at', '<=', $request->closedate)
            ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscriber_subscription_type.startdate as suscripcion', 'subscription_types.name as type')
            ->get();

      if ($queryResults != null ){
        $totalPay = $this->totalPayAccount();
        $totalFree = $this->totalFreeAccount();
      }

      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni', 'dateFin', 'typeAccount' ));

    }

    /*
    *This method show filters for report
    */
    public function filterPaymentUses(){
      $queryResults = null;
      $listUses = null;
      $dateIni = null;
      $dateFin = null;

      return view ('reportpaymentuses', compact('queryResults','listUses','dateIni','dateFin'));

    }
    /*
    *This method allows generate a  payment uses report
    */
    public function reportPaymentUses(Request $request){

      $listUses[] = array();
      $i=0;
      $data = $this->dataValidator();

      /*$dateIni = $this->dateFormat($request->startdate);
      $dateFin = $this->dateFormat($request->closedate);*/
      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $queryResults = DB::table('payment_methods')
        ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
        //->where('payment_method_records.startdate', '>=', $this->dateFormat($request->startdate))
        //->where('payment_method_records.startdate', '<=', $this->dateFormat($request->closedate))
        ->where('payment_method_records.startdate', '>=', $request->startdate)
        ->where('payment_method_records.startdate', '<=', $request->closedate)
        ->select('payment_methods.name')->distinct()->get();

      foreach ($queryResults as $queryResult) {

        $totalPay = DB::table('payment_methods')
              ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
              ->where('payment_methods.name', '=', $queryResult->name )
              ->count('payment_method_records.id');
        $listUses[$i] = $totalPay;
        $i ++;

      }

      return view ('reportpaymentuses', compact('queryResults','listUses', 'dateIni', 'dateFin'));

    }

    /*
    *This method allows generate a  payments received report
    */
    public function filterPaymentsReceived(){

      $queryResults = null;
      $listTotal = null;
      $dateIni = null;
      $dateFin = null;

      return view ('reportpaymentsreceived', compact('queryResults', 'listTotal', 'dateIni', 'dateFin'));
    }

    /*
    *This method allows generate a  payments received report
    */
    public function reportPaymentsReceived(Request $request){

      $listPayments = null;
      $listTotal[] = array();
      $i=0;

      $data = $this->dataValidator();

      /*$dateIni = $this->dateFormat($request->startdate);
      $dateFin = $this->dateFormat($request->closedate);*/
      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $queryResults = DB::table('payment_account_statements')
          ->join('payment_method_records', 'payment_method_records.id','=','payment_account_statements.paymentmethod_id')
          ->join('payment_methods', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
          ->whereNotNull('payment_account_statements.closedate')
          //->where('payment_account_statements.startdate', '>=', $this->dateFormat($request->startdate))
          //->where('payment_account_statements.startdate', '<=', $this->dateFormat($request->closedate))
          ->where('payment_account_statements.startdate', '>=', $request->startdate)
          ->where('payment_account_statements.startdate', '<=', $request->closedate)
          ->select('payment_methods.name as method')->distinct()->get();

      foreach ($queryResults as $queryResult) {

        $totalPayment = DB::table('payment_account_statements')
            ->join('payment_method_records', 'payment_method_records.id','=','payment_account_statements.paymentmethod_id')
            ->join('payment_methods', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
            ->whereNotNull('payment_account_statements.closedate')
            ->where('payment_methods.name','=',$queryResult->method)
            ->where('payment_account_statements.startdate', '>=', $request->startdate)
            ->where('payment_account_statements.startdate', '<=', $request->closedate)
            ->sum('payment_account_statements.amount');

        $listTotal[$i] = $totalPayment;
        $i++;
      }

      return view ('reportpaymentsreceived', compact('queryResults', 'listTotal', 'dateIni', 'dateFin'));
    }

    /*
    *This method allows generate an account  expire report
    */
    public function filterAccountExpire(){

      $queryResults = null;
      $dateIni = null;
      $dateFin = null;

      return view ('reportaccountexpire', compact('queryResults', 'dateIni', 'dateFin'));
    }

    /*
    *This method allows generate an account  expire report
    */
    public function reportAccountExpire(Request $request){

      $queryResults = null;

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $data = $this->dataValidator();
      $queryResults = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
            ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('payment_account_statements.startdate', '>=', $request->startdate)
            ->where('payment_account_statements.startdate', '<=', $request->closedate)
            ->whereNull('payment_account_statements.closedate')
            ->select('subscription_types.name as type', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscribers.name', 'subscribers.lastname', 'payment_account_statements.startdate', 'payment_account_statements.closedate', 'payment_account_statements.amount', 'users.email', 'users.name as user')
            ->get();

      return view ('reportaccountexpire', compact('queryResults', 'dateIni', 'dateFin'));
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
          // 11/01/2019    01/11/2019
          return $date[2].'-'.$date[1].'-'.$date[0];
        }else{
          return date("Y").'-'.date("m").'-'.date("d");
        }
    }

    /**
    *This method allow validate the field in newsletter views
    */
    private function dataValidator(){

      $data = request()->validate([
        'startdate' => 'required',
        'closedate' => 'required'
      ],[
        'required' => 'El filtro de fecha es obligarorio para el reporte.'
      ]);

      return $data;
    }

    /**
    *This method allow validate the field in newsletter views
    */
    private function dataValidatorStartDate(){

      $data = request()->validate([
        'startdate' => 'required'
      ],[
        'required' => 'El filtro de fecha es obligarorio para el reporte.'
      ]);

      return $data;
    }

}
