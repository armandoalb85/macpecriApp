<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    	return view ('dashboard');
    }
}
