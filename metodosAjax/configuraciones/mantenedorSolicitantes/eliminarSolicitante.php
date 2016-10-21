<?php
	include("../../../comun.php");
    conectarBD();

   //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
	$rut = $_REQUEST['rut'];

$resultado = $con->query("select solicitante from audiencia where solicitante=".$rut);

if($resultado->num_rows!=0){
	//no se puede eliminar, se cambia estado a inactivo
		$consulta1= "update solicitante set estado=2 where rut=".$rut;	
		$con->query($consulta1);
		echo'EL SOLICITANTE QUE INTENTA ELIMINAR POSEE ACTIVIDAD EN LOS REGISTROS, SOLO SE PONDRÁ COMO INACTIVO';

}else{//se puede eliminar porque no presenta registros en AUDIENCIAS

		$consulta2= "delete from solicitante where rut=".$rut;	
		$con->query($consulta2);
		echo'SOLICITANTE ELIMINADO';
}

?>