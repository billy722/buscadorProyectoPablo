<?php
	require_once '../clases/Conexion.php';
	$Conexion= new Conexion();

	$privilegioFiltrar=false;

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

					if($privilegio['id']==1){//privilegio ver sospechosos
							$privilegioFiltrar=true;
					}
			 }


			 if($privilegioFiltrar==true){

				 $UsuarioHistorial= new Usuario();
				 $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),3,$_SESSION['run'],"");



/*PARA BUSQUEDA SEGUN PORCENTAGE*/
$cantidadDeParametrosIngresados=0;
/*PARA BUSQUEDA SEGUN PORCENTAGE*/
require_once '../clases/Sospechoso.php';
$Sospechoso= new Sospechoso();

// $resultado=$Sospechoso->crearTablaTemporalBusqueda();
// if($resultado){
// 		 echo "SE CREO LA TABLA";
//
//
// }else{
// 	echo "NO SE PUDO CREAR TABLA TEMPORAL";
// }

				$sexo=$_REQUEST['sexo'];
				$contextura=$_REQUEST['contextura'];
				$tezPiel=$_REQUEST['tezPiel'];
				$tipoPelo=$_REQUEST['tipoPelo'];
				$colorPelo=$_REQUEST['colorPelo'];
				$tipoOjos=$_REQUEST['tipoOjos'];
				$acne=$_REQUEST['acne'];
				$barba=$_REQUEST['barba'];
				$bigote=$_REQUEST['bigote'];
				$manchas=$_REQUEST['manchas'];
				$lentes=$_REQUEST['lentes'];
				$pecas=$_REQUEST['pecas'];

				$contadorDelitos= $_REQUEST['contadorDelitos'];
				$contadorRangosEstatura= $_REQUEST['contadorRangosEstatura'];
				$contadorRangosEdad= $_REQUEST['contadorRangosEdad'];
				$contadorEquiposFutbol= $_REQUEST['contadorEquiposFutbol'];
				$contadorOpcionesCicatriz= $_REQUEST['contadorOpcionesCicatriz'];
				$contadorOpcionesTatuaje= $_REQUEST['contadorOpcionesTatuaje'];
				$contadorOpcionesPiercing= $_REQUEST['contadorOpcionesPiercing'];
				$contadorZonas=$_REQUEST['contadorZonas'];


				$consulta= "select tb_sospechoso.run, nombre_imagen, edad(fecha_nacimiento) from tb_sospechoso ";

				$enlacesConsulta="inner join tb_imagensospechoso on tb_sospechoso.run=tb_imagensospechoso.run_sospechoso
								inner join tb_imagen on tb_imagensospechoso.id_imagen=tb_imagen.id_imagen ";

				$condicionesConsulta="where (tb_imagensospechoso.run_sospechoso=tb_sospechoso.run
				and fecha_imagen = (select max(fecha_imagen) from tb_imagen inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen  where tb_imagensospechoso.run_sospechoso=tb_sospechoso.run and foto_principal=2)) ";



				if($sexo!=0){
					$condicionesConsulta= $condicionesConsulta." and id_sexo=".$sexo;
					$cantidadDeParametrosIngresados++;

					// $res=$Usuario->registros("select run from tb_sospechoso where id_sexo=".$sexo);
					// foreach($res as $col){
          //     $Usuario->registros("update tb_sospechoso_temporal set puntaje=(puntaje+1) where run=".$col['run']);
					// }
				}

        // $resultado=$Usuario->registros("select * from tb_sospechoso_temporal");
				// foreach($resultado as $columna){
				// 		echo "run: ".$columna['run']." puntaje: ".$columna['puntaje'];
				// }

				if($contextura!=0){ $condicionesConsulta= $condicionesConsulta." and id_contextura=".$contextura; $cantidadDeParametrosIngresados++;}
				if($tezPiel!=0){ $condicionesConsulta= $condicionesConsulta." and id_tezPiel=".$tezPiel; $cantidadDeParametrosIngresados++;}
				if($tipoPelo!=0){ $condicionesConsulta= $condicionesConsulta." and id_tipoPelo=".$tipoPelo; $cantidadDeParametrosIngresados++;}
				if($colorPelo!=0){ $condicionesConsulta= $condicionesConsulta." and id_colorPelo=".$colorPelo; $cantidadDeParametrosIngresados++;}
				if($tipoOjos!=0){ $condicionesConsulta= $condicionesConsulta." and id_tipoOjos=".$tipoOjos; $cantidadDeParametrosIngresados++;}
				if($acne!=0){ $condicionesConsulta= $condicionesConsulta." and acne=".$acne; $cantidadDeParametrosIngresados++;}
				if($barba!=0){ $condicionesConsulta= $condicionesConsulta." and barba=".$barba; $cantidadDeParametrosIngresados++;}
				if($bigote!=0){ $condicionesConsulta= $condicionesConsulta." and bigote=".$bigote; $cantidadDeParametrosIngresados++;}
				if($manchas!=0){ $condicionesConsulta= $condicionesConsulta." and manchas=".$manchas; $cantidadDeParametrosIngresados++;}
				if($lentes!=0){ $condicionesConsulta= $condicionesConsulta." and lentes=".$lentes; $cantidadDeParametrosIngresados++;}
				if($pecas!=0){ $condicionesConsulta= $condicionesConsulta." and pecas=".$pecas; $cantidadDeParametrosIngresados++;}



				/*PREPARAR BUSQUEDA CICATRIZ*/
				$cicatriz="";
				for($c=1;$c<=$contadorOpcionesCicatriz;$c++){
					if(isset($_REQUEST['cicatriz'.$c])){

							if($cicatriz==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_cicatrizsospechoso on tb_sospechoso.run=tb_cicatrizsospechoso.run ";
								$cicatriz= $cicatriz." id_lugarCicatriz=".$c;
							}else{
								$cicatriz= $cicatriz." or id_lugarCicatriz=".$c;
							}
             $cantidadDeParametrosIngresados++;
					}
				}
				if($cicatriz!=""){
					$cicatriz=" and (".$cicatriz.") ";
					$condicionesConsulta= $condicionesConsulta.$cicatriz;
				}
				/*FIN CICATRIZ*/

				/*PREPARAR BUSQUEDA TATUAJE*/
				$tatuaje="";
				for($c=1;$c<=$contadorOpcionesTatuaje;$c++){
					if(isset($_REQUEST['tatuaje'.$c])){

							if($tatuaje==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_tatuajesospechoso on tb_sospechoso.run=tb_tatuajesospechoso.run ";
								$tatuaje= $tatuaje." id_lugarTatuaje=".$c;
							}else{
								$tatuaje= $tatuaje." or id_lugarTatuaje=".$c;
							}
           $cantidadDeParametrosIngresados++;
					}
				}
				if($tatuaje!=""){
					$tatuaje=" and (".$tatuaje.") ";
					$condicionesConsulta= $condicionesConsulta.$tatuaje;
				}
				/*FIN TATUAJE*/

				/*PREPARAR BUSQUEDA PIERCING*/
				$piercing="";
				for($c=1;$c<=$contadorOpcionesPiercing;$c++){
					if(isset($_REQUEST['piercing'.$c])){

							if($piercing==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_piercingsospechoso on tb_sospechoso.run=tb_piercingsospechoso.run ";
								$piercing= $piercing." id_lugarPiercing=".$c;
							}else{
								$piercing= $piercing." or id_lugarPiercing=".$c;
							}
            $cantidadDeParametrosIngresados++;
					}
				}
				if($piercing!=""){
					$piercing=" and (".$piercing.") ";
					$condicionesConsultacondicionesConsulta= $condicionesConsultacondicionesConsulta.$piercing;
				}
				/*FIN PIERCING*/

				/*PREPARAR BUSQUEDA DELITOS*/
				$delitos="";
				for($c=1;$c<=$contadorDelitos;$c++){
					if(isset($_REQUEST['delito'.$c])){

							if($delitos==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_delitosopechoso on tb_sospechoso.run=tb_delitosopechoso.run_sospechoso ";
								$delitos= $delitos." id_delito=".$c;
							}else{
								$delitos= $delitos." or id_delito=".$c;
							}
            $cantidadDeParametrosIngresados++;
					}
				}
				if($delitos!=""){
					$delitos=" and (".$delitos.") ";
					$condicionesConsulta= $condicionesConsulta.$delitos;
				}
				/*FIN DELITOS*/

				/*PREPARAR BUSQUEDA RANGO ESTATURA*/
				$rangosEstatura="";
				for($c=1;$c<=$contadorRangosEstatura;$c++){
					if(isset($_REQUEST['estatura'.$c])){

						$rangos= $Conexion->registros("select * from tb_rangoestatura where id_rangoEstatura=".$c);
						foreach($rangos as $filas){

							if($rangosEstatura==""){
								$rangosEstatura= $rangosEstatura." (  estatura between ".$filas['limite_inferior']." and ".$filas['limite_superior']." )";
							}else{
								$rangosEstatura= $rangosEstatura." or (  estatura between ".$filas['limite_inferior']." and ".$filas['limite_superior']." )";
							}
						}
            $cantidadDeParametrosIngresados++;
					}
				}

				if($rangosEstatura!=""){
					$rangosEstatura=" and (".$rangosEstatura.") ";
					$condicionesConsulta= $condicionesConsulta.$rangosEstatura;
				}
				/*FIN RANGO ESTATURA*/


				/*PREPARAR BUSQUEDA RANGO EDAD*/
				$rangosEdad="";
				for($c=1;$c<=$contadorRangosEdad;$c++){
					if(isset($_REQUEST['edad'.$c])){

						$rangos= $Conexion->registros("select * from tb_rangoedad where id_rangoEdad=".$c);
					   foreach($rangos as $filas){

							if($rangosEdad==""){
								$rangosEdad= $rangosEdad." (  edad(fecha_nacimiento) between ".$filas['limite_inferior']." and ".$filas['limite_superior']." )";
							}else{
								$rangosEdad= $rangosEdad." or (  edad(fecha_nacimiento) between ".$filas['limite_inferior']." and ".$filas['limite_superior']." )";
							}
						}
            $cantidadDeParametrosIngresados++;
					}
				}

				if($rangosEdad!=""){
					$rangosEdad=" and (".$rangosEdad.") ";
					$condicionesConsulta= $condicionesConsulta.$rangosEdad;
				}
				/*FIN RANGO EDAD*/

				/*PREPARAR BUSQUEDA EQUIPOS*/
				$equipos="";
				for($c=1;$c<=$contadorEquiposFutbol;$c++){
					if(isset($_REQUEST['equipo'.$c])){

							if($equipos==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_equiposospechoso on tb_sospechoso.run=tb_equiposospechoso.run ";
								$equipos= $equipos." id_equipo=".$c;
							}else{
								$equipos= $equipos." or id_equipo=".$c;
							}
           $cantidadDeParametrosIngresados++;
					}
				}
				if($equipos!=""){
					$equipos=" and (".$equipos.") ";
					$condicionesConsulta= $condicionesConsulta.$equipos;
				}
				/*FIN EQUIPOS*/

				/*PREPARAR BUSQUEDA ZONAS*/
				$zonas="";
				for($c=1;$c<=$contadorZonas;$c++){
					if(isset($_REQUEST['zona'.$c])){

							if($zonas==""){
								$enlacesConsulta= $enlacesConsulta." inner join tb_poblacionsospechoso on tb_sospechoso.run=tb_poblacionsospechoso.run
			    inner join tb_poblacion on tb_poblacionsospechoso.id_poblacion=tb_poblacion.id_poblacion
			    inner join tb_poblacionzonas on tb_poblacion.id_poblacion=tb_poblacionzonas.id_poblacion
			    inner join tb_zona on tb_poblacionzonas.id_zona=tb_zona.id_zona  ";
								$zonas= $zonas." tb_zona.id_zona=".$c;
							}else{
								$zonas= $zonas." or tb_zona.id_zona=".$c;
							}
            $cantidadDeParametrosIngresados++;
					}
				}
				if($zonas!=""){
					$zonas=" and (".$zonas.") ";
					$condicionesConsulta= $condicionesConsulta.$zonas;
				}
				/*FIN ZONAS*/

				$condicionesConsulta= $condicionesConsulta." group by tb_sospechoso.run;";

				$consulta= $consulta.$enlacesConsulta.$condicionesConsulta;
				//echo $consulta;

				$resultado= $Conexion->registros($consulta);

				if($Conexion->cantidadRegistros($consulta)!=0){

				echo '<div class="container">';


				//	$resultado= $Conexion->registros($consulta);

					foreach($resultado as $filas){


						echo'<div onclick="mostrarInformacionSospechoso('.$filas['run'].')" data-toggle="modal" data-target="#modalInfo">
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 img-thumbnail" id="cuadroSospechoso"
									style="
									background-image: url(\'../imagenes/'.$filas['nombre_imagen'].'\');
								    background-size: cover;
								    background-position: center;" >
								</div>
							</div>';
					}
			  	echo'</div>';
				}else{
					echo'<center><label  style="color:white; font-size:40px;">NO SE ENCONTRARON COINCIDENCIAS</label></center>';
				}

				//echo'<center><label  style="color:white; font-size:40px;">CANTIDAD DE PARAMETROS SELECCIONADOS: '.$cantidadDeParametrosIngresados.'</label></center>';



		}else{
			 echo "0";//no tiene privilegios para buscar
		}

}else{
echo "0";//usuario no existe
}


 ?>
