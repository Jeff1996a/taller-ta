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

    private $dbConn;
    private $transmision_list;

    function __construct(){
        $this-> transmision_list = array();
        $this-> dbConn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        mysqli_set_charset($this->dbConn, DB_CHARSET);
    }

    //función para crear la transmisión
    function CrearTransmision($obj){
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($this->dbConn ,"SET @Ubi='".$obj->ubicacion."'");
        mysqli_query($this->dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($this->dbConn ,"SET @Correo='".$obj->email."'");
        mysqli_query($this->dbConn ,"SET @Movil='".$obj->movil."'");
        mysqli_query($this->dbConn ,"SET @Inicio='".$obj->inicio."'");
        mysqli_query($this->dbConn ,"SET @Fin='".$obj->fin."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->obs."'");

        mysqli_multi_query ($this->dbConn, "CALL uspCrearTransmision(@Nom,@Ubi,@Tec,@Correo,@Movil,@Inicio,@Fin,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Actualizar una transmisión
    function ActualizarTransmision($obj){
        mysqli_query($this->dbConn ,"SET @id='".$obj->id_transmision."'");
        mysqli_query($this->dbConn ,"SET @Nom='".$obj->nombre."'");
        mysqli_query($this->dbConn ,"SET @Ubi='".$obj->ubicacion."'");
        mysqli_query($this->dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($this->dbConn ,"SET @Correo='".$obj->email."'");
        mysqli_query($this->dbConn ,"SET @Movil='".$obj->movil."'");
        mysqli_query($this->dbConn ,"SET @Inicio='".$obj->inicio."'");
        mysqli_query($this->dbConn ,"SET @Fin='".$obj->fin."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->obs."'");

        mysqli_multi_query($this->dbConn, "CALL uspActualizarTransmision(@id,@Nom,@Ubi,@Tec,@Correo,@Movil,@Inicio,@Fin,@Obs)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Listar todas las transmisiones
    function GetTransmisionList(){
        mysqli_multi_query ($this->dbConn, "CALL uspVistaListaTransmisiones") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Obtener equipos de transmision
    function ObtenerEquiposPorTransmision($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspLeerEquiposTransmision(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Obtener transmision
    function ObtenerTransmision($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerTransmision(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Elimina una transmision
    function EliminarTransmision($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarTransmision(@id)") 
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Agrega equipos a una transmisión
    function AgregarEquipos($obj){
        mysqli_query($this->dbConn ,"SET @Num_serie='".$obj->serie."'");
        mysqli_query($this->dbConn ,"SET @Num_serie_ta='".$obj->serie_ta."'");
        mysqli_query($this->dbConn ,"SET @Id_transmision='".$obj->id_transmision."'");
        mysqli_query($this->dbConn ,"SET @Descr='".$obj->descripcion."'");
    
        mysqli_multi_query ($this->dbConn, "CALL uspAgregarEquiposATransmision(@Num_serie,@Num_serie_ta,@Id_transmision,@Descr)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Obtener accesorios de una transmisión
    function ObtenerAccesorio($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerEquTrans(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Actualizar equipo asignado a la transmsión
    function ActualizarEquTrans($obj){
        mysqli_query($this->dbConn, "SET @id='".$obj->id_lista."'");
        mysqli_query($this->dbConn, "SET @NumSerieTa='".$obj->serie_ta."'");
        mysqli_query($this->dbConn, "SET @NumSerie='".$obj->serie."'");
        mysqli_query($this->dbConn, "SET @Descr='".$obj->descripcion."'");
        mysqli_multi_query($this->dbConn, "CALL uspActualizarEquTrans(@id,@NumSerieTa,@NumSerie,@Descr)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }

    //Elimina el equipo de una transmisión
    function EliminarEquipoTrans($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarEquipoTrans(@id)") 
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                mysqli_close($this->dbConn);

                return $result;
            }
        }
    }   
}