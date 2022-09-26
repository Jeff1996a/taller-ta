<?php
include '../config.php';

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
    public $responsable;
    public $departamento;
    public $id_estado;
    public $id_tipo_equi;
    public $disponibilidad;
    public $observacion;
    public $result;
    public $file_array;
    public $action;

    private $dbConn;
    private $equipment_list;

    function __construct(){
        $this-> equipment_list = array();
        $this-> dbConn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        mysqli_set_charset($this->dbConn, DB_CHARSET);
    }


    function CrearEquipo($obj){
        mysqli_query($this->dbConn ,"SET @Marca='".$obj->marca."'");
        mysqli_query($this->dbConn ,"SET @Modelo='".$obj->modelo."'");
        mysqli_query($this->dbConn ,"SET @Descripcion='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @SerieTa='".$obj->codigo_ta."'");
        mysqli_query($this->dbConn ,"SET @Serie='".$obj->num_serie."'");
        mysqli_query($this->dbConn ,"SET @Fecha='".$obj->fecha_inst."'");
        mysqli_query($this->dbConn ,"SET @Proveedor='".$obj->proveedor."'");
        mysqli_query($this->dbConn ,"SET @Id_estado='".$obj->id_estado."'");
        mysqli_query($this->dbConn ,"SET @Id_tipo_equi='".$obj->id_tipo_equi."'");
        mysqli_query($this->dbConn ,"SET @Responsable='".$obj->responsable."'");
        mysqli_query($this->dbConn ,"SET @Departamento='".$obj->departamento."'");
        mysqli_query($this->dbConn ,"SET @Disponibilidad='".$obj->disponibilidad."'");
        mysqli_query($this->dbConn ,"SET @Observacion='".$obj->observacion."'");


        mysqli_multi_query ($this->dbConn, "CALL uspCrearEquipo(@Marca, @Modelo, @Descripcion, @SerieTa, @Serie,
                            @Fecha,@Proveedor,@Id_estado,@Id_tipo_equi, @Responsable, @Departamento, @Disponibilidad, @Observacion)")
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result= mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function GuardarArchivo($path, $id){
        mysqli_query($this->dbConn,"SET @Path='".$path."'" );
        mysqli_query($this->dbConn,"SET @Id_equipo='".$id."'" );
        mysqli_multi_query ($this->dbConn, "CALL uspInsertarAdjEquipo(@Path, @Id_equipo)")
        OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result= mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }

    }


    function GetEquipmentList(){
        mysqli_multi_query ($this->dbConn, "CALL uspVistaListaEquipos") OR DIE (mysqli_error($this->dbConn));
        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }

        }
    }

    function GetEquimentByType($category){
        mysqli_query($this->dbConn ,"SET @type='".$category."'");

        mysqli_multi_query ($this->dbConn, "CALL uspGetEquipmentByType(@type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($this->equipment_list = mysqli_store_result($this->dbConn)) {

                return $this->equipment_list;
            }
        }
    }

    function GetEquipmentByDesc($desc, $type){
        mysqli_query($this->dbConn, "SET @descripcion='".$desc."'");
        mysqli_query($this->dbConn, "SET @type='".$type."'");

        mysqli_multi_query($this->dbConn, "CALL uspFiltrarPorEquipo(@descripcion, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function GetEquipmentByMarca($marca, $type){
        mysqli_query($this->dbConn, "SET @marca='".$marca."'");
        mysqli_query($this->dbConn, "SET @type='".$type."'");

        mysqli_multi_query($this->dbConn, "CALL uspFiltrarPorMarca(@marca, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    function GetEquipmentBySerie($serie, $type){
        mysqli_query($this->dbConn, "SET @serie='".$serie."'");
        mysqli_query($this->dbConn, "SET @type='".$type."'");

        mysqli_multi_query($this->dbConn, "CALL uspFiltrarPorSerie(@serie, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {
            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    function GetEquipmentByDep($dep, $type){
        mysqli_query($this->dbConn, "SET @departamento='".$dep."'");
        mysqli_query($this->dbConn, "SET @type='".$type."'");

        mysqli_multi_query($this->dbConn, "CALL uspFiltrarPorDepartamento(@departamento, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    function GetEquipmentByEst($state, $type){
        mysqli_query($this->dbConn, "SET @estado='".$state."'");
        mysqli_query($this->dbConn, "SET @type='".$type."'");

        mysqli_multi_query($this->dbConn, "CALL uspFiltrarPorEstado(@estado, @type)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    function GetEquipmentHistory($id){
        mysqli_query($this->dbConn, "SET @id='".$id."'");

        mysqli_multi_query($this->dbConn, "CALL uspEquipmentHistory(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    function GetEquipmentAccesories($id){
        mysqli_query($this->dbConn, "SET @id='".$id."'");

        mysqli_multi_query($this->dbConn, "CALL uspGetAccesoriesList(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {
                return $result;
            }
        }
    }

    //Crear un nuevo registro para el historial de mantenimiento de cada equipo
    function AddHistoryRecord($obj){
        mysqli_query($this->dbConn ,"SET @id='".$obj->id_equipo."'");
        mysqli_query($this->dbConn ,"SET @ult_mant='".$obj->ultMant."'");
        mysqli_query($this->dbConn ,"SET @ingreso='".$obj->ingreso."'");
        mysqli_query($this->dbConn ,"SET @prob='".$obj->problema."'");
        mysqli_query($this->dbConn ,"SET @sol='".$obj->solucion."'");
        mysqli_query($this->dbConn ,"SET @obs='".$obj->observacion."'");
        mysqli_query($this->dbConn ,"SET @rep='".$obj->repuesto."'");
        mysqli_query($this->dbConn ,"SET @disp='".$obj->disponibilidad."'");
        mysqli_query($this->dbConn ,"SET @tec='".$obj->tecnico."'");
    
        mysqli_query($this->dbConn ,"SET @correo='".$obj->correo."'");


        mysqli_multi_query ($this->dbConn, "CALL uspCreateHistoryRecord(@id,@ult_mant,@ingreso,@prob,@sol,@obs,@rep,@disp,@tec,@correo)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Crear un nuevo registro para el historial de mantenimiento de cada equipo
    function AddAccesorio($obj){
        mysqli_query($this->dbConn ,"SET @Descripcion='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @Disponibilidad='".$obj->disponibilidad."'");
        mysqli_query($this->dbConn ,"SET @Num_serie='".$obj->serie."'");
        mysqli_query($this->dbConn ,"SET @Num_serie_ta='".$obj->serie_ta."'");
        mysqli_query($this->dbConn ,"SET @IdEqu='".$obj->id_equipo."'");

        mysqli_multi_query ($this->dbConn, "CALL uspAgregarAccesorios(@Descripcion,@Disponibilidad,@Num_serie,@Num_serie_ta,@IdEqu)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function ObtenerEquipo($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerEquipo(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function ActualizarEquipo($obj){
        mysqli_query($this->dbConn ,"SET @Id='".$obj->id_equipo."'");
        mysqli_query($this->dbConn ,"SET @Marca='".$obj->marca."'");
        mysqli_query($this->dbConn ,"SET @Modelo='".$obj->modelo."'");
        mysqli_query($this->dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @NumSerieTa='".$obj->codigo_ta."'");
        mysqli_query($this->dbConn ,"SET @NumSerie='".$obj->num_serie."'");
        mysqli_query($this->dbConn ,"SET @FechaInstalacion='".$obj->fecha_inst."'");
        mysqli_query($this->dbConn ,"SET @Prov='".$obj->proveedor."'");
        mysqli_query($this->dbConn ,"SET @IdEstado='".$obj->id_estado."'");
        mysqli_query($this->dbConn ,"SET @IdTipoEqui='".$obj->id_tipo_equi."'");
        mysqli_query($this->dbConn ,"SET @Resp='".$obj->responsable."'");
        mysqli_query($this->dbConn ,"SET @Dep='".$obj->departamento."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->observacion."'");


        mysqli_multi_query ($this->dbConn, "CALL uspActualizarEquipo(@Id, @Marca, @Modelo, @Descr, @NumSerieTa, @NumSerie,
                            @Obs, @FechaInstalacion,@Prov,@IdEstado,@IdTipoEqui, @Resp, @Dep)")
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result= mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function EliminarEquipo($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarEquipo(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    //Obtener historial
    function ObtenerHistorial($id){
        mysqli_query($this->dbConn ,"SET @Id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerHistorial(@Id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function ActualizarHistorial($obj){
        mysqli_query($this->dbConn ,"SET @Id='".$obj->id_historial."'");
        mysqli_query($this->dbConn ,"SET @Tec='".$obj->tecnico."'");
        mysqli_query($this->dbConn ,"SET @Correo='".$obj->correo."'");
        mysqli_query($this->dbConn ,"SET @Ingreso='".$obj->ingreso."'");
        mysqli_query($this->dbConn ,"SET @Mant='".$obj->ultMant."'");
        mysqli_query($this->dbConn ,"SET @Prob='".$obj->problema."'");
        mysqli_query($this->dbConn ,"SET @Sol='".$obj->solucion."'");
        mysqli_query($this->dbConn ,"SET @Obs='".$obj->observacion."'");
        mysqli_query($this->dbConn ,"SET @Disp='".$obj->disponibilidad."'");
        mysqli_query($this->dbConn ,"SET @Rep='".$obj->repuesto."'");


        mysqli_multi_query ($this->dbConn, "CALL uspActualizarHistorial(@Id, @Tec, @Correo, @Ingreso, @Mant,
                            @Prob, @Sol, @Obs, @Disp, @Rep)")
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result= mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function EliminarHistorial($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarHistorial(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function ObtenerAccesorio($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspObtenerAccesorio(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function ActualizarAccesorio($obj){
        mysqli_query($this->dbConn ,"SET @Id='".$obj->id_accesorio."'");
        mysqli_query($this->dbConn ,"SET @Descr='".$obj->descripcion."'");
        mysqli_query($this->dbConn ,"SET @Disp='".$obj->disponibilidad."'");
        mysqli_query($this->dbConn ,"SET @IdEquipo='".$obj->id_equipo."'");
        mysqli_query($this->dbConn ,"SET @NumSerie='".$obj->serie."'");
        mysqli_query($this->dbConn ,"SET @NumSerieTa='".$obj->serie_ta."'");

        mysqli_multi_query ($this->dbConn, "CALL uspActualizarAccesorio(@Id, @Descr, @Disp, @IdEquipo, @NumSerie,
                            @NumSerieTa)")
            OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result= mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }

    function EliminarAccesorio($id){
        mysqli_query($this->dbConn ,"SET @id='".$id."'");

        mysqli_multi_query ($this->dbConn, "CALL uspEliminarAccesorio(@id)") OR DIE (mysqli_error($this->dbConn));

        while (mysqli_more_results($this->dbConn)) {

            if ($result = mysqli_store_result($this->dbConn)) {

                return $result;
            }
        }
    }
   
}
