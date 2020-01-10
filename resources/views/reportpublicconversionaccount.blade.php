@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Reporte de Publico con Conversion de Cuenta</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Reportes</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Conversión de cuentas</strong>
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
          <form method="post" action="{{ url('r_conversion_cuenta')}}" >
            {{csrf_field()}}
            <br>
            <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Desde</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="startdate">
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
                    <input type="text" class="form-control" name="closedate">
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
              <h5>Resultados Obtenidos</h5>
            </div>
            <div class="col-2">
             <form method="get" action="{{ action('ExportsController@xlsPublicConversionAccount', [$dateIni, $dateFin])}}">
                <input type="text" name="dateIni" value="{{ $dateIni }}" disabled  hidden>
                <input type="text" name="dateFin" value="{{ $dateFin }}" disabled  hidden>
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
                <th>Suscriptor</th>
                <th>Fecha de suscripción</th>
                <th>Fecha de Conversión</th>
                <th>Cuenta</th>
            </tr>
            </thead>
            <tbody>
              @if ($queryResults != null)
                @foreach($queryResults as $queryResult)
                  <tr>
                    <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
                    <td>{{$queryResult->created_at}}</td>
                    <td>{{$queryResult->startdate}}</td>
                    <td>{{$queryResult->type}}</td>
                  </tr>
                @endforeach
                  <tr>
                    <td><strong>Total Cuentas Pagas</strong></td>
                    <td>@if($totalPay != null){{$totalPay}} @else 0 @endif</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><strong>Total Cuentas Gratuitas</strong></td>
                    <td>@if($totalFree != null){{$totalFree}} @else 0 @endif</td>
                    <td></td>
                    <td></td>
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