<?php
include("./comun.php");
conectarBD();

	$run= $_REQUEST['run'];

 	$consulta="select * from vistasospechoso where solorrun=".$run;
 	$resultado= $con->query($consulta);

 	while($filas= $resultado->fetch_array()){
 		echo '<div class="" style="padding:10px;">';
 			echo'<input type="button" class=" btn btn-danger pull-left botonCerrarInformacion" value="Cerrar" onclick="ocultarInformacionEmergente()" />';

 			echo '
			<div class="row col-xs-12 ">
				<table class="table table-bordered " id="tablaInformacionSospechoso">

			 		<tbody>

			 			<tr>
			 				<td><strong>Run:</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['run'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Nombre:</strong></td>
			 				<td class="text-uppercase"><input class="form-control" type="text" readonly value="'.$filas['nombre'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Lugar Nacimiento:</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['lugar_deNacimiento'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Sexo</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['descripcion_sexo'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Estado Civil:</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['descripcion_estadoCivil'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Antecedentes Penales:</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['antecedentes'].'" ></td>
			 			</tr>
			 			<tr>
			 				<td><strong>Fecha Nacimiento:</strong></td>
			 				<td><input class="form-control" type="text" readonly value="'.$filas['fecha_nacimiento'].'" ></td>
			 			</tr>
						<tr>
			 				<td><strong>Delitos Cometidos:</strong></td>
			 				<td><input class="form-control" type="text" readonly  ></td>
			 			</tr>

			 		</tbody>

			 </table>
			</div>';


			 echo' <div class="col-xs-12" id="fotosInformacionSospechoso">';

 				$consulta2="select * from tb_imagen
				inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
				where run_sospechoso=".$run;
				//echo $consulta2;
				$resultado2= $con->query($consulta2);

				while($filas2= $resultado2->fetch_array()){

					echo'<div class="container col-xs-12 col-sm-12 col-ms-6 col-lg-4" id="cuadroSospechosoEnInformacion"
					 style="background-image: url(\'../imagenes/'.$filas2['nombre_imagen'].'\');
						background-size: cover;
						background-position: center;" >

						</div>';
				}

			 echo'</div>
			 </div>';
 	}

 ?>
