@extends('layout/template')
@section('contentapp')

<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nuevo Tipo de Suscripción</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Nuevo Tipo de Suscripción</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Nuevo Tipo de Suscripción</strong>
            </li>
        </ol>
    </div>
</div>
<!-- guia -->

<!--form -->
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-7">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Nuevo Tipo de Suscripción</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('suscripciones/nuevo') }}" >
            {{csrf_field()}}
            <div class="form-group row {{ $errors->has('tipo') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Tipo</label>
              <div class="col-lg-9">
                <input type="text" name="tipo" placeholder="Nombre Suscripción" class="form-control">
                @if ($errors->has('tipo'))
                  <strong class="error-text">{{ $errors->first('tipo') }}</strong>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Descripción</label>
              <div class="col-lg-9">
                <textarea name="description" rows="3" cols="25" class="form-control">Descripción de tipo de suscripción</textarea>
              </div>
            </div>
            <div class="form-group row {{ $errors->has('limit') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Limite</label>
              <div class="col-lg-9">
                <input type="number" name = "limit" placeholder="0" class="form-control">
                @if ($errors->has('limit'))
                  <strong class="error-text">{{ $errors->first('limit') }}</strong>
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
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Costo</label>
              <div class="col-lg-9">
                <input type="number" name = "cost" placeholder="0" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Días para Pagar</label>
              <div class="col-lg-9">
                <input type="number" name = "daysforpaying" placeholder="0" class="form-control">
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
