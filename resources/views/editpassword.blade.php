@extends('layout/template')
@section('contentapp')
  <!-- guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Modificar contraseña de usuario</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a><strong>Modificar contraseña</strong></a>
              </li>
          </ol>
      </div>
  </div>
  <!-- guia -->
  <!--form -->
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-6">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Modificar contraseña</h5>
          </div>
          <div class="ibox-content">
            <form method="post" action="{{url('user/updatepassword')}}" >
              {{csrf_field()}}
              <div class="form-group row {{ $errors->has('actualPassword') ? ' has-error' : '' }}">
                <label class="col-lg-5 col-form-label">Contraseña actual</label>
                <div class="col-lg-7">
                  <input type="password" name="actualPassword" placeholder="******" class="form-control" maxlength="16">
                  @if ($errors->has('actualPassword'))
                    <strong class="error-text">{{ $errors->first('actualPassword') }}</strong>
                  @endif
                </div>
              </div>
              <div class="form-group row {{ $errors->has('actualPassword') ? ' has-error' : '' }}">
                <label class="col-lg-5 col-form-label">Nueva contraseña</label>
                <div class="col-lg-7">
                  <input type="password" name = "newPassword" placeholder="******" class="form-control" maxlength="16">
                  @if ($errors->has('newPassword'))
                    <strong class="error-text">{{ $errors->first('newPassword') }}</strong>
                  @endif
                </div>
              </div>
              <div class="form-group row {{ $errors->has('actualPassword') ? ' has-error' : '' }}">
                <label class="col-lg-5 col-form-label">Confirmar contraseña</label>
                <div class="col-lg-7">
                  <input type="password" name = "passwordConfirmation" placeholder="******" class="form-control" maxlength="16">
                  @if ($errors->has('passwordConfirmation'))
                    <strong class="error-text">{{ $errors->first('passwordConfirmation') }}</strong>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-offset-2 col-lg-10">
                  <button class="btn btn-md btn-primary" type="submit">Aceptar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--form -->
@endsection
