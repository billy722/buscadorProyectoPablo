<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];

    $id;
    $nombre;

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		       
				$id = $_POST[$fila.',1'];
				$nombre= $_POST[$fila.',2'];

				$con->query("update tb_poblacion set descripcion_poblacion='".$nombre."' where id_poblacion=".$id);
				echo 'id: '.$id.';  Profesion: '.$nombre;	
	}

?>