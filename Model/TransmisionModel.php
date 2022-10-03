<?php
include '../config.php';

class TransmisionModel
{

    public $id_transmision;
    public $nombre;
    public $ubicacion;
    public $tecnico;
    public $email;
    public $movil;
    public $inicio;
    public $fin;
    public $obs;
    public $result;

    private $db;
    private $transmision_list;

    function __construct(){

        $this-> transmision_list = array();
        
        $this-> db =  new DbConnection();

    }

    //función para crear la transmisión
    function CrearTransmision($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($dbConn ,"SET @Ubi='".$obj->ubicacion."'");
        mysqli_query($dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($dbConn ,"SET @Correo='".$obj->email."'");
        mysqli_query($dbConn ,"SET @Movil='".$obj->movil."'");
        mysqli_query($dbConn ,"SET @Inicio='".$obj->inicio."'");
        mysqli_query($dbConn ,"SET @Fin='".$obj->fin."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->obs."'");

        mysqli_multi_query ($dbConn, "CALL uspCrearTransmision(@Nom,@Ubi,@Tec,@Correo,@Movil,@Inicio,@Fin,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Actualizar una transmisión
    function ActualizarTransmision($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$obj->id_transmision."'");
        mysqli_query($dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($dbConn ,"SET @Ubi='".$obj->ubicacion."'");
        mysqli_query($dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($dbConn ,"SET @Correo='".$obj->email."'");
        mysqli_query($dbConn ,"SET @Movil='".$obj->movil."'");
        mysqli_query($dbConn ,"SET @Inicio='".$obj->inicio."'");
        mysqli_query($dbConn ,"SET @Fin='".$obj->fin."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->obs."'");

        mysqli_multi_query($dbConn, "CALL uspActualizarTransmision(@id,@Nom,@Ubi,@Tec,@Correo,@Movil,@Inicio,@Fin,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Listar todas las transmisiones
    function GetTransmisionList(){

        $dbConn =  $this->db->OpenConnection();

        mysqli_multi_query ($dbConn, "CALL uspVistaListaTransmisiones") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Obtener equipos de transmision
    function ObtenerEquiposPorTransmision($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspLeerEquiposTransmision(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Obtener transmision
    function ObtenerTransmision($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerTransmision(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Elimina una transmision
    function EliminarTransmision($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarTransmision(@id)") 
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Agrega equipos a una transmisión
    function AgregarEquipos($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @Num_serie='".$obj->serie."'");
        mysqli_query($dbConn ,"SET @Num_serie_ta='".$obj->serie_ta."'");
        mysqli_query($dbConn ,"SET @Id_transmision='".$obj->id_transmision."'");
        mysqli_query($dbConn ,"SET @Descr='".$obj->descripcion."'");
    
        mysqli_multi_query ($dbConn, "CALL uspAgregarEquiposATransmision(@Num_serie,@Num_serie_ta,@Id_transmision,@Descr)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Obtener accesorios de una transmisión
    function ObtenerAccesorio($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerEquTrans(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Actualizar equipo asignado a la transmsión
    function ActualizarEquTrans($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn, "SET @id='".$obj->id_lista."'");
        mysqli_query($dbConn, "SET @NumSerieTa='".$obj->serie_ta."'");
        mysqli_query($dbConn, "SET @NumSerie='".$obj->serie."'");
        mysqli_query($dbConn, "SET @Descr='".$obj->descripcion."'");
        mysqli_multi_query($dbConn, "CALL uspActualizarEquTrans(@id,@NumSerieTa,@NumSerie,@Descr)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Elimina el equipo de una transmisión
    function EliminarEquipoTrans($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarEquipoTrans(@id)") 
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }   
}