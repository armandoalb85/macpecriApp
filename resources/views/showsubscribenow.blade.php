@extends('layout/template')
@section('contentapp')
<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Suscríbase ahora ({{ $subscribeNow->name }})</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('suscribase_ahora') }}">Mensajes de suscríbase ahora</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Mensaje de {{ $subscribeNow->name }}</strong>
            </li>
        </ol>
    </div>
</div>
<!-- Guia -->

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-7">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Detalle de mensaje / {{ strtolower ($subscribeNow->category) }} </h5>
        </div>
        <div class="ibox-content">
          <form method="get" action="{{action('SubscribeNowsController@editSubscribeNow', $subscribeNow->id)}}" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class="col-lg-12">

                @if ($url != null)
                  <img src="{{ asset($url) }}" alt="image not found" height="100%" width="25%">
                @else
                  <img src="{{ asset('/img/image_not_found.png') }}" alt="image not found" height="100%" width="25%">
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Categoría</label>
              <div class="col-lg-9">
                <input type="text" name="title" class="form-control"  value=" {{ $subscribeNow->category }}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Mensaje</label>
              <div class="col-lg-9">
                <textarea name="description" rows="6" cols="25" class="form-control" disabled>{{ $subscribeNow->description }}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Estatus</label>
              <div class="col-lg-9">
                <input type="text" name="title" class="form-control"  value=" {{ $subscribeNow->status }}" disabled>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Editar</button>
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
