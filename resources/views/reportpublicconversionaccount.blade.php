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
              <form method="get" action="{{action('ExportsController@xlsPublicConversionAccount', ($dateIni.'/'.$dateFin))}}">
                <!--<a href="{{ url('conversion_cuenta_excel/') }}" class="btn btn-sm btn-success float-right">
                  <span class="glyphicon glyphicon-print" title="Exportar a hoja de cálculo"></span>
                </a>-->
                <div class="form-group row">
                  <div class="col-lg-4">
                    <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
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
