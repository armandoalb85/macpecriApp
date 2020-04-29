<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;
use SubscriberController;
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

      $sc = new SubscribersController();

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      $data = $this->dataValidator();

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $queryResults = DB::table('convertion_accounts')
            ->join('subscribers', 'subscribers.id', '=', 'convertion_accounts.subscriber_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'convertion_accounts.paymentmethod_id')
            ->where('convertion_accounts.startdate', '>=', $request->startdate)
            ->where('convertion_accounts.startdate', '<=', $request->closedate)
            ->where('users.status_id', '=', 1)
            ->select('subscribers.name', 'subscribers.lastname', 'users.email', 
            'subscribers.created_at', 'convertion_accounts.startdate', 
            'payment_methods.name as method')
            ->get();

      if ($queryResults != null){
        $totalPay = $sc->countSubscribers(2);
        $totalFree = $sc->countSubscribers(1);
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
      $typeSubscription = null;
      $typeAccounts = SubscriptionType::all();
      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni', 'dateFin', 'typeAccounts', 'typeSubscription' ));
    }

    /*
    *This method allows generate a  created account report
    */
    public function reportCreatedAccount(Request $request){

      $queryResults = null;
      $totalPay = null;
      $totalFree = null;
      $typeSubscription = null;
      $data = $this->dataValidator();

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;
      $typeSubscription = $request->type;

      $typeAccounts = SubscriptionType::all();

      //if($request->type == 'Todos'){
      if($request->type == 0){
        $queryResults = DB::table('subscribers')
              //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              //->whereNull('subscriber_subscription_type.closedate')
              ->where('subscribers.created_at', '>=', $request->startdate)
              ->where('subscribers.created_at', '<=', $request->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscribers.created_at as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->orderBy('subscribers.name','asc')
              ->get();
      //}elseif ($request->type == 'Gratuita' || $request->type == 'Pago' || $request->type == 'Venezuela') {
      }else{
        $queryResults = DB::table('subscribers')
              //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              //->whereNull('subscriber_subscription_type.closedate')
              //->where('subscription_types.name', '=', $request->type )
              ->where('subscription_types.id', '=', $request->type )
              ->where('subscribers.created_at', '>=', $request->startdate)
              ->where('subscribers.created_at', '<=', $request->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscribers.created_at as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->orderBy('subscribers.name','asc')
              ->get();
      }

      if ($queryResults != null ){
        $totalPay = $this->totalPayAccount();
        $totalFree = $this->totalFreeAccount();
      }

      return view ('reportcreateaccount', compact('queryResults', 'totalPay', 'totalFree', 'dateIni', 'dateFin', 'typeAccounts', 'typeSubscription' ));
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

      $data = $this->dataValidator();

      /*$dateIni = $this->dateFormat($request->startdate);
      $dateFin = $this->dateFormat($request->closedate);*/
      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $queryResults = DB::table('payment_methods')
        ->join('payment_account_statements', 'payment_methods.id','=','payment_account_statements.paymentmethod_id')
        ->where('payment_account_statements.startdate', '>=', $request->startdate)
        ->where('payment_account_statements.startdate', '<=', $request->closedate)
        ->select('payment_methods.name',DB::raw('SUM(payment_account_statements.amount) AS amount'),
            DB::raw('COUNT(payment_account_statements.amount) AS counting'))
        ->groupBy('payment_account_statements.paymentmethod_id')
        ->get();

      return view ('reportpaymentuses', compact('queryResults', 'dateIni', 'dateFin'));

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

      $data = $this->dataValidator();

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $queryResults =DB::table('payment_account_statements')
      ->join('payment_methods', 'payment_methods.id','=','payment_account_statements.paymentmethod_id')
      ->whereNotNull('payment_account_statements.closedate')
      ->where('payment_account_statements.startdate', '>=', $request->startdate)
      ->where('payment_account_statements.startdate', '<=', $request->closedate)
      ->where('payment_methods.status', '=', 1)
      ->where('payment_account_statements.subscriber_id', '>', 0)
      ->select('payment_methods.name',DB::raw('SUM(payment_account_statements.amount) AS amount'))
      ->groupBy('payment_account_statements.paymentmethod_id')
      //->toSql();
      ->get();
      //dd($queryResults);

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

      $queryResults = DB::table('payment_account_statements')
            ->join('subscribers', 'subscribers.id', '=', 'payment_account_statements.subscriber_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payment_account_statements.paymentmethod_id')
            ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
            ->where('payment_account_statements.closedate', '>=', $request->startdate)
            ->where('payment_account_statements.closedate', '<=', $request->closedate)
            ->where('users.status_id', '=', 1)
            ->where('subscription_types.id', '=', 2)
            ->select('subscribers.name', 'subscribers.lastname', 'users.email', 
            'subscribers.created_at', 'payment_account_statements.closedate', 
            'payment_methods.name as method','payment_account_statements.amount','subscription_types.daysforpaying',
            DB::raw('TIMESTAMPDIFF(DAY, NOW(), payment_account_statements.closedate) AS days_for_expire'))
            ->havingRaw('TIMESTAMPDIFF(DAY, NOW(), payment_account_statements.closedate) <= subscription_types.daysforpaying')
            ->get();

      return view ('reportaccountexpire', compact('queryResults', 'dateIni', 'dateFin'));
    }

    /*
    * This method return the total subscribed accounts pay
    */
    private function totalPayAccount(){

      $totalPay = DB::table('subscribers')
      ->join('users', 'users.id', '=', 'subscribers.user_id')
      ->where('users.status_id', '=', 1)
      ->where('subscribers.subscription_types_id', '=', 2)
      ->count('subscribers.subscription_types_id');

      return $totalPay;

    }

    /*
    * This method return the total subscribed accounts free
    */
    private function totalFreeAccount(){

      $totalFree = DB::table('subscribers')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->where('users.status_id', '=', 1)
            ->where('subscribers.subscription_types_id', '=', 1)
            ->count('subscribers.subscription_types_id');

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
