<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$idGrupo = $_REQUEST['idg'];
	$idPrivilegio = $_REQUEST['idp'];

		$consulta= "delete from tb_grupoprivilegio where id_privilegio=".$idPrivilegio." and id_grupoUsuario=".$idGrupo;	
		$con->query($consulta);

	    echo $idGrupo;
?>