<?php
	include("../../../comun.php");
    conectarBD();
?>

<center>
  <div id="divTablaNuevaProfesion">
	<form name="formularioNuevaProfesion" id="formularioNuevaProfesion">
		<table id="tablaNuevaProfesion">
			<thead>

						<h1><label class="text-default" for=""><strong>Poblaciones.</strong></label></h1>

            				<tr class="cabeceraTabla">
                                     <th>Nueva Poblacion</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevaProfesion">
	            <td><input class="form-control" type="text" id="nuevaProfesion" onkeypress="return soloLetrasNumeros(event)" name="nuevaProfesion" ></td>
              <td><input class="btn btn-success" type="button" onclick="guardarNuevaProfesion()" value="Agregar"></td>
      </tr>
    </tbody>
	</table>
</form>
</div>


	 <form name="formularioMantenedorProfesiones" id="formularioMantenedorProfesiones">
        <table class="tablaMantenedorProfesiones">
             <thead>
            				<tr class="cabeceraTabla">
                                      <th>Poblacion</th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php
                   $resultado=$con->query("select * from tb_poblacion order by descripcion_poblacion asc");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" name="'.$contadorFilas.',1"  value="'.$filas['id_poblacion'].'">';
                              echo'<td><input class="form-control" onBlur="guardarCambiosMantenedorProfesiones();" type="text" required name="'.$contadorFilas.',2" value="'.$filas['descripcion_poblacion'].'"></td>';

                              echo'<td><input type="button" class="btn btn-danger" onclick="eliminarProfesion('.$filas['id_poblacion'].')" value="Eliminar" ></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>

             </tbody>
	       </table>
 </form>
</center>
