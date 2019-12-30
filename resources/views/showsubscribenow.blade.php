@extends('layout/template')
@section('contentapp')
<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Definición de Mensajes Sucribase Ahora</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index-2.html">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a>Detalle de Suscriabse Ahora</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detalle de Suscriabse Ahora</strong>
            </li>
        </ol>
    </div>
</div>
<!-- Guia -->

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Detalle de Mensaje Padre a Configurar</h5>
        </div>
        <div class="ibox-content">
          <form method="" action="" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class="col-lg-12">

                @if ($subscribeNow->imagepath != null)
                  <img src="{{ $subscribeNow->imagepath }}" alt="image not found" height="100%" width="25%">
                @else
                  <img src="/img/image_not_found.png" alt="image not found" height="100%" width="25%">
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Mensaje</label>
              <div class="col-lg-9">
                <input type="text" name="title" class="form-control"  value=" {{ $subscribeNow->name }}" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Contenido</label>
              <div class="col-lg-9">
                <textarea name="description" rows="3" cols="25" class="form-control" disabled>
                  {{ $subscribeNow->description }}
                </textarea>
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
    <div class="col-lg-7">
      @if($messages->count())
        <div class="row col-12">
          <div class="ibox col-lg-12">
            <div class="ibox-title">
              <h5>Mensajes Asociados a Suscribase Ahora</h5>
            </div>
            <div class="ibox-content">
              @foreach($messages as $message)
                <strong>Codigo: &nbsp; {{ $message->id }}</strong>
                <p>{{$message->message}}</p>
              @endforeach
            </div>
          </div>
        </div>
      @else
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-title">
                <h5>Mensajes Asociados a Suscribase Ahora</h5>
              </div>
              <div class="ibox-content">
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div  class="ibox-title">
          <div class="row">
            <div class="col-10">
              <h5>Configurar Mensajes Asociados</h5>
            </div>
            <div class="col-2">
              <a href="{{action('SubscriptionMessagesController@newSubscriptionMessage', $subscribeNow->id)}}" class="btn btn-sm btn-primary float-right">
              <i class="glyphicon glyphicon-plus"></i>
                &nbsp;Nuevo Registro
              </a>
            </div>
          </div>
        </div>
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Tipo</th>
                  <th>Estatus</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @if($messages->count())
                  @foreach($messages as $message)
                    <tr>
                      <th>{{$message->id}}</th>
                      <th>{{$message->type}}</th>
                      <th>{{$message->status}}</th>
                      <td>
                        <center>
                          <div class="btn-group" role="group">
                            <a href="{{action('SubscriptionMessagesController@editSubscriptionMessage', $message->id)}}" class="btn btn-sm btn-white ">
                              <span class="glyphicon glyphicon-pencil" title="Editar de registro"></span>
                            </a>
                            <a href="{{action('SubscriptionMessagesController@destroySubscriptionMessage', $message->id)}}" class="btn btn-sm btn-white " onclick="return confirm('Seguro que desea eliminar el registro?')">
                              <span class="glyphicon glyphicon-trash" title="Eliminar de registro"></span>
                            </a>
                          </div>
                        </center>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8">No se encontraron registros</td>
                  </tr>
                @endif
              </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

@endsection
