<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
$equipment = $GLOBALS['equipment'];

?>
<form action="" method="post" id="frmActualizarEquipo" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 d-flex">
                    <div id="btnRegresar" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#fa983a " class="bi bi-arrow-left-circle-fill mt-2 me-3" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </div>
                    <h1 >Actualizar registro equipo de: <?=$GLOBALS['category']?></h1>
                </div>
              
                
                <div class="col-md-3 d-flex justify-content-between text-right mt-3">
                    <p>
                        <button type="button"  class="btn btn-outline-success btn-sm fs-6" id="btnHistorial" data-toggle="tooltip" data-placement="bottom" title="Historial de mantenimiento" >
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-calendar-week float-start  me-2" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                            </a>
                            Historial
                        </button>
                        <button type=button class="btn btn-outline-primary btn-sm  fs-6" id="btnAccesorios" data-toggle="tooltip" data-placement="bottom" title="Lista de accesorios">
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pci-card float-start me-2 " viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .5.5V4h13.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H2v2.5a.5.5 0 0 1-1 0V2H.5a.5.5 0 0 1-.5-.5Z"/>
                                    <path d="M3 12.5h3.5v1a.5.5 0 0 1-.5.5H3.5a.5.5 0 0 1-.5-.5v-1Zm4 0h4v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1Z"/>
                                </svg>     
                            </a>
                            Accesorios
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="mb-2 row">
            <div class="mb-2 col">
                <label for="txtMarca" class="col-sm-2 col-form-label">Marca:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="txtMarca" name="marca" value="<?php echo $equipment->marca; ?>" placeholder="Ejm: DELL" style="text-transform:uppercase">
                </div>
            </div>
            <div class="mb-2 col">
                <label for="txtModelo" class="col-sm-2 col-form-label">Modelo:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="txtModelo" name="modelo" value="<?php echo $equipment->modelo; ?>" style="text-transform:uppercase">
                </div>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col">
                <label for="txtSerieTa" class="col-sm-3 col-form-label">Código TA:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtSerieTa" name="codigoTA" value="<?php echo $equipment->codigo_ta; ?>" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col">
                <label for="txtSerie" class="col-sm-2 col-form-label">Serie:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtSerie" name="serie" value="<?php echo $equipment->num_serie; ?>" style="text-transform:uppercase">
                </div>
            </div>
        </div>

        <div class="mb-2 row">

            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-3 col">
                        <label for="dpFechaInst" class="col-sm-3 col-form-label">Fecha instalación:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="dpFechaInst" value="'.$equipment->fecha_inst.'" name="fechaInst">
                        </div>
                    </div>';
                }

                else{
                    echo '
                    <div class="mb-3 col">
                        <label for="dpFechaInst" class="col-sm-3 col-form-label">Fecha instalación:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="dpFechaInst" value="'.$equipment->fecha_inst.'" name="fechaInst" disabled>
                        </div>
                    </div>';

                }
            ?>
        </div>

        <div class="mb-2 col">
                <label for="txtProveedor" class="col-sm-2 col-form-label">Proveedor:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="txtProveedor" name="proveedor" value="<?php echo $equipment->proveedor; ?>" style="text-transform:uppercase">
                </div>
        </div>

        <div class="mb-2 row">
        <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-2 col">
                        <label for="txtTecnico" class="col-sm-2 col-form-label">Técnico responsable:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="txtTecnico" value="'.$_SESSION['nickuser'].' '.$_SESSION['nickapellido'].'" name="tecnico" style="text-transform:uppercase">
                        </div>
                    </div>';

                }

                else{

                    echo '
                    <div class="mb-2 col">
                        <label for="txtTecnico" class="col-sm-2 col-form-label">Técnico responsable:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="txtTecnico" value="'.$_SESSION['nickuser'].' '.$_SESSION['nickapellido'].'" name="tecnico" style="text-transform:uppercase" disabled>
                        </div>
                    </div>';

                }
            ?>
            

        </div>

        <div class="mb-2 row">

            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-2 col">
                        <label for="txtResponsable" class="col-sm-6 col-form-label">Responsable del equipo:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtResponsable" name="responsable" value="'.$equipment->responsable.'" style="text-transform:uppercase">
                        </div>
                    </div>';

                    echo '
                    <div class="mb-2 col">
                        <label for="txtUbicacion" class="col-sm-2 col-form-label">Departamento:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtDepartamento" name="ubicacion"  value="'.$equipment->departamento.'"  style="text-transform:uppercase">
                        </div>
                    </div>';
                }

                else{

                    echo '
                    <div class="mb-2 col">
                        <label for="txtResponsable" class="col-sm-6 col-form-label">Responsable del equipo:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtResponsable" name="responsable" value="'.$equipment->responsable.'" style="text-transform:uppercase" disabled>
                        </div>
                    </div>';

                    echo '
                    <div class="mb-2 col">
                        <label for="txtUbicacion" class="col-sm-2 col-form-label">Departamento:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtDepartamento" name="ubicacion"  value="'.$equipment->departamento.'"  style="text-transform:uppercase" disabled>
                        </div>
                    </div>';

                }
            ?>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-sm-4">
                <label for="cbEstado">Estado:</label>
                <?php
                    echo '<select class="form-select btn-outline-success" aria-label="Default select example" id="cbEstado"   name="estado">';
                    if($equipment->id_estado == "Operativo: En uso"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1" selected="selected">Operativo: En uso</option>';
                        echo '<option value="2">Operativo: Bodega</option>';
                        echo '<option value="3">No operativo: De baja</option>';
                        echo '<option value="4">No operativo: Repuesto</option>';
                    }
                    elseif($equipment->id_estado == "Operativo: Bodega"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Operativo: En uso</option>';
                        echo '<option value="2" selected="selected">Operativo: Bodega</option>';
                        echo '<option value="3">No operativo: De baja</option>';
                        echo '<option value="4">No operativo: Repuesto</option>';
                    }
                    elseif($equipment->id_estado == "No operativo: De baja"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Operativo: En uso</option>';
                        echo '<option value="2" >Opertivo: Bodega</option>';
                        echo '<option value="3" selected="selected">No operativo: De baja</option>';
                        echo '<option value="4">No operativo: Repuesto</option>';
                    }
                    elseif($equipment->id_estado == "No operativo: Repuesto"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Operativo: En uso</option>';
                        echo '<option value="2" >Opertivo: Bodega</option>';
                        echo '<option value="3">No operativo: De baja</option>';
                        echo '<option value="4" selected="selected">No operativo: Repuesto</option>';
                    }
                    echo '</select>';

                ?>
            </div>
        </div>

        <div class="mb-2 row">
            <label for="txtDescripcion" class="col-form-label">Descripción:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="txtDescripcion"  placeholder="Ejm: CÁMARA"  value="<?php echo $equipment->descripcion; ?>" name="descripcion" style="text-transform:uppercase">
            </div>
        </div>

        <div class="mb-2">
            <label for="txtObservacion" class="form-label">Observación:</label>
            <textarea class="form-control" id="txtObservacion" rows="3" name="observacion" style="text-transform:uppercase"><?php echo $equipment->observacion; ?></textarea>
        </div>

        <div class="col-auto">
            <button id="btnActualizarEquipos" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Actualizar registro</button>
        </div>
    </div>
</form>
<div id='preview'></div>
<script type="text/javascript">
    $(document).ready(function () {
        const msg = {
            category: ''
        };

        const marca2 = $('#txtMarca').val();
        const modelo2 = $('#txtModelo').val();
        const descripcion2 = $('#txtDescripcion').val();
        const serieTA2 = $('#txtSerieTa').val();
        const serie2 = $('#txtSerie').val();
        const fecha2 = $('#dpFechaInst').val();
        const proveedor2 = $('#txtProveedor').val();
        const estado2 = $('#cbEstado').val();
        const tipoEquipo2 = '<?=$GLOBALS['category']?>'
        const tecnico2 = $('#txtTecnico').val();
        const responsable2 = $('#txtResponsable').val();
        const departamento2 = $('#txtDepartamento').val();
        const observacion2 = $('#txtObservacion').val();

        //Validaciones
        const validator = $("#frmActualizarEquipo").validate({
            rules:{
                marca: {
                    required: true
                },
                modelo:{
                    required: true
                },
                codigoTA: {
                    required: true
                },
                serie: {
                    required:true
                },
                fechaInst: {
                    required:true,
                    date: true
                },
                proveedor:{
                    required: true
                },
                responsable: {
                    required: true
                },
                ubicacion:{
                    required: true
                },
                estado:{
                    required: true
                },
                descripcion: {
                    required: true
                }
            },
            messages:{
                marca: {
                    required: "Ingrese la marca!"
                },
                modelo: {
                    required: "Ingrese el modelo!"
                },
                codigoTA :{
                    required: "Ingrese el código !"
                },
                serie: {
                    required: "Ingrese el número!"
                },
                fechaInst: {
                    required: "Seleccione la fecha!",
                    date: "Fecha inválida"
                },
                proveedor:{
                    required: "Ingrese el proveedor!"
                },
                responsable:{
                    required: "Ingrese un responsable!"
                },
                ubicacion: {
                    required: "Ingrese el departamento!"
                },
                estado: {
                    required: "Seleccione el estado del equipo!"
                },
                descripcion:{
                    required: "Ingrese una descripción!"
                }
            }
        });

        $('#btnRegresar').click(function () {
            msg.category = '<?=$GLOBALS['category']?>';

            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data: JSON.stringify(msg), action:'listarEquipos'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#frmActualizarEquipo').on('submit',function(e){

            e.preventDefault();

            const marca = $('#txtMarca').val();
            const modelo = $('#txtModelo').val();
            const descripcion = $('#txtDescripcion').val();
            const serieTA = $('#txtSerieTa').val();
            const serie = $('#txtSerie').val();
            const fecha = $('#dpFechaInst').val();
            const proveedor = $('#txtProveedor').val();
            const estado = $('#cbEstado').val();
            const tipoEquipo = '<?=$GLOBALS['category']?>'
            const tecnico = $('#txtTecnico').val();
            const responsable = $('#txtResponsable').val();
            const departamento = $('#txtDepartamento').val();
            const observacion = $('#txtObservacion').val();

            var idTipo = 0;

            if(tipoEquipo == 'audio'){
                idTipo = 1;
            }

            else if(tipoEquipo == 'cables'){
                idTipo = 2 ;
            }

            else if(tipoEquipo == 'edición'){
                idTipo = 3 ;
            }

            else if(tipoEquipo == 'electricidad'){
                idTipo = 4;
            }

            else if(tipoEquipo == 'red'){
                idTipo = 5;
            }
            else if(tipoEquipo == 'video'){
                idTipo = 6;
            }

            console.log("Categoria:" + msg.category);

            const form_data = new FormData();

            form_data.append('id_equipo','<?php echo $equipment->id_equipo; ?>');
            form_data.append('marca', marca);
            form_data.append('modelo', modelo);
            form_data.append('descripcion', descripcion);
            form_data.append('codigoTA', serieTA);
            form_data.append('serie', serie);
            form_data.append('fechaInst', fecha);
            form_data.append('proveedor', proveedor);
            form_data.append('estado', estado);
            form_data.append('tipoEquipo', idTipo);
            form_data.append('tecnico', tecnico);
            form_data.append('responsable', responsable);
            form_data.append('departamento', departamento);
            form_data.append('disponibilidad', 'si');
            form_data.append('observacion', observacion);
            form_data.append('action', 'actualizarEquipo');

            //Mostrar los datos del formulario mediante clave/valor
            for(let [name, value] of form_data) {
                console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
            }

            const files = document.getElementById('files');
            /*
            const total_files = files.files.length;

            for (var index = 0; index < total_files; index++) {
                form_data.append("files[]", files.files[index]);
            }*/

            // AJAX request
            if(validator.form()){
                    $.ajax({
                    url: 'Controller/EquipoController.php',
                    type: 'POST',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        /*
                        for(var index = 0; index < response.file_array.length; index++) {
                            var src = response.file_array[index];
                            console.log(src);
                            // Add img element in <div id='preview'>
                            $('#preview').append('<img src="'+src+'" width="200px;" height="200px">');
                        }*/
                        console.log(response.result);
                        if(response.result != 0){
                                alert("Registro actualizado correctamente!!");
                                msg.category = '<?=$GLOBALS['category']?>';
                                console.log(msg.category);

                                $.ajax({
                                    type:'GET',
                                    url: 'Controller/EquipoController.php',
                                    data: {data: JSON.stringify(msg), action:'listarEquipos'},
                                    success: function(response){
                                        $('#content').html(response);
                                    }
                                });

                                var actividad = "Actualizó equipo: " +  <?=$equipment->id_equipo?>;

                                if(marca != marca2){
                                    actividad += " Marca: " + marca + " antes: " + marca2;
                                }

                                if(modelo != modelo2){
                                    actividad += " Modelo: " + modelo + " antes: " + modelo2;
                                }

                                if(descripcion != descripcion2){
                                    actividad += " Desc: " + descripcion + " antes: " + descripcion2;
                                }

                                if(serieTA != serieTA2){
                                    actividad += " CodTA: " + serieTA + " antes: " + serieTA2;
                                }

                                if(serie != serie2){
                                    actividad += " Serie: " + serie + " antes: " + serie2;
                                }

                                if(fecha != fecha2){
                                    actividad += " Fecha: " + fecha + " antes: " + fecha2;
                                }

                                if(proveedor != proveedor2){
                                    actividad += " Prov: " + proveedor + " antes: " + proveedor2;
                                }
                                
                                if(estado != estado2){
                                    actividad += " Est: " + estado + " antes: " + estado2;
                                }

                                if(tipoEquipo != tipoEquipo2){
                                    actividad += " TEqu: " + tipoEquipo + " antes: " + tipoEquipo2;
                                }

                                if(tecnico != tecnico2){
                                    actividad += " Tec: " + tecnico + " antes: " + tecnico2;
                                }

                                if(responsable != responsable2){
                                    actividad += " Resp: " + responsable + " antes: " + responsable2;
                                }

                                if(departamento != departamento2){
                                    actividad += " Dep: " + departamento + " antes: " + departamento2;
                                }

                                if(observacion != observacion2){
                                    actividad += " Obs: " + observacion + " antes: " + observacion2;
                                }
                               
                                const nick = '<?=$_SESSION['nicknick']?>';
                                const email = '<?=$_SESSION['email']?>';

                                console.log(nick + " " + email + " " + actividad );

                                $.ajax({
                                    url: 'Controller/ActividadController.php',
                                    type: 'POST',
                                    data: {data: JSON.stringify({'usuario': nick, 'email':email, 'actividad':actividad}), action:'addActividad'},
                                    dataType: 'json',
                                    success: function(response){
                                        console.log(response);
                                    }
                                });
  
                        }

                        else{
                                alert("El equipo ya se encuentra registrado");
                        }
                    }
                });
            }

            /*AJAX request

            const files = document.getElementById('files');

            const total_files = files.files.length;

            for (var index = 0; index < total_files; index++) {
                form_data.append("files[]", files.files[index]);
            }

            ;
            console.log(total_files);
            console.log($('#cbTipoEquipo').val());
            console.log($('#cbEstado').val())
            $.ajax({
                url: 'Controller/EquipoController.php',
                type: 'post',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                }
            });
            */
        });
    })
</script>
