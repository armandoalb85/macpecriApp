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

        $data = request()->validate([
          'actualPassword' => 'required',
          'newPassword' => 'required',
          'newPassword' => 'required|min:6',
          'passwordConfirmation' => 'required',
          'passwordConfirmation' => 'required|same:newPassword'
        ],[
          'actualPassword.required' => 'Password actual es obligatorio',
          'newPassword.required' => 'Nuevo password es obligatorio',
          'passwordConfirmation.required' => 'comfirmacion de password es obligatorio',
          'min'=> 'El campo :attribute no puede tener menos de :min carácteres.'
        ]);

        $user = new User;
        $user->where('email', '=', Auth::user()->email)
             ->update(['password' => md5($request->newPassword)]);
        return redirect('dashboard');


    }
}
