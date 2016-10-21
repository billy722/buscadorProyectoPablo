<?php
	include("../../../comun.php");
    conectarBD();


?>
<center>
  <div id="divTablaNuevoMotivo">
	<form name="formularioNuevoMotivo" id="formularioNuevoMotivo">
		<table id="tablaNuevoMotivo">
			<thead>
						<h1><label class="text-default" for=""><strong>Grupo Privilegios.</strong></label></h1>
            				<tr class="cabeceraTabla">
                                     <th>Equipo</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevoUsuario">
	            <td><input class="form-control" type="text" onkeypress="return soloLetrasNumeros(event)" id="nombreMotivo" name="nombreMotivo" ></td>
              <td><input class="btn btn-success" type="button" onclick="guardarNuevoMotivo()" value="Crear nuevo"></td>
      </tr>
    </tbody>
	</table>
</form>
</div>


	 <form name="formularioMantenedorMotivos" id="formularioMantenedorMotivos">
        <table class="tablaMantenedorMotivos">
             <thead>
            				<tr class="cabeceraTabla">
                                      <th>Equipo</th>
                                      <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php
                   $resultado=$con->query("select * from tb_equipofutbol order by descripcion_equipo");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" readonly name="'.$contadorFilas.',1"  value="'.$filas['id_equipo'].'">';
                              echo'<td><input class="form-control" onBlur="guardarCambiosMantenedorMotivos()" type="text" name="'.$contadorFilas.',2" onkeypress="return soloLetras(event)" value="'.$filas['descripcion_equipo'].'"></td>';

                              echo'<td><select class="form-control" onchange="guardarCambiosMantenedorMotivos()" name="'.$contadorFilas.',3">';

                                                                                  $consultaEstado= 'select * from estados';
                                                                                  $resultadoEstado= $con->query($consultaEstado);

                                                                                  while($filasEstado = $resultadoEstado->fetch_array()){

                                                                                    echo'<option value="'.$filasEstado['id_estado'].'" ';
                                                                                       if($filas['estado']==$filasEstado['id_estado']){echo' selected="selected" >';}else{echo'>';}
                                                                                    echo $filasEstado['descripcion_estado'].' </option>';

                                                                                  }
                                                                        echo'</select></td>';
                              echo'<td><input type="button" class="btn btn-danger" onclick="eliminarMotivo('.$filas['id_equipo'].')" value="Eliminar" ></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>

             </tbody>
	       </table>
 </form>
</center>
