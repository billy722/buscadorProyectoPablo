<?php
	include("./comun.php");
	conectarBD();
	cargarEncabezado();


	if(isset($_REQUEST['correcto'])){
			ECHO'<script type="text/javascript">
				alert("GUARDADO CORRECTAMENTE");
			</script>';
	}



 ?>



<div id="contenedorFormularios" class="container" >

	<form id="form2" name="form2" method="POST" action="ingresar.php" enctype="multipart/form-data">
	<div class="container row">

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" id="tablaIngresoSospechoso">
		<table>
			<thead>
					<th colspan="2" class="text-primary text-center"><strong>Mantenedor sospechoso</strong></th>
			</thead>
			<tbody>

				<tr>
					<td><strong>Run</strong></td>
					<td><input class="form-control" name="run" placeholder="12345678-1"type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Nombre</strong></td>
					<td><input class="form-control" name="nombre" type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Apellido Paterno</strong></td>
					<td><input class="form-control" name="apellidoPaterno" type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Apellido Materno</strong></td>
					<td><input class="form-control" name="apellidoMaterno" type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Fecha Nacimiento</strong></td>
					<td><input class="form-control" name="edad" type="date"></input></td>
				</tr>
				<tr>
					<td><strong>Apodos</strong></td>
					<td><input class="form-control" name="apodo" type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Lugar Nacimiento</strong></td>
					<td><input class="form-control" name="lugarNacimiento" type="text"></input></td>
				</tr>
				<tr>
					<td><strong>Estatura(cm)</strong></td>
					<td><input class="form-control" name="estatura" type="number" min="0"></input></td>
				</tr>
				<tr>
					<td><strong>Color Pelo</strong></td>
					<td>
						<select class="form-control" name="colorPelo">
							<?php
								$resultado = $con->query("select * from tb_colorpelo");
								while ($filas= $resultado->fetch_array()) {
									echo'<option value="'.$filas['id_colorPelo'].'">'.$filas['descripcion_colorPelo'].'</option>';
								}
							 ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Contextura</strong></td>
					<td><select class="form-control" name="contextura">
						<?php
							$resultado = $con->query("select * from tb_contextura");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_contextura'].'">'.$filas['descripcion_contextura'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Estado Civil</strong></td>
					<td><select class="form-control" name="estadoCivil">
						<?php
							$resultado = $con->query("select * from tb_estadoCivil");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_estadoCivil'].'">'.$filas['descripcion_estadoCivil'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Sexo</strong></td>
					<td><select class="form-control" name="sexo">
						<?php
							$resultado = $con->query("select * from tb_sexo");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_sexo'].'">'.$filas['descripcion_sexo'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tez De Piel</strong></td>
					<td><select class="form-control" name="tezPiel">
						<?php
							$resultado = $con->query("select * from tb_tezpiel");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_tezPiel'].'">'.$filas['descripcion_tezPiel'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tipo de Ojos</strong></td>
					<td><select class="form-control" name="tipoOjos">
						<?php
							$resultado = $con->query("select * from tb_colorojos");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_colorOjos'].'">'.$filas['descripcion_colorOjos'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tipo de Pelo</strong></td>
					<td><select class="form-control" name="tipoPelo">
						<?php
							$resultado = $con->query("select * from tb_tipopelo");
							while($filas = $resultado->fetch_array()){
								echo '<option value="'.$filas['id_tipoPelo'].'">'.$filas['descripcion_tipoPelo'].'</option>';
							}
						 ?>
					</select></td>
				</tr>
						<tr>
		 					<td><label>Acne</label></td>
		 					<td>
		 						<input type="radio" value="1" name="acne" id="acne1"><label for="acne1">Si</label>
		 						<input type="radio" value="2" name="acne" id="acne2"><label for="acne2">No</label>
		 						<input type="radio" value="0" name="acne" id="acne3" checked="cheked"><label for="acne3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Barba</label></td>
		 					<td>
		 						<input type="radio" value="1" name="barba" id="barba1"><label for="barba1">Si</label>
		 						<input type="radio" value="2" name="barba" id="barba2"><label for="barba2">No</label>
		 						<input type="radio" value="0" name="barba" id="barba3" checked="cheked"><label for="barba3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Bigote</label></td>
		 					<td>
		 						<input type="radio" value="1" name="bigote" id="bigote1"><label for="bigote1">Si</label>
		 						<input type="radio" value="2" name="bigote" id="bigote2"><label for="bigote2">No</label>
		 						<input type="radio" value="0" name="bigote" id="bigote3" checked="cheked"><label for="bigote3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Manchas</label></td>
		 					<td>
		 						<input type="radio" value="1" name="manchas" id="manchas1"><label for="manchas1">Si</label>
		 						<input type="radio" value="2" name="manchas" id="manchas2"><label for="manchas2">No</label>
		 						<input type="radio" value="0" name="manchas" id="manchas3" checked="cheked"><label for="manchas3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Lentes</label></td>
		 					<td>
		 						<input type="radio" value="1" name="lentes" id="lentes1"><label for="lentes1">Si</label>
		 						<input type="radio" value="2" name="lentes" id="lentes2"><label for="lentes2">No</label>
		 						<input type="radio" value="0" name="lentes" id="lentes3" checked="cheked"><label for="lentes3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Pecas</label></td>
		 					<td>
		 						<input type="radio" value="1" name="pecas" id="pecas1"><label for="pecas1">Si</label>
		 						<input type="radio" value="2" name="pecas" id="pecas2"><label for="pecas2">No</label>
		 						<input type="radio" value="0" name="pecas" id="pecas3" checked="cheked"><label for="pecas3">Sin especificar</label>
		 					</td>
		 				</tr>
						<tr>
		 					<td><label>Antecedentes</label></td>
		 					<td>
		 						<input type="radio" value="1" name="antecedentes" id="antecedentes1"><label for="antecedentes1">Si</label>
		 						<input type="radio" value="2" name="antecedentes" id="antecedentes2"><label for="antecedentes2">No</label>
		 						<input type="radio" value="0" name="antecedentes" id="antecedentes3" checked="cheked"><label for="antecedentes3">Sin especificar</label>
		 					</td>
		 				</tr>

				</tbody>
			</table>
		</div>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" id="divDdelitosIngreso">
				 		<table class="">
				 			<thead>
				 				<th class="text-primary text-center"><strong>DELITOS</strong></th>
				 			</thead>
				 			<tbody>
				 		<?php
				 			$resultado= $con->query("select * from tb_delito");
				 				$contadorDelitos=0;

				 				while($filas= $resultado->fetch_array()){
				 						$contadorDelitos++;
				 						echo'<tr>
				 								<td><input class="" type="checkbox" value="'.$filas['id_delito'].'" name="delito'.$filas['id_delito'].'" /><label class="text-capitalize" for="'.$filas['id_delito'].'" >'.$filas['descripcion_delito'].'</label>
				 								</td>
				 							 </tr>';
				 				}
				 				echo'<input type="hidden" value="'.$contadorDelitos.'" name="contadorDelitos" >';
				 		?>
				 			</tbody>
				 		</table>
				 	</div>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" id="divFotos">

 						<div class="content" id="divSuperiorSubirImagenes">
 							</br>
 							<label>Imagenes</label>
 									<input type="file" class="form-control" id="images" name="images[]" />
 									<br>
 									<button id="btnSubmit" class=" btn btn-default">Subir archivo</button>
 									<ul id="lista-imagenes">

 									</ul>
 									<div class="clearfix"></div>
 									<div id="response"></div>
 							</div>
 						<hr>
 					<div class="content" id="divInferiorImagenesActuales">
 						 <label>Imagenes Actuales</label>
 						 <div id="divListaImagenes" class="content"></div>


 					</div>
 				</div>
	<!--</div> CIERRE PRIMERA FILA
	<div class="container row">-->

				 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 " id="divEquiposIngreso">
				 		<table>
				 			<thead>
				 				<th class="text-primary text-center"><strong>EQUIPO SIMPATIZANTE</strong></th>
				 			</thead>
				 			<tbody>
				 		<?php
				 			$resultado= $con->query("select * from tb_equipofutbol");
				 				$contadorEquiposFutbol=0;
				 				while($filas= $resultado->fetch_array()){
				 						$contadorEquiposFutbol++;
				 						echo'<tr>
				 								<td><input type="checkbox" value="'.$filas['id_equipo'].'" name="equipo'.$filas['id_equipo'].'" /><label for="'.$filas['id_equipo'].'" >'.$filas['descripcion_equipo'].'</label>
				 								</td>
				 							 </tr>';
				 				}
				 				echo'<input type="hidden" value="'.$contadorEquiposFutbol.'" name="contadorEquiposFutbol" >';
				 		?>
				 			</tbody>
				 		</table>
				 	</div>

				 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divCicatrizTatuajePiercingIngreso">

				 			<div id="divCicatriz">
						 		<table>
						 			<thead>
						 				<th class="text-primary text-center"><strong>CICATRIZ</strong></th>
						 			</thead>
						 			<tbody>
						 		<?php
						 			$resultado= $con->query("select * from tb_cicatriz");
						 				$contadorOpcionesCicatriz=0;
						 				while($filas= $resultado->fetch_array()){
						 						$contadorOpcionesCicatriz++;
						 						echo'<tr>
						 								<td><input type="checkbox" value="'.$filas['id_lugarCicatriz'].'" name="cicatriz'.$filas['id_lugarCicatriz'].'" /><label for="'.$filas['id_lugarCicatriz'].'" >'.$filas['descripcion_lugarCicatriz'].'</label>
						 								</td>
						 							 </tr>';
						 				}
						 				echo'<input type="hidden" value="'.$contadorOpcionesCicatriz.'" name="contadorOpcionesCicatriz" >';
						 		?>
						 			</tbody>
						 		</table>
						 	</div>

						 	<div id="divTatuaje">
						 		<table>
						 			<thead>
						 				<th class="text-primary text-center"><strong>-TATUEJE</strong></th>
						 			</thead>
						 			<tbody>
						 		<?php
						 			$resultado= $con->query("select * from tb_tatuaje");
						 				$contadorOpcionesTatuaje=0;
						 				while($filas= $resultado->fetch_array()){
						 						$contadorOpcionesTatuaje++;
						 						echo'<tr>
						 								<td><input type="checkbox" value="'.$filas['id_lugarTatuaje'].'" name="tatuaje'.$filas['id_lugarTatuaje'].'" /><label for="'.$filas['id_lugarTatuaje'].'" >'.$filas['descripcion_lugarTatuaje'].'</label>
						 								</td>
						 							 </tr>';
						 				}
						 				echo'<input type="hidden" value="'.$contadorOpcionesTatuaje.'" name="contadorOpcionesTatuaje" >';
						 		?>
						 			</tbody>
						 		</table>
						 	</div>

						 	<div id="divPiercing">
						 		<table>
						 			<thead>
						 				<th class="text-primary text-center"><strong>-PIERCING</strong></th>
						 			</thead>
						 			<tbody>
						 		<?php
						 			$resultado= $con->query("select * from tb_piercing");
						 				$contadorOpcionesPiercing=0;
						 				while($filas= $resultado->fetch_array()){
						 						$contadorOpcionesPiercing++;
						 						echo'<tr>
						 								<td><input type="checkbox" value="'.$filas['id_lugarPiercing'].'" name="piercing'.$filas['id_lugarPiercing'].'" /><label for="'.$filas['id_lugarPiercing'].'" >'.$filas['descripcion_lugarPiercing'].'</label>
						 								</td>
						 							 </tr>';
						 				}
						 				echo'<input type="hidden" value="'.$contadorOpcionesPiercing.'" name="contadorOpcionesPiercing" >';
						 		?>
						 			</tbody>
						 		</table>
						 	</div>
				 	</div>

				 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divZonasIngreso">
				 		<table>

				 			<thead>
					 			<th class="text-primary text-center"><strong>POBLACION DONDE OPERA</strong></th>
				 			</thead>
				 			<tbody>
				 		<?php
				 			$resultado= $con->query("SELECT * FROM tb_poblacion");
				 				$contadorPoblaciones=0;

				 				while($filas= $resultado->fetch_array()){
				 						$contadorPoblaciones++;
				 						echo'<tr>
				 								<td><input type="checkbox" value="'.$filas['id_poblacion'].'" name="poblacion'.$filas['id_poblacion'].'" /><label for="'.$filas['id_poblacion'].'" >'.$filas['descripcion_poblacion'].'</label>
				 								</td>
				 							 </tr>';
				 				}
				 				echo'<input type="hidden" value="'.$contadorPoblaciones.'" name="contadorPoblaciones" >';
				 		?>
				 			</tbody>
				 		</table>
				 	</div>

				 	<div class="col-xs-12 col-sm-6 col-md-12 col-lg-3" id="divBotonGuardar">
						<td>
							<button class="btn btn-primary botonGrabarSospechoso" type="submit"><h4>GUARDAR</h4></button>
						</td>
				 	</div>

			</form>
		</div>
	</div>

		<script src="./js/subirImagenSospechoso.js"></script>

<?php
	cargarFooter();
 ?>
