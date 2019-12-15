<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;

class SubscriptionTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *This method show a index page with subscription type in a data table
    */
    public function indexSubscriptionType(){
      $sucriptions=SubscriptionType::orderBy('id','DESC')->paginate(3);
      return view('subscriptiontype',compact('sucriptions'));
    }

    /**
    *This method show a  page with an specific subscription type
    */
    public function showSubscriptionType($id){
       $subscription=SubscriptionType::find($id);
        return  view('showsubscriptiontype',compact('subscription'));
    }

    /**
    *This method show a page for create a subscription type
    */
    public function newSubscriptionType(){
      return view('createsubscriptiontype');
    }

    /**
    *This method allow create a subscriptionType
    */
    public function saveSubscriptionType(Request $request){

      $data = $this->dataValidator();

      $SubscriptionType = new SubscriptionType();
      $SubscriptionType->name = $request->tipo;
      $SubscriptionType->description = $request->description;
      $SubscriptionType->cost = $request->cost;
      $SubscriptionType->limit = $request->limit;
      $SubscriptionType->status = $request->status;
      $SubscriptionType->save();

      return redirect('suscripciones');

    }

    /**
    *This method show page to edit a subscription type
    */
    public function editSubscriptionType($id){
      $subscription=SubscriptionType::find($id);
      return  view('editsubscriptiontype',compact('subscription'));
    }

    /**
    *This method allow update a subscription type
    */
    public function updateSubscriptionType(Request $request, $id){

      $data = $this->dataValidator();

      $subscription = SubscriptionType::find($id);
      $subscription ->name = $request->tipo;
      $subscription->description = $request->description;
      $subscription->cost = $request->cost;
      $subscription->limit = $request->limit;
      $subscription->status = $request->status;
      $subscription->update();

      return redirect('suscripciones');
    }

    /**
    *This method allow destroy a subscription type
    */
    public function destroySubscriptionType($id){

       SubscriptionType::find($id)->delete();
       return redirect('suscripciones');
    }

    /**
    *This method allow validate the field in subscription type views
    */
    private function dataValidator() {

      $data = request()->validate([
        'tipo' => 'required',
        'limit' => 'required'
      ],[
        'tipo.required' => 'Tipo de Suscripción es obligatorio.',
        'limit.required' => 'Indique un limite de articulos de lectura.'
      ]);

      return $data;

    }

}
