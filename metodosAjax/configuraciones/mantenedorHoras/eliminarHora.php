<?php
	include("../../../comun.php");
    conectarBD();

	$id = $_REQUEST['id'];

$resultadoComprobarUsuariosActivos = $con->query("select * from horaaudiencia where idHora=".$id);

		if($resultadoComprobarUsuariosActivos->num_rows!=0){
			    //SI HAY USUARIOS ACTIVOS CON ESTE DEPARTAMENTO ASIGNADO
				echo'NO PERMITIDO. HAY AUDIENCIAS QUE TIENEN ESTA HORA ASIGNADA';
		}else{//se puede eliminar porque no presenta registros en historial

						$consulta2= "delete from horas where idHora=".$id;	
						$con->query($consulta2);
						echo'HORA ELIMINADA';
		}


?>