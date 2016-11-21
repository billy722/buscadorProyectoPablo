<?php
session_start();

if(isset($_SESSION['run'])==false &&

   isset($_SESSION['nombre'])==false &&

   isset($_SESSION['idDepartamento'])==false &&

   isset($_SESSION['descripcionDepartamento'])==false){



          header("location: ../index.php");

}else{

	include("./comun.php");
	conectarBD();
	cargarEncabezado();
 ?>

<div class="container" id="filtros">

		<form id="formularioBusqueda">

	<div class="row">
	 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 p-a-3" id="filtrosGenerales">



	 		<table id="tablaFiltrosGenerales">
	 			<caption class="text-primary text-center"><strong>FILTRAR SOSPECHOSOS</strong></caption>
	 			<thead>
	 			</thead>
	 			<tbody>

	 				<tr>
	 					<td>Sexo</td>
	 					<td>
	 						<select class="form-control altoCampo" name="sexo">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_sexo");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_sexo'].'">'.$filas['descripcion_sexo'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>

	 				<tr>
	 					<td>Contextura</td>
	 					<td>
	 						<select class="form-control altoCampo" name="contextura">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_contextura");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_contextura'].'">'.$filas['descripcion_contextura'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>

	 				<tr>
	 					<td>Tez Piel</td>
	 					<td>
	 						<select class="form-control altoCampo" name="tezPiel">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_tezpiel");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_tezPiel'].'">'.$filas['descripcion_tezPiel'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>

	 				<tr>
	 					<td>Tipo Pelo</td>
	 					<td>
	 						<select class="form-control altoCampo" name="tipoPelo">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_tipopelo");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_tipoPelo'].'">'.$filas['descripcion_tipoPelo'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>

	 				<tr>
	 					<td>Color Pelo</td>
	 					<td>
	 						<select class="form-control altoCampo" name="colorPelo">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_colorPelo");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_colorPelo'].'">'.$filas['descripcion_colorPelo'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>

	 				<tr>
	 					<td>Ojos</td>
	 					<td>
	 						<select class="form-control altoCampo" name="tipoOjos">
	 							<option value="0">Sin especificar</option>
	 							<?php
	 								$resultado= $con->query("select * from tb_colorOjos");
	 								while($filas= $resultado->fetch_array()){
	 									echo'<option value="'.$filas['id_colorOjos'].'">'.$filas['descripcion_colorOjos'].'</option>';
	 								}
	 							 ?>
	 						</select>
	 					</td>
	 				</tr>


	 				<tr>
	 					<td><label>Acne</label></td>
	 					<td>
	 						<input type="radio" value="1" name="acne" id="acne1"><label for="acne1">Si</label>
	 						<input type="radio" value="2" name="acne" id="acne2"><label for="acne2">No</label>
	 						<input type="radio" value="0" name="acne" id="acne3" checked="checked"><label for="acne3">No incluir</label>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td><label>Barba</label></td>
	 					<td>
	 						<input type="radio" value="1" name="barba" id="barba1"><label for="barba1">Si</label>
	 						<input type="radio" value="2" name="barba" id="barba2"><label for="barba2">No</label>
	 						<input type="radio" value="0" name="barba" id="barba3" checked="checked"><label for="barba3">No incluir</label>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td><label>Bigote</label></td>
	 					<td>
	 						<input type="radio" value="1" name="bigote" id="bigote1"><label for="bigote1">Si</label>
	 						<input type="radio" value="2" name="bigote" id="bigote2"><label for="bigote2">No</label>
	 						<input type="radio" value="0" name="bigote" id="bigote3" checked="checked"><label for="bigote3">No incluir</label>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td><label>Manchas</label></td>
	 					<td>
	 						<input type="radio" value="1" name="manchas" id="manchas1"><label for="manchas1">Si</label>
	 						<input type="radio" value="2" name="manchas" id="manchas2"><label for="manchas2">No</label>
	 						<input type="radio" value="0" name="manchas" id="manchas3" checked="checked"><label for="manchas3">No incluir</label>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td><label>Lentes</label></td>
	 					<td>
	 						<input type="radio" value="1" name="lentes" id="lentes1"><label for="lentes1">Si</label>
	 						<input type="radio" value="2" name="lentes" id="lentes2"><label for="lentes2">No</label>
	 						<input type="radio" value="0" name="lentes" id="lentes3" checked="checked"><label for="lentes3">No incluir</label>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td><label>Pecas</label></td>
	 					<td>
	 						<input type="radio" value="1" name="pecas" id="pecas1"><label for="pecas1">Si</label>
	 						<input type="radio" value="2" name="pecas" id="pecas2"><label for="pecas2">No</label>
	 						<input type="radio" value="0" name="pecas" id="pecas3" checked="checked"><label for="pecas3">No incluir</label>
	 					</td>
	 				</tr>

	 			</tbody>
	 		</table>

	 	</div>

		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divDdelitos">
		 		<table style="overflow-x:scroll; width:350px;" class="table-responsive">
		 			<caption class="text-primary text-center"><strong>DELITOS</strong></caption>
		 			<thead>
		 			</thead>
		 			<tbody>
		 		<?php
		 			$resultado= $con->query("select * from tb_delito where estado=1 order by descripcion_delito ");
		 				$contadorDelitos=0;

		 				while($filas= $resultado->fetch_array()){
		 						$contadorDelitos++;
		 						echo'<tr>
		 								    <td><input type="checkbox" value="'.$filas['id_delito'].'" name="delito'.$filas['id_delito'].'" id="delito'.$filas['id_delito'].'"><label class="text-capitalize" for="delito'.$filas['id_delito'].'" >'.$filas['descripcion_delito'].'</label>
		 								</td>
		 							 </tr>';
		 				}
		 				echo'<input type="hidden" value="'.$contadorDelitos.'" name="contadorDelitos" >';
		 		?>
		 			</tbody>
		 		</table>
		 	</div>

		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 p-a-3" id="divEdades">
		 		<table>
		 			<caption class="text-primary text-center"><strong>RANGO EDAD</strong></caption>
		 			<thead>
		 			</thead>
		 			<tbody>
		 		<?php
		 			$resultado= $con->query("select * from tb_rangoedad");
		 				$contadorRangosEdad=0;
		 				while($filas= $resultado->fetch_array()){
		 						$contadorRangosEdad++;
		 						echo'<tr>
		 								<td><input type="checkbox" value="'.$filas['id_rangoEdad'].'" name="edad'.$filas['id_rangoEdad'].'" id="edad'.$filas['id_rangoEdad'].'"/><label for="edad'.$filas['id_rangoEdad'].'" >De '.$filas['limite_inferior'].' a '.$filas['limite_superior'].' años</label>
		 								</td>
		 							 </tr>';
		 				}
		 				echo'<input type="hidden" value="'.$contadorRangosEdad.'" name="contadorRangosEdad" >';
		 		?>
		 			</tbody>
		 		</table>
		 	</div>

		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 p-a-3" id="divEquipos">
		 		<table>
		 			<caption class="text-primary text-center"><strong>EQUIPO</strong></caption>
		 			<thead>
		 			</thead>
		 			<tbody>
		 		<?php
		 			$resultado= $con->query("select * from tb_equipofutbol where estado=1 order by descripcion_equipo");
		 				$contadorEquiposFutbol=0;
		 				while($filas= $resultado->fetch_array()){
		 						$contadorEquiposFutbol++;
		 						echo'<tr>
		 								<td><input type="checkbox" value="'.$filas['id_equipo'].'" name="equipo'.$filas['id_equipo'].'" id="equipo'.$filas['id_equipo'].'" /><label for="equipo'.$filas['id_equipo'].'" >'.$filas['descripcion_equipo'].'</label>
		 								</td>
		 							 </tr>';
		 				}
		 				echo'<input type="hidden" value="'.$contadorEquiposFutbol.'" name="contadorEquiposFutbol" >';
		 		?>
		 			</tbody>
		 		</table>
		 	</div>
		</div>



		<div class="row">
		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divCicatrizTatuajePiercing">

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
				 								<td><input type="checkbox" value="'.$filas['id_lugarCicatriz'].'" name="cicatriz'.$filas['id_lugarCicatriz'].'" id="cicatriz'.$filas['id_lugarCicatriz'].'" /><label for="cicatriz'.$filas['id_lugarCicatriz'].'" >'.$filas['descripcion_lugarCicatriz'].'</label>
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
				 				<th class="text-primary text-center"><strong>TATUAJE</strong></th>
				 			</thead>
				 			<tbody>
				 		<?php
				 			$resultado= $con->query("select * from tb_tatuaje");
				 				$contadorOpcionesTatuaje=0;
				 				while($filas= $resultado->fetch_array()){
				 						$contadorOpcionesTatuaje++;
				 						echo'<tr>
				 								<td><input type="checkbox" value="'.$filas['id_lugarTatuaje'].'" name="tatuaje'.$filas['id_lugarTatuaje'].'"  id="tatuaje'.$filas['id_lugarTatuaje'].'"/><label for="tatuaje'.$filas['id_lugarTatuaje'].'" >'.$filas['descripcion_lugarTatuaje'].'</label>
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
				 				<th class="text-primary text-center"><strong>PIERCING</strong></th>
				 			</thead>
				 			<tbody>
				 		<?php
				 			$resultado= $con->query("select * from tb_piercing");
				 				$contadorOpcionesPiercing=0;
				 				while($filas= $resultado->fetch_array()){
				 						$contadorOpcionesPiercing++;
				 						echo'<tr>
				 								<td><input type="checkbox" value="'.$filas['id_lugarPiercing'].'" name="piercing'.$filas['id_lugarPiercing'].'" id="piercing'.$filas['id_lugarPiercing'].'"/><label for="piercing'.$filas['id_lugarPiercing'].'" >'.$filas['descripcion_lugarPiercing'].'</label>
				 								</td>
				 							 </tr>';
				 				}
				 				echo'<input type="hidden" value="'.$contadorOpcionesPiercing.'" name="contadorOpcionesPiercing" >';
				 		?>
				 			</tbody>
				 		</table>
				 	</div>
		 	</div>

		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divZonas">
		 		<table>
		 			<thead>
            <th class="text-primary text-center"><strong>ZONA DONDE OPERA</strong></th>
		 			</thead>
		 			<tbody>
		 		<?php
		 			$resultado= $con->query("SELECT * FROM tb_zona");
		 				$contadorZonas=0;

		 				while($filas= $resultado->fetch_array()){
		 						$contadorZonas++;
		 						echo'<tr>
		 								<td><input type="checkbox" value="'.$filas['id_zona'].'" name="zona'.$filas['id_zona'].'" id="zona'.$filas['id_zona'].'" /><label for="zona'.$filas['id_zona'].'" >'.$filas['descripcion_zona'].'</label>
		 								</td>
		 							 </tr>';
		 				}
		 				echo'<input type="hidden" value="'.$contadorZonas.'" name="contadorZonas" >';
		 		?>
		 			</tbody>
		 		</table>
		 	</div>


		 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" id="divEstatura">
		 		<table style="padding:10px;">
		 			<thead>
  		 			<th class="text-primary text-center"><strong>RANGO ESTATURA</strong></th>
		 			</thead>
		 			<tbody>
		 		<?php
		 			$resultado= $con->query("select * from tb_rangoestatura");
		 				$contadorRangosEstatura=0;

		 				while($filas= $resultado->fetch_array()){
		 					$contadorRangosEstatura++;
		 						echo'<tr>
		 								<td><input type="checkbox" value="'.$filas['id_rangoEstatura'].'" name="estatura'.$filas['id_rangoEstatura'].'" id="estatura'.$filas['id_rangoEstatura'].'" /><label for="estatura'.$filas['id_rangoEstatura'].'" >'.$filas['descripcion_rangoEstatura'].' ('.$filas['limite_inferior'].' a '.$filas['limite_superior'].')</label>
		 								</td>
		 							 </tr>';
		 				}
		 				echo'<input type="hidden" value="'.$contadorRangosEstatura.'" name="contadorRangosEstatura" >';
		 		?>
		 			</tbody>
		 		</table>
		 	</div>


		 	<div  id="divBotones" class="col-xs-12 col-sm-6 col-md-6 col-lg-3">

		 						<input class="btn btn-warning" value="LIMPIAR" type="button" onclick="limpiarResultados();"/>
		 						<input class="btn btn-warning" value="BUSCAR" type="button" onclick="enviarFormulario();" />

		 	</div>
		</div>

		</form>

	</div>

<div class="container">
	<div class="row" id="resultadoBusqueda">

	</div>
</div>
<div class="container" id="divInformacion"></div>


   <div class="modal fade" id="modalInfo" role="dialog">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Crear CDA</h4>
         </div>
         <div id="modbody" class="modal-body">
<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea sed, nulla aspernatur commodi voluptatibus rerum neque. Ipsa quis, blanditiis facilis placeat. Quod numquam quas id, alias praesentium non placeat eaque.</span>
         </div>
        </div>
      </div>
    </div>

<script>

function enviarFormulario(){
		    $.post("./filtrarSospechosos.php",$("#formularioBusqueda").serialize(),function(respuesta){
                $('#informacionSospechoso ').removeClass('informacionSospechoso');
		             document.getElementById("resultadoBusqueda").innerHTML = respuesta;
		    });

            $('html,body').animate({
                scrollTop: $("#resultadoBusqueda").offset().top
            }, 2000);
}


function limpiarResultados(){
	document.getElementById("formularioBusqueda").reset();
	document.getElementById("resultadoBusqueda").innerHTML = "";
}

function mostrarInformacionSospechoso(run){
     //alert(run);

      $.post("./informacionSospechoso.php?run="+run,$("#fis").serialize(),function(respuesta){
                 //document.getElementById("informacionSospechoso").innerHTML = respuesta;
                 //$('#informacionSospechoso ').addClass('informacionSospechoso');
  alert(respuesta);
                 //document.getElementById("divInformacion").innerHTML ='<div id="over" class=" informacionSospechoso ">'+respuesta+'</div><div id="fade" class="atras">&nbsp;</div>';
        });
}
function ocultarInformacionEmergente(){
    document.getElementById("divInformacion").innerHTML ='';
}

function cargarImagenesActuales(run){

      $.post("./metodosAjax/sospechoso/cargarImagenesSospechoso.php?run="+run,$("#fis").serialize(),function(respuesta){
                 document.getElementById("divListaImagenes").innerHTML =respuesta;
        });
}

</script>

<?php
	cargarFooter();

}
 ?>
