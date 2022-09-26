<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
<?php
    
    session_start();
    if (!isset($_SESSION['usuario_sesion'])) {
      header('Location: index.php');
      die;
    }
    $editar = '';
    include 'config.php';
    if (!empty($_GET['editar'])) {
      $esUnaEdicion = true;
      $editar = $_GET['editar'];
    }else {
      $esUnaEdicion = false;
    }

	// Inicialización de variables

	$nombres = '';
  $lote = '';
	$estado = '';
	$propietario = '';
	$numero_fijo = '';
	$numero_movil = '';
	$email = '';
	$miembros = '';
	$cant_vehiculos = '';
	$tipo_vehiculo = '';
	$placas_vehiculo = '';
	$cantninos = '';
	$mensaje = '';
	$errores = '';

	// Si se reciben datos por POST, realizamos las validaciones

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'validate.php';

        if (empty($errores)) {
            if (!$esUnaEdicion) {
                $mensaje = 'Persona ingresada a la base exitosamente...';
                $tipo_de_mensaje = 'positivo';
                include 'config.php';
                @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
                if (!$link) {
                    header('Location: ' . PAGINA_ERROR);
                    die;
                }

                mysqli_set_charset($link, DB_CHARSET);

                $sql = "INSERT INTO arrendatarios SET
                    
                      nombres = '$nombres',
                      estado = '$estado',
                      propietario = '$propietario',
                      numero_fijo = '$numero_fijo',
                      numero_movil = '$numero_movil',
                      email = '$email',
                      lote = '$lote',
                      miembros = '$miembros',
                      cant_vehiculos = '$cant_vehiculos',
                      tipo_vehiculo = '$tipo_vehiculo',
                      placas_vehiculo = '$placas_vehiculo',
                      cant_ninos = '$cantninos'
                ";

                $rs = mysqli_query($link, $sql);
                mysqli_close($link);

                $nombres = '';
                $estado = '';
                $propietario = '';
                $numero_fijo = '';
                $numero_movil = '';
                $lote = '';
                $email = '';
                $miembros = '';
                $cant_vehiculos = '';
                $tipo_vehiculo = '';
                $placas_vehiculo = '';
                $cantninos = '';
            
            }
            else{
                $mensaje = 'Persona actualizada exitosamente...';
                $tipo_de_mensaje = 'positivo';
                include 'config.php';
                @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
                if (!$link) {
                    header('Location: ' . PAGINA_ERROR);
                    die;
                }

                mysqli_set_charset($link, DB_CHARSET);

                $sql = "UPDATE arrendatarios SET
                    
                      nombres = '$nombres',
                      estado = '$estado',
                      propietario = '$propietario',
                      numero_fijo = '$numero_fijo',
                      numero_movil = '$numero_movil',
                      email = '$email',
                      lote = '$lote',
                      miembros = '$miembros',
                      cant_vehiculos = '$cant_vehiculos',
                      tipo_vehiculo = '$tipo_vehiculo',
                      placas_vehiculo = '$placas_vehiculo',
                      cant_ninos = '$cantninos'
                      WHERE
                      Id = '$editar'";

                $rs = mysqli_query($link, $sql);
                mysqli_close($link);

                $nombres = '';
                $estado = '';
                $propietario = '';
                $numero_fijo = '';
                $numero_movil = '';
                $lote = '';
                $email = '';
                $miembros = '';
                $cant_vehiculos = '';
                $tipo_vehiculo = '';
                $placas_vehiculo = '';
                $cantninos = '';
            }
        } else {
            $mensaje = $errores;
            $tipo_de_mensaje = 'negativo';
        }
    }
    else{
        if ($esUnaEdicion) {
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if(!$link) {
                header('Location: ' . PAGINA_ERROR);
                die;
            }
            mysqli_set_charset($link, DB_CHARSET);
            $sql = 'SELECT * FROM arrendatarios WHERE Id = '.$_GET['editar'];
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
            $persona = mysqli_fetch_assoc($rs);
            $nombres = $persona['nombres'];
            $estado = $persona['estado'];
            $lote = $persona['lote'];
            $propietario = $persona['propietario'];
            $numero_fijo = $persona['numero_fijo'];
            $numero_movil = $persona['numero_movil'];
            $email = $persona['email'];
            $miembros = $persona['miembros'];
            $cant_vehiculos = $persona['cant_vehiculos'];
            $tipo_vehiculo = $persona['tipo_vehiculo'];
            $placas_vehiculo = $persona['placas_vehiculo'];
            $cantninos = $persona['cant_ninos'];
        }
    }
    if(isset($_GET['editar']))
    	$titulo = 'Modificación de Personas';
 	else 
 		$titulo = 'Ingreso de Personas';
    include 'header.php';
    ?>

    <h1><?= $titulo ?></h1>
    <?php

    if ($mensaje != '') {
        ?>
        <div class="mensaje <?= $tipo_de_mensaje ?>">
            <h3><?= $mensaje ?></h3>
        </div>
        <?php
    }

  include 'lessees_form.php';
	include 'footer.php';