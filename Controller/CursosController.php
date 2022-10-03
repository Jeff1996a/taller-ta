<?php

include_once ('../Model/CursosModel.php');

$cursos = new CursosModel();

$action = '';
$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['action']) && isset($_GET['data']) ){

        $action = $_GET['action'];

        $data = json_decode($_GET['data']);

        if($action == 'listarCursos' ){

            $title = "Soportes";

            $list = $cursos->LeerCursos();

            $num_filas = mysqli_num_rows($list);

            include_once ("../View/ListaSoportes.php");
        }

        elseif($action == "update"){

            $id = $data->{'id'};

            $result = $cursos->ObtenerCurso($id);

            while ($row = mysqli_fetch_assoc($result)) {
                $cursos->id_curso = $row['idCurso'];
                $cursos->nombreCurso = $row['nombreCurso'];
                $cursos->descripcion = $row['descripcion'];
                $cursos->url = $row['enlace'];
            }

            include_once ('../View/ActualizarCurso.php');
        }

        //Formulario para crear una nueva transmision
        elseif($action == 'viewAddCurso'){

            include_once "../View/CrearSoporte.php";
        }
    }

}

////MÉTODOS POST//////
elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['action']) && isset($_POST['data'])){

        $action = $_POST['action'];
        $data = json_decode($_POST['data']);

        if($action == "eliminar"){

            $id = $data->{'id'};

            $cursos->EliminarCurso($id);
       }

    }

    elseif(isset($_POST)){

        if($_POST['action'] == 'addCurso'){

            $cursos->nombre = $_POST['nombreCurso'];
            $cursos->descripcion = $_POST['descripcion'];
            $cursos->url = $_POST['url'];
          
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
                $row = mysqli_fetch_assoc($curso->CrearCurso($curso));

                $cursos->result = $row["resultado"];
            }

            echo json_encode($cursos);

            die;
        }

        if($_POST['action'] == 'update' ){
            $cursos->id_curso = $_POST['id_curso'];
            $cursos->nombreCurso = $_POST['nombre'];
            $cursos->descripcion = $_POST['descripcion'];
            $cursos->url = $_POST['url'];

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

                $row = mysqli_fetch_assoc($cursos->ActualizarCurso($curso));
   
                $cursos->result = $row["resultado"];
            }

            echo json_encode($cursos);

            die;
        }
    }

}