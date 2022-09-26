	<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
	<form action="" method="POST" id="formlistaequipos" enctype="multipart/form-data">
		<fieldset id="fieldsetequipos">
			<legend id="legend_consultabusqueda"> Listar por </legend>
			
			<label for="nombres" id="labelnombres">Nombre:</label>
			<input type="text" name="nombres" id="nombres" placeholder="Ejemplo: TRIPODE o CAMARA" />

			<label for="comboestado" id="labelestado">Estado:</label>
			<select name="comboestado" id="estado">
				<option value="">Seleccione una opción</option>
				<option value="Averiado">Averiado</option>
				<option value="Obsoleto">Obsoleto</option>
				<option value="Operativo">Operativo</option>
				<option value="Almacenado">Almacenado</option>
			</select>

			<label for="combodisponible" id="labeldisponible">Disponibilidad:</label>
			<select name="combodisponible" id="disponible">
				<option value="">Seleccione una opción</option>
				<option value="1">Disponible</option>
				<option value="2">Ocupado</option>
			</select>

			<label for="comboresponsable" id="labelresponsable">Responsable:</label>
			<select name="comboresponsable" id="responsable">
				<option value="">Seleccione una opción</option>
				<?php
				include 'config.php';
				$sql111 = "SELECT DISTINCT responsable from equipos ORDER BY responsable ASC";
				@ $link111 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
                if (!$link111) {
                    header('Location: ' . PAGINA_ERROR);
                    die;
                }
				$rs111 = mysqli_query($link111, $sql111);
                mysqli_close($link111);
                while ($row111 = mysqli_fetch_assoc($rs111)){
                	//if($wh != $row2['lote']){
           	       		echo "<option value='{$row111['responsable']}'>{$row111['responsable']}</option>";
           	       	//}	
                }
			?>
			</select>					
			
		</fieldset>

		<!--<input type="submit" value="Ingresar Equipamiento" id="agregar" />
		<input type="reset" value="Restablecer Campos" id="restablecer" />-->
		<input type="submit" value="Consultar filtros" class="submitlistado2" />
		<input class="clearlistado" type="button" value="Listar toda la base" onclick="location='equipment_list2.php'"/>
		<!--<input type="reset" value="Restablecer Campos" class="clear" />-->

	</form>