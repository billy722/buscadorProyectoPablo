<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];

    $id;
    $nombre;

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		        //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
				$id = $_POST[$fila.',1'];
				$nombre= $_POST[$fila.',2'];

				$con->query("update tb_zona set descripcion_zona='".$nombre."' where id_zona=".$id);
				echo 'id: '.$id.';  nombre: '.$nombre;
	}

?>