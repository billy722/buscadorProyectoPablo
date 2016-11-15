<?php
require_once '../clases/Sospechoso.php';
$Sospechoso= new Sospechoso();

	$run= $_REQUEST['run'];

			 echo' <div class="col-xs-12" id="fotosInformacionSospechoso">';

 				$consulta2="select * from tb_imagen
				inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
				where run_sospechoso=".$run;
				//echo $consulta2;
				$resultado2=$Sospechoso->registros($consulta2);

					foreach($resultado2 as $filas2){

						echo'
						<div class="img-thumbnail">
						<div class="img-thumbnail col-xs-12" id=""
						 style="background-image: url(\'../imagenes/'.$filas2['nombre_imagen'].'\');
							background-size: cover;
							background-position: center;
              width:100px;
							height:100px;
							float:left;
							margin-left:3px;
							border-style: dotted;
							border-width:1px;
							border-radius:5px;
							" >

							</div>
							<div>
									<label for="">Fecha: '.$filas2['fecha_imagen'].'</label>
									<input class="col-xs-6 btn btn-danger" type="button" onclick="alert("hola")" value="Eliminar">
									<input class="col-xs-6 btn btn-success" type="button" onclick="alert("hola")" value="Principal">
							</div>
							</div>
							';
					}
			 echo'</div>';

 ?>
