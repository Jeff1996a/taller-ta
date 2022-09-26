<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script> src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"</script>
<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
    header('Location: index.php');
    die;
}
$_SESSION['sql_calculada'] = '';

$titulo = 'Lista  Equipos';
include 'home.php';

$titulo = 'Registro de mantenimiento';
?>
<div id="dialog-form">

</div>
<?php
include 'equipment_list_form.php';
?>


<div class="row" style="width: 100%; display: flex; align-items: baseline;">
    <div class="col-11">
        <h1 style="color:#fa983a; text-align: center; border-bottom: 0px; margin-left: 150px;"><?= $titulo ?></h1>

    </div>
    <div class="col" style="color:#fa983a; text-align:right;">
        <a id="btnAddEquipment" style="color:#fa983a;" >
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
            </svg>
        </a>
    </div>
</div>

<script type="text/javascript">
    $('#btnAddEquipment').click(function(){
        $('#dialog-form').load('AddNewEquipment.php',function(){
            $('#dialog-form').dialog({
                autoOpen: false,
                modal: true
            });
        });
    });
</script>

<hr/>


<br/>

<div class="container-fluid">
    <?php
    // Inicialización de variables
    $mensaje = '';

    // Si se reciben datos por POST, realizamos las validaciones
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Repuesto</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
                </thead>
                <?php
                while ($fila = mysqli_fetch_assoc($rs)): ?>
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
                        <td>
                            <a href="#">Historial</a>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
                <thead style="text-align: center">
                <td colspan="14"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
                </thead>
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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Repuesto</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
                </thead>
                <?php
                while ($fila = mysqli_fetch_assoc($rs)):
                    ?>
                    <tr>
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
                        <td>
                            <a href="#">Historial</a>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
                <thead style="text-align: center">
                <td colspan="14"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
                </thead>
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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Repuesto</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
                </thead>
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
                        <td>
                            <a href="#">Historial</a>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
                <thead style="text-align: center">
                <td colspan="14"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
                </thead>
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

            ?>

            <!--<h1><?= $titulo ?></h1>-->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                    <th>Disponibilidad</th>
                    <th>Repuesto</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
                </thead>
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
                        <td>
                            <a href="#">Historial</a>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
                <thead style="text-align: center">
                <td colspan="14"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
                </thead>
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
    else{
        include 'config.php';
        @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        if (!$link):
            header('Location: ' . PAGINA_ERROR);
            die;
        endif;
        mysqli_set_charset($link, DB_CHARSET);
        $sql = 'SELECT * FROM equipos ORDER BY Id';
        $rs = mysqli_query($link, $sql);
        mysqli_close($link);
        $cantidad_de_filas = mysqli_num_rows($rs);

    }
    ?>
    <table class="table table-hover">
        <thead>
        <tr >
            <th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Estado</th>
            <th>Departamento</th>
            <th>Responsable</th>
            <th>Observaciones</th>
            <th>Disponibilidad</th>
            <th>Repuesto</th>
            <th>Fecha</th>
            <th></th>
        </tr>
        </thead>
        <?php
        while ($fila = mysqli_fetch_assoc($rs)):
            ?>
            <tr >
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
                <td>
                    <a href="#">Historial</a>
                </td>
            </tr>
        <?php
        endwhile;
        ?>
        <thead style="text-align: center">
        <td colspan="14"><strong>Se encontraron <?= $cantidad_de_filas ?> registros.</strong></td>
        </thead>
    </table>

</div>

