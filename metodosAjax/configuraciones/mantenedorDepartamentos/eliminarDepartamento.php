<?php
	include("../../../comun.php");
    conectarBD();

	$id = $_REQUEST['id'];

$resultadoComprobarUsuariosActivos = $con->query("select * FROM tb_delitosopechoso where id_delito=".$id);

		if($resultadoComprobarUsuariosActivos->num_rows!=0){
			    //SI HAY USUARIOS ACTIVOS CON ESTE DEPARTAMENTO ASIGNADO
				echo'NO PERMITIDO. HAY SOSPECHOSOS CON ESTE DELITO ASIGNADO, SOLO PUEDE DEJAR DELITO COMO INACTIVO';

				$consulta1= "update tb_delito set estado=2 where id_delito=".$id;	
					$con->query($consulta1);
					echo'SE HA DESACTIVADO EL DEPARTAMENTO';

		}else{

				
						$consulta2= "delete from tb_delito where id_delito=".$id;	
						$con->query($consulta2);
						echo'DELITO ELIMINADO';
				
		}


?>