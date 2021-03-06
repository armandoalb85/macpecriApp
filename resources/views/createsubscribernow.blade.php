@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nueva base de Mensajes (Suscribase Ahora)</h2>
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
    <div class="col-lg-6">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Nueva base de Mensajes (Suscribase Ahora)</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('suscribase_ahora/nuevo') }}" >
            {{csrf_field()}}
            <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">name</label>
              <div class="col-lg-9">
                <input type="text" name="name"  class="form-control" maxlength="30">
                @if ($errors->has('name'))
                  <strong class="error-text">{{ $errors->first('name') }}</strong>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Estatus</label>
              <div class="col-sm-9">
                <select class="form-control m-b" name="status">
                  <option>Activo</option>
                  <option>Inactivo</option>
                </select>
              </div>
            </div>
            <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Descripción</label>
              <div class="col-lg-9">
                <textarea name="description" rows="5" cols="100" class="form-control" maxlength="150"></textarea>
                @if ($errors->has('description'))
                  <strong class="error-text">{{ $errors->first('description') }}</strong>
                @endif
              </div>
            </div>


            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
              <div class="col-lg-4">
                <a href="{{ url('suscribase_ahora')}}" class="btn btn-sm btn-white col-12">Volver</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
