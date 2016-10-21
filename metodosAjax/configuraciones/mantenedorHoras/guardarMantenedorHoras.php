<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];

    $id;
    $nombre;

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		       
				$id = $_POST[$fila.',1'];
				$nombre= $_POST[$fila.',2'];

				$con->query("update horas set hora='".$nombre."' where idHora=".$id);
				echo 'id: '.$id.';  nombre: '.$nombre;	
	}

?>