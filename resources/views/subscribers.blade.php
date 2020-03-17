@extends('layout/template')
@section('contentapp')

<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Consultar suscriptores</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item">
                <strong><a>Suscriptores</a></strong>
            </li>
        </ol>
    </div>
</div>
<!-- Guia -->

<!-- dashboard-->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-content">
                    <form method="post" action="{{action('SubscribersController@listSubscribers', 1)}}">
                        {{csrf_field()}}
                        <h4>Cuentas gratuitas :&nbsp;</h4>
                        <h1 class="text-center">@if($totalFree!= null)
                            {{$totalFree}}
                            @else
                            0
                            @endif</h1>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-offset-12 col-lg-12 text-center">
                                <button class="btn btn-md btn-primary" type="submit" title="Consultar suscriptores">
                                    Buscar

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-content">
                    <h4>Cuentas de pago:&nbsp;</h4>
                    <h1 class="text-center">@if($totalPay!= null)
                        {{$totalPay}}
                        @else
                        0
                        @endif</h1>
                    <hr>
                    <form method="post" action="{{action('SubscribersController@listSubscribers', '2')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-lg-offset-12 col-lg-12 text-center">
                                <button class="btn btn-md btn-primary" type="submit" title="Consultar suscriptores">
                                    Buscar

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-content">
                    <h4>Venezuela:&nbsp;</h4>
                    <h1 class="text-center">@if($totalVenezuela!= null)
                        {{$totalVenezuela}}
                        @else
                        0
                        @endif</h1>
                    <hr>
                    <form method="post" action="{{action('SubscribersController@listSubscribers', '3')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class=" col-lg-12 text-center">
                                <button class="btn btn-primary" type="submit" title="Consultar Suscriptotres">
                                    Buscar

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-content">
                    <h4>Total:&nbsp;</h4>
                    <h1 class="text-center">@if($totalSubscribers!= null)
                        {{$totalSubscribers}}
                        @else
                        0
                        @endif</h1>

                    <hr>
                    <form method="post" action="{{action('SubscribersController@listSubscribers', '0')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class=" col-lg-12 text-center">
                                <button class="btn btn-primary" type="submit" title="Consultar suscriptores">
                                    Buscar

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Consultar suscriptores</h5>
                </div>
                <div class="ibox-content">
                    <form id="fdate" method="post" action="{{ url('suscriptores') }}">
                        {{csrf_field()}}
                        <br>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Suscripción</label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="subscriptionType">
                                    <option value="0">Todos</option>
                                    @foreach($subscriptionTypes as $subscriptionType)
                                    <option value="{{ $subscriptionType->id }}">{{ $subscriptionType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
                            <label class="col-lg-3 col-form-label">Desde</label>
                            <div class="form-group col-lg-9" id="newsletterCalendar">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i></span>
                                    <input type="date" class="form-control" name="startdate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                                    @if ($errors->has('startdate'))
                                    <strong class="error-text col-lg-12">{{ $errors->first('startdate') }}</strong>
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
                                    <input type="date" class="form-control" name="closedate" maxlength="10"
                                        pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                                    @if ($errors->has('closedate'))
                                    <strong class="error-text col-lg-12">{{ $errors->first('closedate') }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <br>
                                <button class="btn btn-md btn-primary" type="submit">Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection