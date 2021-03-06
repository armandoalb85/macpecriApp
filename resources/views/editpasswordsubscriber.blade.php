@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Editar contraseña de suscriptor</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item">
                @if($startDate === "a")
                  <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}">Lista de suscriptores</a>
                @else
                  <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}">Lista de suscriptores</a>
                @endif
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Edición de contraseña de suscriptor</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>

<div class="row">
  <div class="col-lg-5">
    <div class="ibox ">
      <div class="ibox-title">
        <h5><strong>Suscriptor:</strong>&nbsp;{{ $subscriber->name}} {{$subscriber->lastname}}</h5>
      </div>
      <div class="ibox-content">
        <form method="post" action="{{ url('suscriptor/edicion_pw/'.$subscriber->id) }}">
          {{ csrf_field() }}
          <!-- sostener parametro -->
          <input type="text" name="subscriberType" value="{{ $typeSubscribers }}" class="form-control" hidden>
          <input type="text" name="startDate" value="{{ $startDate }}" class="form-control" hidden>
          <input type="text" name="closeDate" value="{{ $closeDate }}" class="form-control" hidden>
          <!-- -->
          <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-lg-3 col-form-label">Contraseña</label>
            <div class="col-lg-9">
              <input type="password" name="password" placeholder="********" value="" class="form-control" minlength="6" maxlength="16">
              @if ($errors->has('password'))
                <strong class="error-text">{{ $errors->first('password') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row {{ $errors->has('passwordConfirmation') ? ' has-error' : '' }}">
            <label class="col-lg-3 col-form-label">Confirmar contraseña</label>
            <div class="col-lg-9">
              <input type="password" name="passwordConfirmation" placeholder="********" value="" class="form-control" minlength="6" maxlength="16">
              @if ($errors->has('passwordConfirmation'))
                <strong class="error-text">{{ $errors->first('passwordConfirmation') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col-lg-4">
              <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
            </div>
            <div class="col-lg-4">
              @if($startDate === "a")
                <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}" class="btn btn-sm btn-white col-12">Volver</a>
              @else
                <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}" class="btn btn-sm btn-white col-12">Volver</a>
              @endif
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
