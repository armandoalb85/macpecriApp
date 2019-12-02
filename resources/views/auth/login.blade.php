@extends('layouts.loginTemplate')

@section('logincontent')

<form class="m-t" role="form" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <input id="email"  class="form-control" name="email" value="{{ old('email') }}" placeholder="email" autofocus>
    @if ($errors->has('email'))
      <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
    @endif
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <input id="password" type="password" class="form-control" name="password" placeholder="password">
    @if ($errors->has('password'))
      <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
    @endif
  </div>
      <button type="submit" class="btn btn-success block full-width m-b">Aceptar </button>
      <!-- <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidast tu contraseña?</a>-->
      <!--<a href="#"><small>¿Olvidaste tu Contraseña?</small></a>-->
</form>

@endsection
