<?php
$action = '';

$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['action']) && isset($_GET['data']) ){

        $action = $_GET['action'];

        $data = json_decode($_GET['data']);

        if($action == 'listarIncidencias' ){

            include_once ('../Model/IncidenciasModel.php');

            $incidencias = new IncidenciasModel();

            $title = "Incidencias";

            $list = $incidencias->GetIncidenciasList();

            $num_filas = mysqli_num_rows($list);

            include_once ("../View/ListaIncidencias.php");
        }

        elseif($action == 'viewAddIncidencias'){

            include_once "../View/AddIncidencia.php";

        }

        elseif($action == "update"){

            include_once('../Model/IncidenciasModel.php');

            $incidencia =  new IncidenciasModel();

            $id = $data->{'id'};

            $result = $incidencia->ObtenerIncidencia($id);

            while ($row = mysqli_fetch_assoc($result)) {
                $incidencia->id_incidencia = $row['id_inc'];
                $incidencia->nombre = $row['nombre'];
                $incidencia->quien_reporta = $row['reporta'];
                $incidencia->responsable = $row['responsable'];
                $incidencia->fecha_sop = $row['fecha_reporte'];
                $incidencia->fecha_sol = $row['fecha_sol'];
                $incidencia->problema = $row['prob'];
                $incidencia->solucion = $row['sol'];
                $incidencia->observacion = $row['obs'];
            }

            include_once ('../View/ActualizarIncidencia.php');
        }

    }
}


//////MÉTODOS POST//////
elseif($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action']) && isset($_POST['data'])){

        $action = $_POST['action'];
        $data = json_decode($_POST['data']);

        if($action == "eliminar"){

            include_once("../Model/IncidenciasModel.php");

            $incidencia =  new IncidenciasModel();

            $id = $data->{'id'};

            $incidencia->EliminarIncidencia($id);
       }

    
    }

    elseif(isset($_POST)){

        include_once ('../Model/IncidenciasModel.php');

        $incidencia = new IncidenciasModel();

        if($_POST['action'] == 'addIncidencia'){
            $incidencia->nombre = $_POST['nombre'];
            $incidencia->responsable = $_POST['responsable'];
            $incidencia->quien_reporta = $_POST['reporta'];
            $incidencia->fecha_sop = $_POST['fecha_reporte'];
            $incidencia->fecha_sol = $_POST['fecha_solucion'];
            $incidencia->problema = $_POST['problema'];
            $incidencia->solucion = $_POST['solucion'];
            $incidencia->observacion = $_POST['observacion'];
          
            if(isset($_FILES['files'])){
                // Count total files
                $countfiles = count($_FILES['files']['name']);

                // Upload Location
                $upload_location = "../Files/";

                // To store uploaded files path
                $equipment->file_array = array();

                $row = mysqli_fetch_assoc($equipment->CrearEquipo($equipment));
                $equipment->result = $row["resultado"];

                // Loop all files
                for($index = 0;$index < $countfiles;$index++){

                    if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
                        // File name
                        $filename = $_FILES['files']['name'][$index];

                        // Get extension
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                        // Valid image extension
                        $valid_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');

                        // Check extension
                        if(in_array($ext, $valid_ext)){

                            // File path
                            $path = $upload_location.$filename;

                            // Upload file
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
                                $equipment->file_array[] = $path;

                            }
                        }
                    }
                }
                echo json_encode($equipment);
                die;
            }

            else{
                $row = mysqli_fetch_assoc($incidencia->CrearIncidencia($incidencia));

                $incidencia->result = $row["resultado"];
            }

            echo json_encode($incidencia);

            die;
        }

        if($_POST['action'] == 'actualizarIncidencia' ){

            $incidencia->id_incidencia = $_POST['id_incidencia'];
            $incidencia->nombre = $_POST['nombre'];
            $incidencia->responsable = $_POST['responsable'];
            $incidencia->quien_reporta = $_POST['reporta'];
            $incidencia->fecha_sop = $_POST['fecha_reporte'];
            $incidencia->fecha_sol = $_POST['fecha_solucion'];
            $incidencia->problema = $_POST['problema'];
            $incidencia->solucion = $_POST['solucion'];
            $incidencia->observacion = $_POST['observacion'];

            if(isset($_FILES['files'])){
                // Count total files
                $countfiles = count($_FILES['files']['name']);

                // Upload Location
                $upload_location = "../Files/";

                // To store uploaded files path
                $equipment->file_array = array();

                $row = mysqli_fetch_assoc($equipment->CrearEquipo($equipment));
                $equipment->result = $row["resultado"];

                // Loop all files
                for($index = 0;$index < $countfiles;$index++){

                    if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
                        // File name
                        $filename = $_FILES['files']['name'][$index];

                        // Get extension
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                        // Valid image extension
                        $valid_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');

                        // Check extension
                        if(in_array($ext, $valid_ext)){

                            // File path
                            $path = $upload_location.$filename;

                            // Upload file
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
                                $equipment->file_array[] = $path;

                            }
                        }
                    }
                }
                echo json_encode($equipment);
                die;
            }

            else{

                $row = mysqli_fetch_assoc($incidencia->ActualizarIncidencia($incidencia));
   
                $incidencia->result = $row["resultado"];
            }

            echo json_encode($incidencia);

            die;
        }
    }
}
