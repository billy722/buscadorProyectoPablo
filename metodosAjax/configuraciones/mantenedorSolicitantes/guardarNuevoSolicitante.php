<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$rut = $_POST['rutSolicitante'];

	//separo el rut del guion
    $posicionGuion = strpos($rut,'-');
	$soloRut = substr($rut,0,$posicionGuion); 
	$digitoVerificador = substr($rut,$posicionGuion+1,strlen($rut));

$consultaVerificar="select * from solicitante where rut=".$soloRut;
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL RUT INGRESADO YA EXISTE';
}else{
			    $nombre=$_POST['nombreSolicitante'];
				$apellidoPaterno=$_POST['apellidoPaterno'];
				$apellidoMaterno=$_POST['apellidoMaterno'];
				$direccion=$_POST['direccionSolicitante'];
				$fechaNacimiento=$_POST['fechaNacimientoSolicitante'];
				$telefonoSolicitante=$_POST['telefonoSolicitante'];
				$profesion=$_POST['profesion'];
				$tipoSolicitante=$_POST['tipoSolicitante'];

		$consulta= "insert into solicitante values(".$soloRut.",'".$digitoVerificador."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$direccion."','".$fechaNacimiento."','".$telefonoSolicitante."',1,".$tipoSolicitante.",0,".$profesion.")";	
		$con->query($consulta);
		echo'NUEVO SOLICITANTE CREADO';
}

?>