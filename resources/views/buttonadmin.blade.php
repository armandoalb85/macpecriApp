@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Nuevo Boletin Informativo</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema Administrativo</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Boton de Pago</strong>
            </li>
        </ol>
    </div>
</div> <br>
<!-- guia -->
<!-- dashboard-->
<div class="row">
  <div class="col-4">
    <div class="alert alert-success alert-block fade-out">
    	<button type="button" class="close" data-dismiss="alert">×</button>
      @if($buttonRecord[0]->status == 'Activo')
    	   <h4><strong>El boton de pago se encuentra ACTIVO</strong></h4>
       @else
        <h4><strong>El boton de pago APAGADO</strong></h4>
      @endif
    </div>
  </div>
</div>

<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4><strong>Al activar boton de pago para Venezuela, cambiara las propiedades una cuenta de suscripción de venexula por una cuenta de suscripción gratuita comun</strong></h4>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Configuración Actual del Boton</h5>
        </div>
        <div class="ibox-content">
          @if($buttonRecord[0]->startdate != null && $buttonRecord[0]->status != null)
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Desde:</label>
              <div class="col-sm-9">
                <label class="col-lg-8 col-form-label">
                  @php($data = explode('-',$buttonRecord[0]->startdate))
                  {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                </label>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Esatus:</label>
              <div class="col-sm-9">
                <label class="col-lg-8 col-form-label">{{$buttonRecord[0]->status}}</label>
              </div>
            </div>
          @else
            <p>No se encontro información.</p>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Cuentas Afectadas</h5>
        </div>
        <div class="ibox-content">
          @if($vezuelaAccounts != null)
            <h2>Total:&nbsp;{{$vezuelaAccounts}}</h2>
          @else
            <h2>Total:&nbsp;0</h2>
          @endif

        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Acciones Sobre Boton de Pago</h5>
        </div>
        <div class="ibox-content">
          <form>
            <div class="form-group row">
              <div class="col-lg-6">
                @if($buttonRecord[0]->status == 'Inactivo')
                  <a href="{{url('pagos_config/enable')}}" class="btn btn-sm btn-success col-12">Activar</a>
                @else
                  <button class="btn btn-sm btn-success col-12" disabled>Activar</button>
                @endif
              </div>
              <div class="col-lg-6">
                @if($buttonRecord[0]->status == 'Inactivo')
                  <button class="btn btn-sm btn-success col-12" disabled>Inactivar</button>
                @else
                  <a href="{{url('pagos_config/disabled')}}" class="btn btn-sm btn-danger col-12">Inactivar</a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="ibox-title">
        <div class="row">
          <div class="col-8">
            <h5>Configuración de Cuentas</h5>
          </div>
          <div class="col-4">
            <a href="{{ url('suscripciones') }}" class="btn btn-md btn-primary float-right" title="Configuración de Cuentas">
              <i class="glyphicon glyphicon-cog"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" >
            <thead>
            <tr>
                <th>Código</th>
                <th>Tipo de Cuenta</th>
                <th>Límite  de Articulos</th>
                <th>Costo</th>
                <th>Días para Pagar</th>
                <th>Estatus</th>
            </tr>
            </thead>
            <tbody>
              @if ($subscriptionConfigs != null)
                @foreach($subscriptionConfigs as $config)
                  <tr>
                    <th>{{$config->id}}</th>
                    <th>{{$config->type}}</th>
                    @if($config->limit >= 999999)
                      <th>Sin Límite</th>
                    @else
                      <th>{{$config->limit}}</th>
                    @endif
                    <th>{{$config->cost}}</th>
                    <th>{{$config->daysforpaying}}</th>
                    <th>{{$config->status}}</th>
                  </tr>
                @endforeach
              @endif
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
