<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$nombre = $_POST['nombreGrupo'];
	
$consultaVerificar="select * from tb_grupousuario where descripcion_grupoUsuario='".$nombre."'";
$resultadoComprobacion= $con->query($consultaVerificar);

if($resultadoComprobacion->num_rows!=0){
	echo'EL NOMBRE DEL GRUPO YA EXISTE, INGRESE OTRO NOMBRE';
}else{

		$consulta= "insert into tb_grupousuario (descripcion_grupoUsuario) values('".$nombre."')";	
		$con->query($consulta);
		echo'NUEVO GRUPO CREADO';
}

?>