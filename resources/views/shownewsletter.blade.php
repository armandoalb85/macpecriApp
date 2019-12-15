@extends('layout/templatetest')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detalle de Boletines</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Detalle de Boletin</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detalle de Boletin</strong>
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
          <form method="" action="" >
            {{csrf_field()}}
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Titulo</label>
              <div class="col-lg-9">
                <input type="text" name="title" class="form-control"  value="{{ $newsletter->description }}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Contenido</label>
              <div class="col-lg-9">
                <textarea name="description" rows="5" cols="100" class="form-control" disabled>
                  {{ $newsletter->description }}
                </textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Fecha de Acción</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                    <input type="text" class="form-control" name="startdate" value="{{ $newsletter->stardate }}" disabled>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Fecha de Cierre</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                    @if ( $newsletter->closedate != null )
                      <input type="text" class="form-control" name="closedate" value="{{ $newsletter->closedate }}" disabled>
                    @else
                      <input type="text" class="form-control" name="closedate" value="Sin definir" disabled>
                    @endif
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Editar</button>
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
