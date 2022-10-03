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
                    <button type="button" class="btn btn-outline-primary btn-sm fs-5 float-end"  id="btnAddEquipment" data-toggle="tooltip" data-placement="bottom" title="Nuevo equipo">
                        Nuevo
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </a>
                    </button>
                    
                </p>
            </div>
        </div>
    </div>
    <hr/>

    <div class="container-fluid">
        <h3>Buscar por:</h3>

        <div class="row  form-inline d-flex align-items-center justify-content-between">

            <div class="col-sm-auto">
                <label for="txtEquipo">Equipo:</label>
                <input type="text" class="form-control" id="txtEquipo" placeholder="Ejm: CÁMARA" style="text-transform:uppercase">
            </div>

            <div class="col-sm-auto">
                <label for="txtMarca">Marca:</label>
                <input type="text" class="form-control" id="txtMarca" placeholder="Ejm: DELL" style="text-transform:uppercase">
            </div>

            <div class="col-sm-auto">
                <label for="txtFiltroSerie">Número de serie:</label>
                <input type="text" class="form-control" id="txtFiltroSerie" placeholder="Ejm: 222214AA" style="text-transform:uppercase">
            </div>

            <div class="col-sm-auto">
                <label for="txtDepartamento">Departamento:</label>
                <input type="text" class="form-control" id="txtDepartamento" placeholder="Ejm: PRODUCCIÓN" style="text-transform:uppercase">
            </div>

            <div class="col-sm-auto">
                <label for="cbEstado">Estado:</label>
                <select id="cbEstado" class="form-select btn-outline-success" aria-label="Default select example" >
                    <option selected>Seleccione un estado</option>
                    <option value="1">Operativo: En uso</option>
                    <option value="2">Operativo: Bodega</option>
                    <option value="3">No operativo: De baja </option>
                    <option value="4">No operativo: Repuesto</option>
                </select>
            </div>

            <div class="col-sm-auto">
                <button type="submit" id="btnBuscar" class="btn btn-outline-success" style="margin-top: 25px;" >Buscar</button>
            </div>
        </div>
    </div>

    <br/>

    <div class="table-responsive">
        <table id="tblEquipos" class="table table-hover">
            <thead style="background-color:  #005aa9; color: white;">
            <tr>
                <td><strong>Cod.</strong></td>
                <td><strong>Marca</strong></td>
                <td><strong>Modelo</strong></td>
                <td><strong>Descripción</strong></td>
                <td><strong>Serie TA</strong></td>
                <td><strong>Serie</strong></td>
                <td><strong>Observación</strong></td>
                <td><strong>Fech_Inst</strong></td>
                <td><strong>Técnico</strong></td>
                <td><strong>Responsable</strong></td>
                <td><strong>Departamento</strong></td>
                <td><strong>Estado</strong></td>
                
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
                    <td class="idEquipo"><?php echo $row["id_equipo"]; ?> </td>
                    <td><?php echo $row["marca"]; ?> </td>
                    <td><?php echo $row["modelo"]; ?> </td>
                    <td><?php echo $row["descripcion"]; ?> </td>
                    <td><?php echo $row["num_serie_ta"]; ?> </td>
                    <td><?php echo $row["num_serie"]; ?> </td>
                    <td><?php echo $row["observacion"]; ?> </td>
                    <td><?php echo $row["fecha_instalacion"]; ?> </td>
                    <td><?php echo $row["tecnico"]; ?> </td>
                    <td><?php echo $row["responsable"]; ?> </td>
                    <td><?php echo $row["departamento"]; ?> </td>
                    <td><?php echo $row["estado"]; ?> </td>
                    <!--
                        <td>
                            <a id="btnHistorial" role="button" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Historial de mantenimiento">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                            </a>
                        </td>

                        <td>
                            <a id="btnAccesorios" role="button" class="text-primary" data-toggle="tooltip" data-placement="bottom" title="Lista de accesorios">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pci-card" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .5.5V4h13.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H2v2.5a.5.5 0 0 1-1 0V2H.5a.5.5 0 0 1-.5-.5Z"/>
                                    <path d="M3 12.5h3.5v1a.5.5 0 0 1-.5.5H3.5a.5.5 0 0 1-.5-.5v-1Zm4 0h4v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1Z"/>
                                </svg>
                            </a>
                        </td>
                    -->
                                    

                    <!--<td><a id="btnEliminar" href="#">Adjuntos</a></td>-->

                    <td>
                        <a id="btnActualizar" role="button" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Detalles del equipo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                        </a>
                    </td>

                    <?php
                        if($_SESSION['rol'] == 'admin'){
                            echo '
                            <td>
                                <a id="btnEliminar" role="button" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar accesorio">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
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
            <tr class="text-center" style="background-color: #005aa9;">
                <td colspan="17" class="text-white"><strong>Se encontraron <?= $GLOBALS['num_filas'] ?> registros.</strong></td>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
      const msg = {
          category: '',
          id: '',
          filter: '',
          filterType: ''
      };

      $('#btnAddEquipment').click(function () {
          msg.category = '<?=$GLOBALS['category']?>';
          $.ajax({
              type:'GET',
              url: 'Controller/EquipoController.php',
              data: {data: JSON.stringify(msg), action:'viewAddEquipment'},
              success: function(response){
                  $('#content').html(response);
              }
          });
      });

      /*Ver el historial de un equipo
      $('#tblEquipos').on('click','#btnHistorial', function(){
          const row =  $(this).closest('tr');
          msg.id= row.find("td.idEquipo").text();

          msg.category = '<?=$GLOBALS['category']?>';

          $.ajax({
              type:'GET',
              url: 'Controller/EquipoController.php',
              data: {data: JSON.stringify(msg), action:'viewHistory'},
              success: function(response){
                  $('#content').html(response);
              }
          });
      });


      //Ver accesorios de un equipo
      $('#tblEquipos').on('click','#btnAccesorios', function(){
          const row =  $(this).closest('tr');
          msg.id= row.find("td.idEquipo").text();
          msg.category = '<?=$GLOBALS['category']?>';

          $.ajax({
              type:'GET',
              url: 'Controller/EquipoController.php',
              data: {data: JSON.stringify(msg), action:'viewAccesories'},
              success: function(response){
                  $('#content').html(response);
              }
          });
      });*/

       //Eliminar equipos
       $('#tblEquipos').on('click', '#btnEliminar', function () {
            const row =  $(this).closest('tr');
            msg.id = row.find("td.idEquipo").text();

            msg.category = '<?=$GLOBALS['category']?>';

            if (confirm('Desea eliminar el registro')) {
                $.ajax({
                    type: 'POST',
                    url: 'Controller/EquipoController.php',
                    data: {data: JSON.stringify(msg), action:'eliminar'},
                    success: function (result) {
                        $.ajax({
                            type:'GET',
                            url: 'Controller/EquipoController.php',
                            data: {data: JSON.stringify(msg), action:'listarEquipos'},
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

      //Actualizar equipos
      $('#tblEquipos').on('click', '#btnActualizar', function () {
            const row =  $(this).closest('tr');
            msg.id= row.find("td.idEquipo").text();

            msg.category = '<?=$GLOBALS['category']?>';

            $.ajax({
                    type: 'GET',
                    url: 'Controller/EquipoController.php',
                    data: {data: JSON.stringify(msg), action:'update'},
                    success: function (result) {
                        $('#content').html(result);
                    },
                    error: function (result) {
                        alert('Ops! No se pudo obtener el registro');
                    }
            });
        });

      //Filtrar por marca
      $("#txtMarca").on('keydown', function (e) {

          const keycode = e.keyCode || e.which;

          if (keycode == 13) {

              const filter = $('#txtMarca').val();

              msg.category = '<?=$GLOBALS['category']?>';

              if(filter != ''){
                  msg.filter = filter;
                  msg.filterType = 'marca';
              }

              $.ajax({
                  type:'POST',
                  url: 'Controller/EquipoController.php',
                  data: {data: JSON.stringify(msg), action: 'filter'},
                  success: function(response){
                      $('#content').html(response);
                  }
              });
          }
      });

      //Filtrar por serie
      $("#txtFiltroSerie").on('keydown', function (e) {

          const  keycode = e.keyCode || e.which;

          if (keycode == 13) {

              const filter = $('#txtFiltroSerie').val();

              msg.category = '<?=$GLOBALS['category']?>';

              if(filter != ''){
                  msg.filter = filter;
                  msg.filterType = 'serie';
              }

              $.ajax({
                  type:'POST',
                  url: 'Controller/EquipoController.php',
                  data: {data: JSON.stringify(msg), action: 'filter'},
                  success: function(response){
                      $('#content').html(response);
                  }
              });

          }
      });

      //Filtro por equipo
      $("#txtEquipo").on('keydown', function (e) {
          const keycode = e.keyCode || e.which;

          if (keycode == 13) {
              const filter = $('#txtEquipo').val();

              msg.category = '<?=$GLOBALS['category']?>';

              if(filter != ''){
                  msg.filter = filter;
                  msg.filterType = 'descripcion';
              }

              $.ajax({
                  type:'POST',
                  url: 'Controller/EquipoController.php',
                  data: {data: JSON.stringify(msg), action: 'filter'},
                  success: function(response){
                      $('#content').html(response);
                  }
              });
          }
      });

      $("#txtDepartamento").on('keydown', function (e) {
          const keycode = e.keyCode || e.which;

          if (keycode == 13) {
              const filter = $('#txtDepartamento').val();

              msg.category = '<?=$GLOBALS['category']?>';

              if(filter != ''){
                  msg.filter = filter;
                  msg.filterType = 'departamento';
              }

              $.ajax({
                  type:'POST',
                  url: 'Controller/EquipoController.php',
                  data: {data: JSON.stringify(msg), action: 'filter'},
                  success: function(response){
                      $('#content').html(response);
                  }
              });
          }
      });

      //Permite filtrar una lista  mediante estados
      $("#cbEstado").on('change', function (e) {

          const filter = $('#cbEstado option:selected').text();

          msg.category = '<?=$GLOBALS['category']?>';

          if(filter != ''){
              msg.filter = filter;
              msg.filterType = 'estado';
          }

          $.ajax({
              type:'POST',
              url: 'Controller/EquipoController.php',
              data: {data: JSON.stringify(msg), action: 'filter'},
              success: function(response){
                  $('#content').html(response);
              }
          });
      });

      //Permite filtrar cada lista mediante un conjunto de opciones
      $('#btnBuscar').click(function (e) {

          const filter_equi = $('#txtEquipo').val();
          const filter_marca = $('#txtMarca').val();
          const filter_serie = $('#txtFiltroSerie').val();
          const filter_dep = $('#txtDepartamento').val();
          const filter_state = $('#cbEstado option:selected').text();

          msg.category = '<?=$GLOBALS['category']?>';


          if(filter_equi != '' && filter_marca == '' && filter_dep == '' && filter_state=='Seleccione un estado' && filter_serie == ''){
              msg.filter = filter_equi;
              msg.filterType = 'descripcion';

          }

          if(filter_equi == '' && filter_marca != '' && filter_dep == '' && filter_state=='Seleccione un estado' && filter_serie == ''){
              msg.filter = filter_marca;
              msg.filterType = 'marca';
          }

          if(filter_equi == '' && filter_marca == '' && filter_dep == '' && filter_state=='Seleccione un estado' && filter_serie != ''){
              msg.filter = filter_serie;
              msg.filterType = 'serie';
          }

          if(filter_equi == '' && filter_marca == '' && filter_dep != '' && filter_state=='Seleccione un estado' && filter_serie == ''){
              msg.filter = filter_dep;
              msg.filterType = 'departamento';
          }

          if(filter_equi == '' && filter_marca == '' && filter_dep == '' && filter_state !='Seleccione un estado' && filter_serie == ''){
              msg.filter = filter_state;
              msg.filterType = 'estado';
          }

          if(filter_equi == '' && filter_marca == '' && filter_dep == '' && filter_state =='Seleccione un estado' && filter_serie == ''){
              msg.filterType = 'empty';
          }

          $.ajax({
              type:'POST',
              url: 'Controller/EquipoController.php',
              data: {data:JSON.stringify(msg), action: 'filter'},
              success: function(response){
                  $('#content').html(response);
              }
          });
      });

      
  })
</script>