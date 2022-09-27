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

    private $dbConn;

    function __construct(){
        $this-> dbConn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        mysqli_set_charset($this->dbConn, DB_CHARSET);
    }

    //Obtener la lista de actividades realizadas por los usuarios
    function LeerActividades(){
        mysqli_multi_query ($this->dbConn, "CALL uspLeerActividades") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    //Crear una actividad
    function CrearActividad($obj){
        mysqli_query($this->dbConn ,"SET @nick='".$obj->usuario."'");
        mysqli_query($this->dbConn ,"SET @correo='".$obj->email."'");
        mysqli_query($this->dbConn ,"SET @acti='".$obj->actividad."'");

        mysqli_multi_query ($this->dbConn, "CALL uspCrearActividad(@nick,@correo,@acti)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }



}
