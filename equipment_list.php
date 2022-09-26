

<?php

    // Inicialización de variables
	$mensaje = '';

	// Si se reciben datos por POST, realizamos las validaciones

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'validate_list.php';
        $mensaje = $errores;
    //}

        if ($check == 2) {
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
            ?>
            <table id="tablaEquipos">
                <tr>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Ubicacion</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Solicitud Repuesto</th>
                    <th>Ultimo Mantenimiento</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($rs)):
                    ?>
                    <tr>
                        <td><?= $fila['nombre'] ?></td>
                        <td><?= $fila['equipo'] ?></td>
                        <td><?= $fila['marca'] ?></td>
                        <td><?= $fila['modelo'] ?></td>
                        <td><?= $fila['estado'] ?></td>
                        <td><?= $fila['ubicacion'] ?></td>
                        <td><?= $fila['responsable'] ?></td>
                        <td><?= $fila['observaciones'] ?></td>
                        <td><?= $fila['disponibilidad'] ?></td>
                        <td><?= $fila['solicitud_repuesto'] ?></td>
                        <td><?= $fila['fecha_last_maintenance'] ?></td>
                    </tr>
                <?php
                endwhile;
                ?>
                <tr>
                    <td colspan="11"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
                </tr>
            </table>
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
            <table  id="tablaEquipos" >
                <tr>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Ubicacion</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Solicitud Repuesto</th>
                    <th>Ultimo Mantenimiento</th>
                </tr>
                <?php
                    while ($fila = mysqli_fetch_assoc($rs)):
                ?>
                <tr>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['equipo'] ?></td>
                    <td><?= $fila['marca'] ?></td>
                    <td><?= $fila['modelo'] ?></td>
                    <td><?= $fila['estado'] ?></td>
                    <td><?= $fila['ubicacion'] ?></td>
                    <td><?= $fila['responsable'] ?></td>
                    <td><?= $fila['observaciones'] ?></td>
                    <td><?= $fila['disponibilidad'] ?></td>
                    <td><?= $fila['solicitud_repuesto'] ?></td>
                    <td><?= $fila['fecha_last_maintenance'] ?></td>
                </tr>
                <?php
                    endwhile;
                ?>
                <tr>
                    <td colspan="11"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
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
            <th>Nombre</th>
            <th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estado</th>
            <th>Ubicacion</th>
            <th>Responsable</th>
            <th>Observaciones</th>
            <th>Disponibilidad</th>
            <th>Solicitud Repuesto</th>
            <th>Ultimo Mantenimiento</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['equipo'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['modelo'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['ubicacion'] ?></td>
            <td><?= $fila['responsable'] ?></td>
            <td><?= $fila['observaciones'] ?></td>
            <td><?= $fila['disponibilidad'] ?></td>
            <td><?= $fila['solicitud_repuesto'] ?></td>
            <td><?= $fila['fecha_last_maintenance'] ?></td>
        </tr>
        <?php
            endwhile;
        ?>
        <tr>
            <td colspan="11"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
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
            <th>Nombre</th>
            <th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estado</th>
            <th>Ubicacion</th>
            <th>Responsable</th>
            <th>Observaciones</th>
            <th>Disponibilidad</th>
            <th>Solicitud Repuesto</th>
            <th>Ultimo Mantenimiento</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($rs)):
        ?>
        <tr>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['equipo'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['modelo'] ?></td>
            <td><?= $fila['estado'] ?></td>
            <td><?= $fila['ubicacion'] ?></td>
            <td><?= $fila['responsable'] ?></td>
            <td><?= $fila['observaciones'] ?></td>
            <td><?= $fila['disponibilidad'] ?></td>
            <td><?= $fila['solicitud_repuesto'] ?></td>
            <td><?= $fila['fecha_last_maintenance'] ?></td>
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