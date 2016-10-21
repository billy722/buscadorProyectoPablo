<?php
	include("../../../comun.php");
    conectarBD();

	$id = $_REQUEST['id'];

$resultadoComprobar = $con->query("select * from tb_poblacionzonas where id_poblacion=".$id);

		if($resultadoComprobar->num_rows!=0){
			    //SI HAY USUARIOS ACTIVOS CON ESTE DEPARTAMENTO ASIGNADO
				echo'NO PERMITIDO. HAY ZONAS CON ESTA POBLACION ASIGNADA';
		}else{//se puede eliminar porque no presenta registros en historial

						$consulta2= "delete from tb_poblacion where id_poblacion=".$id;	
						$con->query($consulta2);
						echo'POBLACION ELIMINADA';
		}


?>