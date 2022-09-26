	<link rel="shorcut icon" href="img/bat.ico" type="image/x-icon"/>
	<form action="" method="POST" id="formpersonas" enctype="multipart/form-data">
		<fieldset id="fieldsetdatosgenerales">
			<legend id="legend_datosgenerales">Datos Generales</legend>
			<label for="nombres" id="labelnombres">Nombres:</label>
			<input type="text" name="nombres" id="inputnombres" value="<?= $nombres ?>" />
			<label for="propietario" id="labelpropietario">Propietario:</label>
			<input type="text" name="propietario" id="inputpropietario" value="<?= $propietario ?>" />
			<label for="email" id="labelemail">Email:</label>
			<input type="text" name="email" id="inputemail" value="<?= $email ?>" />
			<label for="miembros" id="labelmiembros">Miembros:</label>
			<select name="miembros" id="combomiembros">
				<option value="">Seleccione una opción</option>
				<option value="1"<?php if($miembros == '1'){ echo 'selected';} ?>>1 Persona</option>
				<option value="2"<?php if($miembros == '2'){ echo 'selected';} ?>>2 Personas</option>
				<option value="3"<?php if($miembros == '3'){ echo 'selected';} ?>>3 Personas</option>
				<option value="4"<?php if($miembros == '4'){ echo 'selected';} ?>>4 Personas</option>
				<option value="5"<?php if($miembros == '5'){ echo 'selected';} ?>>5 Personas</option>
				<option value="6"<?php if($miembros == '6'){ echo 'selected';} ?>>6 Personas</option>
			</select>
		</fieldset>

		<fieldset id="fieldsetdatoscomerciales">
			<legend id="legend_datosgenerales">Datos Adicionales</legend>
			<label for="estado" id="labelestado">Estado:</label>
			<select name="estado" id="comboestado">
				<option value="">Seleccione una opción</option>
				<option value="Habitada"<?php if($estado == 'Habitada'){ echo 'selected';} ?>>Habitada</option>
				<option value="Deshabitada"<?php if($estado == 'Deshabitada'){ echo 'selected';} ?>>Deshabitada</option>
				<option value="En construccion"<?php if($estado == 'En construccion'){ echo 'selected';} ?>>En construccion</option>
			</select>
			<label for="lote" id="labellote">Lote:</label>
			<input type="text" name="lote" id="inputlote" value="<?= $lote ?>" />
			<label for="cant_vehicles" id="labelcant_vehicles">No. Vehiculos:</label>
			<input type="text" name="cant_vehiculos" id="inputcant_vehicles" placeholder="numeros solamente" value="<?= $cant_vehiculos ?>" />
			<label for="tipo_vehiculo" id="labeltipo_vehicle">Tipo de vehiculo:</label>
			<select name="tipo_vehiculo" id="combovehicles">
				<option value="">Seleccione una opción</option>
				<option value="Motocicleta"<?php if($tipo_vehiculo == 'Motocicleta'){ echo 'selected';} ?>>Motocicleta</option>
				<option value="Automovil"<?php if($tipo_vehiculo == 'Automovil'){ echo 'selected';} ?>>Automovil</option>
				<option value="Camioneta"<?php if($tipo_vehiculo == 'Camioneta'){ echo 'selected';} ?>>Camioneta</option>
				<option value="SUV"<?php if($tipo_vehiculo == 'SUV'){ echo 'selected';} ?>>SUV</option>
				<option value="Otros"<?php if($tipo_vehiculo == 'Otros'){ echo 'selected';} ?>>Otros</option>
			</select>

			<fieldset id="fieldsetdatoscontacto">
				<legend id="legend_datoscontacto">Datos de Contacto</legend>
				<label for="placas_vehiculo" id="labelplacas">Placas vehiculo:</label>
				<input type="text" name="placas_vehiculo" id="inputplacas" placeholder="Ejemplo: PBD-3421" value="<?= $placas_vehiculo ?>" />
				<label for="numero_fijo" id="labeltelffijo">Telefono Fijo:</label>
				<input type="text" name="numero_fijo" id="inputtelffijo" placeholder="numeros solamente" value="<?= $numero_fijo ?>" />
				<label for="numero_movil" id="labeltelfmovil">Telefono Movil:</label>
				<input type="text" name="numero_movil" id="inputtelfmovil" placeholder="numeros solamente" value="<?= $numero_movil ?>" />
				<label for="cant_ninos" id="labelcantninos">No. Niños:</label>
				<input type="text" name="cant_ninos" id="inputcantninos" placeholder="numeros solamente" value="<?= $cantninos ?>" />
			</fieldset>	
			
		</fieldset>
		<input type="submit" value="<?php if(isset($_GET['editar'])) echo 'Actualizar Persona'; else echo 'Ingresar Persona'; ?>" class="submitingresocliente2" />
		<input class="clearcliente2" type="button" value="Restablecer Campos" onclick="location='lessees_in.php'"/>

	</form>