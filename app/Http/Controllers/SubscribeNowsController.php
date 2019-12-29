<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubscribeNow;

class SubscribeNowsController extends Controller
{
    /*
    *This method show a index page with message config list
    */
    public function indexSubscribeMessageConfig(){
      $subscribeNows = SubscribeNow::orderBy('id','type')->paginate(30);
      return view('subscribenow',compact('subscribeNows'));
    }
}
