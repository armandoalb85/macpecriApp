<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function showSubscribers(){

      return view ('subscribers');
    }
}
