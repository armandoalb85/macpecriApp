<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;
use App\Subscriber;
use App\User;
use App\Paises;
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

      $totalFree = $this->countSubscribers(1);
      $totalPay = $this->countSubscribers(2);
      $totalVenezuela = $this->countSubscribers(3);
      $totalSubscribers = $totalPay + $totalFree  + $totalVenezuela;

      $subscriptionTypes = SubscriptionType::all();

      return view ('subscribers', compact('totalPay', 'totalFree', 'totalVenezuela', 'totalSubscribers', 'subscriptionTypes'));
    }

    /*
    *This method return a list subscribers
    */
    public function listSubscribers($type){

      $queryResults = null;
      $type = (integer) $type;
      $typeSubscribers="Total";
      $startDate =null;
      $closeDate = null;

      if ($type > 0){

        $typeSubscribers=SubscriptionType::find($type);

        $queryResults = DB::table('subscribers')
          //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->join('status','status.id', '=', 'users.status_id')
          ->join('paises','paises.id', '=', 'subscribers.country_id')
          ->where('subscribers.subscription_types_id', '=', $type)
          ->where('users.status_id', '=', 1)
          //->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email','paises.country', 'status.name as status', 'subscription_types.name as types', 'subscribers.created_at')
          ->orderBy('subscribers.name','asc')
          ->get();
      }else{
        $queryResults = DB::table('subscribers')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->join('status','status.id', '=', 'users.status_id')
          ->join('paises','paises.id', '=', 'subscribers.country_id')
          ->where('users.status_id', '=', 1)
          //->whereNull('subscriber_subscription_type.closedate')
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email','paises.country', 'status.name as status', 'subscription_types.name as types','subscribers.created_at')
          ->orderBy('subscribers.name','asc')
          ->get();//->toSql();
          //dd($queryResults);
      }

      return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    *This method return a list subscriber by filter
    */
    public function listSubscribersByFilter(Request $request){

      $queryResults = null;
      $typeSubscribers="Total";
      $startDate = $request->startdate;
      $closeDate = $request->closedate;
      $data = $this->dataValidatorDate();

      if ($request->subscriptionType > 0){

        $typeSubscribers=SubscriptionType::find($request->subscriptionType);

        $queryResults = DB::table('subscribers')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->join('status','status.id', '=', 'users.status_id')
          ->join('paises','paises.id', '=', 'subscribers.country_id')
          ->where('subscribers.created_at','>=', $request->startdate)
          ->where('subscribers.created_at','<=', $request->closedate)
          ->where('subscription_types.id', '=', $request->subscriptionType)
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email','paises.country', 'status.name as status', 'subscription_types.name as types', 'subscribers.created_at')
          ->get();
      }else{
        $queryResults = DB::table('subscribers')
          ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
          ->join('users','users.id', '=', 'subscribers.user_id')
          ->join('status','status.id', '=', 'users.status_id')
          ->join('paises','paises.id', '=', 'subscribers.country_id')
          ->where('subscribers.created_at','>=', $request->startdate)
          ->where('subscribers.created_at','<=', $request->closedate)
          ->select('subscribers.id','subscribers.name', 'subscribers.lastname', 'users.email','paises.country', 'status.name as status', 'subscription_types.name as types', 'subscribers.created_at')
          ->get();
      }

      return view('subscribermanager',compact('queryResults', 'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    This method show a dashboard for check payments by subscribers
    */
    public function checkPaymentsBySubscribers(){
      $dateIni = null;
      $dateFin = null;
      $payments = DB::table('subscription_types')->where('subscription_types.name','=', '')->get();
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('paymentsbysubscribers',compact('subscriptionTypes', 'payments', 'dateIni', 'dateFin'));
    }

    /*
    This method show a list with payments by subscribers
    */
    public function listPaymentBySubscribers(Request $request){

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;

      $data = $this->dataValidator();

      $payments = DB::table('subscribers')
            ->join('payment_account_statements', 'payment_account_statements.subscriber_id', '=', 'subscribers.id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payment_account_statements.paymentmethod_id')
            ->where('payment_account_statements.subscriber_id', '>', 0)
            ->where('payment_account_statements.amount', '>', 0.99)
            ->where('payment_account_statements.startdate', '>=', $request->startdate)
            ->where('payment_account_statements.startdate', '<=', $request->closedate)
            ->select('subscribers.name','subscribers.lastname', 'payment_account_statements.amount as cost', 
            'payment_account_statements.startdate as paymentdate', 'payment_account_statements.closedate as payclosedate', 
            'payment_account_statements.amount as amount', 'users.email as email', 'subscribers.created_at as subscriptiondate', 
            'payment_methods.name as method')//->toSql();
            ->get();
      //dd($request->startdate,$request->closedate,$payments);
      
      return view ('paymentsbysubscribers',compact('payments', 'dateIni', 'dateFin'));
    }

    /*
    This method show a dashboard for check subscribers with depts
    */
    public function checkSubscribersWithDebts(){
      $dateIni = null;
      $dateFin = null;
      $payments = DB::table('subscription_types')->where('subscription_types.name','=', '')->get();
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);
      return view ('subscriberswithdepts', compact('subscriptionTypes', 'payments', 'dateIni', 'dateFin'));
    }

    /*
    This method show a list with depts by subscribers
    */
    public function listDebtsBySubscribers(Request $request){

      $dateIni = $request->startdate;
      $dateFin = $request->closedate;
      $subscriptionTypes = SubscriptionType::where("type","=", "Pago")->paginate(10);

      $data = $this->dataValidator();
      
      $payments = DB::table('subscribers')
      ->join('users', 'users.id', '=', 'subscribers.user_id')
      ->join('subscriber_subscription_type', 'subscriber_subscription_type.subscriber_id', '=', 'subscribers.id')
      ->join('payment_account_statements', 'payment_account_statements.subscriber_id', '=', 'subscribers.id')
      ->where('subscriber_subscription_type.expired', '=', 1)
      ->where('subscriber_subscription_type.startdate', '>=', $request->startdate)
      ->where('subscriber_subscription_type.startdate', '<=', $request->closedate)
      ->groupBy()
      ->select('subscribers.name','subscribers.lastname', 'users.email as email', 
      'subscribers.created_at as subscriptiondate', 'subscriber_subscription_type.closedate'
      , 'payment_account_statements.amount as cost')//->toSql();
      ->get();
    
      return view ('subscriberswithdepts',compact('subscriptionTypes', 'payments', 'dateIni', 'dateFin'));

    }

    /*
    * This method show detail the subscribers
    */
    public function showSubscriber($id, $type, $startdate, $closedate){

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);
      $country = Paises::find($subscriber->country_id);
      //dd($subscriber->country_id);
      $typeSubscribers = $type;
      $startDate = $startdate;
      $closeDate = $closedate;

        $subscriberAccount = DB::table ('subscribers')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->join('users', 'users.id', '=', 'subscribers.user_id')
        ->join('status', 'status.id', '=', 'users.status_id')
        ->where('subscribers.id', '=', $id)
        ->select('status.name as status', 'subscription_types.name')
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
        ->select('payment_account_statements.startdate', 'payment_account_statements.closedate')
        ->get();

      return view ('showsubscribers', compact('subscriber', 'subscriberAccount', 'subscriberPayment', 'account', 'typeSubscribers','country', 'startDate', 'closeDate'));
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
      
      if($subscriber->subscription_types_id==2){
        $subscriberAccount = DB::table ('subscribers')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->join('users', 'users.id', '=', 'subscribers.user_id')
        ->join('status', 'status.id', '=', 'users.status_id')
        ->join('payment_account_statements', 'subscribers.id', '=', 'payment_account_statements.subscriber_id')
        ->join('payment_methods', 'payment_methods.id', '=', 'payment_account_statements.paymentmethod_id')
        ->join('paises', 'paises.id', '=', 'subscribers.country_id')
        ->where('subscribers.id', '=', $subscriber->id)
        ->select('status.name as status','payment_methods.name as payment_method', 
        'subscription_types.name','payment_account_statements.startdate',
        'payment_account_statements.closedate','payment_account_statements.amount','paises.country')
        ->orderBy('payment_account_statements.closedate','desc')
        ->take(1)
        ->get();
      }else{
        $subscriberAccount = DB::table ('subscribers')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->join('users', 'users.id', '=', 'subscribers.user_id')
        ->join('status', 'status.id', '=', 'users.status_id')
        //->join('payment_account_statements', 'subscribers.id', '=', 'payment_account_statements.subscriber_id')
        //->join('payment_methods', 'payment_methods.id', '=', 'payment_account_statements.paymentmethod_id')
        ->join('paises', 'paises.id', '=', 'subscribers.country_id')
        ->where('subscribers.id', '=', $subscriber->id)
        ->select('status.name as status', 
        'subscription_types.name','paises.country')
        ->take(1)
        ->get();
      }
      

        //dd( $subscriber->id);
        //dd(" - hola -",$subscriberAccount,$subscriber->id);

      return view ('editsubscribers', compact('subscriber', 'subscriberAccount', 'account', 
      'typeSubscribers', 'startDate', 'closeDate'));
    }

    /*
    * This method update a subscriber
    */
    public function updateSubscriber(Request $request, $id){

      $validateData = $this->subscriberInfoValidator();

      $subscriber = Subscriber::find($id);
      $account = User::find($subscriber->user_id);

      $account->status_id = $request->status;
      $account->username = $request->email;
      $account->email = $request->email;
      $accoutUpd = $account->save();

      $accountUpdated =$account->update();

      //if ($accountUpdated || $affectedRegister > 0){
      if ($account){
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
        //'password' => 'required|min:6',
        'password' => ['required', 'regex:/\A(?=.*[A-Z])(?=.*\d)(?=.*(?:!|#|\$|%|&|\/|\(|\)|=|\?|\*|\.)).{6,16}\z/'],
        'passwordConfirmation' => 'required|same:password'
      ],[
        'password.required' => 'Nueva contraseña es obligatoria.',
        'passwordConfirmation.required' => 'Confirmación de contraseña es obligatoria.',
        'min'=> 'El campo de contraseña no puede tener menos de :min carácteres.',
        'passwordConfirmation.same' => 'Nueva contraseña y confirmación de contraseña deben coincidir.',
        'regex' => 'La contraseña debe contener de seis a dieciséis caracteres y como mínimo una mayúscula, un número y un símbolo.'
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
        ->join('users', 'users.id', '=', 'subscribers.user_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->where('users.status_id', '=', 1)
        ->where('subscription_types.id', '=', $type)
        //->whereNull('subscriber_subscription_type.closedate')
        ->count();

        return $total;
    }

}
