<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscriptionType;

class SubscriptionTypesController extends Controller
{
    public function indexSubscriptionType(){
      $sucriptions=SubscriptionType::orderBy('id','DESC')->paginate(3);
      return view('subscriptiontype',compact('sucriptions'));
    }

    public function showSubscriptionType($id){
       $subscription=SubscriptionType::find($id);
        return  view('showsubscriptiontype',compact('subscription'));
    }

    public function newSubscriptionType(){
      return view('createsubscriptiontype');
    }

    public function saveSubscriptionType(Request $request){

      $data = request()->validate([
        'tipo' => 'required',
        'limit' => 'required'
      ],[
        'tipo.required' => 'Tipo de Suscripción es obligatorio.',
        'limit.required' => 'Indique un limite de articulos de lectura.'
      ]);

      $SubscriptionType = new SubscriptionType();
      $SubscriptionType->name = $request->tipo;
      $SubscriptionType->description = $request->description;
      $SubscriptionType->cost = $request->cost;
      $SubscriptionType->limit = $request->limit;
      $SubscriptionType->status = $request->status;
      $SubscriptionType->save();

      return redirect('suscripciones');

    }

    public function editSubscriptionType($id){
      $subscription=SubscriptionType::find($id);
      return  view('editsubscriptiontype',compact('subscription'));
    }

    public function updateSubscriptionType(Request $request, $id){

      $data = request()->validate([
        'tipo' => 'required',
        'limit' => 'required'
      ],[
        'tipo.required' => 'Tipo de Suscripción es obligatorio.',
        'limit.required' => 'Indique un limite de articulos de lectura.'
      ]);

      $subscription = SubscriptionType::find($id);
      $subscription ->name = $request->tipo;
      $subscription->description = $request->description;
      $subscription->cost = $request->cost;
      $subscription->limit = $request->limit;
      $subscription->status = $request->status;
      $subscription->update();
      return redirect('suscripciones');
    }

    public function destroySubscriptionType($id){

       SubscriptionType::find($id)->delete();
       return redirect('suscripciones');
    }

}
