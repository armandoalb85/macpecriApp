@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Consulta de Subscriptores con Pagos Pendientes</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Pagos pendientes</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Pagos pendientes</strong>
              </li>
          </ol>
      </div>
  </div>
<!-- -->
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Consultar Pagos</h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="{{ url('pagos_pendientes') }}" >
            {{csrf_field()}}
            <br>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Suscripción</label>
            <div class="col-sm-9">
              <select class="form-control m-b" name="subscriptionType">
                @foreach ($subscriptionTypes as $subscriptionType)
                  <option>{{ $subscriptionType->name }}</option>
                @endforeach
              </select>
            </div>
            </div>


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
                <br>
                <button class="btn btn-sm btn-primary col-12" type="submit">Aceptar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="ibox ">
          <div  class="ibox-title">
              <h5>Listado de Pagos Pendientes</h5>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                  <thead>
                  <tr>
                    <th>Suscriptor</th>
                    <th>Fecha de Corbo</th>
                    <th>Días para Cancelar</th>
                    <th>Fecha Actual</th>
                    <th>Pago</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($payments->count())
                      @foreach($payments as $payment)
                        <tr>
                          <td>{{$payment->name." ".$payment->lastname}}</td>
                          <td>{{$payment->startdate}}</td>
                          <td>{{$payment->daysforpaying}}</td>
                          <td>{{date('Y-m-d')}}</td>
                          <td>{{$payment->amount}}</td>
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
