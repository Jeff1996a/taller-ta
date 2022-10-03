<?php

use mysql_xdevapi\Result;

include_once('../Model/EquipmentModel.php');

$equipment =  new EquipmentModel();

$action = '';

$data = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['action']) && isset($_GET['data'])){

        

        $action = $_GET['action'];
        $data = json_decode($_GET['data']);

        if($action == 'listarEquipos'){

            $category = $data->{'category'};

            switch($category){
                case 'audio':
                    $title = 'Equipos de audio';
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case 'cables':
                    $title = 'Cables';
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case 'edición':
                    $title = "Equipos de edición";
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case 'video':
                    $title = "Equipos de video";
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case 'red':
                    $title = "Equipos de red";
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case 'electricidad':
                    $title = "Equipos eléctricos";
                    $list = $equipment->GetEquimentByType($category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                default:
                    $title = "No se pudo cargar la lista";
                    break;
            }

            include_once ("../View/ListaEquipos.php");

        }

        elseif ($action == 'viewAddEquipment'){

            $category = $data->{'category'};

            include_once('../View/AddEquipment.php');
        }

        elseif ($action == 'viewHistory'){


            $category = $data->{'category'};

            $id = $data->{'id'};

            $title = "Historial de Mantenimiento";

            $equipmentList = $equipment->GetEquipmentHistory($id);

            $num_filas = mysqli_num_rows($equipmentList);

            include_once ('../View/Historial_mantenimiento.php');

            
        }

        elseif($action == 'viewAddHistory'){

            $id = $data->{'id'};

            $category = $data->{'category'};

            include_once ('../View/AddHistoryRecord.php');
        }

        elseif($action == "viewAccesories"){

            $id = $data->{'id'};

            $category = $data->{'category'};

            $title = "Accesorios del equipo";

            $accesories= $equipment->GetEquipmentAccesories($id);

            $num_filas = mysqli_num_rows($accesories);

            include_once "../View/AccesoriosEquipo.php";

        }

        elseif($action == "update"){

            $id = $data->{'id'};

            $category = $data->{'category'};

            $result = $equipment->ObtenerEquipo($id);

            while ($row = mysqli_fetch_assoc($result)) {
                $equipment->id_equipo = $row['id_equipo'];
                $equipment->marca = $row['marca'];
                $equipment->modelo = $row['modelo'];
                $equipment->descripcion = $row['descripcion'];
                $equipment->codigo_ta = $row['num_serie_ta'];
                $equipment->num_serie = $row['num_serie'];
                $equipment->fecha_inst = $row['fecha_instalacion'];
                $equipment->proveedor = $row['proveedor'];
                $equipment->tecnico = $row['tecnico'];
                $equipment->responsable = $row['responsable'];
                $equipment->departamento = $row['departamento'];
                $equipment->id_estado = $row['estado'];
                $equipment->id_tipo_equi = $row['tipo'];
                $equipment->observacion = $row['observacion'];
            }

            include_once ('../View/ActualizarEquipo.php');

        }

        elseif($action == "updateHistory"){

            include_once ('../Model/Historial.php');         

            $id = $data->{'id'};

            $category = $data->{'category'};

            $result = $equipment->ObtenerHistorial($id);

            $historial = new Historial();

            while ($row = mysqli_fetch_assoc($result)) {
                $historial->id_equipo = $row['id_equipo'];
                $historial->id_historial = $row['id_hist_mant'];
                $historial->ultMant = $row['fecha_ult_mant'];
                $historial->ingreso = $row['fecha_ingreso'];
                $historial->problema = $row['problema'];
                $historial->solucion = $row['solucion'];
                $historial->observacion = $row['observacion'];
                $historial->repuesto = $row['solic_rep'];
                $historial->disponibilidad = $row['disponibilidad'];
                $historial->tecnico = $row['tecnico'];
                $historial->correo = $row['email'];
            }

            include_once ('../View/ActualizarHistorial.php');

        }
        elseif($action == "updateAccesorio"){

            include_once ('../Model/Accesorio.php');


            $id = $data->{'id'};

            $category = $data->{'category'};

            $result = $equipment->ObtenerAccesorio($id);

            $accesorio = new Accesorio();

            while ($row = mysqli_fetch_assoc($result)) {
                $accesorio->id_accesorio = $row['id_accesorio'];
                $accesorio->descripcion = $row['desc_accesorio'];
                $accesorio->disponibilidad = $row['disponibilidad'];
                $accesorio->id_equipo = $row['id_equipo'];
                $accesorio->serie = $row['serie'];
                $accesorio->serie_ta = $row['serieTa'];  
            }

            include_once ('../View/ActualizarAccesorio.php');

        }

        elseif($action == 'viewAddAccesories'){

            $id = $data->{'id'};

            $category = $data->{'category'};

            include_once ('../View/AddAccesoriesEquipment.php');
        }
    }

}

////MÉTODOS POST/////////
elseif($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['action']) && isset($_POST['data'])){


        $action = $_POST['action'];
        $data = json_decode($_POST['data']);


       if($action == "filter"){

            $category = $data->{'category'};

            $filter = $data->{'filter'};

            $filterType = $data->{'filterType'};

            switch($category){

                case "accesorio":
                    $title = "Accesorios";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "audio":
                    $title = "Equipos de audio";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "cables":
                    $title = "Cables";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "edición":
                    $title = "Equipos de edición";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "video":
                    $title = "Equipos de video";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "red":
                    $title = "Equipos de red";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;

                case "electricidad":
                    $title = "Equipos eléctricos";
                    $list = validateFilter($filterType, $equipment, $filter, $category);
                    $num_filas = mysqli_num_rows($list);
                    break;


                default:
                    $title = "No se pudo cargar la lista";
                    break;
            }
            include_once ("../View/ListaEquipos.php");


       }

       if($action == "eliminar"){

            $id = $data->{'id'};

            $category = $data->{'category'};

            $equipment->EliminarEquipo($id);


       }

       elseif($action == "eliminarAccesorio"){

            $id = $data->{'idAccesorio'};

            $category = $data->{'category'};

            $equipment->EliminarAccesorio($id);   

            mysqli_close($equipment->dbConn);
        }

        elseif($action == "eliminarHistorial"){


            $id = $data->{'id'};

            $category = $data->{'category'};

            $equipment->EliminarHistorial($id); 
            
        }

    }
    elseif(isset($_POST)){

        include_once ('../Model/EquipmentModel.php');

        $equipment = new EquipmentModel();

        if($_POST['action'] == 'addEquipo' ){
            $equipment->marca = $_POST['marca'];
            $equipment->modelo = $_POST['modelo'];
            $equipment->descripcion = $_POST['descripcion'];
            $equipment->codigo_ta = $_POST['codigoTA'];
            $equipment->num_serie = $_POST['serie'];
            $equipment->fecha_inst = $_POST['fechaInst'];
            $equipment->proveedor = $_POST['proveedor'];
            $equipment->id_estado = $_POST['estado'];
            $equipment->id_tipo_equi = $_POST['tipoEquipo'];
            $equipment->tecnico = $_POST['tecnico'];
            $equipment->responsable = $_POST['responsable'];
            $equipment->departamento = $_POST['departamento'];
            $equipment->disponibilidad = $_POST['disponibilidad'];
            $equipment->observacion = $_POST['observacion'];

            //Verifica la existencia de archivos en el formulario
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
                $row = mysqli_fetch_assoc($equipment->CrearEquipo($equipment));

                $equipment->result = $row["resultado"];
            }


            echo json_encode($equipment);

            die;
        }

        //Actualiza el registro de un equipo
        else if($_POST['action'] == 'actualizarEquipo' ){
            $equipment->id_equipo = $_POST['id_equipo'];
            $equipment->marca = $_POST['marca'];
            $equipment->modelo = $_POST['modelo'];
            $equipment->descripcion = $_POST['descripcion'];
            $equipment->codigo_ta = $_POST['codigoTA'];
            $equipment->num_serie = $_POST['serie'];
            $equipment->fecha_inst = $_POST['fechaInst'];
            $equipment->proveedor = $_POST['proveedor'];
            $equipment->id_estado = $_POST['estado'];
            $equipment->id_tipo_equi = $_POST['tipoEquipo'];
            $equipment->tecnico = $_POST['tecnico'];
            $equipment->responsable = $_POST['responsable'];
            $equipment->departamento = $_POST['departamento'];
            $equipment->disponibilidad = $_POST['disponibilidad'];
            $equipment->observacion = $_POST['observacion'];


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

                $row = mysqli_fetch_assoc($equipment->ActualizarEquipo($equipment));
   
                $equipment->result = $row["resultado"];
            }


            echo json_encode($equipment);

            die;
        }


        elseif($_POST['action'] == 'addHistory'){

            include_once ('../Model/Historial.php');

            //Crear el objeto historial 
            $history = new Historial();

            $history->tecnico = $_POST['tecnico'];
            $history->correo = $_POST['correo'];
            $history->ingreso = $_POST['ingreso'];
            $history->ultMant = $_POST['ultMant'];
            $history->problema = $_POST['problema'];
            $history->solucion = $_POST['solucion'];
            $history->observacion = $_POST['observacion'];
            $history->disponibilidad = $_POST['disponibilidad'];
            $history->repuesto = $_POST['repuesto'];
            $history->id_equipo = $_POST['id_equipo'];
  

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
                $row = mysqli_fetch_assoc($equipment->AddHistoryRecord($history));

                $history->result = $row["resultado"];
            }

            echo json_encode($history);

            die;
        }

        elseif($_POST['action'] == 'actualizarHistorial' ){
            
            include_once('../Model/Historial.php');
            $historial = new Historial();
        
            $historial->id_equipo = $_POST['id_equipo'];
            $historial->id_historial = $_POST['id_hist_mant'];
            $historial->ultMant = $_POST['ultMant'];
            $historial->ingreso = $_POST['ingreso'];
            $historial->problema = $_POST['problema'];
            $historial->solucion = $_POST['solucion'];
            $historial->observacion = $_POST['observacion'];
            $historial->repuesto = $_POST['repuesto'];
            $historial->disponibilidad = $_POST['disponibilidad'];
            $historial->tecnico = $_POST['tecnico'];
            $historial->correo = $_POST['correo'];

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

                $row = mysqli_fetch_assoc($equipment->ActualizarHistorial($historial));
   
                $equipment->result = $row["resultado"];
            }

            echo json_encode($equipment);

            die;
        }

        elseif($_POST['action'] == 'actualizarAccesorio' ){
            
            include_once('../Model/Accesorio.php');
            $accesorio = new Accesorio();
        
            $accesorio->id_accesorio = $_POST['id_accesorio'];
            $accesorio->descripcion = $_POST['descripcion'];
            $accesorio->disponibilidad = $_POST['disponibilidad'];
            $accesorio->id_equipo = $_POST['id_equipo'];
            $accesorio->serie = $_POST['serie'];
            $accesorio->serie_ta = $_POST['serieTa'];

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

                $row = mysqli_fetch_assoc($equipment->ActualizarAccesorio($accesorio));
   
                $equipment->result = $row["resultado"];
            }

            echo json_encode($equipment);

            die;
        }


        elseif($_POST['action'] == 'addAccesorio'){

            include_once ('../Model/Accesorio.php');
            include_once ('../Model/EquipmentModel.php');

            //Crear el objeto historial 
            $accesorio = new Accesorio();
            $equipment = new EquipmentModel();

            $accesorio->id_equipo = $_POST['id_equipo'];
            $accesorio->serie = $_POST['serie'];
            $accesorio->serie_ta = $_POST['codigoTA'];
            $accesorio->descripcion = $_POST['descripcion'];
            $accesorio->disponibilidad = $_POST['disponibilidad'];
            
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
                $row = mysqli_fetch_assoc($equipment->AddAccesorio($accesorio));

                $accesorio->result = $row["resultado"];
            }


            echo json_encode($accesorio);

            die;
        }

        
    }

}

//Funcion para validar los datos ingresados al filtro
function validateFilter($filterType, $resultado, $filter, $category){

    if($filterType == 'descripcion'){
        $busqueda = $resultado->GetEquipmentByDesc($filter, $category);
    }

    if($filterType == 'marca'){
        $busqueda = $resultado->GetEquipmentByMarca($filter, $category);
    }

    if($filterType == 'serie'){
        $busqueda = $resultado->GetEquipmentBySerie($filter, $category);
    }

    if($filterType == 'departamento'){
        $busqueda = $resultado->GetEquipmentByDep($filter, $category);
    }

    if($filterType == 'estado'){
        $busqueda = $resultado->GetEquipmentByEst($filter, $category);
    }

    if($filterType == 'empty'){
        $busqueda = $resultado->GetEquimentByType($category);
    }

    return $busqueda;
}