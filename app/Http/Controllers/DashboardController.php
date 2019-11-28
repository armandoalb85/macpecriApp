<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   /*
   This method show application dashboard
   */
    public function showDashboard(){

    	return view ('dashboard');
    }
}
