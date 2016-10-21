<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$nombre = $_POST['nombreGrupo'];
	
$consultaVerificar="select * from tb_zona where descripcion_zona='".$nombre."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL NOMBRE DE ZONA YA EXISTE, INGRESE OTRO NOMBRE';
}else{

		$consulta= "insert into tb_zona (descripcion_zona) values('".$nombre."')";	
		$con->query($consulta);
		echo'NUEVA ZONA CREADA';
}

?>