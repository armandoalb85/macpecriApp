<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;
use App\SubscriptionMessage;
use DB;

class SubscriptionMessagesController extends Controller
{
    private $typeMessage = array('Más','Porque Macpecri', 'Precios', 'Que Obtienes');
    private $codeMessage;
    private $message;

    public function __construct()
    {
        $this->middleware('auth');

        $codeMessage = 'warning';
        $message = 'Ocurrio un problema con la operación, intentlo de nuevo.';
    }

    /*
    *This method show a message on subscriber now
    */
    public function showSubscriptionMessage(){

    }

    /*
    *This method allow create a message
    */
    public function newSubscriptionMessage($id){
      $types = $this->typeMessage;
      $subscribeNow = SubscribeNow::find($id);
      return view('createmessage', compact('subscribeNow','types'));
    }

    /*
    *This method allow save a massage
    */
    public function saveSubscriptionMessage(Request $request, $idMessageConfig){

      $data = $this->dataValidator();

      $canInsert = $this->doesTheMessageExist($request->type, $idMessageConfig) ? true: false;

      if ($canInsert){
        $this->codeMessage = 'danger';
        $this->message = '';
        $newSubscriptionMessage = new SubscriptionMessage();
        $newSubscriptionMessage->type = $this->getCodeTypeMessage($request->type);
        $newSubscriptionMessage->status = $request->status;
        $newSubscriptionMessage->message = $request->message;
        $newSubscriptionMessage->configmessage_id = $idMessageConfig;
        $operationResult = $newSubscriptionMessage->save();

        if ($operationResult){
          $this->codeMessage = 'info';
          $this->message = 'El nuevo regitro fue guardado con exito.';
        }

      }else{
        $this->codeMessage = 'error';
        $this->message = 'El mensaje ya existe o esta completa la configuración de mensaje.';
      }

      return redirect('suscribase_ahora/detalle/'.$idMessageConfig)->with($this->codeMessage, $this->message);
    }

    /*
    *This method allow edit a message
    */
    public function editSubscriptionMessage(){

    }

    /*
    *This method allow update a message
    */
    public function updateSubscriptionMessage(){

    }

    /*
    *This method allow delete a message
    */
    public function destroySubscriptionMessage(){

    }

    /*
    *This method validate if possible save or update a message
    */
    private function doesTheMessageExist($messageType, $id){
      $value = true;
      $table = 'subscription_messages';

      switch ($messageType) {
          case 'Más':
              $value = $this->searchingMessage($table,'Mas', $id);
              break;
          case 'Porque Macpecri':
              $value = $this->searchingMessage($table,'Porque', $id);
              break;
          case 'Precios':
              $value = $this->searchingMessage($table,'Precio', $id);
              break;
          case 'Que Obtienes':
              $value = $this->searchingMessage($table,'Beneficio', $id);
              break;
          default:
            $value = false;
            break;

      }

      return $value;
    }

    /*
    *This method return a value message type
    */
    private function getCodeTypeMessage($messageType){

      $value = '';

      switch ($messageType) {
          case 'Más':
              $value = 'Mas';
              break;
          case 'Porque Macpecri':
              $value = 'Porque'; //ventajas
              break;
          case 'Precios':
              $value = 'Precio';
              break;
          case 'Que Obtienes':
              $value = 'Beneficio';
              break;
      }

      return $value;
    }

    /*
    * This method verify if exi an active specific type message
    */
    private function searchingMessage($table, $type, $id){
      $value = true;

      $result = DB::table($table)
        ->where('subscription_messages.configmessage_id','=', $id)
        ->where('subscription_messages.status','=', 'Activo')
        ->where('subscription_messages.type','=', $type)->get();

      if ($result->count()){
        switch ($type) {
            case 'Mas':
                $value = ($result->count() == 3)? false: true;
                break;
            case 'Porque':
                $value = ($result->count() == 1)? false: true;
                break;
            case 'Precio':
                $value = ($result->count() == 2)? false: true;
                break;
            case 'Beneficio':
                $value = ($result->count() == 1)? false: true;
                break;
        }
      }

      return $value;
    }

    /**
    *This method allow validate the field in createsubsritionmessage views
    */
    private function dataValidator(){

      $data = request()->validate([
        'message' => 'required'
      ],[
        'message.required' => 'Elc ontenido del mensaje es obligatorio.'
      ]);

      return $data;
    }
}
