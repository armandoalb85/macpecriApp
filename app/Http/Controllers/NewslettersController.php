<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;

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

    }

    /*
    This method allow create a newsletter
    */
    public function saveNewsletters(){

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
    public function destroyNewsletters(){

    }
}
