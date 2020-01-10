@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Reporte de Cuentas por Vencerse</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Reportes</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Cuentas por Vencer</strong>
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
          <form method="post" action="{{ url('r_cuentas_por_vencer')}}" >
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
              <form method="get" action="{{ action('ExportsController@xlsAccountExpire', $dateIni)}}">
                 <input type="text" name="dateIni" value="{{ $dateIni }}" disabled hidden>
                 <div class="form-group row">
                   <div class="col-lg-12">
                     @if ($dateIni !=null)
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
                <th>Tipo de Cuenta</th>
                <th>Fecha de Pago</th>
                <th>Días para pagar</th>
                <th>Monto a Pagar</th>
            </tr>
            </thead>
            <tbody>
              @if ($queryResults != null)
                @foreach($queryResults as $queryResult)
                  <tr>
                    <td>{{ $queryResult->name." ".$queryResult->lastname}}</td>
                    <td>{{ $queryResult->type}}</td>
                    <td>{{ $queryResult->startdate}}</td>
                    <td>{{ $queryResult->daysforpaying}}</td>
                    <td>{{ $queryResult->amount}}</td>
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