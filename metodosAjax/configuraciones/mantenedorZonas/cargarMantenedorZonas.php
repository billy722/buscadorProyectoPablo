<?php
	include("../../../comun.php");
    conectarBD();


?>

  <div id="divTablaNuevoGrupo">
	<form name="formularioNuevoGrupo" id="formularioNuevoGrupo">
		<table id="tablaNuevoGrupo">
			<thead>
								<h1><label class="text-default" for=""><strong>Zonas.</strong></label></h1>
            				<tr class="cabeceraTabla">
                                     <th>Nombre de nueva Zona</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevoUsuario">
	            <td><input class="form-control" type="text" onkeypress="return soloLetrasNumeros(event)" id="nombreGrupo" name="nombreGrupo" ></td>
              <td><input class="btn btn-success" type="button" onclick="guardarNuevaZona()" value="Crear nuevo"></td>
      </tr>
    </tbody>
	</table>
</form>
</div>


	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table class="tablaMantenedorGrupo">
             <thead>
            				<tr class="cabeceraTabla">
                                      <th>Nombre</th>
                                     <th></th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php
                   $resultado=$con->query("select * from tb_zona order by descripcion_zona");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" name="'.$contadorFilas.',1"  value="'.$filas['id_zona'].'">';

                              echo'<td><input class="form-control" onBlur="guardarCambiosMantenedorZonas();" type="text" name="'.$contadorFilas.',2" onkeypress="return soloLetrasNumeros(event)" value="'.$filas['descripcion_zona'].'"></td>';

                              echo'<td><input class="btn btn-primary" type="button" onclick="seleccionarZona('.$filas['id_zona'].')" value="Poblaciones" ></td>';

                              echo'<td><input type="button" class="btn btn-danger" onclick="eliminarZona('.$filas['id_zona'].')" value="x" ></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>

             </tbody>
	       </table>
 </form>
