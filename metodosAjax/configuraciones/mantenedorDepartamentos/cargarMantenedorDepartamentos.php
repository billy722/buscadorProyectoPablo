<?php
	include("../../../comun.php");
    conectarBD();


?>
<div class="center-block" id="contenedorMantenedorDelitos">

<center>
  <div class="center-block" id="divTablaNuevoDepartamento">
	<form name="formularioNuevoDepartamento" id="formularioNuevoDepartamento">
		<table id="table tablaNuevoDepartamento">
			<thead>
											 	<h1><label class="text-default" for=""><strong>Delitos.</strong></label></h1>
            				<tr class="cabeceraTabla">
                                     <th>Nuevo Delito</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevoUsuario">
	            <td><input class="form-control" type="text" onkeypress="return soloLetrasNumeros(event)" id="nombreDepartamento" name="nombreDepartamento" ></td>
              <td><input class="btn btn-success" type="button" onclick="guardarNuevoDepartamento()" value="Crear nuevo"></td>
      </tr>
    </tbody>
	</table>
</form>
</div>


	 <form name="formularioMantenedorDepartamento" id="formularioMantenedorDepartamento">
        <table class="tablaMantenedorDepartamento">
             <thead>
            				<tr class="cabeceraTabla">
                                      <th>Nombre</th>
                                      <th>Estado</th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php
                   $resultado=$con->query("select * from tb_delito ORDER BY descripcion_delito");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" name="'.$contadorFilas.',1"  value="'.$filas['id_delito'].'">';
                              echo'<td><input class="form-control" onBlur="guardarCambiosMantenedorDepartamento();" type="text" name="'.$contadorFilas.',2" onkeypress="return soloLetras(event)" value="'.$filas['descripcion_delito'].'"></td>';

                                                                        echo'<td><select class="form-control" onchange="guardarCambiosMantenedorDepartamento()" name="'.$contadorFilas.',3">';
                                                                                  $consultaEstado= 'select * from estados';
                                                                                  $resultadoEstado= $con->query($consultaEstado);

                                                                                  while($filasEstado = $resultadoEstado->fetch_array()){

                                                                                    echo'<option value="'.$filasEstado['id_estado'].'" ';
                                                                                       if($filas['estado']==$filasEstado['id_estado']){echo' selected="selected" >';}else{echo'>';}
                                                                                    echo $filasEstado['descripcion_estado'].' </option>';

                                                                                  }
                                                                        echo'</select></td>';
                              echo'<td><input type="button" class="btn btn-danger" onclick="eliminarDepartamento('.$filas['id_delito'].')" value="Eliminar" ></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>

             </tbody>
	       </table></center>
 </form>
</div>
