@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Consulta de suscriptores con pagos pendientes</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item active">
                <a><strong>Consulta de suscriptores con pagos pendientes</strong></a>
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
          <h5>Consultar pagos</h5>
        </div>
        <div class="ibox-content">
          <form id="fdate" method="post" action="{{ url('pagos_pendientes') }}" >
            {{csrf_field()}}
            <br>
            <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Desde</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    @if($dateIni)
                      <input type="date" class="form-control" name="startdate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})" value="{{$dateIni}}">
                    @else
                      <input type="date" class="form-control" name="startdate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
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
                    @if($dateFin)
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
              <h5>Lista de pagos pendientes</h5>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                  <thead>
                  <tr>
                    <th class="text-center">Suscriptor</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Suscripción de cuenta</th>
                    <th class="text-center">Fecha de cobro</th>
                    <th class="text-center">Días para pagar</th>
                    <!--<th>Fecha actual</th>-->
                    <th class="text-center">Pago</th>
                    <th class="text-center">Método de pago</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($payments->count())
                      @foreach($payments as $payment)
                        <tr>
                          <td>{{$payment->subsname." ".$payment->subslastname}}</td>
                          <td>{{$payment->subsname." ".$payment->email}}</td>
                          <td>
                            @php($data = explode('-', $payment->suscripcion))
                            {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                          </td>
                          <td>
                            @php($data = explode('-', $payment->paymentdate))
                            {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                          </td>
                          <td>{{$payment->daysforpaying}}</td>
                          <!--<td>
                            @php($data = explode('-',date('Y-m-d')))
                            {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                          </td>-->
                          <td>{{$payment->amount}}</td>
                          <td>{{$payment->method}}</td>
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
