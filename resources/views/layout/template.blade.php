<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MACPECRI | Administrador de Suscripciones </title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('/js/inspinia.js') }}"></script>
    <script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- data table -->
    <script src="{{ asset('/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Data picker -->
   <script src="{{ asset('/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

</head>

<body>
    <div id="wrapper">
    <!-- Menu Lateral del Dashboard -->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="logo-element">

                        <!--<img src="../img/Logo_mini.png" style="width: 30%; height: 30%;">-->

                    </div>
                </li>
                <li>
                    <a href="{{ url('/dashboard/') }}"><i class="glyphicon glyphicon-th-large"></i> <span class="nav-label">Sistema Administrativo</span></a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-asterisk"></i> <span class="nav-label">Mi Cuenta</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                          <a href="{{ url('/password_modify/') }}">Modificar Contraseña </a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="#"><i class="glyphicon glyphicon-cog"></i> <span class="nav-label">Configuración</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                          <a href="{{ url('suscripciones') }}">Tipos de Suscripción </a>
                          <a href="{{ url('suscribase_ahora') }}">Suscríbase Ahora </a>
                          <a href="{{ url('pagos_config') }}">Botón de Pago </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('gestion_suscriptores') }}">
                      <i class="glyphicon glyphicon-globe"></i>
                      <span class="nav-label">Gestión de Suscripción</span>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-user"></i> <span class="nav-label">Información del Lector</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('pagos_realizados') }}">Consultar Pagos Realizados</a></li>
                        <li><a href="{{ url('pagos_pendientes') }}">Consultar Pagos Pendientes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span class="nav-label">Reportes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('r_conversion_cuenta')}}">Conversión de Cuentas</a></li>
                        <li><a href="{{ url('r_creacion_cuenta')}}">Creación de Cuentas</a></li>
                        <li><a href="{{ url('r_canales_pago')}}">Canales de Pago</a></li>
                        <li><a href="{{ url('r_pagos_recibidos')}}">Pagos Recibidos</a></li>
                        <li><a href="{{ url('r_cuentas_por_vencer')}}">Cuentas por Vencerse</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
    <!-- Menu Lateral del Dashboard -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenido</span>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </nav>
        </div>

        <!-- Contenido o Cuerpo de Pagina -->
        <div class="wrapper wrapper-content">
            @include('layouts/flashmessage')
            @yield('contentapp')
             <!-- Pie de Pagina -->
            <div class="footer">
                <div>
                    <strong>Grupo Macpecri - Rif: J-29355653-8 2019 </strong>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                "language": {
                  "decimal": "",
                  "emptyTable": "No hay información",
                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                  "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                  "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                  "infoPostFix": "",
                  "thousands": ",",
                  "lengthMenu": "Mostrar _MENU_ Entradas",
                  "loadingRecords": "Cargando...",
                  "processing": "Procesando...",
                  "search": "Buscar:",
                  "zeroRecords": "Sin resultados encontrados",
                  "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
              });
        });
    </script>
    <script>
      /*$(document).ready(function(){
        var mem = $('#newsletterCalendar .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true,
          dateFormat: 'dd-mm-yy'
        });
      });*/
      $(document).ready(function(){
        $.fn.datepicker.defaults.language = 'es';
        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy",
            clear: "Borrar",
            weekStart: 1,
        };
        $('div.input-group.date').each(function() {
            var target = $(this);
            target.find("input:text").each(function() {
                if (!$(this).is('[readonly]')) {
                    target.datepicker({
                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: false,
                        autoclose: true,
                        format: "dd/mm/yyyy",
                        dateFormat: "dd/mm/yyyy",
                        language: 'es'
                    });
                }
            });
        });
      });
    </script>
    <script>
      $(document).ready(function(){
        setTimeout(function(){
          $('.fade-out').fadeOut(5000);
        });
      });
    </script>
    <!--<script>
      $('#form input[type=text]').on('change invalid', function() {
        var campotexto = $(this).get(0);

        campotexto.setCustomValidity('');

        if (!campotexto.validity.valid) {
          campotexto.setCustomValidity('No se permiten caracteres especiales');
        }
      });
      $('#form input[type=number]').on('change invalid', function() {
          var campotexto = $(this).get(0);

          campotexto.setCustomValidity('');

          if (!campotexto.validity.valid) {
            campotexto.setCustomValidity('Se permiten solo caracteres númericos');
          }
      });
      $('#fdate input[type=text]').on('change invalid', function() {
          var campotexto = $(this).get(0);

          campotexto.setCustomValidity('');

          if (!campotexto.validity.valid) {
            campotexto.setCustomValidity('El formato correcto es dd/mm/yyyy');
          }
      });
    </script>-->
    <!--<script>

    $(document).ready(function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
          return true;
         }
         return false;
      });
    </script>-->

</body>

</html>
