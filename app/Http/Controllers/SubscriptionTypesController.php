<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;

class SubscriptionTypesController extends Controller
{
    private $codeMessage;
    private $message;

    public function __construct()
    {
        $this->middleware('auth');
        $codeMessage = 'warning';
        $message = 'Ocurrio un problema con la operación, intentlo de nuevo.';
    }

    /**
    *This method show a index page with subscription type in a data table
    */
    public function indexSubscriptionType(){
      $sucriptions=SubscriptionType::orderBy('id','DESC')->paginate(10);
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
      $SubscriptionType->cost = ($this->columnValidator($request->cost)) ? $request->cost : 0;
      $SubscriptionType->limit = $request->limit;
      $SubscriptionType->status = $request->status;
      $SubscriptionType->daysforpaying = ($this->columnValidator($request->daysforpaying)) ? $request->daysforpaying : 0;
      $SubscriptionType->type =  ($this->columnValidator($request->cost)) ? 'Pago' : 'Gratuita';
      $operationResult = $SubscriptionType->save();

      if ($operationResult){
        $this->codeMessage = 'info';
        $this->message = 'El nuevo regitro fue guardado con exito.';
      }

      return redirect('suscripciones')->with($this->codeMessage, $this->message);

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
      $subscription->cost = ($this->columnValidator($request->cost)) ? $request->cost : 0;
      $subscription->limit = $request->limit;
      $subscription->status = $request->status;
      $subscription->daysforpaying = ($this->columnValidator($request->daysforpaying)) ? $request->daysforpaying : 0;
      $subscription->type = ($this->columnValidator($request->cost)) ? 'Pago' : 'Gratuita';
      $operationResult = $subscription->update();

      if ($operationResult){
        $this->codeMessage = 'info';
        $this->message = 'El regitro fue actualizado con exito.';
      }

      return redirect('suscripciones')->with($this->codeMessage, $this->message);
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

    /*
    *This method validate if column is empty
    */
    private function columnValidator($column){

      $value = false;

      if ($column > '0' or $column > 0){
        $value = true;
      }

      return $value;
    }

}
