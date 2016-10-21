<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$rut = $_REQUEST['rut'];

		$consulta= "delete from tb_usuarios where run=".$rut;	
		$con->query($consulta);
		echo'USUARIO ELIMINADO';


?>