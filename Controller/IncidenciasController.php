<?php
include_once ('../Model/IncidenciasModel.php');

$incidencias = new IncidenciasModel();

$action = '';

$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['action']) && isset($_GET['data']) ){

        $action = $_GET['action'];

        $data = json_decode($_GET['data']);

        if($action == 'listarIncidencias' ){


            $title = "Incidencias";

            $list = $incidencias->GetIncidenciasList();

            $num_filas = mysqli_num_rows($list);

            include_once ("../View/ListaIncidencias.php");
        }

        elseif($action == 'viewAddIncidencias'){

            include_once "../View/AddIncidencia.php";

        }

        elseif($action == "update"){

            $id = $data->{'id'};

            $result = $incidencias->ObtenerIncidencia($id);

            while ($row = mysqli_fetch_assoc($result)) {
                $incidencias->id_incidencia = $row['id_inc'];
                $incidencias->nombre = $row['nombre'];
                $incidencias->quien_reporta = $row['reporta'];
                $incidencias->responsable = $row['responsable'];
                $incidencias->fecha_sop = $row['fecha_reporte'];
                $incidencias->fecha_sol = $row['fecha_sol'];
                $incidencias->problema = $row['prob'];
                $incidencias->solucion = $row['sol'];
                $incidencias->observacion = $row['obs'];
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

            $id = $data->{'id'};

            $incidencias->EliminarIncidencia($id);
       }

    
    }

    elseif(isset($_POST)){

        if($_POST['action'] == 'addIncidencia'){
            $incidencias->nombre = $_POST['nombre'];
            $incidencias->responsable = $_POST['responsable'];
            $incidencias->quien_reporta = $_POST['reporta'];
            $incidencias->fecha_sop = $_POST['fecha_reporte'];
            $incidencias->fecha_sol = $_POST['fecha_solucion'];
            $incidencias->problema = $_POST['problema'];
            $incidencias->solucion = $_POST['solucion'];
            $incidencias->observacion = $_POST['observacion'];
          
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
                $row = mysqli_fetch_assoc($incidencias->CrearIncidencia($incidencia));

                $incidencias->result = $row["resultado"];
            }

            echo json_encode($incidencias);

            die;
        }

        if($_POST['action'] == 'actualizarIncidencia' ){

            $incidencias->id_incidencia = $_POST['id_incidencia'];
            $incidencias->nombre = $_POST['nombre'];
            $incidencias->responsable = $_POST['responsable'];
            $incidencias->quien_reporta = $_POST['reporta'];
            $incidencias->fecha_sop = $_POST['fecha_reporte'];
            $incidencias->fecha_sol = $_POST['fecha_solucion'];
            $incidencias->problema = $_POST['problema'];
            $incidencias->solucion = $_POST['solucion'];
            $incidencias->observacion = $_POST['observacion'];

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

                $row = mysqli_fetch_assoc($incidencias->ActualizarIncidencia($incidencias));
   
                $incidencias->result = $row["resultado"];
            }

            echo json_encode($incidencias);

            die;
        }
    }
}
