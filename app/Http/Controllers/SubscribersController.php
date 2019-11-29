<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    This method show a subscribers dashboard
    */
    public function showSubscribers(){

      return view ('subscribers');
    }
}
