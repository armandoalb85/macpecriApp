@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Tipos de Suscripción</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Suscripciones</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Suscripciones</strong>
              </li>
          </ol>
      </div>
  </div>
<!-- Guia -->

<!-- table--><br>
<div class="row white-bg" >
    <div class="col-lg-12">
      <div class="ibox ">
          <div  class="ibox-title">
            <div class="row">
              <div class="col-10">
                <h5>Listado de Tipo de Suscripciones</h5>
              </div>
              <div class="col-2">
                <a href="{{ url('suscripciones/nuevo') }}" class="btn btn-sm btn-primary float-right"><i class="glyphicon glyphicon-plus"></i>Nuevo Tipo</a>
              </div>
            </div>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
              </tr>
              </thead>
              <tbody>
                <tr class="gradeX">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td class="center">4</td>
                    <td class="center">X</td>
                </tr>
                <tr class="gradeC">
                    <td>Trident</td>
                    <td>Internet
                        Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td class="center">5</td>
                    <td class="center">C</td>
                </tr>
              </tfoot>
          </table>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
