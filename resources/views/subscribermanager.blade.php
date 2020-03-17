@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          @if ( $startDate == "")
            <h2>Suscriptores a consultar</h2>
          @else
            <h2>Suscriptores a consultar - Desde el {{date("d/m/Y", strtotime($startDate))}} hasta {{date("d/m/Y", strtotime($closeDate))}}</h2>
          @endif
          @if ( $startDate == null || $startDate == null )
           @php($startDate = "a")
           @php($closeDate = "b")
          @endif
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a href="{{ url('gestion_suscriptores') }}">Suscriptores</a>
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Gestión de suscriptores ({{ (is_object($typeSubscribers)?$typeSubscribers->name:$typeSubscribers) }})</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>
<div class="row white-bg" >
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Suscriptores encontrados</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Correo</th>
                <th class="text-center">País</th>
                <th class="text-center">Suscripción</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Cuenta</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
              @if ($queryResults != null)
                @foreach($queryResults as $queryResult)
                  <tr>
                    <td>{{$queryResult->id}}</td>
                    <td>{{$queryResult->name}}&nbsp;{{$queryResult->lastname}}</td>
                    <td>{{$queryResult->email}}</td>
                    <td>{{$queryResult->country}}</td>
                    <td>
                      {{date("d/m/Y", strtotime($queryResult->created_at))}}
                    </td>
                    <td>{{$queryResult->status}}</td>
                    <td>{{$queryResult->types}}</td>
                    <td>
                      <center>
                        <div class="btn-group" role="group">
                            <a href="{{action('SubscribersController@showSubscriber', [$queryResult->id,$typeSubscribers,$startDate,$closeDate])}}" class="btn btn-sm btn-white ">
                            <span class="glyphicon glyphicon-search" title="Consulta Registro"></span>
                          </a>
                          <a href="{{action('SubscribersController@editSubscriber', [$queryResult->id,$typeSubscribers,$startDate,$closeDate])}}" class="btn btn-sm btn-white ">
                            <span class="glyphicon glyphicon-pencil" title="Editar Registro"></span>
                          </a>
                          <a href="{{action('SubscribersController@editPasswordSubscriber', [$queryResult->id,$typeSubscribers,$startDate,$closeDate])}}" class="btn btn-sm btn-white ">
                            <span class="glyphicon glyphicon-asterisk" title="Editar Contraseña"></span>
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
<br>
@endsection
