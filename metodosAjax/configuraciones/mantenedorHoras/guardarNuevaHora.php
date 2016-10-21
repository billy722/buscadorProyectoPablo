<?php
	include("../../../comun.php");
    conectarBD();

	$nuevaHora = $_POST['nuevaHora'];
	
$consultaVerificar="select * from horas where hora='".$nuevaHora."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'LA HORA QUE INTENTA INGRESAR YA EXISTE';
}else{

		$consulta= "insert into horas (hora) values('".$nuevaHora."')";	
		$con->query($consulta);
		echo'NUEVO HORA AGREGADA';
}

?>