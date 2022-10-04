<?php 
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
$incidencia = $GLOBALS['incidencia']
?>

<form action="" method="post" id="frmActualizarIncidencia">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" class="text-warning" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-square-fill me-2 mt-2" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1>Actualizar incidencia:</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-7">
                <label for="txtNombre" class="col-sm-12 col-form-label">Nombre:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtNombre" name="nombre" style="text-transform:uppercase" value="<?php echo $incidencia->nombre; ?>">
                </div>
            </div>


        </div>

        <div class="mb-2 row">
            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-2 col-6">
                        <label for="txtReporta" class="col-sm-12 col-form-label">Quien reporta:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="txtReporta" name="reporta" value="'.$incidencia->quien_reporta.'" style="text-transform:uppercase">
                        </div>
                    </div>';

                    echo '
                    <div class="mb-2 col-6">
                        <label for="txtResponsable" class="col-sm-12 col-form-label">Responsable:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="txtResponsable" name="responsable" value="'.$incidencia->responsable.'" style="text-transform:uppercase">
                        </div>
                    </div>';
                }
                else{
                    echo '
                    <div class="mb-2 col-6">
                        <label for="txtReporta" class="col-sm-12 col-form-label">Quien reporta:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="txtReporta" name="reporta" value="'.$incidencia->quien_reporta.'" style="text-transform:uppercase" disabled>
                        </div>
                    </div>';

                    echo '
                    <div class="mb-2 col-6">
                        <label for="txtResponsable" class="col-sm-12 col-form-label">Responsable:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="txtResponsable" name="responsable" value="'.$incidencia->responsable.'" style="text-transform:uppercase" disabled>
                        </div>
                    </div>';
                }
            ?>
            

            

        </div>

        <div class="mb-2 row">
            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '
                    <div class="mb-2 col-6">
                        <label for="dpInicios" class="col-sm-6 col-form-label">Fecha reporte:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="dpInicio" name="fecha_reporte" value="'.$incidencia->fecha_sop.'">
                        </div>
                    </div>';
                }
                else{
                    echo '
                    <div class="mb-2 col-6">
                        <label for="dpInicios" class="col-sm-6 col-form-label">Fecha reporte:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="dpInicio" name="fecha_reporte" value="'.$incidencia->fecha_sop.'" disabled>
                        </div>
                    </div>';
                }
            ?>
            

            <div class="mb-2 col-6">
                <label for="dpFin" class="col-sm-6 col-form-label">Fecha solución:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpFin" name="fecha_solucion" value="<?php echo $incidencia->fecha_sol; ?>">
                </div>
            </div>

        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-sm-6">
                <label for="txtProblema" class="form-label">Problema:</label>
                <textarea class="form-control" id="txtProblema" rows="3" name="problema"  style="text-transform:uppercase"><?php echo $incidencia->problema; ?></textarea>
            </div>

            <div class="mb-2 col-sm-6">
                <label for="txtSolucion " class="form-label">Solución:</label>
                <textarea class="form-control" id="txtSolucion" rows="3" name="solucion" style="text-transform:uppercase"><?php echo $incidencia->solucion; ?></textarea>
            </div>
        </div>

        <div class="mb-2">
            <label for="txtObservacion" class="form-label">Observación:</label>
            <textarea class="form-control" id="txtObservacion" rows="3" name="observacion"  style="text-transform:uppercase"><?php echo $incidencia->observacion; ?></textarea>
        </div>

        <!--
            <div class="mb-2">
            <label for="file" class="form-label">Adjuntos:</label>
            <input class="form-control" type="file" id="file">
        </div>
        -->
        
        <div class="col-auto">
            <button id="btnGuardarIncidencia" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Guardar</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function (){


        const nombre2 = $('#txtNombre').val();
        const reporta2 = $('#txtReporta').val();
        const responsable2 = $('#txtResponsable').val();
        const fecha_rep2 = $('#dpInicio').val();
        const fecha_sol2 = $('#dpFin').val();
        const prob2 = $('#txtProblema').val();
        const sol2 = $('#txtSolucion').val();
        const obs2 = $('#txtObservacion').val();

        //Validaciones
        const validator = $("#frmActualizarIncidencia").validate({
            rules:{
                nombre:{
                    required: true
                },
                reporta: {
                    required: true
                },
                responsable:{
                    required: true
                },
                fecha_reporte: {
                    required: true,
                    date: true
                },
                fecha_solucion: {
                    required:true,
                    date: true
                },
                problema: {
                    required:true
                },
                solucion:{
                    required: true
                }
            },
            messages:{
                nombre:{
                    required: "Ingrese un nombre a la transmisión"
                },
                reporta: {
                    required: "Ingrese la persona que reporta!"
                },
                responsable: {
                    required: "Ingrese un responsable!"
                },
                fecha_reporte :{
                    required: "Seleccione una fecha!",
                    date: "Fecha inválida"
                },
                fecha_solucion: {
                    required: "Seleccione una fecha!",
                    date: "Fecha inválida"
                },
                problema: {
                    required: "Ingrese el problema!",
                },
                solucion:{
                    required: "Ingrese la solución implementada!"
                }
            }
        });

        $('#btnRegresar').click(function(){
            $.ajax({
                type:'GET',
                url: 'Controller/IncidenciasController.php',
                data: { data:JSON.stringify(''), action:'listarIncidencias'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#frmActualizarIncidencia').on('submit', function(e){

                e.preventDefault();

                const nombre = $('#txtNombre').val();
                const reporta = $('#txtReporta').val();
                const responsable = $('#txtResponsable').val();
                const fecha_rep = $('#dpInicio').val();
                const fecha_sol = $('#dpFin').val();
                const prob = $('#txtProblema').val();
                const sol = $('#txtSolucion').val();
                const obs = $('#txtObservacion').val();


                const form_data = new FormData();

                form_data.append('id_incidencia', <?=$incidencia->id_incidencia;?>);
                form_data.append('nombre', nombre);
                form_data.append('reporta', reporta);
                form_data.append('responsable', responsable);
                form_data.append('fecha_reporte', fecha_rep);
                form_data.append('fecha_solucion', fecha_sol);
                form_data.append('problema', prob);
                form_data.append('solucion', sol);
                form_data.append('observacion', obs);
                form_data.append('action', 'actualizarIncidencia');

                //Mostrar los datos del formulario mediante clave/valor
                for(let [name, value] of form_data) {
                    console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
                }
                /*
                const files = document.getElementById('files');

                const total_files = files.files.length;

                for (var index = 0; index < total_files; index++) {
                    form_data.append("files[]", files.files[index]);
                }*/

                // AJAX request
                if(validator.form()){
                    $.ajax({
                        url: 'Controller/IncidenciasController.php',
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
                                alert("Actualización exitosa!!");

                                $.ajax({
                                    type:'GET',
                                    url: 'Controller/IncidenciasController.php',
                                    data: { data:JSON.stringify(''), action:'listarIncidencias'},
                                    success: function(response){
                                        $('#content').html(response);
                                    }
                                });  
                                
                                var actividad = "Actualizó incidencia: " +  <?=$incidencia->id_incidencia?>;

                                if(nombre != nombre2){
                                    actividad += " Nom: " + nombre + " antes: " + nombre2;
                                }

                                if(reporta != reporta2){
                                    actividad += " Rep: " + reporta + " antes: " + reporta2;
                                }

                                if(responsable != responsable2){
                                    actividad += " Resp: " + responsable + " antes: " + responsable2;
                                }

                                if(fecha_rep != fecha_rep2){
                                    actividad += " FRep: " + fecha_rep + " antes: " + fecha_rep2;
                                }

                                if(fecha_sol != fecha_sol2){
                                    actividad += " FSol: " + fecha_sol + " antes: " + fecha_sol2;
                                }

                                if(prob != prob2){
                                    actividad += " Prob: " + prob + " antes: " + prob2;
                                }

                                if(sol != sol2){
                                    actividad += " Sol: " + sol + " antes: " + sol2;
                                }

                                if(obs != obs2){
                                    actividad += " Obs: " + obs + " antes: " + obs2;
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
                                    alert("No se pudo registrar la transmisión");
                            }
                        },
                        error: function(xhr){
                            console.log(xhr);
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