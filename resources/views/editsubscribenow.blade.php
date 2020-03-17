@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Suscríbase ahora ({{ strtolower ($subscribeNow->name) }})</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('suscribase_ahora') }}">Mensajes de suscríbase ahora</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Mensaje de {{ strtolower ($subscribeNow->name) }}</strong>
            </li>
        </ol>
    </div>
</div>
<!-- guia -->

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-7">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Edición de mensaje / {{ strtolower ($subscribeNow->category) }}</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('suscribase_ahora/edicion/'.$subscribeNow->id ) }}" enctype="multipart/form-data" >
            {{csrf_field()}}

            <div class="form-group row {{ $errors->has('file') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Subir archivo</label>
              <div class="col-sm-9">
                  <input type="file" class="form-control" name="file">
                  <center><h5>(Archivos permitidos: JPEG y PNG, máximo 4MB)</h5></center>
                  @if ($errors->has('file'))
                    <strong class="error-text">{{ $errors->first('file') }}</strong>
                  @endif
              </div>
            </div>

            <div class="form-group row {{ $errors->has('category') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Categoría</label>
              <div class="col-lg-9">
                <input type="text" name="name"  class="form-control" value='{{ $subscribeNow->category }}' maxlength="30" disabled>
                @if ($errors->has('category'))
                  <strong class="error-text">{{ $errors->first('category') }}</strong>
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
              <label class="col-lg-3 col-form-label">Mensaje</label>
              <div class="col-lg-9">
                <textarea name="description" rows="6" cols="100" class="form-control" maxlength="500">{{ $subscribeNow->description }}</textarea>
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
