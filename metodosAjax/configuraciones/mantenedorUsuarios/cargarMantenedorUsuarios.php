<?php
	include("../../../comun.php");
    conectarBD();


?>
<div id="contenedorMantenedorUsuario" >

	<div class="container row" id="divTablaNuevoUsuario">
		<form name="formularioNuevoUsuario" id="formularioNuevoUsuario">
			<table id="tablaNuevoUsuario">
				<caption><h1 class="text text-primary">Crear nuevo usuario</h1></caption>
				<thead>
            				<tr class="">
                                     <th>Run usuario</th>
                                     <th>Nombre</th>
                                     <th>Apellido P</th>
                                     <th>Apellido M</th>
                                     <th>Contraseña</th>
                                     <th>Correo</th>
                                     <th>Telefono</th>
                                     <th>Privilegios</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevoUsuario">
				<td>  <input class="form-control camposTexto" type="text" onkeypress="return soloNumerosyK(event);" maxlength="10" id="rutUsuario" name="rutUsuario" ></td>
                <td>  <input class="form-control camposTexto" type="text" onkeypress="return soloLetras(event)" name="nombreUsuario" ></td>
                <td>  <input class="form-control camposTexto" type="text" onkeypress="return soloLetras(event)" name="apellidoPaterno"  ></td>
                <td>  <input class="form-control camposTexto" type="text" onkeypress="return soloLetras(event)" name="apellidoMaterno" ></td>
                <td>  <input class="form-control camposTexto" type="text" onkeypress="return soloLetrasNumeros(event)" name="contraseniaUsuario" ></td>
                <td>  <input class="form-control camposTexto" type="text" placeholder="ejemplo@ejm.cl" onkeypress="" name="correoUsuario" ></td>
                <td>  <input class="form-control camposTexto" type="tel" onkeypress="return soloNumeros(event);" name="telefonoUsuario"></td>
                                                <?php
                                                                           echo'<td><select class="form-control" name="grupoUsuario" >';
                                                                                  $consultaGrupos= 'select * from tb_grupousuario';
                                                                                  $resultadoGrupo= $con->query($consultaGrupos);

                                                                                  while($filasGrupo = $resultadoGrupo->fetch_array()){

                                                                                    echo'<option value="'.$filasGrupo['id_grupoUsuario'].'">';
                                                                                    echo $filasGrupo['descripcion_grupoUsuario'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';

                                                ?>


                            					<td><input type="button" class="btn btn-success" onclick="guardarNuevoUsuario()" value="Nuevo"></td>
                                            </tr>

			</tr>
		</tbody>
		</table>
	</form>
</div>


	 <form name="formularioMantenedorUsuarios" id="formularioMantenedorUsuarios">
                <div id="div_botonGuardarMantenedorUsuario">

               <!--    <input type="button" onclick="guardarCambiosMantenedorUsuarios()" id="btn_guardarCambiosMantenedorUsuarios" value="GUARDAR CAMBIOS"> -->

                </div>

                <table>
										<caption><h1 class="text text-primary">Usuario existentes</h1></caption>
		                <thead>
            				<tr class="cabeceraTabla">
                                     <th>Run usuraio</th>
                                     <th>DV</th>
                                     <th>Nombre</th>
                                     <th>Apellido p</th>
                                     <th>Apellido m</th>
                                     <th>Contraseña</th>
                                     <th>Correo</th>
                                     <th>Telefono</th>
                                     <th>Privilegios</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>

                        <?php

                           	$consulta = "select * from tb_usuarios order by nombre";
 							              $resultado = $con->query($consulta);


                          $contadorFilas=0;
                          while($filas = $resultado->fetch_array()){
                              $contadorFilas++;
                              $contadorColumnas=1;


                                                echo'<td>  <input class="form-control camposTexto" readonly type="text" onkeypress="return soloNumeros(event);"  maxlength="10" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['run'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input class="form-control camposTextoPequeno" readonly type="text" onkeypress="return soloNumerosyK(event);" maxlength="1" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['dv'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input class="form-control camposTexto" onBlur="guardarCambiosMantenedorUsuarios();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['nombre'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input class="form-control camposTexto" onBlur="guardarCambiosMantenedorUsuarios();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['apellidoPaterno'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input class="form-control camposTexto" onBlur="guardarCambiosMantenedorUsuarios();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['apellidoMaterno'].'" ></td>';
                                              	$contadorColumnas++;
                                                echo'<td>  <input class="form-control camposTexto" onBlur="guardarCambiosMantenedorUsuarios();" type="text" onkeypress="return soloLetrasNumeros(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['password'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input onBlur="guardarCambiosMantenedorUsuarios();" class="form-control camposTexto" type="text" onkeypress="" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['correo'].'" ></td>';
                                                $contadorColumnas++;
                                                echo'<td>  <input onBlur="guardarCambiosMantenedorUsuarios();" class="form-control camposTexto" type="tel" onkeypress="return soloNumeros(event);" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['telefono'].'" ></td>';
                                                $contadorColumnas++;
                                                                           echo'
                                                                           <td><select class="form-control" onchange="guardarCambiosMantenedorUsuarios()" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" >';
                                                                                  $consultaGrupos= 'select * from tb_grupousuario';
                                                                                  $resultadoGrupo= $con->query($consultaGrupos);

                                                                                  while($filasGrupo = $resultadoGrupo->fetch_array()){

                                                                                    echo'<option value="'.$filasGrupo['id_grupoUsuario'].'" ';
                                                                                       if($filas['id_grupoUsuario']==$filasGrupo['id_grupoUsuario']){echo' selected="selected" >';}else{echo'>';}
                                                                                    echo $filasGrupo['descripcion_grupoUsuario'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';

                            /*limpiar campos*/ echo'<td><input type="button" class="btn btn-danger" onclick="eliminarUsuario('.$filas['run'].')" value="Eliminar"></td>';
                                              echo'</tr>';

                            }

                    //este campo envia la cantidad de filas que hay en la tabla
                    echo'<input type="hidden" value="'.$contadorFilas.'" id="cantidadFilas" name="cantidadFilas" >';

        					$con->close();
        			 ?>


                    </tbody>
	             </table>
             </form>
</div>
