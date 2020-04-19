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
      @if($buttonRecord[0]->status_id == 1)
    	   <h4><strong>Botón de pago. ENCENDIDO</strong></h4>
       @else
        <h4><strong>Botón de pago. APAGADO</strong></h4>
      @endif
    </div>
  </div>
</div>

<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4><strong>Activar o desactivar el botón de pago modificará las propiedades de una cuenta gratuita común y una cuenta gratuita con acceso ilimitado para Venezuela.</strong></h4>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Configuración actual del botón</h5>
        </div>
        <div class="ibox-content">
          @if($buttonRecord[0]->startdate != null && $buttonRecord[0]->status_id >= 0)
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
                <label class="col-lg-8 col-form-label">{{$buttonRecord[0]->name}}</label>
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
          @if($venezuelaAccounts != null)
            <h2>Total:&nbsp;{{$venezuelaAccounts}}</h2>
          @else
            <h2>Total: 0</h2>
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
              <div class="col-lg-12 text-center">
                @if($buttonRecord[0]->status_id == 0)
                  <a href="{{url('pagos_config/enable')}}" class="btn btn-sm btn-success col-6">Activar</a>
                @else
                  <a href="{{url('pagos_config/disabled')}}" class="btn btn-sm btn-danger col-6">Desactivar</a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
