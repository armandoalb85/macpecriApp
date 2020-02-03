<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;
use Input;
use Validator;
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
    public function indexSubscribeNow(){
      $subscribeNows = SubscribeNow::orderBy('id','category')->paginate(30);
      return view('subscribenow',compact('subscribeNows'));
    }

    /*
    *This method show a message config
    */
    public function  showSubscribeNow($id){
      $url = null;
      $subscribeNow = SubscribeNow::find($id);

      if ($subscribeNow->pathimage != null){
        $public_path = public_path();
        //$url = $public_path.'/imageSubscribeMessage/'.$subscribeNow->pathimage;
        $url = '/imageSubscribeMessage/'.$subscribeNow->pathimage;
      }

      return  view('showsubscribenow',compact('subscribeNow', 'url'));
    }

    /*
    *This method allow edit a message config
    */
    public function editSubscribeNow($id){

      $subscribeNow = SubscribeNow::find($id);
      return view ('editsubscribenow', compact('subscribeNow'));

    }

    /*
    *This method allow update a message config
    */
    public function updateSubscribeNow(Request $request, $id){

      $data = $this->dataValidator();
      $fileName = null;

      $data = $this->dataValidator();

      $file = $request->file('file');


      $subscribeNow = SubscribeNow::find($id);

      if ($file != null){

        if ($subscribeNow->pathimage != null){
          Storage::delete([$subscribeNow->pathimage]);
        }

        $fileName = $file->getClientOriginalName();
        $subscribeNow->pathimage = $fileName;
      }

      $subscribeNow->description = $request->description;
      $subscribeNow->status = $request->status;

      $operationResult = $subscribeNow->update();

      if($operationResult){
        if ($file != null){
          \Storage::disk('local')->put($fileName,  \File::get($file));
        }

        $codeMessage = 'info';
        $message = 'El registro fue actualizado con éxito.';
      }

      return redirect('suscribase_ahora')->with($codeMessage, $message);

    }

    /**
    *This method allow validate the field in createsubsribenow views
    */
    private function dataValidator(){

      $data = request()->validate([
        'description' => 'required'
      ],[
        'description.required' => 'El contenido del mensaje es obligatorio.'
      ]);

      return $data;
    }

}
