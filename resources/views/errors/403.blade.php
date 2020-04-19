@extends('layouts/errorsTemplate')
@section('errorcontent')
<div class="middle-box text-center animated fadeInDown">
    <h1>403</h1>
    <h3 class="font-bold">Acceso no Autorizado</h3>

    <div class="error-desc">
        Lo sentimos, pero el acceso no esta autorizado
        <a href="{{ url('dashboard') }}"><img src="{{ asset('/img/macpecri_dash.jpg') }}" style="width:100%; height:auto; margin-top: 30%;"></a>
    </div>

</div>

@endsection
