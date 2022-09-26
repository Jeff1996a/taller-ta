<!DOCTYPE html>
<html lang="es">
<head>
	<title>Taller Ingenieria</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/estilos.css">
<!--===============================================================================================-->

</head>
<body>
	
	<div class="fondo">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						TALLER INGENIERIA
					</span>
                    </div>

                    <form class="login100-form validate-form" action="" method="POST">
                        <div class="wrap-input100 validate-input m-b-26" data-validate="Nombre de usuario requerido">
                            <span class="label-input100">Usuario</span>
                            <input class="input100" type="text" name="username" placeholder="Ingresar usuario">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Contraseña requerida">
                            <span class="label-input100">Contraseña</span>
                            <input class="input100" type="password" name="pass" placeholder="Ingresar contraseña">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="flex-sb-m w-full p-b-30">
                            <!--<div class="contact100-form-checkbox">
                                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                <label class="label-checkbox100" for="ckb1">
                                    Recuerdame
                                </label>
                            </div>-->
                            <!--<div>
                                <a href="#" class="txt1">
                                    Forgot Password?
                                </a>
                            </div>-->
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

	<?php
    	$usuario ='';
        $contrasena = '';
        session_start();
        include 'config.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if (!$link) {
                header('Location: ' . PAGINA_ERROR);
                die;
        	}
        	mysqli_set_charset($link, DB_CHARSET);

        	$usuario = mysqli_real_escape_string($link, $_POST['username']);
        	$contrasena = mysqli_real_escape_string($link, $_POST['pass']);

        	//$contrasena = md5($contrasena);

        	$sql = "SELECT * FROM Usuario WHERE nickname = '$usuario' AND password = MD5 ('$contrasena')";

        	$rs = mysqli_query($link, $sql);

        	mysqli_close($link);
        	if (mysqli_num_rows($rs) == 1) {
           		@ $link2 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
           		if (!$link2) {
               		header('Location: ' . PAGINA_ERROR);
               		die;
           		}

        		mysqli_set_charset($link2, DB_CHARSET);

        		$sql2 = "UPDATE Usuario SET lastlogin = NOW() WHERE nickname = '$usuario'";
        		$rs2 = mysqli_query($link2, $sql2);

        		mysqli_close($link2);

        		$_SESSION['usuario_sesion'] = $usuario;
        		@ $link3 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        		if(!$link3) {
           			header('Location: ' . PAGINA_ERROR);
           			die;
        		}	
        		mysqli_set_charset($link3, DB_CHARSET);
        		$sql3 = "SELECT * FROM Usuario WHERE nickname = '$usuario'";
        		$rs3 = mysqli_query($link3, $sql3);
        		mysqli_close($link3);
        		$nickcalc = mysqli_fetch_assoc($rs3);
        		$nickweb = $nickcalc['nombre'];
        		$apellidoweb = $nickcalc['apellido'];
        		$nickweb2 = $nickcalc['nickname'];
        		$rol = $nickcalc['rol'];
        		//setcookie('usuario', $usuario, time() + 60*60*24*30);
        		//setcookie('contrasena', $contrasena, time() + 60*60*24*30);
        		$_SESSION['nickuser2'] = '';
        		$_SESSION['nickapellido2'] = '';
        		$_SESSION['nickuser'] = $nickweb;
        		$_SESSION['nickapellido'] = $apellidoweb;
        		$_SESSION['nicknick'] = $nickweb2;
        		$_SESSION['rol'] = $rol;
        		$_SESSION['sql_calculada'] = '';
        		$_SESSION['sql_calculada2'] = '';
        		$_SESSION['sql_calculada3'] = '';
        		$_SESSION['sql_calculada4'] = '';
        		$_SESSION['sql_calculada5'] = '';
        		$_SESSION['sql_cero_regs'] = '';
        		header('Location: home.php');
        		die;
    		}
    		else {
            	echo '<script language="JavaScript">';
            	echo 'alert("Error! \\n Usuario y/o contraseña incorrectos...");';
            	echo '</script>';
        	}
		}
	?>
	
<!--===============================================================================================-->
	<script src="/vendor2/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor2/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor2/bootstrap/js/popper.js"></script>
	<script src="/vendor2/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor2/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor2/daterangepicker/moment.min.js"></script>
	<script src="/vendor2/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor2/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>

</body>
</html>