<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use DateTime;

class NewslettersController extends Controller
{

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
    public function showNewsletters(){

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
    public function editNewsletters(){

    }

    /*
    This method allow update a newsletter
    */
    public function updateNewsletters(){

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
