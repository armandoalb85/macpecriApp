@extends('layout/template')
@section('contentapp')

<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Editar datos del suscriptor</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                @if($startDate === "a")
                <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}">Lista de
                    suscriptores</a>
                @else
                <a
                    href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}">Lista
                    de suscriptores</a>
                @endif
            </li>
            <li class="breadcrumb-item">
                <strong><a>Edición de datos de suscriptor</a></strong>
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
                <form method="post" action="{{ url('suscriptor/edicion/'.$subscriber->id) }}">
                    {{ csrf_field() }}
                    <!-- sostener parametro -->
                    <input type="text" name="subscriberType" value="{{ $typeSubscribers }}" class="form-control" hidden>
                    <input type="text" name="startDate" value="{{ $startDate }}" class="form-control" hidden>
                    <input type="text" name="closeDate" value="{{ $closeDate }}" class="form-control" hidden>
                    <!-- -->
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Usuario</label>
                        <div class="col-lg-9">
                            <input type="text" name="username" value="{{ $account->username }}" class="form-control"
                                disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label">Fecha de nacimiento</label>
                        <div class="col-lg-6">
                            <input type="text" name="birthDate"
                                value="{{date('d/m/Y', strtotime($subscriber->birthday))}}" class="form-control"
                                disabled>
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
                            <input type="text" name="typeAcccount" value="{{ $subscriberAccount[0]->name }}"
                                class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">País</label>
                        <div class="col-lg-9">
                            <input type="text" name="country" value="{{ $subscriberAccount[0]->country }}"
                                class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-lg-3 col-form-label">Correo</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" value="{{ $account->email }}" class="form-control"
                                maxlength="45">
                            @if ($errors->has('email'))
                            <strong class="error-text">{{ $errors->first('email') }}</strong>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Estatus</label>
                        <div class="col-sm-9">
                            <select class="form-control m-b" name="status">
                                @if( $subscriberAccount[0]->status == 'Activo')
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                                @elseif($subscriberAccount[0]->status == 'Inactivo')
                                <option value="0" selected>Inactivo</option>
                                <option value="1">Activo</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <button class="btn btn-md btn-primary col-12" type="submit">Aceptar</button>
                        </div>
                        <div class="col-lg-4">
                            @if($startDate === "a")
                            <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}"
                                class="btn btn-md btn-white col-12">Volver</a>
                            @else
                            <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}"
                                class="btn btn-md btn-white col-12">Volver</a>
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
            @if(isset($subscriberAccount[0]->startdate))
            <div class="ibox-content">
                <div class="form-group row">
                    <label class="col-lg-6 col-form-label">Fecha de pago</label>
                    <div class="col-lg-6">
                        @php( $startDate = date('d/m/Y',strtotime($subscriberAccount[0]->startdate)))
                        <input type="text" name="paymentDate" value="{{ $startDate }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-6 col-form-label">Método de pago</label>
                    <div class="col-lg-6">
                        <input type="text" name="amount" value="{{ $subscriberAccount[0]->payment_method }}"
                            class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-6 col-form-label">Monto</label>
                    <div class="col-lg-6">
                        <input type="text" name="amount"
                            value="{{ number_format($subscriberAccount[0]->amount, 2 , ',' , '.') }} USD"
                            class="form-control" disabled>
                    </div>
                </div>
            </div>
            @else
            <div class="ibox-content">
                <div class="alert alert-info" role="alert">
                    No se encontraron registros de pago!
                </div>
            </div>
            @endif
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
                            <input type="text" name="phone" value="{{ $subscriber->phone}}" class="form-control"
                                disabled>
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