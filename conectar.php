<?php 
$con;

function conectarBD(){
		global $con;
		$con = new mysqli("localhost","root","","pdisospechosos");
		if($con===false){
			die("ERROR, no se pudo conectar: ".mysqli_connect_error());
		}
}

 ?>