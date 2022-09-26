
	<div class="container-fluid" style="margin-top:0px;" >
        <h3>Filtrar por:</h3>

        <form action="" method="POST"  enctype="multipart/form-data">

            <div>

                <label for="nombres" id="labelnombres">Equipo:</label>
                <input type="text" name="nombres" id="nombres" placeholder="Ejemplo: CAMARA"/>
            </div>


            <div>

                <label for="marca" id="labelmarca">Marca:</label>
                <input type="text" name="marca" id="marca" placeholder="Ejemplo: DELL"/>

            </div>

            <div>

                <label for="departamento" id="labeldepartamento">Departamento:</label>
                <input type="text" name="departamento" id="departamento" placeholder="Ejemplo: Producción"/>
            </div>

            <div>
                <label for="comboestado" id="labelestado">Estado:</label>
                <select name="comboestado" id="estado">
                    <option value="">Seleccione una opción</option>
                    <option value="Almacenado">Almacenado</option>
                    <option value="Averiado">Averiado</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Operativo">Operativo</option>
                    <option value="Optimo">Óptimo</option>
                </select>

            </div>

            <div class="d-felx justify-content-center">
                <button class="btn btn-success" type="submit" style="margin-top: 25px;">Consultar</button>
            </div>


        </form>


    </div>
    <br/>