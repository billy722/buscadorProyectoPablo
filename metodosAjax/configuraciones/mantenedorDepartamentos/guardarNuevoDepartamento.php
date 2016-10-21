<?php
	include("../../../comun.php");
    conectarBD();

	$nombre = $_POST['nombreDepartamento'];
	
$consultaVerificar="select * from tb_delito where descripcion_delito='".$nombre."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL NOMBRE DEL DELITO YA EXISTE, INGRESE OTRO NOMBRE';
}else{

		$consulta= "insert into tb_delito (descripcion_delito,estado) values('".$nombre."',1)";	
		$con->query($consulta);
		echo'NUEVO DELITO CREADO';
}

?>