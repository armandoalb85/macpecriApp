@extends('layout/template')
@section('contentapp')
  <!-- guia -->
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>Modificar Password de Usuario</h2>
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <a href="index-2.html">dashboard</a>
              </li>
              <li class="breadcrumb-item">
                  <a>Modificar Password</a>
              </li>
              <li class="breadcrumb-item active">
                  <strong>Modificar Password</strong>
              </li>
          </ol>
      </div>
  </div>
  <!-- guia -->
  <!--form -->
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-5">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Modificar Password</h5>
          </div>
          <div class="ibox-content">
            <form>
              <div class="form-group row">
                <label class="col-lg-5 col-form-label">Password Actual</label>
                <div class="col-lg-7">
                  <input type="password" placeholder="******" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-5 col-form-label">Nuevo Password</label>
                <div class="col-lg-7">
                  <input type="password" placeholder="******" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-5 col-form-label">Confirmar Password</label>
                <div class="col-lg-7">
                  <input type="password" placeholder="******" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-offset-2 col-lg-10">
                  <button class="btn btn-sm btn-white" type="submit">Aceptar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--form -->
@endsection
