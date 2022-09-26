<?php
include '../config.php';

class CursosModel
{
    public $id_curso;
    public $nombreCurso;
    public $descripcion;
    public $url;
    public $result;

    private $dbConn;

    function __construct(){
        $this-> dbConn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        mysqli_set_charset($this->dbConn, DB_CHARSET);
    }

    //Obtener la lista de cursos
    function LeerCursos(){
        mysqli_multi_query ($this->dbConn, "CALL uspLeerCursos") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    //Crear una incidencia
    function CrearCurso($obj){
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombreCurso."'");
        mysqli_query($this->dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @Url='".$obj->url."'");
    
        mysqli_multi_query ($this->dbConn, "CALL uspCrearCurso(@Nom,@Descr,@Url)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Obtener una incidencia
    function ObtenerCurso($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerCurso(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Actualizar incidencia
    function ActualizarCurso($obj){
        mysqli_query($this->dbConn ,"SET @id='".$obj->id_curso."'");
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombreCurso."'");
        mysqli_query($this->dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @Url='".$obj->url."'");

        mysqli_multi_query ($this->dbConn, "CALL uspActualizarCurso(@id,@Nom,@Descr,@Url)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Eliminar incidencia
    function EliminarCurso($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarCurso(@id)") 
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }


}