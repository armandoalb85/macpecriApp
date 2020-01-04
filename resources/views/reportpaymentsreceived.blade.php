@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Reporte de Pagos Recibidos</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Reportes</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Pagos Recibidos</strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia -->
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Filtros de Reporte</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('r_pagos_recibidos')}}" >
            {{csrf_field()}}
            <br>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Desde</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="startdate">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Hasta</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="closedate">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-4">
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="ibox">
        <div class="ibox-title">
          <div class="row">
            <div class="col-10">
              <h5>Resultados Obtenidos</h5>
            </div>
            <div class="col-2">
              <a href="{{ url('pagos_recibidos_excel') }}" class="btn btn-sm btn-success float-right">
                <span class="glyphicon glyphicon-print" title="Exportar a hoja de cálculo"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="ibox-content">
        <table class="table table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Tipo de Cuenta</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
              @if ($queryResults != null)
                @php($i=0)
                @php($y=0)
                @foreach($queryResults as $queryResult)
                  @php($y= $y + $listTotal[$i])
                  <tr>
                    <td>{{$queryResult->type}}</td>
                    <td>{{$listTotal[$i]}} @php($i++)</td>
                  </tr>
                @endforeach
                  <tr>
                    <td><strong>Total:</strong></td>
                    <td>
                    {{$y}}
                    </td>
                  </tr>
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
