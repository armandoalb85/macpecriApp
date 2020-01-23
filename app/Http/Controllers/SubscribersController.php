<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;
use App\Subscriber;
use App\User;
use App\PaymentMethodRecord;
use DB;

class SubscribersController extends Controller
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
    This method show a subscribers dashboard
    */
    public function indexSubscribers(){

      $totalPay = $this->countSubscribers('Pago');
      $totalFree = $this->countSubscribers('Gratuita');
      $totalVenezuela = $this->countSubscribers('Venezuela');
      $totalSubscribers = $totalPay + $totalFree  + $totalVenezuela;

      $subscriptionTypes = SubscriptionType::all();

      return view ('subscribers', compact('totalPay', 'totalFree', 'totalVenezuela', 'totalSubscribers', 'subscriptionTypes'));
    }

    /*
    *This method return a list subscribers
    */
    public function listSubscribers($type){

      $queryResults = null;

      if ($type == 'Gratuita' || $type == 'Pago' || $type == 'Venezuela'){
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->where('subscription_types.type', '=', $type)
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
          ->get();
      }elseif($type == 'Total'){
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
          ->get();
      }

      return view('subscribermanager',compact('queryResults'));
    }

    /*
    *This method return a list subscriber by filter
    */
    public function listSubscribersByFilter(Request $request){

      $queryResults = null;
      $data = $this->dataValidatorDate();

      if ($request->subscriptionType != 'Todos'){
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->where('subscriber_subscription_type.startdate','>=', $request->startdate)
          ->where('subscriber_subscription_type.startdate','<=', $request->closedate)
          ->where('subscription_types.type', '=', $request->subscriptionType)
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
          ->get();
      }else{
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->where('subscriber_subscription_type.startdate','>=', $request->startdate)
          ->where('subscriber_subscription_type.startdate','<=', $request->closedate)
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type')
          ->get();
      }

      return view('subscribermanager',compact('queryResults'));
    }

    /*
    This method show a dashboard for check payments by subscribers
    */
    public function checkPaymentsBySubscribers(){
      $payments = DB::table('subscription_types')->where('subscription_types.name','=', '')->get();
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('paymentsbysubscribers',compact('subscriptionTypes', 'payments'));
    }

    /*
    This method show a list with payments by subscribers
    */
    public function listPaymentBySubscribers(Request $request){

      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);

      $data = $this->dataValidator();

      $payments = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
            ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('subscription_types.name', '=', $request->subscriptionType)
            //->where('payment_account_statements.closedate', '>=', $this->dateFormat($request->startdate))
            //->where('payment_account_statements.closedate', '<=', $this->dateFormat($request->closedate))
            ->where('payment_account_statements.closedate', '>=', $request->startdate)
            ->where('payment_account_statements.closedate', '<=', $request->closedate)
            ->select('subscription_types.name', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscribers.name', 'subscribers.lastname', 'payment_account_statements.startdate', 'payment_account_statements.closedate', 'payment_account_statements.amount')
            ->get();

      return view ('paymentsbysubscribers',compact('subscriptionTypes', 'payments'));
    }

    /*
    This method show a dashboard for check subscribers with depts
    */
    public function checkSubscribersWithDebts(){
      $payments = DB::table('subscription_types')->where('subscription_types.name','=', '')->get();
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('subscriberswithdepts', compact('subscriptionTypes', 'payments'));
    }

    /*
    This method show a list with depts by subscribers
    */
    public function listDebtsBySubscribers(REquest $request){



      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);

      $data = $this->dataValidatorOneDate();

      $payments = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
            ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('subscription_types.name', '=', $request->subscriptionType)
            //->where('payment_account_statements.startdate', '>=', $this->dateFormat($request->startdate))
            ->where('payment_account_statements.startdate', '>=', $request->startdate)
            ->whereNull('payment_account_statements.closedate')
            ->select('subscription_types.name', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscribers.name', 'subscribers.lastname', 'payment_account_statements.startdate', 'payment_account_statements.closedate', 'payment_account_statements.amount')
            ->get();

      return view ('subscriberswithdepts',compact('subscriptionTypes', 'payments'));

    }

    /*
    * This method show detail the subscribers
    */
    public function showSubscriber($id){

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);
      $subscriberAccount = DB::table ('subscribers')
        ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
        ->where('subscribers.id', '=', $id)
        ->whereNull('subscriber_subscription_type.closedate')
        ->select('subscriber_subscription_type.status', 'subscription_types.type')
        ->get();

        $subQuery = DB::table('subscribers')
                ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
                ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
                ->where('subscribers.id', '=', $id )
                ->max('payment_account_statements.startdate');

      $subscriberPayment = DB::table('subscribers')
        ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
        ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
        ->where('subscribers.id', '=', $id )
        ->where('payment_account_statements.startdate', '=', $subQuery )
        ->select('payment_account_statements.startdate', 'payment_account_statements.closedate','payment_account_statements.status')
        ->get();



      return view ('showsubscribers', compact('subscriber', 'subscriberAccount', 'subscriberPayment', 'account'));
    }

    /*
    * this method show a edit view for subscirber
    */
    public function editSubscriber(){

    }

    /*
    * This method update a subscriber
    */
    public function updateSubscriber(){

    }

    /*
    This method allow aplicate format on date parameter
    */
    private function dateFormat($value){
        $date;

        if($value != ''){
          $date = explode('/', $value);
          ///01/10/2020
          //return $date[2].'-'.$date[0].'-'.$date[1];
          //10/01/2020
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
        'required' => 'El filtro de fecha es obligarorio para consulta.'
      ]);

      return $data;
    }

    /**
    *This method allow validate the field in newsletter views
    */
    private function dataValidatorOneDate(){

      $data = request()->validate([
        'startdate' => 'required'
      ],[
        'required' => 'El filtro de fecha es obligarorio para consulta.'
      ]);

      return $data;
    }

    /**
    *This method allow validate the field in newsletter views
    */
    private function dataValidatorDate(){

      $data = request()->validate([
        'startdate' => 'required',
        'closedate' => 'required'
      ],[
        'required' => 'El filtro de fecha es obligarorio para consulta.'
      ]);

      return $data;
    }

    /*
    * This method count the subscribers
    */
    public function countSubscribers($type){

      $total = DB::table('subscribers')
        ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
        ->where('subscription_types.type', '=', $type)
        ->whereNull('subscriber_subscription_type.closedate')
        ->count();

        return $total;
    }

}
