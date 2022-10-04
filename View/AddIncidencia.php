<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
?>

<form action="" method="post" id="frmCrearIncidencia">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" class="text-warning" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-square-fill me-2 mt-2" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1>Registrar nueva incidencia:</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-7">
                <label for="txtNombre" class="col-sm-12 col-form-label">Nombre:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtNombre" name="nombre" style="text-transform:uppercase">
                </div>
            </div>


        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtReporta" class="col-sm-12 col-form-label">Quien reporta:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtReporta" name="reporta" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtResponsable" class="col-sm-12 col-form-label">Responsable:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtResponsable" name="responsable" value="<?php echo $_SESSION['nickuser'].' '.$_SESSION['nickapellido']; ?>" style="text-transform:uppercase" disabled>
                </div>
            </div>

        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="dpInicios" class="col-sm-6 col-form-label">Fecha reporte:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpInicio" name="fecha_reporte">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="dpFin" class="col-sm-6 col-form-label">Fecha solución:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpFin" name="fecha_solucion">
                </div>
            </div>

        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-sm-6">
                <label for="txtProblema" class="form-label">Problema:</label>
                <textarea class="form-control" id="txtProblema" rows="3" name="problema" style="text-transform:uppercase"></textarea>
            </div>

            <div class="mb-2 col-sm-6">
                <label for="txtSolucion " class="form-label">Solución:</label>
                <textarea class="form-control" id="txtSolucion" rows="3" name="solucion" style="text-transform:uppercase"></textarea>
            </div>
        </div>

        <div class="mb-2">
            <label for="txtObservacion" class="form-label">Observación:</label>
            <textarea class="form-control" id="txtObservacion" rows="3" name="observacion" style="text-transform:uppercase"></textarea>
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

        //Validaciones
        const validator = $("#frmCrearIncidencia").validate({
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
                    required: "Ingrese un nombre a la incidencia!"
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

        $('#frmCrearIncidencia').on('submit', function(e){

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

                form_data.append('nombre', nombre);
                form_data.append('reporta', reporta);
                form_data.append('responsable', responsable);
                form_data.append('fecha_reporte', fecha_rep);
                form_data.append('fecha_solucion', fecha_sol);
                form_data.append('problema', prob);
                form_data.append('solucion', sol);
                form_data.append('observacion', obs);
                form_data.append('action', 'addIncidencia');

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
                                alert("Registro exitoso!!");

                                $.ajax({
                                    type:'GET',
                                    url: 'Controller/IncidenciasController.php',
                                    data: { data:JSON.stringify(''), action:'listarIncidencias'},
                                    success: function(response){
                                        $('#content').html(response);
                                    }
                                });  
                                
                                const nick = '<?=$_SESSION['nicknick']?>';
                                const email = '<?=$_SESSION['email']?>';
                                const actividad = "Agregó incidencia: \n" +
                                    "Rep: " + reporta + "\n" +  
                                    "FRep: " + fecha_rep + "\n" +
                                    "Fsol: " + fecha_sol;

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