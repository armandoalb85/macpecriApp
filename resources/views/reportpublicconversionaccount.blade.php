@extends('layout/template')
@section('contentapp')
<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Reporte de público con conversión de cuentas</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item active">
                <a><strong>Conversión de cuentas</strong></a>
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
                    <form id="fdate" method="post" action="{{ url('r_conversion_cuenta')}}">
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
            <div class="ibox">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>Resultados obtenidos</h5>
                        </div>
                        <div class="col-2">
                            <form method="get"
                                action="{{ action('ExportsController@xlsPublicConversionAccount', [$dateIni, $dateFin])}}">
                                <input type="text" name="dateIni" value="{{ $dateIni }}" disabled hidden>
                                <input type="text" name="dateFin" value="{{ $dateFin }}" disabled hidden>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        @if ($dateIni !=null && $dateFin != null)
                                        <button class="btn btn-md btn-success col-6 float-right" type="submit">
                                            @else
                                            <button class="btn btn-md btn-success col-6 float-right" type="submit"
                                                disabled>
                                                @endif
                                                <span class="glyphicon glyphicon-print" title="exportar csv"></span>
                                            </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center">Suscriptor</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Fecha de suscripción</th>
                                <th class="text-center">Fecha de conversión</th>
                                <th class="text-center">Método de pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($queryResults != null)
                            @foreach($queryResults as $queryResult)
                            <tr>
                                <td>{{$queryResult->name." ".$queryResult->lastname}}</td>
                                <td>{{$queryResult->email}}</td>
                                <td>
                                    @php($data = explode(' ',$queryResult->created_at))
                                    @php($data = explode('-',$data[0]))
                                    {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                                </td>
                                <td>
                                    @php($data = explode('-',$queryResult->startdate))
                                    {{ $data[2].'/'.$data[1].'/'.$data[0]}}
                                </td>
                                <td>{{$queryResult->method}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total cuentas pagas</strong></td>
                                <td>@if($totalPay != null){{$totalPay}} @else 0 @endif</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Total cuentas gratuitas</strong></td>
                                <td>@if($totalFree != null){{$totalFree}} @else 0 @endif</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
@endsection