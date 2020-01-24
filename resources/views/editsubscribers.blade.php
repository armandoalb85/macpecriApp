@extends('layout/template')
@section('contentapp')

<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Editar Datos del Suscriptor</h2>
          {{ $typeSubscribers }}
          {{ $startDate }}
          {{ $closeDate }}
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="{{ url('dashboard') }}">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                @if($startDate === "a")
                  <a href="{{action('SubscribersController@listSubscribers', $typeSubscribers)}}">Lista de Suscriptores</a>
                @else
                  <a href="{{action('specialsController@listSubscribersByFilterWihtParams', [$typeSubscribers,$startDate,$closeDate])}}">Lista de Suscriptores</a>
                @endif
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Edición de Datos de Suscriptor</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>

@endsection
