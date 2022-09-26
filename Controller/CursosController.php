<?php

$action = '';
$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['action']) && isset($_GET['data']) ){

        $action = $_GET['action'];

        $data = json_decode($_GET['data']);

        if($action == 'listarCursos' ){

            include_once ('../Model/CursosModel.php');

            $cursos = new CursosModel();

            $title = "Soportes";

            $list = $cursos->LeerCursos();

            $num_filas = mysqli_num_rows($list);

            include_once ("../View/ListaSoportes.php");
        }

        elseif($action == "update"){

            include_once('../Model/CursosModel.php');

            $curso =  new CursosModel();

            $id = $data->{'id'};

            $result = $curso->ObtenerCurso($id);

            while ($row = mysqli_fetch_assoc($result)) {
                $curso->id_curso = $row['idCurso'];
                $curso->nombreCurso = $row['nombreCurso'];
                $curso->descripcion = $row['descripcion'];
                $curso->url = $row['enlace'];
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

            include_once('../Model/CursosModel.php');

            $curso =  new CursosModel();

            $id = $data->{'id'};

            $curso->EliminarCurso($id);
       }

    }

    elseif(isset($_POST)){
        include_once ('../Model/CursosModel.php');

        $curso = new CursosModel();

        if($_POST['action'] == 'addCurso'){

            $curso->nombre = $_POST['nombreCurso'];
            $curso->descripcion = $_POST['descripcion'];
            $curso->url = $_POST['url'];
          
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

                $curso->result = $row["resultado"];
            }

            echo json_encode($curso);

            die;
        }

        if($_POST['action'] == 'update' ){
            $curso->id_curso = $_POST['id_curso'];
            $curso->nombreCurso = $_POST['nombre'];
            $curso->descripcion = $_POST['descripcion'];
            $curso->url = $_POST['url'];

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

                $row = mysqli_fetch_assoc($curso->ActualizarCurso($curso));
   
                $curso->result = $row["resultado"];
            }

            echo json_encode($curso);

            die;
        }
    }

}