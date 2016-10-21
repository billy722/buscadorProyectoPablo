<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA
	$rut = $_POST['rutUsuario'];

	//separo el rut del guion
    $posicionGuion = strpos($rut,'-');
	$soloRut = substr($rut,0,$posicionGuion);
	$digitoVerificador = substr($rut,$posicionGuion+1,strlen($rut));

$consultaVerificar="select * from tb_usuarios where run=".$soloRut;
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL RUT INGRESADO YA EXISTE';
}else{
			  $nombre=$_POST['nombreUsuario'];
				$apellidoPaterno=$_POST['apellidoPaterno'];
				$apellidoMaterno=$_POST['apellidoMaterno'];
				$contrasenia=$_POST['contraseniaUsuario'];
				$idGrupo=$_POST['grupoUsuario'];
				$correo=$_POST['correoUsuario'];
				$telefono=$_POST['telefonoUsuario'];

		$consulta= "insert into tb_usuarios values(".$soloRut.",'".$digitoVerificador."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$contrasenia."',".$telefono.",'".$correo."',".$idGrupo.")";

		$con->query($consulta);
		echo'NUEVO USUARIO CREADO';
}

?>
