<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$idGrupo = $_REQUEST['idg'];
	$idPrivilegio = $_REQUEST['idp'];

		$consulta= "insert into tb_poblacionzonas values(".$idPrivilegio.",".$idGrupo.")";	
		$con->query($consulta);

	    echo $idGrupo;
?>