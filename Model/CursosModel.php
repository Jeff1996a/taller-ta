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
        $this->db = new DbConnection();
    }

    //Obtener la lista de cursos
    function LeerCursos(){
        
        $dbConn =  $this->db->OpenConnection();

        mysqli_multi_query ($dbConn, "CALL uspLeerCursos") OR DIE (mysqli_error($dbConn));
        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);
                return $result;
            }
        }
    }

    //Crear una incidencia
    function CrearCurso($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @Nom='".$obj->nombreCurso."'");
        mysqli_query($dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @Url='".$obj->url."'");
    
        mysqli_multi_query ($dbConn, "CALL uspCrearCurso(@Nom,@Descr,@Url)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Obtener una incidencia
    function ObtenerCurso($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerCurso(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Actualizar incidencia
    function ActualizarCurso($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$obj->id_curso."'");
        mysqli_query($dbConn ,"SET @Nom='".$obj->nombreCurso."'");
        mysqli_query($dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @Url='".$obj->url."'");

        mysqli_multi_query ($dbConn, "CALL uspActualizarCurso(@id,@Nom,@Descr,@Url)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Eliminar incidencia
    function EliminarCurso($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarCurso(@id)") 
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }


}