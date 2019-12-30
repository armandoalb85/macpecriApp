<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;
use DB;

class SubscribeNowsController extends Controller
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
    *This method show a index page with message config list
    */
    public function indexSubscribeMessageConfig(){
      $subscribeNows = SubscribeNow::orderBy('id','type')->paginate(30);
      return view('subscribenow',compact('subscribeNows'));
    }

    /*
    *This method show a message config
    */
    public function  showSubscribeMessageConfig($id){
      $subscribeNow = SubscribeNow::find($id);
      $messages = DB::table('subscription_messages')->where('subscription_messages.configmessage_id','=', $id)->get();
      return  view('showsubscribenow',compact('subscribeNow', 'messages'));
    }

    /*
    *This method show a view for create a new message config
    */
    public function newSubscribeMessageConfig(){

    }

    /*
    *This method allow save a  message config
    */
    public function saveSubscribeMessageConfig(){

    }

    /*
    *This method allow edit a message config
    */
    public function editSubscribeMessageConfig(){

    }

    /*
    *This method allow update a message config
    */
    public function updateSubscribeMessageConfig(){

    }

    /*
    *This method allow destroy a message config
    */
    public function destroySubscribeMessageConfig($id){

      $result = DB::table('subscription_messages')->where('subscription_messages.configmessage_id','=', $id);

      if($result->count()){
        $this->codeMessage = 'error';
        $this->message = 'El registro no puede ser eliminado. El mismo posee una configuracion de mensajes asociada.';
      }else{
        $this->codeMessage = 'info';
        $this->message = 'El registro fue eliminado con exito.';
        SubscribeNow::find($id)->delete();
      }

      return redirect('suscribase_ahora')->with($this->codeMessage, $this->message);

    }


}
