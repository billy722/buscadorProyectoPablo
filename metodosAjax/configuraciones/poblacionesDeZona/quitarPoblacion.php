<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$idGrupo = $_REQUEST['idg'];
	$idPrivilegio = $_REQUEST['idp'];

		$consulta= "delete from tb_poblacionzonas where id_poblacion=".$idPrivilegio." and id_zona=".$idGrupo;	
		$con->query($consulta);

	    echo $idGrupo;
?>