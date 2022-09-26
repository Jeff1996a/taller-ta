<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $titulo ?></title>
	<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/themes/default.css">

</head>
<!--style="background-color:#2d3436;"-->
<body background="img/Paper.jpg">
	<!--<div id="header">-->
        <br>
		<div id="banner"><strong style="color: orange; font-family: 'Verdana'; font-size: 15;"><?php $us = isset($_SESSION['nickuser']) ? ($_SESSION['nickuser']) : '';
                $ap = isset($_SESSION['nickapellido']) ? ($_SESSION['nickapellido']) : ''; echo ' Bienvenid@: '.$us.' '.$ap; ?></strong></div>
	<!--</div>-->
	<br>
	<div id="barramenu">
		<div id="menu">
			<ul>
				<li><a href="equipment_list.php">Listado Equipos</a></li>
				<?php $very = isset($_SESSION['rol']) ? ($_SESSION['rol']) : ''; if ($very != 'normal') echo '<li><a href="equipment_in.php">Ingreso Equipos</a></li>';?>
				<li><a href="equipment_list.php">Modificar Equipos</a></li>
				<li><a href="equipment_list.php">Transmisiones</a></li>
				<?php $very2 = isset($_SESSION['rol']) ? ($_SESSION['rol']) : ''; if ($very2 == 'admin') echo '<li><a href="users_list.php">Usuarios</a></li>'; elseif ($very2 == 'super') {
					echo '<li><a href="history.php">Estadisticas</a></li>';}?>
				<li><a href="equipment_list.php">Incidencias</a></li>
				<li><a href="salir.php">Salir</a></li>
			</ul>
			<div id="fecha">
				<h3><?= date('Y-m-d'); ?></h3>
			</div>
		</div>
	</div>
	<div id="principal">