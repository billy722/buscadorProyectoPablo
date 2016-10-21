<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$id = $_REQUEST['id'];

$resultadoComprobarUsuarioGrupo = $con->query("select * from tb_usuarios where id_grupoUsuario =".$id);

if($resultadoComprobarUsuarioGrupo->num_rows!=0){
	//no se puede eliminar, al menos un usuario tiene este grupo asignado
		echo'NO SE PUEDE ELIMINAR, EL GRUPO ESTÁ ASIGNADO AL MENOS A UN USUARIO';

}else{//se puede eliminar porque no presenta registros en historial

		$resultadoComprobarPrivilegiosGrupo = $con->query("select * from tb_grupoprivilegio where id_grupoUsuario=".$id);
		if($resultadoComprobarPrivilegiosGrupo->num_rows!=0){
			//primero se deben borrar los privilegios asignados y luego se borra el grupo
				$consulta1= "delete from tb_grupoprivilegio where id_grupoUsuario=".$id;	
				$con->query($consulta1);

				$consulta2= "delete from tb_grupousuario where id_grupoUsuario=".$id;	
				$con->query($consulta2);
				echo'GRUPO ELIMINADO(p)';
		}else{//se puede eliminar porque no presenta registros en historial

				$consulta2= "delete from tb_grupousuario where id_grupoUsuario=".$id;	
				$con->query($consulta2);
				echo'GRUPO ELIMINADO';
		}
}

?>