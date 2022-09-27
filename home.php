<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="Content/css/bootstrap.min.css"/>

    <script src="Content/js/bootstrap.bundle.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

</head>
<body>

    <header>
        <div id="header-info">
            <h3 class="text-success"> <?php $us = isset($_SESSION['nickuser']) ? ($_SESSION['nickuser']) : '';
                $ap = isset($_SESSION['nickapellido']) ? ($_SESSION['nickapellido']) : ''; echo 'Bienvenid@: '.$us.' '.$ap; ?>
            </h3>
            <h4 class="text-success">Fecha: <?= date('Y-m-d'); ?></h4>
            <div id="logo-ta">
                <img src="img/logo.png" width="170" height="125" alt=""/>
            </div>
            <br/>
        </div>

        <!--Navbar-->
        <nav class="navbar navbar-expand-sm navbar-light text-white " style="background-color: #005aa9;">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="display: flex; justify-content: space-between; width: 100%; font-size: 25px;">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Listado equipos
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown" style="background-color:  #005aa9; font-size: 20px;">

                            <li><a class="dropdown-item text-white" id="btnAudio" role="button">Audio</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li><a class="dropdown-item text-white" id="btnCables" role="button">Cables</a></li>
                            <li><hr class="dropdown-divider">

                            <li><a class="dropdown-item text-white" id="btnEdicion" role="button">Edición</a></li>
                            <li><hr class="dropdown-divider" role="button"></li>

                            <li><a class="dropdown-item text-white" id="btnElectrico" role="button">Eléctricidad</a></li>
                            <li><hr class="dropdown-divider"></li>



                            <li><a class="dropdown-item text-white" id="btnRed" role="button">Red</a></li>
                            <li><hr class="dropdown-divider"></li>


                            <li><a class="dropdown-item text-white" id="btnVideo" role="button">Video</a></li>
                        </ul>
                    </li>

                    <li class="nav-item active" id="btnTransmisiones" role="button">
                        <a class="nav-link text-white">Transmisiones</a>
                    </li>

                    <li class="nav-item active" id="btnIncidencias">
                        <a class="nav-link text-white" href="#">Incidencias</a>
                    </li>

                    <li class="nav-item active" id="btnSoporte">
                        <a class="nav-link text-white" href="#">Soporte</a>
                    </li>

                    <?php
                        if($_SESSION['rol'] == 'admin'){
                            echo '
                            <li class="nav-item active" id="btnSoporte">
                                <a class="nav-link text-white" href="#">Control</a>
                            </li>';
                        }

                        else {
                            echo '
                            <li class="nav-item active" id="btnSoporte" style="display: none;">
                                <a class="nav-link text-white" href="#">Control</a>
                            </li>'; 
                        }
                    ?>

                    <li class="nav-item active">
                        <a class="nav-link text-white" style="margin-right: 15px;" href="salir.php">Salir</a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <br/>

    <div id="content" class="container-fluid">

    </div>

    <div id="popup" >

    </div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {

        const msg = {
            category: ''
        }

        $("#btnTransmisiones").click(function(){
            msg.category = 'transmision';
            $.ajax({
                type:'GET',
                url: 'Controller/TransmisionController.php',
                data: { data : JSON.stringify(msg), action:'listarTransmisiones'},
                success: function(response){
                    $('#content').html(response);
                }
            });

        });


        $("#btnAudio").click(function () {
            msg.category = 'audio';
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            })
        });

        $("#btnCables").click(function () {
            msg.category = 'cables';
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            })
        });

        $("#btnEdicion").click(function () {
            msg.category = 'edición';
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            })
        });

        $("#btnVideo").click(function () {
            msg.category = 'video';
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });


        $("#btnRed").click(function () {
            msg.category = 'red'
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $("#btnElectrico").click(function () {
            msg.category = 'electricidad'
            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $("#btnIncidencias").click(function(){
            msg.category = 'incidencias';
            $.ajax({
                type:'GET',
                url: 'Controller/IncidenciasController.php',
                data: {data:JSON.stringify(msg), action: 'listarIncidencias'},
                success: function(response){
                    $('#content').html(response);
                }
            });

        });

        $("#btnSoporte").click(function(){
            msg.category = 'soporte';
            $.ajax({
                type:'GET',
                url: 'Controller/CursosController.php',
                data: {data:JSON.stringify(msg), action: 'listarCursos'},
                success: function(response){
                    $('#content').html(response);
                }
            });

        });
    })
</script>






