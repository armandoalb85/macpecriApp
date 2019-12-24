<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   /*
   This method show application dashboard
   */
    public function showDashboard(){

      if(Auth::user()->password == md5('Macpecri123#')){
        return redirect ('/')->with('warning','Esta utilizando una contraseña generica. Recuerde Cambiarla!!');;
      }

      return redirect ('/');

    }
}
