<!--<pre>-->
<?php
    //print_r($_POST);
    //die();
?>
<!--</pre>-->
<!--<br><br>-->
<?php

    $check = '';
    $errores = '';
    $sql = '';
    $nombres = isset($_POST['nombres']) ? ($_POST['nombres']) : '';
    $comboestado = isset($_POST['comboestado']) ? ($_POST['comboestado']) : '';
    $combodisponible = isset($_POST['combodisponible']) ? ($_POST['combodisponible']) : '';
    $comboresponsable = isset($_POST['comboresponsable']) ? ($_POST['comboresponsable']) : '';

    if ($nombres == '' && $comboestado == '' && $combodisponible == '' && $comboresponsable == '') {
        $errores = 'Favor elegir por lo menos un criterio de búsqueda...<br>';
        $check = 2;
    }

    if ($comboestado != '' && empty($nombres) && empty($combodisponible) && empty($comboresponsable)) {
        $check = 3;
        $sql = "SELECT * FROM equipos WHERE estado LIKE '$comboestado'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE estado LIKE '$comboestado'";
    }

    if ($combodisponible != '' && empty($nombres) && empty($comboestado) && empty($comboresponsable)) {
        $check = 4;
        $sql = "SELECT * FROM equipos WHERE disponibilidad LIKE '%".$combodisponible."%'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE disponibilidad LIKE '%".$combodisponible."%'";
    }

    if ($comboresponsable != '' && empty($nombres) && empty($comboestado) && empty($combodisponible)) {
        $check = 5;
        $sql = "SELECT * FROM equipos WHERE responsable LIKE '$comboresponsable'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE responsable LIKE '$comboresponsable'";
    }

    if ($nombres != '' && empty($combodisponible) && empty($comboestado) && empty($comboresponsable)) {
        $check = 6;
        $sql = "SELECT * FROM equipos WHERE nombre LIKE '%".$nombres."%'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE nombre LIKE '%".$nombres."%'";
    }