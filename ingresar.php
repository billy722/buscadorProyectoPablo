<?php
include("./comun.php");
conectarBD();

	 $run=$_POST['run'];
     $posicionGuion = strpos($run,'-');
     $soloRun = substr($run,0,$posicionGuion);
     $digitoVerificador = substr($run,$posicionGuion+1,strlen($run));

$nombre=$_POST['nombre'];
$apellidoP=$_POST['apellidoPaterno'];
$apellidoM=$_POST['apellidoMaterno'];
$fechaNacimiento=$_POST['edad'];
$apodo=$_POST['apodo'];
$lugarNacimiento=$_POST['lugarNacimiento'];
$colorPelo=$_REQUEST['colorPelo'];
$contextura=$_POST['contextura'];
$estadoCivil=$_POST['estadoCivil'];
$sexo=$_REQUEST['sexo'];
$tezPiel=$_REQUEST['tezPiel'];
$tipoOjos=$_REQUEST['tipoOjos'];
$tipoPelo=$_REQUEST['tipoPelo'];
$acne=$_REQUEST['acne'];
$barba=$_REQUEST['barba'];
$bigote=$_REQUEST['bigote'];
$manchas=$_REQUEST['manchas'];
$lentes=$_REQUEST['lentes'];
$pecas=$_REQUEST['pecas'];
$antecedentes=$_REQUEST['antecedentes'];
$estatura=$_REQUEST['estatura'];

if($estatura==""){
	$estatura=0;
}

/*INGRESAR NUEVO SOSPECHOSO*/
$consultaIngreso="INSERT INTO `pdisospechosos`.`tb_sospechoso`
(`run`,`dv`,`nombres`,`apellido_paterno`,`apellido_materno`,`lugar_deNacimiento`,`id_colorPelo`,`id_contextura`,`id_estadoCivil`,
`id_sexo`,`id_tezPiel`,`id_tipoOjos`,`id_tipoPelo`,`antecedentes_penales`,`apodos`,`barba`,`lentes`,`pecas`,`acne`,`bigote`,`manchas`,
`estatura`,`fecha_nacimiento`)
VALUES('$soloRun','$digitoVerificador','$nombre','$apellidoP','$apellidoM','$lugarNacimiento','$colorPelo','$contextura','$estadoCivil',
'$sexo','$tezPiel','$tipoOjos','$tipoPelo','$antecedentes','$apodo','$barba','$lentes','$pecas','$acne','$bigote','$manchas','$estatura','$fechaNacimiento');";

$con->query($consultaIngreso);


	$contadorDelitos= $_REQUEST['contadorDelitos'];
	$contadorEquiposFutbol= $_REQUEST['contadorEquiposFutbol'];
	$contadorOpcionesCicatriz= $_REQUEST['contadorOpcionesCicatriz'];
	$contadorOpcionesTatuaje= $_REQUEST['contadorOpcionesTatuaje'];
	$contadorOpcionesPiercing= $_REQUEST['contadorOpcionesPiercing'];
	$contadorPoblaciones=$_REQUEST['contadorPoblaciones'];
	$contadorFotos=$_REQUEST['contadorFotos'];



/*PREPARAR BUSQUEDA DELITOS*/
	$delitos="";
	for($c=1;$c<=$contadorDelitos;$c++){

		if(isset($_REQUEST['delito'.$c])){

				if($delitos==""){
					$delitos= $delitos.$c;
				}else{
					$delitos= $delitos.";".$c;
				}

		}
	}
	$arrayDelitos= explode(";",$delitos);

	foreach ($arrayDelitos as $key => $de) {

		//echo $de."\n";
		$consultaDelitos= "INSERT INTO tb_delitosopechoso(id_delito,run_sospechoso) VALUES('$de','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}
	/*FIN DELITOS*/

	/*PREPARAR BUSQUEDA EQUIPOS*/
	$equipos="";
	for($c=1;$c<=$contadorEquiposFutbol;$c++){
		if(isset($_REQUEST['equipo'.$c])){

				if($equipos==""){
					$equipos= $equipos.$c;
				}else{
					$equipos= $equipos.";".$c;
				}

		}
	}
	$arrayEquipos= explode(";",$equipos);

	foreach ($arrayEquipos as $key => $eq) {

		//echo $eq."\n";
		$consultaDelitos= "insert into tb_equiposospechoso(id_equipo,run) VALUES('$eq','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}
	/*FIN EQUIPOS*/

	/*PREPARAR BUSQUEDA POBLACIONES*/
	$poblaciones="";
	for($c=1;$c<=$contadorPoblaciones;$c++){
		if(isset($_REQUEST['poblacion'.$c])){

				if($poblaciones==""){
					$poblaciones= $poblaciones.$c;
				}else{
					$poblaciones= $poblaciones.";".$c;
				}

		}
	}
	$arrayPoblaciones= explode(";",$poblaciones);

	foreach ($arrayPoblaciones as $key => $pob) {

		//echo $pob."\n";
		$consultaDelitos= "insert into tb_poblacionsospechoso(id_poblacion,run) VALUES('$pob','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}
	/*FIN POBLACIONES*/

	/*PREPARAR BUSQUEDA CICATRIZ*/
	$cicatriz="";
	for($c=1;$c<=$contadorOpcionesCicatriz;$c++){
		if(isset($_REQUEST['cicatriz'.$c])){

				if($cicatriz==""){
					$cicatriz= $cicatriz.$c;
				}else{
					$cicatriz= $cicatriz.";".$c;
				}

		}
	}
	$arrayCicatrices= explode(";",$cicatriz);
	foreach ($arrayCicatrices as $key => $cic) {

		//echo $cic."\n";
		$consultaDelitos= "insert into tb_cicatrizsospechoso(id_lugarCicatriz,run) VALUES('$cic','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}
	/*FIN CICATRIZ*/

	/*PREPARAR BUSQUEDA TATUAJE*/
	$tatuaje="";
	for($c=1;$c<=$contadorOpcionesTatuaje;$c++){
		if(isset($_REQUEST['tatuaje'.$c])){

				if($tatuaje==""){
					$tatuaje= $tatuaje.$c;
				}else{
					$tatuaje= $tatuaje.";".$c;
				}

		}
	}
	$arrayTatuaje= explode(";",$tatuaje);
	foreach ($arrayTatuaje as $key => $tat) {

		//echo $tat."\n";
		$consultaDelitos= "insert into tb_tatuajesospechoso(id_lugarTatuaje,run) VALUES('$tat','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}
	/*FIN TATUAJE*/

	/*PREPARAR BUSQUEDA PIERCING*/
	$piercing="";
	for($c=1;$c<=$contadorOpcionesPiercing;$c++){
		if(isset($_REQUEST['piercing'.$c])){

				if($piercing==""){
					$piercing= $piercing.$c;
				}else{
					$piercing= $piercing.";".$c;
				}

		}
	}
	$arrayPiercing= explode(";",$piercing);

	foreach ($arrayPiercing as $key => $pi) {

		//echo $pi."\n";
		$consultaDelitos= "insert into tb_piercingsospechoso(id_lugarPiercing,run) VALUES('$pi','$soloRun');";
		$con->query($consultaDelitos);
		//echo $consultaDelitos;
	}

	/*FIN PIERCING*/




		for($c=1;$c<=$contadorFotos;$c++){
			$campo= "foto".$c;
			$fechaFoto= "fechaFoto".$c;
			$tipoFoto= "tipoFoto".$c;

			if(isset($_REQUEST[$tipoFoto])){
					$tipoFoto=1;
			}else{
					$tipoFoto=2;
			}
				$target_path = "imagenes/";
				$target_path = $target_path . basename( $_FILES[$campo]['name']);

				str_replace("�","n",$target_path);

				if(move_uploaded_file($_FILES[$campo]['tmp_name'], $target_path)) {
				   //echo "El archivo ". basename( $_FILES[$campo]['name']). " ha sido subido";

				  $consultaFotos="call guardarImagen('".basename( $_FILES[$campo]['name'])."','".$_REQUEST[$fechaFoto]."',".$tipoFoto.",".$soloRun.");";
				          //echo $consultaFotos;
				          $con->query($consultaFotos);

				} else{
				echo "Ha ocurrido un error, trate de nuevo!";
				}
		}

		header("location: formularioIngresoSospechosos.php?correcto=1");

//$consulta2 = $con->query("insert into tb_imagen (nombre_imagen) values ('$_FILES[$key]['tmp_name']')");

//echo $consulta2;
 ?>
