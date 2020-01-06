@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Tipos de Suscripción</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Suscripciones</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Suscripciones</strong>
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
                <h5>Listado de Tipo de Suscripciones</h5>
              </div>
              <div class="col-2">
                <a href="{{ url('suscripciones/nuevo') }}" class="btn btn-md btn-primary float-right" title="Nuevo Registro">
                  <i class="glyphicon glyphicon-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>Tipo</th>
                  <th>Limite de Lectura</th>
                  <th>Costo</th>
                  <th>Estatus</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @if($sucriptions->count())
                  @foreach($sucriptions as $sucription)
                  <tr>
                    <td>{{$sucription->name}}</td>
                    <td>{{$sucription->limit}}</td>
                    <td>{{$sucription->cost}}</td>
                    <td>{{$sucription->status}}</td>
                    <td>
                      <center>
                      <div class="btn-group" role="group">
                        <a href="{{action('SubscriptionTypesController@showSubscriptionType', $sucription->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-search" title="Consulta de registro"></span>
                        </a>
                        <a href="{{action('SubscriptionTypesController@editSubscriptionType', $sucription->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-pencil" title="Editar de registro"></span>
                        </a>
                        <a href="{{action('SubscriptionTypesController@destroySubscriptionType', $sucription->id)}}" class="btn btn-sm btn-white " onclick="return confirm('Seguro que desea eliminar el registro?')">
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
@endsection
