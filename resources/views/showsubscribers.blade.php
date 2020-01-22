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
                  <a href="{{ url('gestion_suscriptores') }}">Suscriptores a Consultar</a>
              </li>
              <li class="breadcrumb-item">
                  <strong><a>Detalle de Suscriptor</a></strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia --><br>
@endsection
