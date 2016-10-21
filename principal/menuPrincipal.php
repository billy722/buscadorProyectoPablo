<?php
session_start();

if(isset($_SESSION['rut'])==false &&

   isset($_SESSION['nombre'])==false &&

   isset($_SESSION['idDepartamento'])==false &&

   isset($_SESSION['descripcionDepartamento'])==false){



          header("location: ../index.php");

}else{

	include("./comun.php");

	cargarEncabezado();
 ?>

<?php
	cargarFooter();

}
 ?>
