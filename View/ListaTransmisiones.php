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
            <div class="col-lg-11">
                <h1><?=$GLOBALS['title']?></h1>
            </div>
            <div class="col-lg-1" id="btnAddTransmision" role="button" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Nueva transmisión">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#ff9000" class="bi bi-plus-circle-fill float-end" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </div>
        </div>
    </div>
    <hr/>

    <div class="container-fluid">
        <h3>Filtar por:</h3>

        <div class="row g-3 form-inline d-flex align-items-center justify-content-between">

            <div class="col-auto">
                <label for="txtResponsable">Responsable:</label>
                <input type="text" class="form-control" id="txtResponsable" placeholder="Nombre responsable:">
            </div>

            <div class="col-auto">
                <button type="submit" id="btnFiltrar" class="btn btn-outline-success" style="margin-top: 25px;" >Consultar</button>
            </div>
        </div>
    </div>

    <br/>
    <div class="table-responsive">
        <table id="tblTransmisiones" class="table table-hover">
            <thead style="background-color:  #005aa9; color:white;">
            <tr>
                <td><strong>Cod.</strong></td>
                <td><strong>Nombre</strong></td>
                <td><strong>Ubicación</strong></td>
                <td><strong>Responsable</strong></td>
                <td><strong>Email</strong></td>
                <td><strong>Unidad móvil</strong></td>
                <td><strong>Fecha inicio</strong></td>
                <td><strong>Fecha fin</strong></td>
                <td><strong>Observación</strong></td>
                <td></td>
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
                    <td class="idTransmision"><?php echo $row["id_transmision"]; ?> </td>
                    <td><?php echo $row["nombre"]; ?> </td>
                    <td><?php echo $row["ubicacion"]; ?> </td>
                    <td><?php echo $row["tecnico"]; ?> </td>
                    <td><?php echo $row["email"]; ?> </td>
                    <td><?php echo $row["unidad_movil"]; ?> </td>
                    <td><?php echo $row["fecha_inicio"]; ?> </td>
                    <td><?php echo $row["fecha_fin"]; ?> </td>
                    <td><?php echo $row["observaciones"]; ?> </td>   
                    <td>
                        <a id="btnListaEquipos" role="button" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Listado de equipos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                 <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                 <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a id="btnActualizar" role="button" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Editar transmisión">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </a>
                    </td>
                    <?php
                        if($_SESSION['rol'] == 'admin'){
                            echo '
                            <td>
                                <a id="btnEliminar" role="button" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar transmisión">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>     
                            </td>';
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
        };

        $("#btnAddTransmision").click(function () {

            $.ajax({
                type:'GET',
                url: 'Controller/TransmisionController.php',
                data: {data:JSON.stringify(''), action: 'viewAddTransmision'},
                success: function(response){
                    $('#content').html(response);
                }
            });
        });


        //Lista todos los equipos asignados a la transmision
        $('#tblTransmisiones').on('click','#btnListaEquipos', function(){
            const row =  $(this).closest('tr');
            msg.id = row.find("td.idTransmision").text();
            $.ajax({
                type:'GET',
                url: 'Controller/TransmisionController.php',
                data: {data:JSON.stringify(msg), action:'listarAccesorios'},
                success: function(response){
                    $('#content').html(response);
                },
                error:function(xhr){
                    console.log(xhr);
                }
            });
        });

      //Actualizar datos de la transmision
      $('#tblTransmisiones').on('click', '#btnActualizar', function () {
            const row =  $(this).closest('tr');
            msg.id= row.find("td.idTransmision").text();

            $.ajax({
                    type: 'GET',
                    url: 'Controller/TransmisionController.php',
                    data: {data: JSON.stringify(msg), action:'update'},
                    success: function (result) {
                        $('#content').html(result);
                    },
                    error: function (result) {
                        alert('Ops! No se pudo obtener el registro');
                    }
            });
        });

        //Eliminar equipos
       $('#tblTransmisiones').on('click', '#btnEliminar', function () {
            const row =  $(this).closest('tr');
            msg.id = row.find("td.idTransmision").text();

            if (confirm('Desea eliminar el registro')) {
                $.ajax({
                    type: 'POST',
                    url: 'Controller/TransmisionController.php',
                    data: {data: JSON.stringify(msg), action:'eliminar'},
                    success: function (result) {
                        $.ajax({
                            type:'GET',
                            url: 'Controller/TransmisionController.php',
                            data: {data: JSON.stringify(msg), action:'listarTransmisiones'},
                            success: function(response){
                                $('#content').html(response);
                            }
                        });
                    },
                    error: function (result) {
                        alert('Ops! No se pudo eliminar el equipo');
                    }
                });
            }
        });
    })
</script>