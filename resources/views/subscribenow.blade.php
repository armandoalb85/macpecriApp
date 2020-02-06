@extends('layout/template')
@section('contentapp')
<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Mensajes de invitación (suscríbase ahora)</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard')}}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <a><strong>Mensajes de suscríbase ahora</strong></a>
            </li>
        </ol>
    </div>
</div>
<!-- Guia -->

<!-- table--><br>
<div class="row white-bg" >
    <div class="col-lg-12">
      <div class="ibox ">
          <div  class="ibox-title">
            <div class="row">
              <div class="col-10">
                <h5>Lista de mensajes para suscríbase ahora </h5>
              </div>
              <!--<div class="col-2">
                <a href="{{ url('suscribase_ahora/nuevo') }}" class="btn btn-md btn-primary float-right" title="Nuevo Registro">
                  <i class="glyphicon glyphicon-plus"></i>
                </a>
              </div>-->
            </div>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>Mensaje</th>
                  <th>Estatus</th>
                  <th>Categoría</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @if($subscribeNows->count())
                  @foreach($subscribeNows as $subscribeNow)
                  <tr>
                    <td>{{$subscribeNow->name}}</td>
                    <td>{{$subscribeNow->status}}</td>
                    <td>{{$subscribeNow->category}}</td>
                    <td>
                      <center>
                      <div class="btn-group" role="group">
                        <a href="{{action('SubscribeNowsController@showSubscribeNow', $subscribeNow->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-search" title="Consulta Registro"></span>
                        </a>
                        <a href="{{action('SubscribeNowsController@editSubscribeNow', $subscribeNow->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-pencil" title="Editar Registro"></span>
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
<br>
@endsection
