<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;
use App\Subscriber;
use App\PaymentMethodRecord;
use DB;

class SubscribersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    This method show a subscribers dashboard
    */
    public function indexSubscribers(){

      return view ('subscribers');
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

      $payments = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
            ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('subscription_types.name', '=', $request->subscriptionType)
            ->where('payment_account_statements.closedate', '>=', $this->dateFormat($request->startdate))
            ->where('payment_account_statements.closedate', '<=', $this->dateFormat($request->closedate))
            ->select('subscription_types.name', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscribers.name', 'subscribers.lastname', 'payment_account_statements.startdate', 'payment_account_statements.closedate', 'payment_account_statements.amount')
            ->get();

      return view ('paymentsbysubscribers',compact('subscriptionTypes', 'payments'));
    }

    /*
    This method show a dashboard for check subscribers with depts
    */
    public function checkSubscribersWithDebts(){
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('subscriberswithdepts', compact('subscriptionTypes'));
    }

    /*
    This method show a list with depts by subscribers
    */
    public function listDebtsBySubscribers(){

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
