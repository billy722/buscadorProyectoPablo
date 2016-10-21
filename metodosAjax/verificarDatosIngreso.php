<?php
	include("../principal/comun.php");
	conectarBD();

 	$usuario = $_REQUEST["u"];
 	$contrasena = $_REQUEST["c"];

 	$posicionGuion = strpos($usuario,'-');
	$soloRunConPuntos = substr($usuario,0,$posicionGuion);
	$soloRun=str_replace(".", "", $soloRunConPuntos);


 	$consulta = "CALL comprobarDatosIngreso('".$soloRun."','".$contrasena."')";
 	//echo $consulta;
 	$resultado = $con->query($consulta);


 	if($resultado->num_rows != 0){
 		$filas = $resultado->fetch_array();
 			@session_start();
 			$_SESSION['run'] = $soloRun;
 			$_SESSION['nombre'] = $filas['nombre'].' '.$filas['apellidoPaterno'].' '.$filas['apellidoMaterno'];

		    header('Location: ../principal/menuPrincipal.php');
 	}else{
 		header('Location: ../index.php');
 	}
 ?>
