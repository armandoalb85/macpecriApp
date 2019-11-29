<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.8/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Aug 2018 01:30:12 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MACPERCRI | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

            <!--<h1 class="logo-name">IN+</h1>-->
            <img class="logo-imgEdg" src="img/Logo_B.png" style="width: 80%; height: 90%;">

            </div>
            <!--<form class="m-t" role="form" action="http://webapplayers.com/inspinia_admin-v2.8/index.html">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-success block full-width m-b">Aceptar</button>

                <a href="#"><small>¿Olvidaste tu Contraseña?</small></a>
            </form>-->
            @yield('logincontent')
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
