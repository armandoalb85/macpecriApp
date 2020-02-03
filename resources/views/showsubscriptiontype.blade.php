@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detalle de tipo de suscripción</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('suscripciones') }}">Suscripciones</a>
            </li>
            <li class="breadcrumb-item active">
                <a><strong>Detalle de tipo</strong></a>
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
          <h5>Detalle de suscripción definida</h5>
        </div>
        <div class="ibox-content">
          <form method="get" action="{{url('suscripciones/edicion/'.$subscription->id ) }}" >
            {{csrf_field()}}
            <div class="form-group row">
              <label class="col-lg-4 col-form-label">Nombre de suscripción</label>
              <div class="col-lg-8">
                <input type="text" name="tipo"  class="form-control" value="{{$subscription->name}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label">Descripción</label>
              <div class="col-lg-8">
                <textarea name="description" rows="6" cols="25" class="form-control" disabled>{{$subscription->description}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label">Límite de artículos</label>
              <div class="col-lg-8">
                <input type="text" name = "limit" class="form-control" value="{{$subscription->limit}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label">Estatus</label>
              <div class="col-lg-8">
                <input type="text" name = "status" class="form-control" value="{{$subscription->status}}" disabled>
              </div>
            </div>
            <!--<div class="form-group row">
              <label class="col-lg-3 col-form-label">Costo</label>
              <div class="col-lg-9">
                <input type="text" name = "cost" class="form-control" value="{{$subscription->cost}}" disabled>
              </div>
            </div>-->
            <div class="form-group row">
              <label class="col-lg-4 col-form-label">Días para pagar</label>
              <div class="col-lg-8">
                <input type="number" name = "daysforpaying" placeholder="0" class="form-control" value="{{$subscription->daysforpaying}}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Editar</button>
              </div>
              <div class="col-lg-4">
                <a href="{{url('suscripciones')}}" class="btn btn-sm btn-white col-12">Volver</a>
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
