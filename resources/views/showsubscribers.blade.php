@extends('layout/template')
@section('contentapp')

<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Datos del suscriptor</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema administrativo</a>
              </li>
              <li class="breadcrumb-item">
                @if($startDate === "a")
                  <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}">Lista de suscriptores</a>
                @else
                  <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}">Lista de suscriptores</a>
                @endif
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Datos del suscriptor</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>
<div class="row">
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5><strong>Nombre:</strong>&nbsp;{{ $subscriber->name}} {{$subscriber->lastname}}</h5>
      </div>
      <div class="ibox-content">
        <form method="" action="">

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Correo</label>
            <div class="col-lg-9">
              <input type="text" name="email" value="{{ $account->email }}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-6 col-form-label">Fecha de nacimiento</label>
            <div class="col-lg-6">
              <input type="text" name="birthDate" value="{{date('d/m/Y', strtotime($subscriber->birthday))}}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Sexo</label>
            <div class="col-lg-9">
              @php($sex = ($subscriber->sex=='f'?'Femenino':'Masculino'))
              <input type="text" name="sex" value="{{ $sex }}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Cuenta</label>
            <div class="col-lg-9">
              <input type="text" name="typeAcccount" value="{{ $subscriberAccount[0]->type }}" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label">País</label>
            <div class="col-lg-9">
              <input type="text" name="country" value="{{ $country->country }}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Región</label>
            <div class="col-lg-9">
              <input type="text" name="region" value="" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Estatus</label>
            <div class="col-lg-9">
              <input type="text" name="status" value="{{ $subscriberAccount[0]->status }}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-lg-4">
              @if($startDate === "a")
                <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}" class="btn btn-sm btn-white col-12">Volver</a>
              @else
                <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}" class="btn btn-sm btn-white col-12">Volver</a>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Información del último pago</h5>
      </div>
      <div class="ibox-content">
        @if (sizeof($subscriberPayment) != 0)
        <form>
          <div class="form-group row">
            <label class="col-lg-5 col-form-label">Día de pago</label>
            <div class="col-lg-7">
              @php($data = explode('-',$subscriberPayment[0]->startdate))
              <input type="text" name="PaymentDate" value="{{ $data[2].'/'.$data[1].'/'.$data[0]}}" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-5 col-form-label">Pago efectuado</label>
            <div class="col-lg-7">
              @if ($subscriberPayment[0]->closedate != null)
                @php($data = explode('-',$subscriberPayment[0]->closedate))
                <input type="text" name="payment" value="{{ $data[2].'/'.$data[1].'/'.$data[0] }}" class="form-control" disabled>
              @else
                <input type="text" name="payment" value="N/A" class="form-control" disabled>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-5 col-form-label">Estatus del pago</label>
            <div class="col-lg-7">
              <input type="text" name="status" value="{{ $subscriberPayment[0]->status }}" class="form-control" disabled>
            </div>
          </div>
        </form>
        @else
          <h5>No existe información de pago.</h5>
        @endif
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Datos de contacto</h5>
      </div>
      <div class="ibox-content">
        <form>

          <div class="form-group row">
            <label class="col-lg-3 col-form-label">Teléfono</label>
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
