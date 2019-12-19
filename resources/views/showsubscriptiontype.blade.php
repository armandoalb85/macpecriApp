@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detalle de Tipo de Suscripción</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Detalle de Tipo</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detalle de Tipo</strong>
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
          <h5>Detalle de Suscripción Definida</h5>
        </div>
        <div class="ibox-content">
          <form method="#" action="#" >
            {{csrf_field()}}
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Tipo</label>
              <div class="col-lg-9">
                <input type="text" name="tipo"  class="form-control" value="{{$subscription->name}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Descripción</label>
              <div class="col-lg-9">
                <textarea name="description" rows="3" cols="25" class="form-control" value="{{$subscription->description}}" disabled>
                </textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Limite</label>
              <div class="col-lg-9">
                <input type="text" name = "limit" class="form-control" value="{{$subscription->limit}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Estatus</label>
              <div class="col-lg-9">
                <input type="text" name = "status" class="form-control" value="{{$subscription->status}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Costo</label>
              <div class="col-lg-9">
                <input type="text" name = "cost" class="form-control" value="{{$subscription->cost}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Editar</button>
              </div>
              <div class="col-lg-4">
                <a href="#" class="btn btn-sm btn-white col-12">Volver</a>
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
