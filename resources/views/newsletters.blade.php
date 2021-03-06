@extends('layout/template')
@section('contentapp')
<!-- Guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Boletines Informativos</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">Sistema Administrativo</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Boletines</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Boletines</strong>
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
                <h5>Lista de Boletines</h5>
              </div>
              <div class="col-2">
                <a href="{{ url('boletines/nuevo') }}" class="btn btn-sm btn-primary float-right">
                  <i class="glyphicon glyphicon-plus"></i>
                  &nbsp;Nuevo Registro
                </a>
              </div>
            </div>
          </div>
          <div class="ibox-content">

            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>Boletin</th>
                  <th>Apertura</th>
                  <th>Cierre</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @if($newsletters->count())
                  @foreach($newsletters as $newsletter)
                  <tr>
                    <td>{{$newsletter->name}}</td>
                    <td>{{$newsletter->stardate}}</td>
                    @if($newsletter->closedate != null)
                      <td>{{$newsletter->closedate}}</td>
                    @else
                      <td>Sin definir</td>
                    @endif
                    <td>
                      <center>
                      <div class="btn-group" role="group">
                        <a href="{{action('NewslettersController@showNewsletter', $newsletter->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-search" title="Consulta de registro"></span>
                        </a>
                        <a href="{{action('NewslettersController@editNewsletter', $newsletter->id)}}" class="btn btn-sm btn-white ">
                          <span class="glyphicon glyphicon-pencil" title="Editar de registro"></span>
                        </a>
                        <a href="{{action('NewslettersController@destroyNewsletters', $newsletter->id)}}" class="btn btn-sm btn-white " onclick="return confirm('Seguro que desea eliminar el registro?')">
                          <span class="glyphicon glyphicon-trash" title="Eliminar de registro"></span>
                        </a>
                      </div>
                      </center>
                    </td>
                   </tr>
                  @endforeach
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
