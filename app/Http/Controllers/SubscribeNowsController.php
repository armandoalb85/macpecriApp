<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;
use App\AppRoute;
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
      //$subscribeNows = SubscribeNow::orderBy('id','category')->paginate(30);
      $subscribeNows = DB::table('subscribe_nows')
        ->join('status','status.id','=','subscribe_nows.status')
        ->select('subscribe_nows.id','subscribe_nows.name','subscribe_nows.category','status.name as status')
        ->orderBy('subscribe_nows.id','subscribe_nows.category')->paginate(30);

      return view('subscribenow',compact('subscribeNows'));
    }

    /*
    *This method show a message config
    */
    public function showSubscribeNow($id){
      $url = null;
      //$subscribeNow = SubscribeNow::find($id);
      $subscribeNow = DB::table('subscribe_nows')
        ->join('status','status.id','=','subscribe_nows.status')
        ->where('subscribe_nows.id','=',$id)
        ->select('subscribe_nows.id','subscribe_nows.name','subscribe_nows.category',
        'status.name as status','subscribe_nows.pathimage','subscribe_nows.description')
        ->get();

      if ($subscribeNow[0]->pathimage != null){
        $public_path = public_path();
        $url = $subscribeNow[0]->pathimage;
      }
      //dd($subscribeNow->name);
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

      $fileName = null;
      $url=$this->searchPathSubscriberNowImage(2);

      $data = $this->dataValidator();

      $file = $request->file('file');


      $subscribeNow = SubscribeNow::find($id);

      if ($file != null){

        if ($subscribeNow->pathimage != null){
          Storage::delete([$subscribeNow->pathimage]);
        }

        $fileName = $file->getClientOriginalName();
        $subscribeNow->pathimage = $url.$fileName;
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
        'description' => 'required',
        'file' => 'image|mimes:jpeg, png, jpg|max:4096'
      ],[
        'description.required' => 'El contenido del mensaje es obligatorio.',
        'file.image' => 'Solo se permiten archivos jpg, png y jpeg.',
        'file.max' => 'El archivo no debe pesar más de 4 MB.'
      ]);

      return $data;
    }

    /**
     * función que busca la ruta donde se encuentra la imagen
     *
     * @param integer $id
     * @return string
     */
    private function searchPathSubscriberNowImage($id){
      
      $path = AppRoute::where('id', $id)->first();

      return $path->route;
      
    }

}
