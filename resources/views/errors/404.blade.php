@extends('layouts/errorsTemplate')
@section('errorcontent')
<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Página no Encontrada</h3>

    <div class="error-desc">
        Lo sentimos, pero la página que estás buscando no ha sido encontrada. Intente verificar la URL, luego presione el botón Actualizar en su navegador.
        <a href="{{ url('dashboard') }}"><img src="{{ asset('/img/macpecri_dash.png') }}" style="width:100%; height:auto; margin-top: 30%;"></a>
    </div>

</div>

@endsection
