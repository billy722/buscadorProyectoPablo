<?php
	include("../../../comun.php");
    conectarBD();

	$nombre = $_POST['nombreMotivo'];
	
$consultaVerificar="select * from tb_equipofutbol where descripcion_equipo='".$nombre."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL NOMBRE DEL EQUIPO YA EXISTE, INGRESE OTRO NOMBRE';
}else{

		$consulta= "insert into tb_equipofutbol (descripcion_equipo,estado) values('".$nombre."',1)";	
		$con->query($consulta);
		echo'NUEVO EQUIPO CREADO';
}

?>