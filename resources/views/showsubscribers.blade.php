@extends('layout/template')
@section('contentapp')

<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Datos de Suscriptor</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a href="{{ url('gestion_suscriptores') }}">Lista de Suscriptores</a>
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Detalle de Suscriptor</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>
<div class="row">
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5><strong>Suscriptor:</strong>&nbsp;{{ $subscriber->name}} &nbsp; {{$subscriber->lastname}}</h5>
      </div>
      <div class="ibox-content">
        <form method="" action="">

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nombre de Usuario</label>
            <div class="col-lg-9">
              <input type="text" name="username" value="{{ $account->username }}" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Correo</label>
            <div class="col-lg-9">
              <input type="text" name="email" value="{{ $account->email }}" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Estatus</label>
            <div class="col-lg-9">
              <input type="text" name="status" value="{{ $subscriberAccount[0]->status }}" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tipo de Cuenta</label>
            <div class="col-lg-9">
              <input type="text" name="typeAcccount" value="{{ $subscriberAccount[0]->type }}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-lg-4">
              <a href="" class="btn btn-sm btn-white col-12">Volver</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Información del Último Pago</h5>
      </div>
      <div class="ibox-content">
        @if (sizeof($subscriberPayment) != 0)
        <form>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Dia de Pago</label>
            <div class="col-lg-9">
              @php($data = explode('-',$subscriberPayment[0]->startdate))
              <input type="text" name="PaymentDate" value="{{ $data[2].'/'.$data[1].'/'.$data[0]}}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Pago Efectuado</label>
            <div class="col-lg-9">
              @if ($subscriberPayment[0]->closedate != null)
                @php($data = explode('-',$subscriberPayment[0]->closedate))
                <input type="text" name="payment" value="{{ $data[2].'/'.$data[1].'/'.$data[0] }}" class="form-control" disabled>
              @else
                <input type="text" name="payment" value="dd/mm/yyyy" class="form-control" disabled>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Estatus del Pago</label>
            <div class="col-lg-9">
              <input type="text" name="status" value="{{ $subscriberPayment[0]->status }}" class="form-control" disabled>
            </div>
          </div>
        </form>
        @else
          <h5>Ho existe información de pago.</h5>
        @endif
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Datos de Contacto</h5>
      </div>
      <div class="ibox-content">
        <form>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Telefono</label>
            <div class="col-lg-9">
              <input type="text" name="phone" value="{{ $subscriber->phone}}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Correo</label>
            <div class="col-lg-9">
              <input type="text" name="email" value="{{ $account->email}}" class="form-control" disabled>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
