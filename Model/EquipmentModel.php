<?php
include_once ('../config.php');

class EquipmentModel 
{
    public $id_equipo;
    public $marca;
    public $modelo;
    public $descripcion;
    public $codigo_ta;
    public $num_serie;
    public $fecha_inst;
    public $proveedor;
    public $tecnico;
    public $responsable;
    public $departamento;
    public $id_estado;
    public $id_tipo_equi;
    public $disponibilidad;
    public $observacion;
    public $result;
    public $file_array;
    public $action;

    private $db;
    public $equipment_list;

    function __construct(){

        $this->equipment_list = array();

        $this->db = new DbConnection();
        
    }


    function CrearEquipo($obj){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @Marca='".$obj->marca."'");
        mysqli_query($dbConn ,"SET @Modelo='".$obj->modelo."'");
        mysqli_query($dbConn ,"SET @Descripcion='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @SerieTa='".$obj->codigo_ta."'");
        mysqli_query($dbConn ,"SET @Serie='".$obj->num_serie."'");
        mysqli_query($dbConn ,"SET @Fecha='".$obj->fecha_inst."'");
        mysqli_query($dbConn ,"SET @Proveedor='".$obj->proveedor."'");
        mysqli_query($dbConn ,"SET @Id_estado='".$obj->id_estado."'");
        mysqli_query($dbConn ,"SET @Id_tipo_equi='".$obj->id_tipo_equi."'");
        mysqli_query($dbConn ,"SET @Tecnico='".$obj->tecnico."'");
        mysqli_query($dbConn ,"SET @Responsable='".$obj->responsable."'");
        mysqli_query($dbConn ,"SET @Departamento='".$obj->departamento."'");
        mysqli_query($dbConn ,"SET @Disponibilidad='".$obj->disponibilidad."'");
        mysqli_query($dbConn ,"SET @Observacion='".$obj->observacion."'");


        mysqli_multi_query ($dbConn, "CALL uspCrearEquipo(@Marca, @Modelo, @Descripcion, @SerieTa, @Serie,
                            @Fecha,@Proveedor,@Id_estado,@Id_tipo_equi,@Tecnico, @Responsable, @Departamento, @Disponibilidad, @Observacion)")
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result= mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GuardarArchivo($path, $id){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn,"SET @Path='".$path."'" );
        mysqli_query($dbConn,"SET @Id_equipo='".$id."'" );
        mysqli_multi_query ($dbConn, "CALL uspInsertarAdjEquipo(@Path, @Id_equipo)")
        OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result= mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }

    }


    function GetEquipmentList(){

        $dbConn =  $this->db->OpenConnection();
        mysqli_multi_query ($dbConn, "CALL uspVistaListaEquipos") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);
         
                return $result;
            }

        }
    }

    function GetEquimentByType($category){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @type='".$category."'");

        mysqli_multi_query ($dbConn, "CALL uspGetEquipmentByType(@type)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($this->equipment_list = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $this->equipment_list;
            }
        }
    }

    function GetEquipmentByDesc($desc, $type){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @descripcion='".$desc."'");
        mysqli_query($dbConn, "SET @type='".$type."'");

        mysqli_multi_query($dbConn, "CALL uspFiltrarPorEquipo(@descripcion, @type)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GetEquipmentByMarca($marca, $type){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @marca='".$marca."'");
        mysqli_query($dbConn, "SET @type='".$type."'");

        mysqli_multi_query($dbConn, "CALL uspFiltrarPorMarca(@marca, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GetEquipmentBySerie($serie, $type){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @serie='".$serie."'");
        mysqli_query($dbConn, "SET @type='".$type."'");

        mysqli_multi_query($dbConn, "CALL uspFiltrarPorSerie(@serie, @type)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {
            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GetEquipmentByDep($dep, $type){
        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @departamento='".$dep."'");
        mysqli_query($dbConn, "SET @type='".$type."'");

        mysqli_multi_query($dbConn, "CALL uspFiltrarPorDepartamento(@departamento, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GetEquipmentByEst($state, $type){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @estado='".$state."'");
        mysqli_query($dbConn, "SET @type='".$type."'");

        mysqli_multi_query($dbConn, "CALL uspFiltrarPorEstado(@estado, @type)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    function GetEquipmentHistory($id){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @id='".$id."'");

        mysqli_multi_query($dbConn, "CALL uspEquipmentHistory(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {
                
                mysqli_close($dbConn);

                return $result;

            }
        }
    }

    function GetEquipmentAccesories($id){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn, "SET @id='".$id."'");

        mysqli_multi_query($dbConn, "CALL uspGetAccesoriesList(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Crear un nuevo registro para el historial de mantenimiento de cada equipo
    function AddHistoryRecord($obj){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @id='".$obj->id_equipo."'");
        mysqli_query($dbConn ,"SET @ult_mant='".$obj->ultMant."'");
        mysqli_query($dbConn ,"SET @ingreso='".$obj->ingreso."'");
        mysqli_query($dbConn ,"SET @prob='".$obj->problema."'");
        mysqli_query($dbConn ,"SET @sol='".$obj->solucion."'");
        mysqli_query($dbConn ,"SET @obs='".$obj->observacion."'");
        mysqli_query($dbConn ,"SET @rep='".$obj->repuesto."'");
        mysqli_query($dbConn ,"SET @disp='".$obj->disponibilidad."'");
        mysqli_query($dbConn ,"SET @tec='".$obj->tecnico."'");
    
        mysqli_query($dbConn ,"SET @correo='".$obj->correo."'");


        mysqli_multi_query ($dbConn, "CALL uspCreateHistoryRecord(@id,@ult_mant,@ingreso,@prob,@sol,@obs,@rep,@disp,@tec,@correo)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
    }

    //Crear un nuevo registro para el historial de mantenimiento de cada equipo
    function AddAccesorio($obj){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @Descripcion='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @Disponibilidad='".$obj->disponibilidad."'");
        mysqli_query($dbConn ,"SET @Num_serie='".$obj->serie."'");
        mysqli_query($dbConn ,"SET @Num_serie_ta='".$obj->serie_ta."'");
        mysqli_query($dbConn ,"SET @IdEqu='".$obj->id_equipo."'");

        mysqli_multi_query ($dbConn, "CALL uspAgregarAccesorios(@Descripcion,@Disponibilidad,@Num_serie,@Num_serie_ta,@IdEqu)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function ObtenerEquipo($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerEquipo(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }

        mysqli_close($dbConn);
    }

    function ActualizarEquipo($obj){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @Id='".$obj->id_equipo."'");
        mysqli_query($dbConn ,"SET @Marca='".$obj->marca."'");
        mysqli_query($dbConn ,"SET @Modelo='".$obj->modelo."'");
        mysqli_query($dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @NumSerieTa='".$obj->codigo_ta."'");
        mysqli_query($dbConn ,"SET @NumSerie='".$obj->num_serie."'");
        mysqli_query($dbConn ,"SET @FechaInstalacion='".$obj->fecha_inst."'");
        mysqli_query($dbConn ,"SET @Prov='".$obj->proveedor."'");
        mysqli_query($dbConn ,"SET @IdEstado='".$obj->id_estado."'");
        mysqli_query($dbConn ,"SET @IdTipoEqui='".$obj->id_tipo_equi."'");
        mysqli_query($dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($dbConn ,"SET @Dep='".$obj->departamento."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->observacion."'");


        mysqli_multi_query ($dbConn, "CALL uspActualizarEquipo(@Id, @Marca, @Modelo, @Descr, @NumSerieTa, @NumSerie,
                            @Obs, @FechaInstalacion,@Prov,@IdEstado,@IdTipoEqui, @Tec, @Resp, @Dep)")
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result= mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function EliminarEquipo($id){

        $dbConn =  $this->db->OpenConnection();

        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarEquipo(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }

        mysqli_close($dbConn);
    }

    //Obtener historial
    function ObtenerHistorial($id){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @Id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerHistorial(@Id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function ActualizarHistorial($obj){
        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @Id='".$obj->id_historial."'");
        mysqli_query($dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($dbConn ,"SET @Correo='".$obj->correo."'");
        mysqli_query($dbConn ,"SET @Ingreso='".$obj->ingreso."'");
        mysqli_query($dbConn ,"SET @Mant='".$obj->ultMant."'");
        mysqli_query($dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($dbConn ,"SET @Obs='".$obj->observacion."'");
        mysqli_query($dbConn ,"SET @Disp='".$obj->disponibilidad."'");
        mysqli_query($dbConn ,"SET @Rep='".$obj->repuesto."'");


        mysqli_multi_query ($dbConn, "CALL uspActualizarHistorial(@Id, @Tec, @Correo, @Ingreso, @Mant,
                            @Prob, @Sol, @Obs, @Disp, @Rep)")
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result= mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function EliminarHistorial($id){

        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarHistorial(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function ObtenerAccesorio($id){
        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspObtenerAccesorio(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function ActualizarAccesorio($obj){
        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @Id='".$obj->id_accesorio."'");
        mysqli_query($dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($dbConn ,"SET @Disp='".$obj->disponibilidad."'");
        mysqli_query($dbConn ,"SET @IdEquipo='".$obj->id_equipo."'");
        mysqli_query($dbConn ,"SET @NumSerie='".$obj->serie."'");
        mysqli_query($dbConn ,"SET @NumSerieTa='".$obj->serie_ta."'");

        mysqli_multi_query ($dbConn, "CALL uspActualizarAccesorio(@Id, @Descr, @Disp, @IdEquipo, @NumSerie,
                            @NumSerieTa)")
            OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result= mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }

    function EliminarAccesorio($id){
        $dbConn =  $this->db->OpenConnection();
        mysqli_query($dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($dbConn, "CALL uspEliminarAccesorio(@id)") OR DIE (mysqli_error($dbConn));

        while (mysqli_more_results($dbConn)) {

            if ($result = mysqli_store_result($dbConn)) {

                mysqli_close($dbConn);

                return $result;
            }
        }
        mysqli_close($dbConn);
    }
   
}
