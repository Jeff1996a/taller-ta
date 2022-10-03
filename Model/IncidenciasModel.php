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
        
        $this-> db =  new DbConnection();
    }

    //Obtener la lista de incidencias
    function GetIncidenciasList(){

        $dbConn =  $this->db->OpenConnection();

        mysqli_multi_query ($dbConn, "CALL uspLeerListaIncidencias") OR DIE (mysqli_error($dbConn));
        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);
                return $result;
            }
        }
    }

    //Crear una incidencia
    function CrearIncidencia($obj){

        $dbConn =  $this->db->OpenConnection();
        
        mysqli_query($dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($dbConn ,"SET @Rep='".$obj->quien_reporta."'");
        mysqli_query($dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($dbConn ,"SET @FechaRep='".$obj->fecha_sop."'");
        mysqli_query($dbConn ,"SET @FechaSol='".$obj->fecha_sol."'");
        mysqli_query($dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->observacion."'");

        mysqli_multi_query ($dbConn, "CALL uspCrearIncidencia(@Nom,@Rep,@Resp,@FechaRep,@FechaSol,@Prob,@Sol,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Obtener una incidencia
    function ObtenerIncidencia($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerIncidencia(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Actualizar incidencia
    function ActualizarIncidencia($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$obj->id_incidencia."'");
        mysqli_query($dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($dbConn ,"SET @Rep='".$obj->quien_reporta."'");
        mysqli_query($dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($dbConn ,"SET @FechaRep='".$obj->fecha_sop."'");
        mysqli_query($dbConn ,"SET @FechaSol='".$obj->fecha_sol."'");
        mysqli_query($dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->observacion."'");

        mysqli_multi_query ($dbConn, "CALL uspActualizarIncidencia(@id,@Nom,@Rep,@Resp,@FechaRep,@FechaSol,@Prob,@Sol,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Eliminar incidencia
    function EliminarIncidencia($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarIncidencia(@id)") 
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }


}