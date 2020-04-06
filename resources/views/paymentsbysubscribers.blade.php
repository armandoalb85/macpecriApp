@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Consulta de pagos realizados por los suscriptores</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item active">
                  <a><strong>Consulta de pagos realizados</strong></a>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia -->
<div class="wrapper wrapper-content animated fadeInRight">
  
  <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">Desde</div>
                        <div class="col-md-5">Hasta</div>
                        <div class="col-md-2"></div>
                    </div>
                    <form id="fdate" method="post" action="{{ url('pagos_realizados')}}" >
                      {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group date {{ $errors->has('startdate') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i></span>
                                    @if($dateIni)
                                    <input type="date" class="form-control" name="startdate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})" value="{{$dateIni}}">
                                    @else
                                    <input type="date" class="form-control" name="startdate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                                    @endif
                                    @if ($errors->has('startdate'))
                                    <strong class="error-text">{{ $errors->first('startdate') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group date {{ $errors->has('closedate') ? ' has-error' : '' }}">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i></span>
                                    @if($dateFin)
                                    <input type="date" class="form-control" name="closedate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})" value="{{$dateFin}}">
                                    @else
                                    <input type="date" class="form-control" name="closedate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                                    @endif
                                    @if ($errors->has('closedate'))
                                    <strong class="error-text">{{ $errors->first('closedate') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-primary" type="submit">Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="ibox ">
          <div  class="ibox-title">
              <h5>Lista de pagos realizados</h5>
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
                      <th class="text-center">Fecha de pago</th>
                      <th class="text-center">Pago</th>
                      <th class="text-center">Método de pago</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($payments->count())
                      @foreach($payments as $payment)
                        <tr>
                          <td class="text-center">{{$payment->name." ".$payment->lastname}}</td>
                          <td class="text-center">{{$payment->email}}</td>
                          <td class="text-center">
                            {{date("d/m/Y", strtotime($payment->subscriptiondate))}}
                          </td>
                          <td class="text-center">
                            {{date("d/m/Y", strtotime($payment->paymentdate))}}
                          </td>
                          <td class="text-center">
                            {{date("d/m/Y", strtotime($payment->payclosedate))}}
                          </td>
                          <td class="text-center">{{$payment->amount}}</td>
                          <td class="text-center">{{$payment->method}}</td>
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
