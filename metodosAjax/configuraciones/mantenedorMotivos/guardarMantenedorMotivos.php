<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];

    $id;
    $nombre;
    $estado;

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		       	
				$id = $_POST[$fila.',1'];
				$nombre= $_POST[$fila.',2'];
				$estado= $_POST[$fila.',3'];

				$con->query("update tb_equipofutbol set descripcion_equipo='".$nombre."', estado=".$estado." where id_equipo=".$id);	
	}

?>