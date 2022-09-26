<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
<?php
    
    session_start();
    if (!isset($_SESSION['usuario_sesion'])) {
        header('Location: index.php');
        die;
    }
    $_SESSION['sql_calculada'] = '';
	$titulo = 'Listado Equipos';
	include 'header.php';

?>

<h1><?= $titulo ?></h1>

<?php

    // Inicialización de variables

	$mensaje = '';

	// Si se reciben datos por POST, realizamos las validaciones

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'validate_list.php';
        $mensaje = $errores;
    //}

        if ($check == 2) {
            ?>
            <div class="mensaje negativo">
                <h3><?= $mensaje ?></h3>
            </div>
            <input class="continuarl" type="button" value="Continuar" onclick="location='equipment_list.php'"/>
            <br><br><br><br>
            <?php
            $nombres = '';
            $comboestado = '';
            $combodisponible = '';
            $comboresponsable = '';
            include 'footer.php';
            die;
        }

        if ($check == 3) {
            include 'config.php';
            @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if (!$link):
                header('Location: ' . PAGINA_ERROR);
                die;
            endif;
            mysqli_set_charset($link, DB_CHARSET);
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
            $cantidad_de_filas = mysqli_num_rows($rs);
            //$titulo = 'Listado de Inventario';
            //include 'home.php';

            ?>

            <!--<h1><?= $titulo ?></h1>-->
            <table id="tablaEquipos">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estado</th>
            <th>Ubicacion</th>
            <th>Responsable</th>
            <th>Observaciones</th>
            <th>Disponibilidad</th>
            <th>Manuales Tecnicos</th>
            <th>Fecha Instalacion</th>
            <th>Solicitud Repuesto</th>
            <th>Ultimo Mantenimiento</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['Id'] ?></td>
            <td><?= $fila['nombres'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['modelo'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['ubicacion'] ?></td>
            <td><?= $fila['responsable'] ?></td>
            <td><?= $fila['observaciones'] ?></td>
            <td><?= $fila['disponibilidad'] ?></td>
            <td><?= $fila['manuales'] ?></td>
            <td><?= $fila['fecha_instalacion'] ?></td>
            <td><?= $fila['solicitud_repuesto'] ?></td>
            <td><?= $fila['fecha_ult_job'] ?></td>
        </tr>
        <?php
            endwhile;
        ?>
        <tr>
            <td colspan="13"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
        </tr>
    </table>
            <br><br>
            <div align="center">
                <a href="reporte_excel_filtrado.php"><img src="img/excel.png" width="50" height="50" alt="Reporte Excel" title="Generar Reporte Excel" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href='#top'><img border='0' style='height: 35px; width: 60px' src="img/up.png" title="Ir arriba" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href="reporte_pdf_filtrado.php" target="_blank"><img src="img/pdf.png" width="46" height="46" alt="Reporte PDF" title="Generar Reporte PDF" /></a>
            </div>
            <?php
            $nombres = '';
            $comboestado = '';
            $combodisponible = '';
            $comboresponsable = '';
            include 'footer.php';
            die;
        }

        if ($check == 4) {
            include 'config.php';
            @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if (!$link):
                header('Location: ' . PAGINA_ERROR);
                die;
            endif;
            mysqli_set_charset($link, DB_CHARSET);
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
            $cantidad_de_filas = mysqli_num_rows($rs);
            //$titulo = 'Listado de Inventario';
            //include 'home.php';

            ?>

            <!--<h1><?= $titulo ?></h1>-->
            <table id="tablaEquipos">
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Estado</th>
            <th># Lote</th>
            <th>Propietario</th>
            <th>Telf. Fijo</th>
            <th>Telf. Movil</th>
            <th>Email</th>
            <th>Miembros Familiares</th>
            <th>Cantidad Vehiculos</th>
            <th>Tipo Vehiculo</th>
            <th>Placas</th>
            <th># Niños</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['Id'] ?></td>
            <td><?= $fila['nombres'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['lote'] ?></td>
            <td><?= $fila['propietario'] ?></td>
            <td><?= $fila['numero_fijo'] ?></td>
            <td><?= $fila['numero_movil'] ?></td>
            <td><?= $fila['email'] ?></td>
            <td><?= $fila['miembros'] ?></td>
            <td><?= $fila['cant_vehiculos'] ?></td>
            <td><?= $fila['tipo_vehiculo'] ?></td>
            <td><?= $fila['placas_vehiculo'] ?></td>
            <td><?= $fila['cant_ninos'] ?></td>
        </tr>
        <?php
            endwhile;
        ?>
        <tr>
            <td colspan="13"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
        </tr>
    </table>
            <br><br>
            <div align="center">
                <a href="reporte_excel_filtrado.php"><img src="img/excel.png" width="50" height="50" alt="Reporte Excel" title="Generar Reporte Excel" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href='#top'><img border='0' style='height: 35px; width: 60px' src="img/up.png" title="Ir arriba" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href="reporte_pdf_filtrado.php" target="_blank"><img src="img/pdf.png" width="46" height="46" alt="Reporte PDF" title="Generar Reporte PDF" /></a>
            </div>
            <?php
            $nombres = '';
            $comboestado = '';
            $combodisponible = '';
            $comboresponsable = '';
            include 'footer.php';
            die;
        }

        if ($check == 5) {
            include 'config.php';
            @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if (!$link):
                header('Location: ' . PAGINA_ERROR);
                die;
            endif;
            mysqli_set_charset($link, DB_CHARSET);
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
            $cantidad_de_filas = mysqli_num_rows($rs);
            //$titulo = 'Listado de Inventario';
            //include 'home.php';

            ?>

            <!--<h1><?= $titulo ?></h1>-->
            <table id="tablaEquipos">
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Estado</th>
            <th># Lote</th>
            <th>Propietario</th>
            <th>Telf. Fijo</th>
            <th>Telf. Movil</th>
            <th>Email</th>
            <th>Miembros Familiares</th>
            <th>Cantidad Vehiculos</th>
            <th>Tipo Vehiculo</th>
            <th>Placas</th>
            <th># Niños</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['Id'] ?></td>
            <td><?= $fila['nombres'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['lote'] ?></td>
            <td><?= $fila['propietario'] ?></td>
            <td><?= $fila['numero_fijo'] ?></td>
            <td><?= $fila['numero_movil'] ?></td>
            <td><?= $fila['email'] ?></td>
            <td><?= $fila['miembros'] ?></td>
            <td><?= $fila['cant_vehiculos'] ?></td>
            <td><?= $fila['tipo_vehiculo'] ?></td>
            <td><?= $fila['placas_vehiculo'] ?></td>
            <td><?= $fila['cant_ninos'] ?></td>
        </tr>
        <?php
            endwhile;
        ?>
        <tr>
            <td colspan="13"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
        </tr>
    </table>
            <br><br>
            <div align="center">
                <a href="reporte_excel_filtrado.php"><img src="img/excel.png" width="50" height="50" alt="Reporte Excel" title="Generar Reporte Excel" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href='#top'><img border='0' style='height: 35px; width: 60px' src="img/up.png" title="Ir arriba" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href="reporte_pdf_filtrado.php" target="_blank"><img src="img/pdf.png" width="46" height="46" alt="Reporte PDF" title="Generar Reporte PDF" /></a>
            </div>
            <?php
            $nombres = '';
            $comboestado = '';
            $combodisponible = '';
            $comboresponsable = '';
            include 'footer.php';
            die;
        }

        if ($check == 6) {
            include 'config.php';
            @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
            if (!$link):
                header('Location: ' . PAGINA_ERROR);
                die;
            endif;
            mysqli_set_charset($link, DB_CHARSET);
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);
            $cantidad_de_filas = mysqli_num_rows($rs);
            //$titulo = 'Listado de Inventario';
            //include 'home.php';

            ?>

            <!--<h1><?= $titulo ?></h1>-->
        <table id="tablaEquipos">
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Estado</th>
            <th># Lote</th>
            <th>Propietario</th>
            <th>Telf. Fijo</th>
            <th>Telf. Movil</th>
            <th>Email</th>
            <th>Miembros Familiares</th>
            <th>Cantidad Vehiculos</th>
            <th>Tipo Vehiculo</th>
            <th>Placas</th>
            <th># Niños</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['Id'] ?></td>
            <td><?= $fila['nombres'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['lote'] ?></td>
            <td><?= $fila['propietario'] ?></td>
            <td><?= $fila['numero_fijo'] ?></td>
            <td><?= $fila['numero_movil'] ?></td>
            <td><?= $fila['email'] ?></td>
            <td><?= $fila['miembros'] ?></td>
            <td><?= $fila['cant_vehiculos'] ?></td>
            <td><?= $fila['tipo_vehiculo'] ?></td>
            <td><?= $fila['placas_vehiculo'] ?></td>
            <td><?= $fila['cant_ninos'] ?></td>
        </tr>
        <?php
            endwhile;
        ?>
        <tr>
            <td colspan="13"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
        </tr>
    </table>
            <br><br>
            <div align="center">
                <a href="reporte_excel_filtrado.php"><img src="img/excel.png" width="50" height="50" alt="Reporte Excel" title="Generar Reporte Excel" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href='#top'><img border='0' style='height: 35px; width: 60px' src="img/up.png" title="Ir arriba" /></a>
                <span><img src="img/space.png" title=""></span>
                <a href="reporte_pdf_filtrado.php" target="_blank"><img src="img/pdf.png" width="46" height="46" alt="Reporte PDF" title="Generar Reporte PDF" /></a>
            </div>
            <?php
            $nombres = '';
            $comboestado = '';
            $combodisponible = '';
            $comboresponsable = '';
            include 'footer.php';
            die;
        }
    }
	include 'equipment_list_form.php';
	include 'footer.php';