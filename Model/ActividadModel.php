<?php
include '../config.php';

class ActividadModel
{
    public $idControl;
    public $usuario;
    public $email;
    public $actividad;
    public $fecha;
    public $id_registro;
    public $result; 

    private $db;

    function __construct(){
        $this->db = new DbConnection();
    }

    //Obtener la lista de actividades realizadas por los usuarios
    function LeerActividades(){

        $this->db = new DbConnection();
        mysqli_multi_query ($dbConn, "CALL uspLeerActividades") OR DIE (mysqli_error($dbConn));
        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);
                return $result;
            }
        }
    }

    //Crear una actividad
    function CrearActividad($obj){

        $this->db = new DbConnection();
        mysqli_query($dbConn ,"SET @nick='".$obj->usuario."'");
        mysqli_query($dbConn ,"SET @correo='".$obj->email."'");
        mysqli_query($dbConn ,"SET @acti='".$obj->actividad."'");

        mysqli_multi_query ($dbConn, "CALL uspCrearActividad(@nick,@correo,@acti)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }



}
