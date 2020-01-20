@extends('layout/template')
@section('contentapp')

<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Consultar Suscriptores</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a href="{{ url('gestion_suscriptores') }}">Suscriptores</a>
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Gestion de Suscriptores</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>
<div class="row white-bg" >
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Suscriptores Encontrados</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Nombre de Suscriptor</th>
                <th>Apellido de Suscriptor</th>
                <th>Correo</th>
                <th>Estatus</th>
                <th>Tipo de Cuenta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
              @if ($queryResults != null)
                @foreach($queryResults as $queryResult)
                  <tr>
                    <td>{{$queryResult->name}}</td>
                    <td>{{$queryResult->lastname}}</td>
                    <td>{{$queryResult->email}}</td>
                    <td>{{$queryResult->status}}</td>
                    <td>{{$queryResult->type}}</td>
                    <td>
                      <center>
                        <div class="btn-group" role="group">
                          <a href="" class="btn btn-sm btn-white ">
                            <span class="glyphicon glyphicon-search" title="Consulta Registro"></span>
                          </a>
                          <a href="" class="btn btn-sm btn-white ">
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

@endsection
