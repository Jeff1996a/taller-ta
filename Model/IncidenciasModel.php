<?php
include '../config.php';

class IncidenciasModel
{

    public $id_incidencia;
    public $nombre;
    public $quien_reporta;
    public $responsable;
    public $fecha_sop;
    public $fecha_sol;
    public $problema;
    public $solucion;
    public $observacion;
    public $result;

    private $dbConn;
    private $incidencias_list;

    function __construct(){
        $this-> incidencias_list = array();
        $this-> dbConn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        mysqli_set_charset($this->dbConn, DB_CHARSET);
    }

    //Obtener la lista de incidencias
    function GetIncidenciasList(){
        mysqli_multi_query ($this->dbConn, "CALL uspLeerListaIncidencias") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    //Crear una incidencia
    function CrearIncidencia($obj){
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($this->dbConn ,"SET @Rep='".$obj->quien_reporta."'");
        mysqli_query($this->dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($this->dbConn ,"SET @FechaRep='".$obj->fecha_sop."'");
        mysqli_query($this->dbConn ,"SET @FechaSol='".$obj->fecha_sol."'");
        mysqli_query($this->dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($this->dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->observacion."'");

        mysqli_multi_query ($this->dbConn, "CALL uspCrearIncidencia(@Nom,@Rep,@Resp,@FechaRep,@FechaSol,@Prob,@Sol,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Obtener una incidencia
    function ObtenerIncidencia($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerIncidencia(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Actualizar incidencia
    function ActualizarIncidencia($obj){
        mysqli_query($this->dbConn ,"SET @id='".$obj->id_incidencia."'");
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($this->dbConn ,"SET @Rep='".$obj->quien_reporta."'");
        mysqli_query($this->dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($this->dbConn ,"SET @FechaRep='".$obj->fecha_sop."'");
        mysqli_query($this->dbConn ,"SET @FechaSol='".$obj->fecha_sol."'");
        mysqli_query($this->dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($this->dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->observacion."'");

        mysqli_multi_query ($this->dbConn, "CALL uspActualizarIncidencia(@id,@Nom,@Rep,@Resp,@FechaRep,@FechaSol,@Prob,@Sol,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Eliminar incidencia
    function EliminarIncidencia($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarIncidencia(@id)") 
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }


}