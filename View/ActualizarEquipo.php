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
            <div class="add-equipment-header">
                <div id="btnRegresar" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fa983a " class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>
                <h1>Actualizar registro equipo de <?=$GLOBALS['category']?>:</h1>
            </div>
        </div>

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
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="dpFechaInst" value="'.$equipment->fecha_inst.'" name="fechaInst">
                        </div>
                    </div>';
                }

                else{
                    echo '
                    <div class="mb-3 col">
                        <label for="dpFechaInst" class="col-sm-3 col-form-label">Fecha instalación:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="dpFechaInst" value="'.$equipment->fecha_inst.'" name="fechaInst" disabled>
                        </div>
                    </div>';

                }
            ?>
        
            <div class="mb-2 col">
                <label for="txtProveedor" class="col-sm-2 col-form-label">Proveedor:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="txtProveedor" name="proveedor" value="<?php echo $equipment->proveedor; ?>" style="text-transform:uppercase">
                </div>
            </div>
        </div>

        <div class="mb-2 row">

            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-2 col">
                        <label for="txtResponsable" class="col-sm-2 col-form-label">Responsable:</label>
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
                        <label for="txtResponsable" class="col-sm-2 col-form-label">Responsable:</label>
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
            <div class="mb-2 col">
                <label for="cbEstado">Estado:</label>
                <?php
                    echo '<select class="form-select btn-outline-success" aria-label="Default select example" id="cbEstado"   name="estado">';
                    if($equipment->id_estado == "Almacenado"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1" selected="selected">Almacenado</option>';
                        echo '<option value="2">Averiado</option>';
                        echo '<option value="3">Óptimo</option>';
                        echo '<option value="4">Operativos</option>';
                    }
                    elseif($equipment->id_estado == "Averiado"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Almacenado</option>';
                        echo '<option value="2" selected="selected">Averiado</option>';
                        echo '<option value="3">Óptimo</option>';
                        echo '<option value="4">Operativos</option>';
                    }
                    elseif($equipment->id_estado == "Óptimo"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Almacenado</option>';
                        echo '<option value="2">Averiado</option>';
                        echo '<option value="3" selected="selected">Óptimo</option>';
                        echo '<option value="4">Operativos</option>';
                    }
                    elseif($equipment->id_estado == "Operativo"){
                        echo '<option>Seleccione un estado</option>';
                        echo '<option value="1">Almacenado</option>';
                        echo '<option value="2">Averiado</option>';
                        echo '<option value="3">Óptimo</option>';
                        echo '<option value="4" selected="selected">Operativos</option>';
                    }
                    echo '</select>';

                ?>
            </div>

            <div class="mb-2 col">
                <label for="cbTipoEquipo">Tipo de Equipo:</label>
                <?php 
                    echo '<select class="form-select btn-outline-success" aria-label="Default select example" id="cbTipoEquipo" name="tipoEquipo">';
                    if($equipment->id_tipo_equi == "Audio"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1" selected="selected">Audio</option>';
                        echo '<option value="2">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4">Electricidad</option>';
                        echo '<option value="5">Red</option>';
                        echo '<option value="6">Video</option>';
                    }

                    elseif($equipment->id_tipo_equi == "Cables"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1">Audio</option>';
                        echo '<option value="2" selected="selected">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4">Electricidad</option>';
                        echo '<option value="5">Red</option>';
                        echo '<option value="6">Video</option>';
                    }

                    elseif($equipment->id_tipo_equi == "Edición"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1">Audio</option>';
                        echo '<option value="2" selected="selected">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4">Electricidad</option>';
                        echo '<option value="5">Red</option>';
                        echo '<option value="6">Video</option>';
                    }

                    elseif($equipment->id_tipo_equi == "Electricidad"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1">Audio</option>';
                        echo '<option value="2">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4" selected="selected">Electricidad</option>';
                        echo '<option value="5">Red</option>';
                        echo '<option value="6">Video</option>';
                    }

                    elseif($equipment->id_tipo_equi == "Red"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1">Audio</option>';
                        echo '<option value="2">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4">Electricidad</option>';
                        echo '<option value="5" selected="selected">Red</option>';
                        echo '<option value="6">Video</option>';
                    }

                    elseif($equipment->id_tipo_equi == "Video"){
                        echo '<option>Seleccione una categoría</option>';
                        echo '<option value="1">Audio</option>';
                        echo '<option value="2">Cables</option>';
                        echo '<option value="3">Edición</option>';
                        echo '<option value="4">Electricidad</option>';
                        echo '<option value="5">Red</option>';
                        echo '<option value="6" selected="selected">Video</option>';
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
            <button id="btnActualizarEquipos" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Guardar</button>
        </div>
    </div>
</form>
<div id='preview'></div>
<script type="text/javascript">
    $(document).ready(function () {
        const msg = {
            category: ''
        };

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
            const tipoEquipo = $('#cbTipoEquipo').val();
            const responsable = $('#txtResponsable').val();
            const departamento = $('#txtDepartamento').val();
            const observacion = $('#txtObservacion').val();

            if(tipoEquipo == 1){
                msg.category = 'audio';
            }

            else if(tipoEquipo == 2){
                msg.category = 'cables';
            }

            else if(tipoEquipo == 3){
                msg.category = 'edicion';
            }

            else if(tipoEquipo == 4){
                msg.category = 'electricidad';
            }

            else if(tipoEquipo == 5){
                msg.category = 'red';
            }
            else if(tipoEquipo == 6){
                msg.category = 'video';
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
            form_data.append('tipoEquipo', tipoEquipo);
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

                                console.log(msg.category);

                                $.ajax({
                                    type:'GET',
                                    url: 'Controller/EquipoController.php',
                                    data: {data: JSON.stringify(msg), action:'listarEquipos'},
                                    success: function(response){
                                        $('#content').html(response);
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
