<?php
	include("../../../comun.php");
    conectarBD();


?>

<div  id="contenedorManetenedorGrupo">

	  <div id="divTablaNuevoGrupo">
		<form name="formularioNuevoGrupo" id="formularioNuevoGrupo">
			<table >
				<thead>
											<tr>
												<td>
													<h1><label class="text-default" for=""><strong>Grupo Privilegios.</strong></label></h1>
												</td>
											</tr>
		            				<tr class="cabeceraTabla">
		                                     <th>Nombre del nuevo grupo</th>
		                                     <th></th>
		            				</tr>
		                        </thead>
		                        <tbody>
					<tr class="filasTablaAgregarNuevoUsuario">
			            <td><input type="text" class="form-control" onkeypress="return soloLetrasNumeros(event)" id="nombreGrupo" name="nombreGrupo" ></td>
		              <td><button class="btn btn-success" type="button" onclick="guardarNuevoGrupo()" >Nuevo</button></td>
		      </tr>
		    </tbody>
			</table>
		</form>
	</div>

	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table >
             <thead>
            				<tr class="cabeceraTabla">
                                      <th>Nombre</th>
                                     <th></th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php
                   $resultado=$con->query("select * from tb_grupousuario");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" name="'.$contadorFilas.',1"  value="'.$filas['id_grupoUsuario'].'">';
                              echo'<td><input class="form-control" onBlur="guardarCambiosMantenedorGrupo();" type="text" name="'.$contadorFilas.',2" onkeypress="return soloLetras(event)" value="'.$filas['descripcion_grupoUsuario'].'"></td>';

                              echo'<td><input class="btn btn-primary" type="button" onclick="seleccionarGrupo('.$filas['id_grupoUsuario'].')" value="Privilegios" ></td>';

                              echo'<td><button class="btn btn-danger botonEliminarMantenedores" onclick="eliminarGrupo('.$filas['id_grupoUsuario'].')" >X</button></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>

             </tbody>
	       </table>
 </form>
 </div>
