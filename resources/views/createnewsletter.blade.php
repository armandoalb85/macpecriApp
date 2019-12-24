@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nuevo Boletin Informativo</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Nuevo Boletin</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Nuevo Boletin</strong>
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
          <h5>Nuevo Boletin Informativo</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('boletines/nuevo') }}" >
            {{csrf_field()}}
            <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Titulo</label>
              <div class="col-lg-9">
                <input type="text" name="title" placeholder="nombre del boletin" class="form-control">
                @if ($errors->has('title'))
                  <strong class="error-text">{{ $errors->first('title') }}</strong>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Contenido</label>
              <div class="col-lg-9">
                <textarea name="description" rows="5" cols="100" class="form-control">Descripción de tipo de suscripción</textarea>
              </div>
            </div>
            <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Fecha</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control col-lg-12" name="startdate">
                    @if ($errors->has('startdate'))
                      <strong class="error-text">{{ $errors->first('startdate') }}</strong>
                    @endif
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
              <div class="col-lg-4">
                <a href="{{ url('boletines')}}" class="btn btn-sm btn-white col-12">Volver</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
