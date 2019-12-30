@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nueva Sección de Mensaje</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Mensaje Suscribase Ahora</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Mensaje Suscribase Ahora</strong>
            </li>
        </ol>
    </div>
</div>
<!-- guia -->

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Configuración de Mensaje Padre</h5>
        </div>
        <div class="ibox-content">
          <form>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Código</label>
              <div class="col-lg-9">
                <input type="text" name="code" class="form-control"  value=" {{ $subscribeNow->id  }}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Mensaje</label>
              <div class="col-lg-9">
                <input type="text" name="message" class="form-control"  value=" {{ $subscribeNow->name }}" disabled>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Nueva Sección de Mensaje Suscribase Ahora</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ action('SubscriptionMessagesController@saveSubscriptionMessage', $subscribeNow->id) }}" >
            {{csrf_field()}}

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Tipo</label>
              <div class="col-sm-9">
                <select class="form-control m-b" name="type">
                    <option>Escoja un Tipo de Mensaje</option>
                    @for($x=0; $x < sizeof($types); $x++)
                      <option>{{ $types[$x] }}</option>
                    @endfor
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Estatus</label>
              <div class="col-sm-9">
                <select class="form-control m-b" name="status">
                    <option>Escoja un Estatus</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>
              </div>
            </div>

            <div class="form-group row {{ $errors->has('message') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Contenido</label>
              <div class="col-lg-9">
                <textarea name="message" rows="5" cols="100" class="form-control"></textarea>
                @if ($errors->has('message'))
                  <strong class="error-text">{{ $errors->first('message') }}</strong>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
              <div class="col-lg-4">
                <a href="{{action('SubscribeNowsController@showSubscribeMessageConfig', $subscribeNow->id)}}" class="btn btn-sm btn-white col-12">Volver</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
