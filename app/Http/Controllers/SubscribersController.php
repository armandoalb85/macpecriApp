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
      $typeSubscribers = $type;
      $startDate =null;
      $closeDate = null;

      if ($type == 'Gratuita' || $type == 'Pago' || $type == 'Venezuela'){
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->where('subscription_types.type', '=', $type)
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type', 'subscriber_subscription_type.startdate')
          ->get();
      }elseif($type == 'Total'){
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type','subscriber_subscription_type.startdate')
          ->get();
      }

      return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    *This method return a list subscriber by filter
    */
    public function listSubscribersByFilter(Request $request){

      $queryResults = null;
      $typeSubscribers = $request->subscriptionType;
      $startDate = $request->startdate;
      $closeDate = $request->closedate;
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
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type', 'subscriber_subscription_type.startdate')
          ->get();
      }else{
        $queryResults = DB::table('subscribers')
          ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->where('subscriber_subscription_type.startdate','>=', $request->startdate)
          ->where('subscriber_subscription_type.startdate','<=', $request->closedate)
          ->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email', 'subscriber_subscription_type.status', 'subscription_types.type', 'subscriber_subscription_type.startdate')
          ->get();
      }

      return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
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
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payment_method_records.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('subscription_types.name', '=', $request->subscriptionType)
            ->where('payment_account_statements.closedate', '>=', $request->startdate)
            ->where('payment_account_statements.closedate', '<=', $request->closedate)
            ->select('subscription_types.name as name', 'subscription_types.cost as cost', 'subscription_types.daysforpaying as daysforpaying', 'subscribers.name as subsname', 'subscribers.lastname as subslastname', 'payment_account_statements.startdate as paymentdate', 'payment_account_statements.closedate as payclosedate', 'payment_account_statements.amount as amount', 'users.email as email', 'subscriber_subscription_type.startdate as subscriptiondate', 'payment_methods.name as method')
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
    public function listDebtsBySubscribers(Request $request){

      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);

      $data = $this->dataValidator();

      $payments = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
            ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payment_method_records.paymentmethod_id')
            ->where('subscription_types.type', '=', 'Pago')
            ->where('subscription_types.name', '=', $request->subscriptionType)
            ->where('payment_account_statements.startdate', '>=', $request->startdate)
            ->where('payment_account_statements.startdate', '<=', $request->closedate)
            ->whereNull('payment_account_statements.closedate')
            ->select('subscription_types.name as type', 'subscription_types.cost as cost', 'subscription_types.daysforpaying as daysforpaying', 'subscribers.name as subsname', 'subscribers.lastname as subslastname', 'payment_account_statements.startdate as paymentdate', 'payment_account_statements.closedate as payclosedate', 'payment_account_statements.amount as amount', 'users.email as email', 'subscriber_subscription_type.startDate as suscripcion','payment_methods.name as method')
            ->get();

      return view ('subscriberswithdepts',compact('subscriptionTypes', 'payments'));

    }

    /*
    * This method show detail the subscribers
    */
    public function showSubscriber($id, $type, $startdate, $closedate){

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);

      $typeSubscribers = $type;
      $startDate = $startdate;
      $closeDate = $closedate;

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

      return view ('showsubscribers', compact('subscriber', 'subscriberAccount', 'subscriberPayment', 'account', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    * this method show a edit view for subscirber
    */
    public function editSubscriber($id, $type, $startdate, $closedate){

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);

      $typeSubscribers = $type;
      $startDate = $startdate;
      $closeDate = $closedate;

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

      return view ('editsubscribers', compact('subscriber', 'subscriberAccount', 'subscriberPayment', 'account', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    * This method update a subscriber
    */
    public function updateSubscriber(Request $request, $id){

      $validateData = $this->subscriberInfoValidator();
      $data = explode('-',date('Y-m-d'));
      $today = $data[0].'-'.$data[1].'-'.$data[2];

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);
      $subscriberAccount = DB::table ('subscribers')
        ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
        ->where('subscribers.id', '=', $id)
        ->whereNull('subscriber_subscription_type.closedate')
        ->select('subscriber_subscription_type.status', 'subscription_types.type', 'subscriber_subscription_type.limit', 'subscriber_subscription_type.subscription_id')
        ->get();

      $account->email = $request->email;

      if ($subscriberAccount[0]->status != $request->status){
        $affectedRegister = DB::update("update subscriber_subscription_type set status ='".$request->status."', closedate='".$today."' where closedate is null AND subscriber_id = ?", [$id]);
        $limit = "`limit`";
        DB::insert('insert into subscriber_subscription_type (startdate, status,'.$limit.', created_at, updated_at, subscriber_id, subscription_id) values (?, ?, ?, ?, ?, ?, ?) ', [$today,$request->status,$subscriberAccount[0]->limit, $today, $today, $subscriber->id,$subscriberAccount[0]->subscription_id]);
      }

      $accountUpdated =$account->update();

      if ($accountUpdated || $affectedRegister > 0){
        $this->codeMessage = 'info';
        $this->message = 'La información del suscriptor fue actualizada con éxito.';
      }

      if ($request->startDate == 'a'){
        return redirect(action('SubscribersController@listSubscribers', $request->subscriberType))->with($this->codeMessage, $this->message);
      }else{
        return redirect(action('specialsController@listSubscribersByFilterWihtParams', [$request->subscriberType,$request->startDate,$request->closeDate]))->with($this->codeMessage, $this->message);
      }

    }

    public function editPasswordSubscriber($id, $type, $startdate, $closedate){

      $subscriber = Subscriber::find($id);

      $typeSubscribers = $type;
      $startDate = $startdate;
      $closeDate = $closedate;

      return view ('editpasswordsubscriber', compact('subscriber', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    public function updatePasswordSubscriber(Request $request, $id){

      $data = $this->passwordValidator();
      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);

      $account->password = md5($request->password);
      $accountUpdated = $account->update();

      if ($accountUpdated){
        $this->codeMessage = 'info';
        $this->message = 'La contraseña del suscriptor fue actualizada con éxito.';
      }

      if ($request->startDate == 'a'){
        return redirect(action('SubscribersController@listSubscribers', $request->subscriberType))->with($this->codeMessage, $this->message);
      }else{
        return redirect(action('specialsController@listSubscribersByFilterWihtParams', [$request->subscriberType,$request->startDate,$request->closeDate]))->with($this->codeMessage, $this->message);
      }

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

    private function passwordValidator(){

      $data = request()->validate([
        'password' => 'required',
        'passwordConfirmation' => 'required',
        'password' => 'required|min:6',
        'password' => ['required', 'regex:/\A(?=.*[A-Z])(?=.*\d)(?=.*(?:!|#|\$|%|&|\/|\(|\)|=|\?|\*|\.)).{6,8}\z/'],
        'passwordConfirmation' => 'required|same:password'
      ],[
        'password.required' => 'Nueva contraseña es obligatoria.',
        'passwordConfirmation.required' => 'comfirmacion de contraseña es obligatoria.',
        'min'=> 'El campo de contraseña no puede tener menos de :min carácteres.',
        'passwordConfirmation.same' => 'Nueva contraseña y confirmación de contraseña deben coincidir.',
        'regex' => 'La contraseña debe contener 6 a 8 caracteres, al menos una mayúscula, al menos un dígito, y al menos un símbolo'
      ]);

      return $data;
    }

    private function subscriberInfoValidator(){

      $data = request()->validate([
        'email'    => 'required',
        'email' => ['required', 'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/']
      ],[
        'required' => 'El campo de correo es obligatorio.',
        'regex' => 'El formato de correo no es correcto'
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
