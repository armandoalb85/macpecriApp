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

        $codeMessage = 'warning';
        $message = 'Opps!... ocurrio un problema, intenetlo de nuevo';

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
        $value = $user->where('email', '=', Auth::user()->email)
             ->update(['password' => md5($request->newPassword)]);

        if ($value){
          $codeMessage = 'info';
          $message = 'Se modifico la información de forma exitosa.';
        }

        return redirect('password_modify')->with($codeMessage, $message);
    }
}
