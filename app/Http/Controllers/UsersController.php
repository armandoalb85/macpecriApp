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
          'newPassword' => ['required', 'regex:/\A(?=.*[A-Z])(?=.*\d)(?=.*(?:!|#|\$|%|&|\/|\(|\)|=|\?|\*|\.)).{6,8}\z/'],
          'passwordConfirmation' => 'required',
          'passwordConfirmation' => 'required|same:newPassword'
        ],[
          'actualPassword.required' => 'Contraseña actual es obligatoria.',
          'newPassword.required' => 'Nueva contraseña es obligatoria.',
          'passwordConfirmation.required' => 'comfirmacion de contraseña es obligatoria.',
          'min'=> 'El campo :attribute no puede tener menos de :min carácteres.',
          'passwordConfirmation.same' => 'Nueva contraseña y confirmación de contraseña deben coincidir.',
          'regex' => 'La contraseña debe contener 6 a 8 caracteres, al menos una mayúscula, al menos un dígito, y al menos un símbolo'
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
