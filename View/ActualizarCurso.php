<?php
$curso = $GLOBALS['curso'];
?>
<form method="post" action="" enctype="multipart/form-data" id="frmActualizarSoporte">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fa983a " class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>
                <h1>Actualizar video</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtNombre" class="col-sm-12 col-form-label">Nombre:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtNombre" name="nombre" value="<?php echo $curso->nombreCurso; ?>" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtURL" class="col-sm-12 col-form-label">Enlace:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtURL" name="url" value="<?php echo $curso->url; ?>">
                </div>
            </div>

        </div>

        <div class="mb-2">
            <label for="txtObservacion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="txtDescripcion" rows="3" name="descripcion" style="text-transform:uppercase"><?php echo $curso->descripcion; ?></textarea>
        </div>

        <div class="col-auto">
            <button id="btnSaveHistory" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;" >Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){

        const msg = {
            id: ''
        };
        $("#frmCrearSoporte").validate({
            rules:{
                nombre: {
                    required: true
                },
                url: {
                    required:true
                },
                descripcion:{
                    required: true
                }
            },
            messages:{
                nombre: {
                    required: "Ingrese el nombre"
                },

                url: {
                    required: "Ingrese un enlace"
                },
                descripcion: {
                    required: "Ingrese una descripción del equipo"
                }
            }
        });

        $('#btnRegresar').click(function(){
            $.ajax({
                type:'GET',
                url: 'Controller/CursosController.php',
                data: { data:JSON.stringify(''), action:'listarCursos'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#frmActualizarSoporte').on('submit', function(e){

            e.preventDefault();

            const nombre = $('#txtNombre').val();
            const url = $('#txtURL').val();
            const descripcion = $('#txtDescripcion').val();

            const form_data = new FormData();

            form_data.append('id_curso',<?=$curso->id_curso; ?> )
            form_data.append('nombre', nombre);
            form_data.append('url', url);
            form_data.append('descripcion', descripcion);
            form_data.append('action', 'update')

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
                url: 'Controller/CursosController.php',
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
                            url: 'Controller/CursosController.php',
                            data: { data:JSON.stringify(''), action:'listarCursos'},
                            success: function(response){
                                $('#content').html(response);
                            }
                        });     
                    }

                    else{
                            alert("No se pudo registrar el curso");
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