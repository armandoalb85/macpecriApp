<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use DateTime;

class NewslettersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    This method show a newsletter dashboard
    */
    public function indexNewsletters(){
      $newsletters = Newsletter::orderBy('id','DESC')->paginate(3);
      return view('newsletters',compact('newsletters'));
    }

    /*
    This method show a newsletter in specific
    */
    public function showNewsletter($id){
      $newsletter = Newsletter::find($id);
       return  view('shownewsletter',compact('newsletter'));
    }

    /*
    This method show a page for create newsletter
    */
    public function newNewsletters(){
      return view('createnewsletter');
    }

    /*
    This method allow create a newsletter
    */
    public function saveNewsletters(Request $request){

      $data = $this->dataValidator();

      $newsletter = new Newsletter();
      $newsletter->name = $request->title;
      $newsletter->description = $request->description;
      $time = strtotime($request->startdate);
      $newsletter->stardate = date('Y-m-d',$time);

      $newsletter->save();

      return redirect('boletines');

    }

    /*
    This method show a page for edit newsletter in specific
    */
    public function editNewsletter($id){
      $newsletter=Newsletter::find($id);
      return  view('editnewsletter',compact('newsletter'));
    }

    /*
    This method allow update a newsletter
    */
    public function updateNewsletter(Request $request, $id){

      $data = $this->dataValidator();

      $newsletter = Newsletter::find($id);
      $newsletter ->name = $request->title;
      $newsletter->description = $request->description;
      $time = strtotime($request->startdate);
      $newsletter->stardate = date('Y-m-d',$time);
      $time = strtotime($request->closedate);
      if ($request->closedate != '' or $request->closedate != null){
        $newsletter->closedate = date('Y-m-d',$time);
      }else {
        $newsletter->closedate = null;
      }

      $newsletter->update();

      return redirect('boletines');
    }

    /*
    This method allow destroy a newsletter
    */
    public function destroyNewsletters($id){

      Newsletter::find($id)->delete();
      return redirect('boletines');
    }

    /**
    *This method allow validate the field in newsletter views
    */
    private function dataValidator(){

      $data = request()->validate([
        'title' => 'required',
        'startdate' => 'required'
      ],[
        'tipo.required' => 'Titulo de boletin es obligatorio.',
        'limit.required' => 'Fecha es requerida.'
      ]);

      return $data;
    }
}
