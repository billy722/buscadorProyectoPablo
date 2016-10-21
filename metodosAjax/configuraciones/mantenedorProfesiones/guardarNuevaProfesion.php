<?php
	include("../../../comun.php");
    conectarBD();

	$nuevaProfesion = $_POST['nuevaProfesion'];
	
$consultaVerificar="select * from tb_poblacion where descripcion_poblacion='".$nuevaProfesion."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL NOMBRE QUE INGRESO YA EXISTE';
}else{

		$consulta= "insert into tb_poblacion (descripcion_poblacion) values('".$nuevaProfesion."')";	
		$con->query($consulta);
		echo'NUEVO POBLACION CREADA';
}

?>