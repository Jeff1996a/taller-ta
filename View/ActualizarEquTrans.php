<?php 
$equTrans = $GLOBALS['equTrans'];
?>
<form method="post" action="" enctype="multipart/form-data" id="frmActualizarEquTrans">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fa983a " class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>
                <h1>Agregar equipo</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtTecnico" class="col-sm-12 col-form-label">Numero de serie:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtSerie" name="serie" value="<?php echo $equTrans->serie; ?>" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtCorreo" class="col-sm-12 col-form-label">Código de TA:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtCodTa" name="codigoTA" value="<?php echo $equTrans->serie_ta; ?>" style="text-transform:uppercase">
                </div>
            </div>

        </div>

        <div class="mb-2">
            <label for="txtObservacion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="txtObservacion" rows="3" name="descripcion" style="text-transform:uppercase"><?php echo $equTrans->descripcion; ?></textarea>
        </div>

        <div class="col-auto">
            <button id="btnSaveHistory" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){

        const msg = {
            id: ''
        };
        $("#frmActualizarEquTrans").validate({
            rules:{
                serie: {
                    required: true
                },
                codigoTA: {
                    required:true
                },
                descripcion:{
                    required: true
                }
            },
            messages:{
                serie: {
                    required: "Ingrese el número de serie"
                },

                codigoTA: {
                    required: "Ingrese el código de TA"
                },
                descripcion: {
                    required: "Ingrese una descripción del equipo"
                }
            }
        });

        $('#btnRegresar').click(function(){

            msg.id = '<?=$equTrans->id_transmision;?>';
            $.ajax({
                type:'GET',
                url: 'Controller/TransmisionController.php',
                data: { data:JSON.stringify(msg), action:'listarAccesorios'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#frmActualizarEquTrans').on('submit', function(e){

            e.preventDefault();

            const serie = $('#txtSerie').val();
            const serieTa = $('#txtCodTa').val();
            const observacion = $('#txtObservacion').val();

            const form_data = new FormData();

            form_data.append('serie', serie);
            form_data.append('codigoTa', serieTa);
            form_data.append('descripcion', observacion);
            form_data.append('id_lista', <?=$equTrans->id_lista;?>);
            form_data.append('action', 'actualizarEquTrans');

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
                        alert("Actualización exitosa!!");
                        msg.id = <?=$equTrans->id_transmision;?>;
                        $.ajax({
                            type:'GET',
                            url: 'Controller/TransmisionController.php',
                            data: { data:JSON.stringify(msg), action:'listarAccesorios'},
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