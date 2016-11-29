<?php
include("./comun.php");
conectarBD();

	$run= $_REQUEST['run'];

 	include "../clases/Sospechoso.php";
	$Sospechoso= new Sospechoso();
	$Sospechoso->setRun($run);
	$resultado1= $Sospechoso->vistasospechoso();

 	foreach($resultado1 as $filas){

 			echo '
				<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">

			 				<strong>Run:</strong>
			 				<input class="form-control" type="text" readonly value="'.$filas['run'].'" >


			 				<strong>Nombre:</strong><class="text-uppercase"><input class="form-control" type="text" readonly value="'.$filas['nombres'].'" >


			 				<strong>Lugar Nacimiento:</strong>
			 				<input class="form-control" type="text" readonly value="'.$filas['lugar_deNacimiento'].'" >


			 				<strong>Sexo</strong>
			 				<input class="form-control" type="text" readonly value="'.$filas['descripcion_sexo'].'" >


			 				<strong>Estado Civil:</strong>
			 				<input class="form-control" type="text" readonly value="'.$filas['descripcion_estadoCivil'].'" >


			 				<strong>Antecedentes Penales:</strong>
			 				<input class="form-control" type="text" readonly value="'.$filas['antecedentes'].'" >


			 				<strong>Fecha Nacimiento:</strong>';

							$fecha=date_create($filas['fecha_nacimiento']);
							$fecha=date_format($fecha,"d/m/Y");

							echo'
			 				<input class="form-control" type="text" readonly value="'.$fecha.'" >


			 				<strong>Delitos Cometidos:</strong>
			 				<textarea name="" class="form-control" id="" cols="30" rows="10">';
								include "../clases/Delito.php";
								$Delito= new Delito();

								$resultado= $Delito->listarDelitosUnSospechoso($run);
								foreach ($resultado as $filasD) {
										echo $filasD['descripcion_delito']." \n";
								}
			 				echo'</textarea>
								<button class="btn btn-warning col-xs-12">Editar</button>
</div>
<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
';


						 $consulta2="select * from tb_imagen
						 inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
						 where run_sospechoso=".$run;
						 //echo $consulta2;
						 $resultado2= $con->query($consulta2);

						 while($filas2= $resultado2->fetch_array()){

							 echo'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 img-thumbnail alturaImage "
								style="background-image: url(\'../imagenes/'.$filas2['nombre_imagen'].'\');
								 background-size: cover;
								 background-position: center;
								 height:300px;"

								  >

								 </div>';
						 }


		echo '</div>
		';


 	}

 ?>
