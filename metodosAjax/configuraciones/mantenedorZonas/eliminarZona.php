<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$id = $_REQUEST['id'];

		$resultadoComprobarPrivilegiosGrupo = $con->query("select * from tb_poblacionzonas where id_zona=".$id);
		if($resultadoComprobarPrivilegiosGrupo->num_rows!=0){
			//primero se deben borrar los privilegios asignados y luego se borra el grupo
				echo 'NO PERMITIDO. LA ZONA QUE INTENTA ELIMINAR TIENE POBLACIONES ASOCIADAS';
				/*$consulta1= "delete from tb_grupoprivilegio where id_grupoUsuario=".$id;	
				$con->query($consulta1);

				$consulta2= "delete from tb_grupousuario where id_grupoUsuario=".$id;	
				$con->query($consulta2);
				echo'GRUPO ELIMINADO(p)';*/
		}else{//se puede eliminar porque no presenta registros en historial

				$consulta2= "delete from tb_zona where id_zona=".$id;	
				$con->query($consulta2);
				echo'ZONA ELIMINADA';
		}


?>