<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function editPassword(){
      return view(editPassword);
    }

    public function updatePassword(){

    }
}
