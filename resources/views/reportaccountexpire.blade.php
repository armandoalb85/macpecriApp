@extends('layout/template')
@section('contentapp')
<!-- Guia -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Reporte de cuentas por vencerse</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('dashboard') }}">Sistema administrativo</a>
            </li>
            <li class="breadcrumb-item active">
                <a><strong>Cuentas por vencerse</strong></a>
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
                    <form id="fdate" method="post" action="{{ url('r_cuentas_por_vencer')}}">
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
                                action="{{ action('ExportsController@xlsAccountExpire', [$dateIni, $dateFin])}}">
                                <input type="text" name="dateIni" value="{{ $dateIni }}" disabled hidden>
                                <input type="text" name="dateFin" value="{{ $dateFin }}" disabled hidden>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        @if ($dateIni !=null)
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
                                <th class="text-center">Fecha de pago</th>
                                <th class="text-center">Días para pagar</th>
                                <th class="text-center">Monto a pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($queryResults != null)
                            @foreach($queryResults as $queryResult)
                            <tr>
                                <td class="text-center">{{ $queryResult->name." ".$queryResult->lastname}}</td>
                                <td class="text-center">{{ $queryResult->email}}</td>
                                <td class="text-center">
                                    {{ date('d/m/Y',strtotime($queryResult->closedate)) }}
                                </td>
                                <td class="text-center">{{ $queryResult->days_for_expire}}</td>
                                <td class="text-center">{{ number_format($queryResult->amount, 2 , ',' , '.') }} USD
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">No se encontraron registros</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection