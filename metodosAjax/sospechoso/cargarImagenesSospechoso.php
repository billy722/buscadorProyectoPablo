<?php
include("comun.php");
conectarBD();

	$run= $_REQUEST['run'];

			 echo' <div class="col-xs-12" id="fotosInformacionSospechoso">';

 				$consulta2="select * from tb_imagen
				inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
				where run_sospechoso=".$run;
				//echo $consulta2;
				$resultado2= $con->query($consulta2);

					while($filas2= $resultado2->fetch_array()){

						echo'<div class="" id=""
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
									<input type="button" onclick="alert("hola")" class="btn btn-danger" value="x">
									<input type="button" onclick="alert("hola")" class="btn btn-succes" value="p">
							</div>';
					}
			 echo'</div>';

 ?>
