@extends('layouts/errorsTemplate')
@section('errorcontent')
<div class="middle-box text-center animated fadeInDown">
    <h1>500</h1>
    <h3 class="font-bold">Error Interno del Servidor</h3>

    <div class="error-desc">
      El servidor encontró algo inesperado que no le permitió completar la solicitud. Nos disculpamos. Intente más tarde. 
        <a href="{{ url('dashboard') }}"><img src="{{ asset('/img/macpecri_dash.jpg') }}" style="width:100%; height:auto; margin-top: 30%;"></a>
    </div>

</div>

@endsection
