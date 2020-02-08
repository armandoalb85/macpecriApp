@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Reporte de pagos recibidos</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item active">
                  <a><strong>Pagos recibidos</strong></a>
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
          <h5>Filtros de reportes</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('r_pagos_recibidos')}}" >
            {{csrf_field()}}
            <br>

            <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Desde</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    @if($dateIni != null)
                      <input type="date" class="form-control" name="startdate"  maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})" value="{{$dateIni}}">
                    @else
                      <input type="date" class="form-control" name="startdate"  maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                    @endif

                    @if ($errors->has('startdate'))
                      <strong class="error-text">{{ $errors->first('startdate') }}</strong>
                    @endif
                </div>
              </div>
            </div>

            <div class="form-group row {{ $errors->has('closedate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Hasta</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    @if($dateFin != null)
                      <input type="date" class="form-control" name="closedate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})" value="{{$dateFin}}">
                    @else
                      <input type="date" class="form-control" name="closedate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                    @endif
                    @if ($errors->has('closedate'))
                      <strong class="error-text">{{ $errors->first('closedate') }}</strong>
                    @endif
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
              <h5>Resultados obtenidos</h5>
            </div>
            <div class="col-2">
              <form method="get" action="{{ action('ExportsController@xlsPaymentsReceived', [$dateIni, $dateFin])}}">
                 <input type="text" name="dateIni" value="{{ $dateIni }}" disabled hidden>
                 <input type="text" name="dateFin" value="{{ $dateFin }}" disabled hidden>
                 <div class="form-group row">
                   <div class="col-lg-12">
                     @if ($dateIni !=null && $dateFin != null)
                       <button class="btn btn-md btn-success col-6 float-right" type="submit" >
                     @else
                       <button class="btn btn-md btn-success col-6 float-right" type="submit" disabled>
                     @endif
                         <span class="glyphicon glyphicon-print" title="exportar csv"></span>
                     </button>
                   </div>
                 </div>
               </form>
            </div>
          </div>
        </div>
        <div class="ibox-content">
        <table class="table table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Método de pago</th>
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
                    <td>{{$queryResult->method}}</td>
                    <td>{{$listTotal[$i]}} @php($i++)&nbsp;$</td>
                  </tr>
                @endforeach
                  <tr>
                    <td><strong>Total:</strong></td>
                    <td>
                    {{$y}}&nbsp;$
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
