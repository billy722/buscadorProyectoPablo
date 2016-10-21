<?php
	include("../../../comun.php");
    conectarBD();

    $cantidadFilas= $_POST['cantidadFilas'];
    echo $cantidadFilas;

    $rut;
    $dv;
    $nombre;
    $apellidoPaterno;
    $apellidoMaterno;
    $contrasenia;
    $correo;
    $telefono;
    $idGrupo;
    

    for($fila=1; $fila <= $cantidadFilas; $fila++){
		        //RECIBE VALOR DEL TXT OCULTO CON ID DE HORA	
				$rut = $_POST[$fila.',1'];
				$dv= $_POST[$fila.',2'];
				$nombre=$_POST[$fila.',3'];
				$apellidoPaterno=$_POST[$fila.',4'];
				$apellidoMaterno=$_POST[$fila.',5'];
				$contrasenia=$_POST[$fila.',6'];
				$correo=$_POST[$fila.',7'];
				$telefono=$_POST[$fila.',8'];
				$idGrupo=$_POST[$fila.',9'];

				$consulta="update tb_usuarios set nombre='".$nombre."',
							apellidoPaterno='".$apellidoPaterno."',
							apellidoMaterno='".$apellidoMaterno."',
							password='".$contrasenia."',
							correo='".$correo."', 
							telefono='".$telefono."',
							id_grupoUsuario=".$idGrupo."
							where tb_usuarios.run=".$rut;

				$con->query($consulta);
				echo $consulta;
	}

?>