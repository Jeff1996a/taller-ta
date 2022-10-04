<?php
session_start();
if (!isset($_SESSION['usuario_sesion'])) {
header('Location: index.php');
die;
}
?>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <h1><?=$GLOBALS['title']?></h1>
            </div>
            <div class="col-sm-2 text-right mt-2">
                <p>
                    <button type="button" class="btn btn-outline-primary btn-sm fs-5 float-end"  id="btnAddSoporte" data-toggle="tooltip" data-placement="bottom" title="Nuevo video">
                        Nuevo
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-square-fill mb-1" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </a>
                    </button>
                    
                </p>
            </div>
        </div>
    </div>
    <hr/>

    <div class="container-fluid">
        <h3>Filtar por:</h3>

        <div class="row g-3 form-inline d-flex align-items-center justify-content-between">

            <div class="col-auto">
                <label for="txtNombre">Nombre:</label>
                <input type="text" class="form-control" id="txtResponsable" placeholder="Nombre responsable:">
            </div>

            <div class="col-auto">
                <button type="submit" id="btnFiltrar" class="btn btn-outline-success" style="margin-top: 25px;" >Consultar</button>
            </div>
        </div>
    </div>

    <br/>
    <div class="table-responsive">
        <table id="tblSoportes" class="table table-hover">
            <thead style="background-color:  #005aa9; color:white;">
            <tr>
                <td><strong>Cod.</strong></td>
                <td><strong>Video</strong></td>
                <td><strong>Descripción</strong></td>
                <td></td>
                <?php
                     if($_SESSION['rol'] == 'admin'){
                        echo '
                        <td></td>';
                    }                       
                ?>

            </tr>
            </thead>

            <?php
            while ($row = mysqli_fetch_assoc($GLOBALS['list'])) {

                ?>
                <tr>
                    <td class="idCurso"><?php echo $row["idCurso"]; ?> </td>
                    <td>
                        <p><?php echo $row["nombreCurso"]; ?></p>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                src="<?=$row["enlace"]?>" allowfullscreen>
                            </iframe>
                        </div>
                    </td>
                    <td><?php echo $row["descripcion"]; ?> </td>
                          
                    <td>
                        <a id="btnActualizar" role="button" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Editar documento">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </a>
                    </td>

                    <?php
                        if($_SESSION['rol'] == 'admin'){
                            echo '
                            <td>
                                <a id="btnEliminar" role="button" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar documento">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>     
                            </td>
                            ';
                        }
                    ?>

                    
                </tr>
                <?php
            }
            ?>
            <thead>
            <tr class="text-center" style="background-color: #005aa9; color: white">
                <td colspan="16" class="text-white"><strong>Se encontraron <?= $GLOBALS['num_filas'] ?> registros.</strong></td>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        const msg = {
            id: ''
        }

        $("#btnAddSoporte").click(function () {
            $.ajax({
                type:'GET',
                url: 'Controller/CursosController.php',
                data: {data:JSON.stringify(msg), action: 'viewAddCurso'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });

        //Actualizar incidencias
        $('#tblSoportes').on('click', '#btnActualizar', function () {
            const row =  $(this).closest('tr');
            msg.id= row.find("td.idCurso").text();

            $.ajax({
                    type: 'GET',
                    url: 'Controller/CursosController.php',
                    data: {data: JSON.stringify(msg), action:'update'},
                    success: function (result) {
                        $('#content').html(result);
                    },
                    error: function (result) {
                        alert('Ops! No se pudo obtener el registro');
                    }
            });
        });


        //Eliminar incidencias
        $('#tblSoportes').on('click', '#btnEliminar', function () {
            const row =  $(this).closest('tr');
            msg.id = row.find("td.idCurso").text();

            if (confirm('Desea eliminar el registro')) {
                $.ajax({
                    type: 'POST',
                    url: 'Controller/CursosController.php',
                    data: {data: JSON.stringify(msg), action:'eliminar'},
                    success: function (result) {
                        alert('Registro eliminado!!');
                        $.ajax({
                            type:'GET',
                            url: 'Controller/CursosController.php',
                            data: {data: JSON.stringify(msg), action:'listarCursos'},
                            success: function(response){
                                $('#content').html(response);
                            }
                        });
                    },
                    error: function (result) {
                        alert('Ops! No se pudo eliminar el curso');
                    }
                });
            }
        });

    })
</script>