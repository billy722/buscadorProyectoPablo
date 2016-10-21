<?php
	include("../../../comun.php");
    conectarBD();


?>

  <div id="divTablaNuevoSolicitante">
	<form name="formularioNuevoSolicitante" id="formularioNuevoSolicitante">
		<table id="tablaNuevoSolicitante">
			<caption>Agregar nuevo Solicitante</caption>
			<thead> 
            				<tr class="cabeceraTabla">
                                     <th>Rut Solicitante</th>
                                     <th>Nombre</th>
                                     <th>Apellido Pat.</th>
                                     <th>Apellido Mat.</th>
                                     <th>Direccion</th>
                                     <th>Fecha ncto.</th>
                                     <th>Telefono</th>
                                     <th>Profesion</th>
                                     <th>Tipo</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevoSolicitante">
				<td>  <input class="camposTexto" type="text" placeholder="ej: 11111111-1" onkeypress="return soloNumerosyK(event);" maxlength="10" id="rutSolicitante" name="rutSolicitante" ></td>
                <td>  <input class="camposTexto" type="text" onkeypress="return soloLetras(event)" name="nombreSolicitante" ></td>  
                <td>  <input class="camposTexto" type="text" onkeypress="return soloLetras(event)" name="apellidoPaterno"  ></td>
                <td>  <input class="camposTexto" type="text" onkeypress="return soloLetras(event)" name="apellidoMaterno" ></td>
                <td>  <input class="camposTexto" type="text" onkeypress="return soloLetrasNumeros(event)" name="direccionSolicitante" ></td>
                <td>  <input class="camposFecha" type="date" name="fechaNacimientoSolicitante" ></td>
                <td>  <input class="camposTexto" type="tel" onkeypress="return soloNumeros(event)" name="telefonoSolicitante" ></td>
                                                  <?php
                                                                           echo'
                                                                           <td><select name="profesion">';
                                                                                  $consultaProfesion= 'select * from profesion';
                                                                                  $resultadoProfesion= $con->query($consultaProfesion);

                                                                                  while($filasProfesion= $resultadoProfesion->fetch_array()){

                                                                                    echo'<option value="'.$filasProfesion['idProfesion'].'">';
                                                                                    echo $filasProfesion['descripcionProfesion'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';                           
                                                ?>
                                                  <?php
                                                                           echo'
                                                                           <td><select name="tipoSolicitante">';
                                                                                  $consultaTipoSolicitante= 'select * from tiposolicitante';
                                                                                  $resultadoTipoSolicitante= $con->query($consultaTipoSolicitante);

                                                                                  while($filasTipoSolicitante= $resultadoTipoSolicitante->fetch_array()){

                                                                                    echo'<option value="'.$filasTipoSolicitante['idTipoSolicitante'].'">';
                                                                                    echo $filasTipoSolicitante['descripcion'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';                           
                                                ?>
                                                 
                                              
                <td><input type="button" onclick="guardarNuevoSolicitante()" value="Crear nuevo"></td>
          

			</tr>
		</tbody>	
		</table>	
	</form>	


	 <form name="formularioMantenedorSolicitantes" id="formularioMantenedorSolicitantes">
                <div id="div_botonGuardarMantenedorSolicitantes">
                 
               <!--    <input type="button" onclick="guardarCambiosMantenedorUsuarios()" id="btn_guardarCambiosMantenedorUsuarios" value="GUARDAR CAMBIOS"> -->
                                   
                </div>  

                <table class="tablaMantenedorSolicitantes">		
                  			
		                <thead> 
            				 
                                     <th>Rut Solicitante</th>
                                     <th>Nombre</th>
                                     <th>Apellido Pat.</th>
                                     <th>Apellido Mat.</th>
                                     <th>Direccion</th>
                                     <th>Fecha ncto.</th>
                                     <th>Telefono</th>
                                     <th>Tipo</th>
                                     <th>Estado</th>
                                     <th>Profesion</th>
                                     <th></th>
            				  
                    </thead>
                        <tbody>

                        <?php

                          $filaDistinta=false;//para aplicar color intercalado a las filas
                          $claseFila; // para aplicar color intercalado a las filas
                          $contadorFilas=0; //para identificar las filas

                           	$consulta = "select * from solicitante ";
 							              $resultado = $con->query($consulta);


                          while($filas = $resultado->fetch_array()){
                                $contadorColumnas=1; //para identificar columnas

                             
                             $contadorFilas++;

                                       echo'<tr>';
                                                echo'<td>  <input class="camposTexto" readonly type="text" onkeypress="return soloNumeros(event);"  maxlength="10" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['rut'].'-'.$filas['digitoVerificador'].'" ></td>';
                                                $contadorColumnas++; 
                                                echo'<td>  <input class="camposTexto" onBlur="guardarCambiosMantenedorSolicitantes();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['nombre'].'" ></td>';  
                                                $contadorColumnas++;  
                                                echo'<td>  <input class="camposTexto" onBlur="guardarCambiosMantenedorSolicitantes();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['apellidoPaterno'].'" ></td>'; 
                                                $contadorColumnas++;  
                                                echo'<td>  <input class="camposTexto" onBlur="guardarCambiosMantenedorSolicitantes();" type="text" onkeypress="return soloLetras(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['apellidoMaterno'].'" ></td>'; 
                                              	$contadorColumnas++;  
                                                echo'<td>  <input class="camposTexto" onBlur="guardarCambiosMantenedorSolicitantes();" type="text" onkeypress="return soloLetrasNumeros(event)" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['direccion'].'" ></td>';
                                                $contadorColumnas++;  
                                                echo'<td>  <input class="camposFecha" onBlur="guardarCambiosMantenedorSolicitantes();" type="date" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['fechaNacimiento'].'" ></td>';
                                                $contadorColumnas++;  
                                                echo'<td>  <input onBlur="guardarCambiosMantenedorSolicitantes();" class="camposTexto" type="tel" onkeypress="return soloNumeros(event);" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" value="'.$filas['telefono'].'" ></td>';                            
                                                
                                                $contadorColumnas++;  
                                                                           echo'
                                                                           <td><select onchange="guardarCambiosMantenedorSolicitantes()" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" >';
                                                                                  
                                                                                  $consultaSolicitantes= 'select * from tiposolicitante';
                                                                                  $resultadoSolicitantes= $con->query($consultaSolicitantes);

                                                                                  while($filasSolicitantes = $resultadoSolicitantes->fetch_array()){

                                                                                    echo'<option value="'.$filasSolicitantes['idTipoSolicitante'].'" ';
                                                                                       if($filas['tipo']==$filasSolicitantes['idTipoSolicitante']){echo' selected="selected" >';}else{echo'>';} 
                                                                                    echo $filasSolicitantes['descripcion'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';
                                                $contadorColumnas++;   
                                                                           echo'
                                                                           <td><select onchange="guardarCambiosMantenedorSolicitantes()" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" >';
                                                                                  $consultaEstado= 'select * from estadousuario';
                                                                                  $resultadoEstado= $con->query($consultaEstado);

                                                                                  while($filasEstado = $resultadoEstado->fetch_array()){

                                                                                    echo'<option value="'.$filasEstado['idEstadoUsuario'].'" ';
                                                                                       if($filas['estado']==$filasEstado['idEstadoUsuario']){echo' selected="selected" >';}else{echo'>';} 
                                                                                    echo $filasEstado['descripcion'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';

                                                $contadorColumnas++;
                                                                           echo'
                                                                           <td><select onchange="guardarCambiosMantenedorSolicitantes()" name="'.$contadorFilas.','.$contadorColumnas.'" id="'.$contadorFilas.','.$contadorColumnas.'" >';
                                                                                  $consultaProfesion= 'select * from profesion';
                                                                                  $resultadoProfesion= $con->query($consultaProfesion);

                                                                                  while($filasProfesion= $resultadoProfesion->fetch_array()){

                                                                                    echo'<option value="'.$filasProfesion['idProfesion'].'" ';
                                                                                    if($filas['profesion']==$filasProfesion['idProfesion']){echo' selected="selected" >';}else{echo'>';}
                                                                                    echo $filasProfesion['descripcionProfesion'].' </option>';

                                                                                  }
                                                                           echo'</select></td>';                               
                                                                      

                                                
                            /*limpiar campos*/ echo'<td><input type="button" class="botonEliminarMantenedores" onclick="eliminarSolicitante('.$filas['rut'].')" value="Eliminar"></td>';
                              echo'</tr>';
                                   
                            }

                    //este campo envia la cantidad de filas que hay en la tabla

                    echo'<input type="text" value="'.$contadorFilas.'" style="display:none;" name="cantidadFilas" />';

        					$con->close();
        			 ?> 

                        
                    </tbody>
	             </table>
             </form>	
 