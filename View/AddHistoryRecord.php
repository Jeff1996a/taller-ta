<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
?>

<form action="" method="post" id="form-history">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" class="text-warning" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-square-fill me-2 mt-2" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1>Agregar registro a historial:</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtTecnico" class="col-sm-12 col-form-label">Técnico responsable:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtTecnico" name="tecnico" value="<?php echo $_SESSION['nickuser'].' '.$_SESSION['nickapellido']; ?>" style="text-transform:uppercase" disabled>
                </div>
            </div>

        </div>

        <div class="mb-2 row">

            <div class="mb-2 col-6">
                <label for="txtCorreo" class="col-sm-12 col-form-label">Correo:</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="txtCorreo" name="correo">
                </div>
            </div>

        </div>

        <div class="mb-2 row">

            <div class="mb-2 col-6">
                <label for="dpUltMant" class="col-sm-6 col-form-label">Fecha de mantenimiento:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpUltMant" name="ultMant">
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

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                Disponibilidad
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispSi" checked>
                    <label class="form-check-label" for="rbDispSi">
                        Si
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispNo">
                    <label class="form-check-label" for="rbDispNo">
                        No
                    </label>
                </div>
            </div>

            <div class="mb-2 col-6">
                Solicitó repuesto
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbRepSi" checked>
                    <label class="form-check-label" for="rbRepSi">
                        Si
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbRepNo">
                    <label class="form-check-label" for="rbRepNo">
                        No
                    </label>
                </div>
            </div>

        </div>

        <!--
        <div class="row mb-2">
            <div class="mb-2">
                <label for="file" class="form-label">Adjuntos:</label>
                <input class="form-control" type="file" id="file">
            </div>
        </div>
        -->


        <div class="row text-center">
            <div class="col-md-12 ">
                <button id="btnSaveHistory" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Guardar</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        const msg = {
          category: '',
          id: ''
        };

        //Validacion
        const validator = $("#form-history").validate({
            rules:{
                tecnico:{
                    required: true
                },
                correo: {
                    required: true,
                    email: true
                },
                ultMant:{
                    required: true,
                    date: true
                },
                ingreso:{
                    required: true,
                    date: true
                },
                problema : {
                    required: true
                },
                solucion: {
                    required: true
                }

            },
            messages:{
                tecnico:{
                    required: "Ingrese un técnico responsable!"
                },
                correo: {
                    required: "Ingrese un correo!",
                    email: "Dirección de correo no válida!"
                },
                ultMant:{
                    required: "Seleccione la fecha de mantenimiento!",
                    date: "Ingrese una fecha válida!"
                },
                ingreso:{
                    required: "Seleccione la fecha de ingreso!",
                    date: "Ingrese un fecha válida!"
                },
                problema: {
                    required: "Ingrese el problema detectado!"
                },
                solucion:{
                    required: "Ingrese la solución!"
                }
            }
        });

        $('#btnRegresar').click(function () {
            msg.id = '<?=$GLOBALS['id']?>';
            msg.category = '<?=$GLOBALS['category']?>';

            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data:JSON.stringify(msg), action:'viewHistory'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#form-history').on('submit',function(e){

            e.preventDefault();

            const id_equipo = '<?=$GLOBALS['id']?>';
            const categoria = '<?=$GLOBALS['category']?>';

            const tecnico = $('#txtTecnico').val();
            const correo = $('#txtCorreo').val();
            const fecha_ingreso = $('#dpIngreso').val(); 
            const fecha_ult_mant = $('#dpUltMant').val();
            const problema = $('#txtProblema').val();
            const solucion = $('#txtSolucion').val();
            const observacion = $('#txtObservacion').val();

            var disp = '';
            var repuesto = '';

            if($('#rbDispSi').is(':checked')){
                disp = 'Si';
            }
            
            if($('#rbDispNo').is(':checked')){
                disp = 'No';
            }

            if($('#rbRepSi').is(':checked')){
                repuesto = 'Si';
            }
            
            if($('#rbRepNo').is(':checked')){
                repuesto = 'No';
            }

            const form_data = new FormData();

            form_data.append('id_equipo', id_equipo);
            form_data.append('tecnico', tecnico);
            form_data.append('correo', correo);
            form_data.append('ingreso', fecha_ingreso);
            form_data.append('ultMant', fecha_ult_mant);
            form_data.append('problema', problema);
            form_data.append('solucion', solucion);
            form_data.append('observacion', observacion);
            form_data.append('disponibilidad', disp);
            form_data.append('repuesto', repuesto);
            form_data.append('category', categoria);
            form_data.append('action', 'addHistory');
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
                    console.log(response);
                    
                    if(response.result != 0){
                            alert("Registro exitoso!!");
                            msg.id = '<?=$GLOBALS['id']?>';
                            msg.category = '<?=$GLOBALS['category']?>';

                            $.ajax({
                                type:'GET',
                                url: 'Controller/EquipoController.php',
                                data: {data:JSON.stringify(msg), action:'viewHistory'},
                                success: function(response){
                                    $('#content').html(response);
                                }
                            });

                            const nick = '<?=$_SESSION['nicknick']?>';
                            const email = '<?=$_SESSION['email']?>';
                            const actividad = "Nuevo registro historial: \n" +
                                "Prob: " + problema + "\n" + 
                                "Equ: " + id_equipo + "\n" ;//Id del equipo 

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
        });
    })
</script>
