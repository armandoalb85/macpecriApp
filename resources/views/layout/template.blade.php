<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MACPERCRI | Dashboard </title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- data table -->
    <script src="/js/plugins/dataTables/datatables.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Data picker -->
   <script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>

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
                          <a href="{{ url('/password_modify/') }}">Modificar Password </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('boletines') }}">
                      <i class="glyphicon glyphicon-envelope"></i>
                      <span class="nav-label">Boletines Informativos </span>
                    </a>
                </li>
                <li >
                    <a href="#"><i class="glyphicon glyphicon-cog"></i> <span class="nav-label">Configuración</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                          <a href="{{ url('suscripciones') }}">Tipos de suscripción </a>
                        </li>
                        <li>
                          <a href="#">Artículos / Suscripción </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-user"></i> <span class="nav-label">Información del Lector</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Consultar Pagos</a></li>
                        <li><a href="{{ url('/suscriptores/') }}">Consultar Lectores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span class="nav-label">Reportes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Conversión de Cuentas</a></li>
                        <li><a href="#">Creación de Cuentas</a></li>
                        <li><a href="#">Canales de Pago</a></li>
                        <li><a href="#">Pagos Recibidos</a></li>
                        <li><a href="#">Cuentas por Vencerse</a></li>
                        <li><a href="#">Visitas por suscripción </a></li>
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
                    <span class="m-r-sm text-muted welcome-message">Bienveido</span>
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
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>
    <script>
      $(document).ready(function(){
        var mem = $('#newsletterCalendar .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
        });
      });
    </script>

</body>

</html>
