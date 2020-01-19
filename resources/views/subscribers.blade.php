@extends('layout/template')
@section('contentapp')

<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Consultar Suscriptores</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Resumen de Suscriptores</a></strong>
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
        <div class="ibox-title">
          <h5>Cuentas Gratuita:&nbsp;
            <h1>@if($totalFree!= null)
              {{$totalFree}}
            @else
              0
            @endif</h1>
          </h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="#" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class="col-lg-offset-12 col-lg-12">
                <button class="btn btn-md btn-primary" type="submit" title="Consultar Suscriptores">
                  Aceptar
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Cuentas de Pago:&nbsp;
            <h1>@if($totalPay!= null)
              {{$totalPay}}
            @else
              0
            @endif</h1>
          </h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="#" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class="col-lg-offset-12 col-lg-12">
                <button class="btn btn-md btn-primary" type="submit" title="Consultar Suscriptores">
                  Aceptar
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Venezuela:&nbsp;
            <h1>@if($totalVenezuela!= null)
              {{$totalVenezuela}}
            @else
              0
            @endif</h1>
          </h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="#" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class=" col-lg-12">
                <button class="btn btn-primary" type="submit" title="Consultar Suscriptotres">
                  Aceptar
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Total:&nbsp;
            <h1>@if($totalSubscribers!= null)
              {{$totalSubscribers}}
            @else
              0
            @endif</h1>
          </h5>
        </div>
        <div class="ibox-content">
          <form method="post" action="#" >
            {{csrf_field()}}
            <div class="form-group row">
              <div class=" col-lg-12">
                <button class="btn btn-primary" type="submit" title="Consultar Suscriptores">
                  Aceptar
                  <span class="glyphicon glyphicon-search"></span>
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
          <h5>Consultar Suscriptores</h5>
        </div>
        <div class="ibox-content">
          <form id="fdate" method="post" action="#" >
            {{csrf_field()}}
            <br>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label">Suscripción</label>
            <div class="col-sm-9">
              <select class="form-control m-b" name="subscriptionType">
                  <option>Selecciona</option>
              </select>
            </div>
            </div>
            <div class="form-group row {{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Desde</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control" name="startdate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                    @if ($errors->has('startdate'))
                      <strong class="error-text">{{ $errors->first('startdate') }}</strong>
                    @endif
                </div>
              </div>
            </div>
            <!--<div class="form-group row {{ $errors->has('closedate') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label">Hasta</label>
              <div class="form-group col-lg-9" id="newsletterCalendar">
                <div class="input-group date">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control" name="closedate" maxlength="10" pattern="[0-9]{2}[/][0-9]{2}[/]([0-9]{4})">
                    @if ($errors->has('closedate'))
                      <strong class="error-text">{{ $errors->first('closedate') }}</strong>
                    @endif
                </div>
              </div>
            </div>-->
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
@endsection
