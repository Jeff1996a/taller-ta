<?php 
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
$accesorio = $GLOBALS['accesorio'];
?>
<form id="accesories-form" method="post" action="" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="add-equipment-header">
                <div id="btnRegresar" class="text-warning" role="button" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left-square-fill me-2 mt-2" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <h1>Actualizar accesorio equipo:</h1>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                <label for="txtSerie" class="col-sm-12 col-form-label">Número de serie:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtSerie" name="serie" value="<?php echo $accesorio->serie; ?>" style="text-transform:uppercase">
                </div>
            </div>

            <div class="mb-2 col-6">
                <label for="txtSerieTA" class="col-sm-12 col-form-label">Número de serie TA:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtSerieTA" name="codigoTA" value="<?php echo $accesorio->serie_ta; ?>" style="text-transform:uppercase" >
                </div>
            </div>

        </div>


        <div class="mb-2 row">
            <div class="mb-2 col-sm-6">
                <label for="txtDescripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" id="txtDescripcion" rows="3" name="descripcion" style="text-transform:uppercase"><?php echo $accesorio->descripcion; ?></textarea>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="mb-2 col-6">
                Disponibilidad
                <?php 
                
                    if($accesorio->disponibilidad == 'Si'){
                        echo '
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispSi" checked>
                            <label class="form-check-label" for="rbDispSi">
                            Si
                            </label>
                        </div>';

                        echo '
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispNo">
                            <label class="form-check-label" for="rbDispNo">
                            No
                            </label>
                        </div>';
                    } 
                    else {
                        echo '
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispSi">
                            <label class="form-check-label" for="rbDispSi">
                            Si
                            </label>
                        </div>';

                        echo '
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="rbDispNo" checked>
                            <label class="form-check-label" for="rbDispNo">
                            No
                            </label>
                        </div>';
                    }     
                ?>
            </div>

        </div>

        <!--
        <div class="mb-2">
            <label for="file" class="form-label">Adjuntos:</label>
            <input class="form-control" type="file" id="file" name="image">
        </div>
        -->
        <div class="col-auto">
            <button id="btnSaveAccesories" type="submit" class="btn btn-outline-success" style="margin-top: 25px; float: right; margin-bottom:25px;"  >Guardar</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){

        const serie2 = $('#txtSerie').val();
        const serieTA2 = $('#txtSerieTA').val();
        const descripcion2 = $('#txtDescripcion').val();
        
        var disp2 = '';

        if($('#rbDispSi').is(':checked')){
            disp2 = 'Si';
        }
            
        if($('#rbDispNo').is(':checked')){
            disp2 = 'No';
        }

        const msg = {
            category: '',
            id: ''
        };

        //Validacion
        const validator = $("#accesories-form").validate({
            rules:{
                serie:{
                    required: true
                },
                codigoTA:{
                    required: true,
                },
                descripcion:{
                    required: true
                }
            },
            messages:{
                serie:{
                    required: "Ingrese el número de serie!"
                },
                codigoTA:{
                    required: "Ingrese el código!",
                },
                descripcion: {
                    required: "Ingrese una descripción!"
                }
            }
        });

        $('#btnRegresar').click(function () {
            msg.id = <?=$accesorio->id_equipo?>;
            msg.category = '<?=$GLOBALS['category']?>';

            $.ajax({
                type:'GET',
                url: 'Controller/EquipoController.php',
                data: {data:JSON.stringify(msg), action:'viewAccesories'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        $('#accesories-form').on('submit',function(e){

            msg.id= <?=$accesorio->id_equipo?>;

            msg.category = '<?=$GLOBALS['category']?>';

            e.preventDefault();

            const serie = $('#txtSerie').val();
            const serieTA = $('#txtSerieTA').val();
            const descripcion = $('#txtDescripcion').val();
            const id_equipo = <?=$accesorio->id_equipo?>;

            var disp = '';

            if($('#rbDispSi').is(':checked')){
                disp = 'Si';
            }
            
            if($('#rbDispNo').is(':checked')){
                disp = 'No';
            }

            const form_data = new FormData();

            form_data.append('id_accesorio',<?=$accesorio->id_accesorio?> )
            form_data.append('descripcion', descripcion);
            form_data.append('disponibilidad', disp);
            form_data.append('serieTa', serieTA);
            form_data.append('serie', serie);
            form_data.append('id_equipo', id_equipo);
            form_data.append('action', 'actualizarAccesorio');

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
                        console.log(response.result);
                        if(response.result != 0){
                                alert("Registro actulizado correctamente!!");

                                console.log(msg.category);

                                $.ajax({
                                    type:'GET',
                                    url: 'Controller/EquipoController.php',
                                    data: {data: JSON.stringify(msg), action:'viewAccesories'},
                                    success: function(response){
                                        $('#content').html(response);
                                    }
                                });

                                var actividad = "Actualizó accesorio equ: " +  <?=$accesorio->id_equipo?>;

                                if(serie != serie2){
                                    actividad += " Serie: " + serie + " antes: " + serie2;
                                }

                                if(serieTA != serieTA2){
                                    actividad += " CodTA: " + serieTA + " antes: " + serieTA2;
                                }

                                if(descripcion != descripcion2){
                                    actividad += " Descr: " + descripcion + " antes: " + descripcion2;
                                }

                                if(disp != disp2){
                                    actividad += " Disp: " + disp + " antes: " + disp2;
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
                                alert("No se puede actualizar el registro");
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