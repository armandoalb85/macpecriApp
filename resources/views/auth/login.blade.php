@extends('layouts.loginTemplate')

@section('logincontent')
<form class="m-t" role="form" action="{{ route('login') }}">
	{{ csrf_field() }}
    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Username" required="">
        @if ($errors->has('email'))
            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" required="">
        @if ($errors->has('password'))
            <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
        @endif
    </div>
    <button type="submit" class="btn btn-success block full-width m-b">Aceptar</button>

    <a href="#"><small>¿Olvidaste tu Contraseña?</small></a>
</form>

@endsection
