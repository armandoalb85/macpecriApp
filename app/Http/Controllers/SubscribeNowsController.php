<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;
use DB;
use Storage;

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
      $url = null;
      $subscribeNow = SubscribeNow::find($id);
      $messages = DB::table('subscription_messages')->where('subscription_messages.configmessage_id','=', $id)->get();

      if ($subscribeNow->pathimage != null){
        $public_path = public_path();
        //$url = $public_path.'/imageSubscribeMessage/'.$subscribeNow->pathimage;
        $url = '/imageSubscribeMessage/'.$subscribeNow->pathimage;
      }

      return  view('showsubscribenow',compact('subscribeNow', 'messages', 'url'));
    }

    /*
    *This method show a view for create a new message config
    */
    public function newSubscribeMessageConfig(){

      return view ('createsubscribernow');

    }

    /*
    *This method allow save a  message config
    */
    public function saveSubscribeMessageConfig(Request $request){

      $data = $this->dataValidator();

      $status = ($this->thereIsAnActiveMessage()) ? 'Activo':'Inactivo';
      $subscribeNow = new SubscribeNow();

      $subscribeNow->name = $request->name;
      $subscribeNow->description = $request->description;
      $subscribeNow->status = $status;

      $operationResult = $subscribeNow->save();

      if($operationResult){
        $codeMessage = 'info';
        $message = 'El registro fue creado con exito y con estatus '.$status.'.';
      }

      return redirect('suscribase_ahora')->with($codeMessage, $message);

    }

    /*
    *This method allow edit a message config
    */
    public function editSubscribeMessageConfig($id){

      $subscribeNow = SubscribeNow::find($id);
      return view ('editsubscribenow', compact('subscribeNow'));

    }

    /*
    *This method allow update a message config
    */
    public function updateSubscribeMessageConfig(Request $request, $id){

      $data = $this->dataValidator();
      $fileName = null;

      $status = ($this->thereIsAnActiveMessage()) ? 'Activo':'Inactivo';
      $subscribeNow = SubscribeNow::find($id);

      if ($subscribeNow->status == 'Activo' && $request->status == 'Inactivo' ){
        $status = 'Inactivo';
      }

      $file = $request->file('file');

      if ($file != null){
        $fileName = $file->getClientOriginalName();
      }

      $subscribeNow->name = $request->name;
      $subscribeNow->description = $request->description;
      $subscribeNow->status = $status;
      $subscribeNow->pathimage = $fileName;

      $operationResult = $subscribeNow->update();

      if($operationResult){
        if ($file != null){
          \Storage::disk('local')->put($fileName,  \File::get($file));
        }

        $codeMessage = 'info';
        $message = 'El registro fue creado con exito y con estatus '.$status.'.';
      }

      return redirect('suscribase_ahora')->with($codeMessage, $message);

    }

    /*
    *This method allow destroy a message config
    */
    public function destroySubscribeMessageConfig($id){

      $result = DB::table('subscription_messages')->where('subscription_messages.configmessage_id','=', $id);
      $subscribeNow = SubscribeNow::find($id);

      if($result->count()){
        $this->codeMessage = 'error';
        $this->message = 'El registro no puede ser eliminado. El mismo posee una configuracion de mensajes asociada.';
      }else{
        $this->codeMessage = 'info';
        $this->message = 'El registro fue eliminado con exito.';
        Storage::delete([$subscribeNow->pathimage]);
        $subscribeNow->delete();
      }

      return redirect('suscribase_ahora')->with($this->codeMessage, $this->message);

    }

    /*
    * This method verify if exi an active specific type message
    */
    private function thereIsAnActiveMessage(){
      $value = true;

      $result = DB::table('subscribe_nows')
        ->where('subscribe_nows.status','=', 'Activo')->get();

      $value = ($result->count())? false: true;

      return $value;
    }

    /**
    *This method allow validate the field in createsubsribenow views
    */
    private function dataValidator(){

      $data = request()->validate([
        'description' => 'required',
        'name' => 'required'
      ],[
        'description.required' => 'El ontenido del mensaje es obligatorio.',
        'name.required' => 'Es obligatorio que identifique el mensaje.'
      ]);

      return $data;
    }


}
