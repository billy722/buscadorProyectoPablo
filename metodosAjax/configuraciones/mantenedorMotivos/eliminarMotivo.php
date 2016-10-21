<?php
	include("../../../comun.php");
    conectarBD();

	$id = $_REQUEST['id'];

$resultadoComprobarUsuariosActivos = $con->query("select * from tb_equiposospechoso where id_equipo=".$id);

		if($resultadoComprobarUsuariosActivos->num_rows!=0){
			    //SI HAY AUDIENCIAS CON ESTE ESTADO ASIGNADO

				echo'NO PERMITIDO. HAY SOSPECHOSOS CON EL EQUIPO QUE DESEA ELIMINAR';
		}else{//se puede eliminar porque no presenta audiencias con este motivo
	
						$consulta2= "delete from tb_equipofutbol where id_equipo=".$id;	
						$con->query($consulta2);
						echo'EQUIPO ELIMINADO';
		}


?>