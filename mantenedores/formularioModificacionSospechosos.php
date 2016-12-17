<?php
require_once '../clases/Usuario.php';
$UsuarioValidar= new Usuario();
$UsuarioValidar->verificarSesion();

	include("../principal/comun.php");
	require_once '../clases/Sospechoso.php';
	cargarEncabezado();


		 $privilegioModificar=false;

		 @session_start();
		 require_once '../clases/Usuario.php';
		 require_once '../clases/Grupos.php';
		 $Usuario= new Usuario();
		 $Usuario->setRun($_SESSION['run']);
		 $resultadoUsuario= $Usuario->consultaUnUsuario();
		 if($resultadoUsuario){

		      $Grupo = new Grupos();
		      $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
		      $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

		      foreach($privilegios as $privilegio){

		         if($privilegio['id']==4){//privilegio modificar sospechosos
		             $privilegioModificar=true;
		         }
		      }


		      if($privilegioModificar==false){
		         header("location: ../principal/menuPrincipal.php");
		      }

		  }else{
		    echo "0";//usuario no existe
		  }




			$soloRun=$_REQUEST['id'];
				 if(is_numeric($soloRun)){

						$Sospechoso= new Sospechoso();
						$listado= $Sospechoso->registros("select * from tb_sospechoso where run=".$soloRun);

						if($listado){
								$filasPrincipal= $listado[0];
								$_SESSION['sospechosoModificando']=$filasPrincipal['run'].'-'.$filasPrincipal['dv'];
								//echo "run sosp mod: ".$_SESSION['sospechosoModificando'];
						}else{
							header("location: mantenedorSospechosos.php");
						}
				 }else{
					 header("location: mantenedorSospechosos.php");
				 }

 ?>



<div id="contenedorFormularios" class="container" >

	<form id="formularioModificacionSospechoso" name="formularioModificacionSospechoso" method="POST"  enctype="multipart/form-data">
	<div class="container row">

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" id="tablaIngresoSospechoso">
		<table>
			<thead>
					<th colspan="2" class="text-primary text-center"><strong>Ingreso de sospechoso</strong></th>
			</thead>
			<tbody>

				<tr>
					<td><strong>Run</strong></td>
					<td><input required class="form-control" name="run" placeholder="12345678-1" type="text"
					    <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['run'].'-'.$filasPrincipal['dv'].'" readonly '; } ?>
					    >
					</td>
				</tr>
				<tr>
					<td><strong>Nombre</strong></td>
					<td><input required class="form-control text-uppercase" name="nombre" type="text"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['nombres'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Apellido Paterno</strong></td>
					<td><input required class="form-control text-uppercase" name="apellidoPaterno" type="text"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['apellido_paterno'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Apellido Materno</strong></td>
					<td><input required class="form-control" name="apellidoMaterno" type="text"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['apellido_materno'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Fecha Nacimiento</strong></td>
					<td><input required class="form-control" name="edad" type="date"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['fecha_nacimiento'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Apodos</strong></td>
					<td><input class="form-control" name="apodo" type="text"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['apodos'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Lugar Nacimiento</strong></td>
					<td><input class="form-control" name="lugarNacimiento" type="text"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['lugar_deNacimiento'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Estatura(cm)</strong></td>
					<td><input required class="form-control" name="estatura" type="number" min="0"
					     <?php if(isset($soloRun)){ echo' value="'.$filasPrincipal['estatura'].'"'; } ?>
					>
					</td>
				</tr>
				<tr>
					<td><strong>Color Pelo</strong></td>
					<td>
						<select class="form-control" name="colorPelo">
							<?php
								$resultado = $Sospechoso->registros("select * from tb_colorpelo");
                                if(isset($soloRun)){
                                    foreach($resultado as $filas){
                                        echo'<option value="'.$filas['id_colorPelo'].'"';
                                            if($filas['id_colorPelo']==$filasPrincipal['id_colorPelo']){
                                                echo'selected="selected" ';
                                            }
                                        echo'>'.$filas['descripcion_colorPelo'].'</option>';
                                    }
                                }else{
                                    foreach($resultado as $filas){
                                        echo'<option value="'.$filas['id_colorPelo'].'">'.$filas['descripcion_colorPelo'].'</option>';
                                    }
                                }
							 ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Contextura</strong></td>
					<td><select class="form-control" name="contextura">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_contextura");
                            if(isset($soloRun)){

                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_contextura'].'" ';
                                            if($filas['id_contextura']==$filasPrincipal['id_contextura']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_contextura'].'</option>';
                                }
                            }else{
                                 foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_contextura'].'">'.$filas['descripcion_contextura'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Estado Civil</strong></td>
					<td><select class="form-control" name="estadoCivil">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_estadoCivil");
                            if(isset($soloRun)){
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_estadoCivil'].'"  ';
                                            if($filas['id_estadoCivil']==$filasPrincipal['id_estadoCivil']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_estadoCivil'].'</option>';
                                }
                            }else{
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_estadoCivil'].'">'.$filas['descripcion_estadoCivil'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Sexo</strong></td>
					<td><select class="form-control" name="sexo">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_sexo");
                            if(isset($soloRun)){
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_sexo'].'" ';
                                            if($filas['id_sexo']==$filasPrincipal['id_sexo']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_sexo'].'</option>';
                                }
                            }else{
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_sexo'].'">'.$filas['descripcion_sexo'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tez De Piel</strong></td>
					<td><select class="form-control" name="tezPiel">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_tezpiel");                            if(isset($soloRun)){
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_tezPiel'].'" ';
                                            if($filas['id_tezPiel']==$filasPrincipal['id_tezPiel']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_tezPiel'].'</option>';
                                }
                            }else{
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_tezPiel'].'">'.$filas['descripcion_tezPiel'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tipo de Ojos</strong></td>
					<td><select class="form-control" name="tipoOjos">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_colorojos");
                            if(isset($soloRun)){
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_colorOjos'].'" ';
                                            if($filas['id_colorOjos']==$filasPrincipal['id_tipoOjos']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_colorOjos'].'</option>';
                                }
                            }else{
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_colorOjos'].'">'.$filas['descripcion_colorOjos'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
				<tr>
					<td><strong>Tipo de Pelo</strong></td>
					<td><select class="form-control" name="tipoPelo">
						<?php
							$resultado = $Sospechoso->registros("select * from tb_tipopelo");
                            if(isset($soloRun)){
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_tipoPelo'].'" ';
                                            if($filas['id_tipoPelo']==$filasPrincipal['id_tipoPelo']){
                                                echo'selected="selected" ';
                                            }
                                    echo'>'.$filas['descripcion_tipoPelo'].'</option>';
                                }
                            }else{
                                foreach($resultado as $filas){
                                    echo '<option value="'.$filas['id_tipoPelo'].'">'.$filas['descripcion_tipoPelo'].'</option>';
                                }
                            }
						 ?>
					</select></td>
				</tr>
						<tr>
		 					<td><label>Acne</label></td>
		 					<td>
		 						<input type="radio" value="1" name="acne" id="acne1"
                    <?php if(isset($soloRun)){ if($filasPrincipal['acne']=="1"){echo' checked="checked" ';} } ?>

                    ><label for="acne1">Si</label>

		 						<input type="radio" value="2" name="acne" id="acne2"
                    <?php if(isset($soloRun)){ if($filasPrincipal['acne']=="2"){echo' checked="checked" ';} } ?>

                    ><label for="acne2">No</label>

		 						<input type="radio" value="0" name="acne" id="acne3"
		 	        <?php if(isset($soloRun)){ if($filasPrincipal['acne']=="0"){echo' checked="checked" ';} }else{echo' checked="checked"';} ?>

		 	        ><label for="acne3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Barba</label></td>
		 					<td>
		 						<input type="radio" value="1" name="barba" id="barba1"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['barba']=="1"){
                                        echo' checked="checked" ';
                                    }
                                } ?>
		 						><label for="barba1">Si</label>

		 						<input type="radio" value="2" name="barba" id="barba2"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['barba']=="2"){
                                        echo' checked="checked" ';
                                    }
                                } ?>
                                ><label for="barba2">No</label>

		 						<input type="radio" value="0" name="barba" id="barba3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['barba']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
                                 ><label for="barba3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Bigote</label></td>
		 					<td>
		 						<input type="radio" value="1" name="bigote" id="bigote1"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['bigote']=="1"){
                                        echo' checked="checked" ';
                                    }
                                } ?>
		 						><label for="bigote1">Si</label>
		 						<input type="radio" value="2" name="bigote" id="bigote2"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['bigote']=="2"){
                                        echo' checked="checked" ';
                                    }
                                } ?>

		 						><label for="bigote2">No</label>
		 						<input type="radio" value="0" name="bigote" id="bigote3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['bigote']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
		 						><label for="bigote3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Manchas</label></td>
		 					<td>
		 						<input type="radio" value="1" name="manchas" id="manchas1"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['manchas']=="1"){
                                        echo' checked="checked" ';
                                    }
                                } ?>
		 						><label for="manchas1">Si</label>
		 						<input type="radio" value="2" name="manchas" id="manchas2"
		 						<?php
                                if(isset($soloRun)){
                                    if($filasPrincipal['manchas']=="2"){
                                        echo' checked="checked" ';
                                    }
                                } ?>
		 						><label for="manchas2">No</label>
		 						<input type="radio" value="0" name="manchas" id="manchas3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['manchas']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
		 						><label for="manchas3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Lentes</label></td>
		 					<td>
		 						<input type="radio" value="1" name="lentes" id="lentes1"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['lentes']=="1"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="lentes1">Si</label>
		 						<input type="radio" value="2" name="lentes" id="lentes2"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['lentes']=="2"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="lentes2">No</label>
		 						<input type="radio" value="0" name="lentes" id="lentes3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['lentes']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
		 						><label for="lentes3">Sin especificar</label>
		 					</td>
		 				</tr>
		 				<tr>
		 					<td><label>Pecas</label></td>
		 					<td>
		 						<input type="radio" value="1" name="pecas" id="pecas1"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['pecas']=="1"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="pecas1">Si</label>
		 						<input type="radio" value="2" name="pecas" id="pecas2"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['pecas']=="2"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="pecas2">No</label>
		 						<input type="radio" value="0" name="pecas" id="pecas3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['pecas']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
		 						><label for="pecas3">Sin especificar</label>
		 					</td>
		 				</tr>
						<tr>
		 					<td><label>Antecedentes</label></td>
		 					<td>
		 						<input type="radio" value="1" name="antecedentes" id="antecedentes1"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['antecedentes_penales']=="1"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="antecedentes1">Si</label>
		 						<input type="radio" value="2" name="antecedentes" id="antecedentes2"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['antecedentes_penales']=="2"){
                                        echo' checked="checked" ';
                                    }
                                }?>
		 						><label for="antecedentes2">No</label>
		 						<input type="radio" value="0" name="antecedentes" id="antecedentes3"
                                <?php if(isset($soloRun)){
                                    if($filasPrincipal['antecedentes_penales']=="0"){
                                        echo' checked="checked" ';
                                    }
                                }else{
                                    echo' checked="checked"';
                                } ?>
		 						><label for="antecedentes3">Sin especificar</label>
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
				 			$resultado= $Sospechoso->registros("select * from tb_delito order by descripcion_delito asc");
				 				$contadorDelitos=0;


						 				foreach($resultado as $filas){
						 						$contadorDelitos++;
						 						echo'<tr>
						 								<td><input class="" type="checkbox" value="'.$filas['id_delito'].'" name="delito'.$filas['id_delito'].'" ';

		                                        $resultado2= $Sospechoso->registros("select * from tb_delitosopechoso where id_delito=".$filas['id_delito'].' and run_sospechoso='.$soloRun);

		                                           if($resultado2){
		                                                echo' checked="checked" ';
		                                            }

		                                        echo' /><label class="text-capitalize" for="'.$filas['id_delito'].'" >'.$filas['descripcion_delito'].'</label>
		                                                    </td>
		                                                 </tr>';
						 				}
						 				echo'<input type="hidden" value="'.$contadorDelitos.'" name="contadorDelitos" >';
				 		?>
				 			</tbody>
				 		</table>
				 	</div>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" id="divFotos">
						<div id="divSuperiorSubirImagenes">
							<div class="row col-xs-12 pull-right">
								<input class="btn btn-primary" type="button" id="botonAgregar" onclick="agregarCampoFoto();" value="+ Imagenes" />
								<input class="btn btn-primary" type="button" id="botonAgregar" onclick="removerCampoFoto();" value="- Imagenes" />
							</div>

							<table class="table" id="tablaFotosIngreso">

								<input type="hidden" id="contadorFotos" name="contadorFotos" value="0">

								<caption>IMAGENES</caption>
								<thead>
									<th>Archivo</th>
									<th>Fecha</th>
									<th>Principal</th>
								</thead>
								<tbody>
									<!-- <tr>
										<td><input class="form-control" name="foto1" type="file"></input></td>
										<td><input class="form-control" type="date" name="fechaFoto1"></td>
										<td><input class="form-control" type="checkbox" name="tipoFoto1"></td>
									</tr> -->
							</tbody>
							</table>

						</div>

 						<div id="divInferiorImagenesActuales">

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
				 			$resultado= $Sospechoso->registros("select * from tb_equipofutbol");
				 				$contadorEquiposFutbol=0;

								if(isset($soloRun)){
								 				foreach($resultado as $filas){
								 						$contadorEquiposFutbol++;
								 						echo'<tr>
								 								<td><input type="checkbox" value="'.$filas['id_equipo'].'" name="equipo'.$filas['id_equipo'].'" ';

				                                            $resultado2= $Sospechoso->registros("select * from tb_equiposospechoso where id_equipo=".$filas['id_equipo'].' and run='.$soloRun);

				                                            if($resultado2){
				                                                echo' checked="checked" ';
				                                            }

				                                        echo'/><label for="'.$filas['id_equipo'].'" >'.$filas['descripcion_equipo'].'</label>
								 								</td>
								 							 </tr>';
								 				}
								}else{
								 				foreach($resultado as $filas){
								 						$contadorEquiposFutbol++;
								 						echo'<tr>
								 								<td><input type="checkbox" value="'.$filas['id_equipo'].'" name="equipo'.$filas['id_equipo'].'" /><label for="'.$filas['id_equipo'].'" >'.$filas['descripcion_equipo'].'</label>
								 								</td>
								 							 </tr>';
								 				}
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
						 			$resultado= $Sospechoso->registros("select * from tb_cicatriz");
						 				$contadorOpcionesCicatriz=0;

								if(isset($soloRun)){
										 				foreach($resultado as $filas){
										 						$contadorOpcionesCicatriz++;
										 						echo'<tr>
										 								<td><input type="checkbox" value="'.$filas['id_lugarCicatriz'].'" name="cicatriz'.$filas['id_lugarCicatriz'].'" ';

				                                                $resultado2= $Sospechoso->registros("select * from tb_cicatrizsospechoso where id_lugarCicatriz=".$filas['id_lugarCicatriz'].' and run='.$soloRun);

				                                                if($resultado2){
				                                                    echo' checked="checked" ';
				                                                }

				                                                echo'/><label for="'.$filas['id_lugarCicatriz'].'" >'.$filas['descripcion_lugarCicatriz'].'</label>
										 								</td>
										 							 </tr>';
										 				}
								}else{
														foreach($resultado as $filas){
																$contadorOpcionesCicatriz++;
																echo'<tr>
																		<td><input type="checkbox" value="'.$filas['id_lugarCicatriz'].'" name="cicatriz'.$filas['id_lugarCicatriz'].'" /><label for="'.$filas['id_lugarCicatriz'].'" >'.$filas['descripcion_lugarCicatriz'].'</label>
																		</td>
																	 </tr>';
														}
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
						 			$resultado= $Sospechoso->registros("select * from tb_tatuaje");
						 				$contadorOpcionesTatuaje=0;

								if(isset($soloRun)){
								 				foreach($resultado as $filas){
								 						$contadorOpcionesTatuaje++;
								 						echo'<tr>
								 								<td><input type="checkbox" value="'.$filas['id_lugarTatuaje'].'" name="tatuaje'.$filas['id_lugarTatuaje'].'" ';

		                                                $resultado2= $Sospechoso->registros("select * from tb_tatuajesospechoso where id_lugarTatuaje=".$filas['id_lugarTatuaje'].' and run='.$soloRun);

		                                                if($resultado2){
		                                                    echo' checked="checked" ';
		                                                }

		                                                echo'/><label for="'.$filas['id_lugarTatuaje'].'" >'.$filas['descripcion_lugarTatuaje'].'</label>
								 								</td>
								 							 </tr>';
								 				}
									}else{
									 				foreach($resultado as $filas){
									 						$contadorOpcionesTatuaje++;
									 						echo'<tr>
									 								<td><input type="checkbox" value="'.$filas['id_lugarTatuaje'].'" name="tatuaje'.$filas['id_lugarTatuaje'].'" /><label for="'.$filas['id_lugarTatuaje'].'" >'.$filas['descripcion_lugarTatuaje'].'</label>
									 								</td>
									 							 </tr>';
									 				}
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
						 			$resultado= $Sospechoso->registros("select * from tb_piercing");
						 				$contadorOpcionesPiercing=0;

								if(isset($soloRun)){
									 				foreach($resultado as $filas){
									 						$contadorOpcionesPiercing++;
									 						echo'<tr>
									 								<td><input type="checkbox" value="'.$filas['id_lugarPiercing'].'" name="piercing'.$filas['id_lugarPiercing'].'" ';

			                                                $resultado2= $Sospechoso->registros("select * from tb_piercingsospechoso where id_lugarPiercing=".$filas['id_lugarPiercing'].' and run='.$soloRun);

			                                                if($resultado2){
			                                                    echo' checked="checked" ';
			                                                }

			                                                echo'/><label for="'.$filas['id_lugarPiercing'].'" >'.$filas['descripcion_lugarPiercing'].'</label>
									 								</td>
									 							 </tr>';
									 				}
									}else{
										 				foreach($resultado as $filas){
										 						$contadorOpcionesPiercing++;
										 						echo'<tr>
										 								<td><input type="checkbox" value="'.$filas['id_lugarPiercing'].'" name="piercing'.$filas['id_lugarPiercing'].'" /><label for="'.$filas['id_lugarPiercing'].'" >'.$filas['descripcion_lugarPiercing'].'</label>
										 								</td>
										 							 </tr>';
										 				}
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
				 			$resultado= $Sospechoso->registros("SELECT * FROM tb_poblacion");
				 				$contadorPoblaciones=0;

								if(isset($soloRun)){
						 				foreach($resultado as $filas){
						 						$contadorPoblaciones++;
						 						echo'<tr>
						 								<td><input type="checkbox" value="'.$filas['id_poblacion'].'" name="poblacion'.$filas['id_poblacion'].'" ';

		                                                $resultado2= $Sospechoso->registros("select * from tb_poblacionsospechoso where id_poblacion=".$filas['id_poblacion'].' and run='.$soloRun);

		                                                if($resultado2){
		                                                    echo' checked="checked" ';
		                                                }

		                                        echo'/><label for="'.$filas['id_poblacion'].'" >'.$filas['descripcion_poblacion'].'</label>
						 								</td>
						 							 </tr>';
						 				}
								}else{
						 				foreach($resultado as $filas){
						 						$contadorPoblaciones++;
						 						echo'<tr>
						 								<td><input type="checkbox" value="'.$filas['id_poblacion'].'" name="poblacion'.$filas['id_poblacion'].'" /><label for="'.$filas['id_poblacion'].'" >'.$filas['descripcion_poblacion'].'</label>
						 								</td>
						 							 </tr>';
						 				}
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
	<script type="text/javascript">

	          $("#formularioModificacionSospechoso").submit(function(){
								event.preventDefault();


										swal("Cargando", "", "info");

												          var formData = new FormData(document.getElementById("formularioModificacionSospechoso"));

													            $.ajax({
													              url: "controladorMantenedores.php?mant=7&func=1&mod=1",
													              dataType: "html",
																				type:'post',
													              data: formData,
													              cache: false,
													              contentType: false,
													              processData:false,
													              success:function(resultado){
																					//alert(resultado);
													                  if(resultado==0){
													                         swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
													                         setTimeout(function(){
													                               window.location="../principal/menuPrincipal.php";
													                            },5000);

													                   }else if(resultado=="1"){
													                      swal("Operacion exitosa!", "Modificado Correctamente", "success");
													                      $("#botonCerrarModalModificar").click();
																								cargarImagenesActuales(<?php echo $filasPrincipal['run']; ?>);
																								$("#tablaFotosIngreso").html('<input type="hidden" id="contadorFotos" name="contadorFotos" value="0"><caption>IMAGENES</caption><thead><th>Archivo</th><th>Fecha</th><th>Principal</th></thead><tbody></tbody></table>');
													                    }else if(resultado=="2"){
													                      sweetAlert("No permitido.", "No puede ingresar campos vacios.", "warning");

													                    }else{

													                      sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
													                    }
													              }
													            });
	          });


  function soloUnaPrincipal(id){//permite presionar solo un checkbox
     var cantidad= $("#contadorFotos").val();

		 for(var c=1;c<=cantidad;c++){
				 $('#tipoFoto'+c).prop('checked', false);
		 }
		 $("#tipoFoto"+id).prop('checked', true);

	}




					function agregarCampoFoto(){
					  var contadorTr=$("#tablaFotosIngreso tr").length-1;
					  contadorTr++;

					  //alert(contadorTr);
					      $("#tablaFotosIngreso").append('<tr><td><input required class="form-control" name="foto'+contadorTr+'" type="file"></input></td><td><input required class="form-control" type="date" name="fechaFoto'+contadorTr+'"></td><td><input class="form-control" type="checkbox" onclick="soloUnaPrincipal('+contadorTr+')" name="tipoFoto'+contadorTr+'" id="tipoFoto'+contadorTr+'"></td></tr>');
					      $("#contadorFotos").val(contadorTr);
					}

					function removerCampoFoto(){
					     var cantidad= $("#contadorFotos").val();

					     if(cantidad!=0){
					         $("#tablaFotosIngreso tr:last").remove();

					          cantidad--;
					           $("#contadorFotos").val(cantidad);
					      }
					}
					function eliminarFoto(idFoto,run){
						swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
						$.ajax({
							url:"controladorMantenedores.php?mant=7&func=5",
							data:"idFoto="+idFoto+"&run="+run,
							success:function(respuesta){
								 if(respuesta==1){
									 cargarImagenesActuales(run);
									 swal("Operacion exitosa!", "Imagen Eliminada", "success");
								 }
							}
						});
					}
					function fotoPrincipal(idFoto,run){
						swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
						$.ajax({
							url:"controladorMantenedores.php?mant=7&func=6",
							data:"idFoto="+idFoto+"&run="+run,
							success:function(respuesta){
								 if(respuesta==1){
									 cargarImagenesActuales(run);
									 swal("Operacion exitosa!", "Imagen Principal Cambiada", "success");
								 }
							}
						});
					}

		function cargarImagenesActuales(run){

			 $.ajax({
				 url:"controladorMantenedores.php?mant=7&func=4",
				 data:"run="+run,
				 success:function(respuesta){

						$("#divInferiorImagenesActuales").html(respuesta);
				 }
			 });
		}

		cargarImagenesActuales(<?php echo $soloRun; ?>);
		</script>
<?php
	cargarFooter();
 ?>
