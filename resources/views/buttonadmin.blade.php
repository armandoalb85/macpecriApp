@extends('layout/template')
@section('contentapp')
<!-- guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Configuración de botón de pago</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Botón de pago</strong>
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
    	   <h4><strong>Botón de pago. ENCENDIDO</strong></h4>
       @else
        <h4><strong>Botón de pago. APAGADO</strong></h4>
      @endif
    </div>
  </div>
</div>

<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4><strong>La acción de activar o inactivar el botón de pago, alternara las propiedades de una cuenta gratita común y una cuenta gratuita con acceso ilimitado para Venezuela.</strong></h4>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Configuración actual del botón</h5>
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
              <label class="col-lg-3 col-form-label">Estatus:</label>
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
          <h5>Cuentas afectadas</h5>
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
          <h5>Acción sobre botón de pago</h5>
        </div>
        <div class="ibox-content">
          <form>
            <div class="form-group row">
              <div class="col-lg-12">
                @if($buttonRecord[0]->status == 'Inactivo')
                  <center><a href="{{url('pagos_config/enable')}}" class="btn btn-sm btn-success col-6">Activar</a></center>
                @else
                  <center><a href="{{url('pagos_config/disabled')}}" class="btn btn-sm btn-danger col-6">Inactivar</a></center>
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
            <h5>Configuración de cuentas</h5>
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
                <th>Tipo de cuenta</th>
                <th>Propiedad heredada</th>
                <th>Límite  de articulos</th>
                <th>Costo</th>
                <th>Días para pagar</th>
                <th>Estatus</th>
            </tr>
            </thead>
            <tbody>
              @if ($subscriptionConfigs != null)
                @foreach($subscriptionConfigs as $config)
                  <tr>
                    <th>{{$config->id}}</th>
                    <th>{{$config->type}}</th>
                    <th>{{$config->typeswap}}</th>
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
