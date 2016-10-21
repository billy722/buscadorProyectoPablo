<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];

    $id;
    $nombre;
    $estado;

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		        //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
				$id = $_POST[$fila.',1'];
				$nombre= $_POST[$fila.',2'];
				$estado= $_POST[$fila.',3'];

				$con->query("update tb_delito set descripcion_delito='".$nombre."', estado=".$estado." where id_delito=".$id);
				echo 'id: '.$id.';  nombre: '.$nombre.'; estado: '.$estado;
	}

?>