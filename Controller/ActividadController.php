<?php

$action = '';
$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['action']) && isset($_GET['data']) ){

        $action = $_GET['action'];

        $data = json_decode($_GET['data']);

        if($action == 'listarActividades' ){

            include_once ('../Model/ActividadModel.php');

            $actividad = new ActividadModel();

            $title = "Actividades registradas";

            $list = $actividad->LeerActividades();

            $num_filas = mysqli_num_rows($list);

            include_once ("../View/ListaActividades.php");
        }

        
    }

}

////MÉTODOS POST//////
elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['action']) && isset($_POST['data'])){

        $action = $_POST['action'];
        $data = json_decode($_POST['data']);

        include_once ('../Model/ActividadModel.php');

        $actividad = new ActividadModel();

        if($_POST['action'] == 'addActividad'){

            $actividad->usuario = $_POST['usuario'];
            $actividad->email = $_POST['email'];
            $actividad->actividad = $_POST['actividad'];
          
            $row = mysqli_fetch_assoc($actividad->Actividad($actividad));

            $actividad->result = $row["resultado"];

            echo json_encode($actividad);

            die;
        }
    }

}