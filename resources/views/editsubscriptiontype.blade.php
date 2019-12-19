@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Editar Tipo de Suscripción</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Edición de Tipo</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edición de Tipo</strong>
            </li>
        </ol>
    </div>
</div>
<!-- guia -->
<!--form -->
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Edición Suscripción Definida</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('suscripciones/edicion/'.$subscription->id ) }}" >
            {{csrf_field()}}
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Tipo</label>
              <div class="col-lg-9">
                <input type="text" name="tipo"  class="form-control" value="{{$subscription->name}}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Descripción</label>
              <div class="col-lg-9">
                <textarea name="description" rows="3" cols="25" class="form-control">
                  {{$subscription->description}}
                </textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Limite</label>
              <div class="col-lg-9">
                <input type="number" name = "limit" placeholder="0" class="form-control" value="{{$subscription->limit}}">
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
                <input type="number" name = "cost" class="form-control" value="{{$subscription->cost}}">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
              <div class="col-lg-4">
                <a href="{{ url('suscripciones')}}" class="btn btn-sm btn-white col-12">Volver</a>
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
