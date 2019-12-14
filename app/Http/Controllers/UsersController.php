<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use app\User;

class UsersController extends Controller
{
    public function editPassword(){
      return view(editPassword);
    }

    public function updatePassword(Request $request){

        echo $request->actualPassword. "<br>";
        echo $request->newPassword. "<br>";
        echo $request->passwordConfirmation. "<br>";
        echo Auth::user()->password. "<br>";
        echo Auth::user()->email. "<br>";
        echo "<br>";

        $user = new User;
        $user->where('email', '=', Auth::user()->email)
             ->update(['password' => md5($request->newPassword)]);
        return redirect('dashboard');

    }
}
