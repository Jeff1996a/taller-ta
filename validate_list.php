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
    $responsable = isset($_POST['responsable']) ? ($_POST['responsable']) : '';
    $comboestado = isset($_POST['comboestado']) ? ($_POST['comboestado']) : '';
    $marca = isset($_POST['marca']) ? ($_POST['marca']) : '';

    if ($nombres == '' && $comboestado == '' && $responsable == '' && $marca == '') {
        $check = 2;
        $sql = " SELECT * FROM equipos";
        $_SESSION['sql_calculada'] = " SELECT * FROM equipos";
    }

    if ($comboestado != '' && empty($nombres) && empty($responsable) && empty($marca)) {
        $check = 3;
        $sql = "SELECT * FROM equipos WHERE estado LIKE '$comboestado'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE estado LIKE '$comboestado'";
    }

    if ($responsable != '' && empty($comboestado) && empty($nombres)) {
        $check = 4;
        $sql = "SELECT * FROM equipos WHERE responsable LIKE '%".$responsable."%'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE responsable LIKE '%".$responsable."%'";
    }

    if ($nombres != '' && empty($comboestado) && empty($responsable)) {
        $check = 5;
        $sql = "SELECT * FROM equipos WHERE nombre LIKE '%".$nombres."%'";
        $_SESSION['sql_calculada'] = "SELECT * FROM equipos WHERE nombre LIKE '%".$nombres."%'";
    }