<form action="" method="post" id="transmision-form" enctype="multipart/form-data>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" role="button" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fa983a " class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>
                <h1>Nueva transmisión:</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtNombreTransmision" class="col-sm-12 col-form-label">Nombre transmisión:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtNombre" name="nombre" style="text-transform:uppercase">
                </div>
            </div>
        </div>
        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtUbicacion" class="col-sm-12 col-form-label">Ubicación:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtUbicacion" name="ubicacion" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtResponsable" class="col-sm-12 col-form-label">Responsable:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtTecnico" name="tecnico" style="text-transform:uppercase">
                </div>
            </div>

        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtEmail" class="col-sm-12 col-form-label">Email:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtEmail" name="email">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtMovil" class="col-sm-12 col-form-label">Unidad móvil:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtMovil" name="movil" style="text-transform:uppercase">
                </div>
            </div>

        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="dpInicio" class="col-sm-6 col-form-label">Fecha inicio:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpInicio" name="fechaInicio">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="dpFin" class="col-sm-6 col-form-label">Fecha fin:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="dpFin" name="fechaFin">
                </div>
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
            <button id="btnCrearTransmision" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Guardar</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function (){

        //Validacion
        $("#transmision-form").validate({
            rules:{
                nombre:{
                    required: true
                },
                ubicacion:{
                    required: true
                },
                tecnico:{
                    required: true
                },
                email:{
                    required: true,
                    email: true
                },
                movil:{
                    required:true
                },
                fechaInicio:{
                    required: true,
                    date: true
                },
                fechaFin:{
                    required: true,
                    date: true
                }
            },
            messages:{
                nombre:{
                    required: "Ingrese un nombre!"
                },
                ubicacion:{
                    required: "Ingrese la ubicación!"
                },
                tecnico: {
                    required: "Ingrese un responsable!"
                },
                email: {
                    required: "Ingrese un correo electrónico!",
                    email: "Correo electrónico inválido!!"
                },
                movil:{
                    required: "Ingrese la unidad móvil asignada!"
                },
                fechaInicio:{
                    required: "Seleccion una fecha!",
                    date: "Fecha seleccionada no válida!"
                },
                fechaFin:{
                    required: "Seleccione una fecha!",
                    date: "Fecha seleccionada no válida!"
                }
            }
        });

        $('#btnRegresar').click(function(){
            $.ajax({
                type:'GET',
                url: 'Controller/TransmisionController.php',
                data: { data:JSON.stringify(''), action:'listarTransmisiones'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        
        $('#transmision-form').on('submit', function(e){

            e.preventDefault();

            const nombre = $('#txtNombre').val();
            const ubicacion = $('#txtUbicacion').val();
            const tecnico = $('#txtTecnico').val();
            const email = $('#txtEmail').val();
            const movil = $('#txtMovil').val();
            const inicio = $('#dpInicio').val();
            const fin = $('#dpFin').val();
            const observacion = $('#txtObservacion').val();
   
           
            const form_data = new FormData();

            form_data.append('nombre', nombre);
            form_data.append('ubicacion', ubicacion);
            form_data.append('tecnico', tecnico);
            form_data.append('email', email);
            form_data.append('movil', movil);
            form_data.append('fechaInicio', inicio);
            form_data.append('fechaFin', fin);
            form_data.append('observacion', observacion);
            form_data.append('action', 'addTransmision');

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
            $.ajax({
                url: 'Controller/TransmisionController.php',
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
                            url: 'Controller/TransmisionController.php',
                            data: { data:JSON.stringify(''), action:'listarTransmisiones'},
                            success: function(response){
                                $('#content').html(response);
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