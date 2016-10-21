<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas = $_POST['cantidadFilas'];
    //echo "cant: ".$cantidadFilas.", 1,10: ".$_POST['1,10'];   
   	$rut;
    $dv;
    $nombre;
    $apellidoPaterno;
    $apellidoMaterno;
    $direccion;
    $fechaNacimiento;
    $telefono;
    $idDepartamento;
    $estado;
    $profesion;

    for($fila==1; $fila <= $cantidadFilas; $fila++){
    			//separo el rut del guion
    			$rut = $_POST[$fila.',1'];
			    $posicionGuion = strpos($rut,'-');
				$soloRut = substr($rut,0,$posicionGuion); 
				$digitoVerificador = substr($rut,$posicionGuion+1,strlen($rut));

				$nombre=$_POST[$fila.',2'];
				$apellidoPaterno=$_POST[$fila.',3'];
				$apellidoMaterno=$_POST[$fila.',4'];
				$direccion=$_POST[$fila.',5'];
				$fechaNacimiento=$_POST[$fila.',6'];
				$telefono=$_POST[$fila.',7'];
				$idTipo=$_POST[$fila.',8'];
				$estado = $_POST[$fila.',9'];
				$profesion = $_POST[$fila.',10'];



				$con->query("update solicitante set nombre='".$nombre."',
							apellidoPaterno='".$apellidoPaterno."',
							apellidoMaterno='".$apellidoMaterno."',
							direccion='".$direccion."',
							fechaNacimiento='".$fechaNacimiento."',
							telefono='".$telefono."',
							estado=".$estado.",
							tipo=".$idTipo.",
							profesion=".$profesion."
							where rut=".$soloRut);
	}

?>