@extends('layouts.loginTemplate')

@section('logincontent')

<form class="m-t" role="form" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <input id="email"  type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="usuario" autofocus>
    @if ($errors->has('username'))
      <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
    @endif
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <input id="password" type="password" class="form-control" name="password" placeholder="contraseña">
    @if ($errors->has('password'))
      <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
    @endif
  </div>
      <button type="submit" class="btn btn-success block full-width m-b">Aceptar </button>
      <!-- <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidast tu contraseña?</a>-->
      <!--<a href="#"><small>¿Olvidaste tu Contraseña?</small></a>-->
</form>

@endsection
