<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use app\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    This method show a password modify view
    */
    public function editPassword(){
      return view(editPassword);
    }

    /*
    This method modify a password user
    */
    public function updatePassword(Request $request){

        $user = new User;
        $user->where('email', '=', Auth::user()->email)
             ->update(['password' => md5($request->newPassword)]);
        return redirect('dashboard');

    }
}
