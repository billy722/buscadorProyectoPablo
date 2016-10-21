<?php
$con;
function conectarBD(){
		global $con;
		$con = new mysqli("localhost","root","82537240Guitar","pdisospechosos");
		if($con===false){
			die("ERROR, no se pudo conectar: ".mysqli_connect_error());
		}
}


function cargarEncabezado(){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>SOSPECHOSOS</title>
		<link rel="stylesheet" type="text/css" href="../css/principal.css">
		<link rel="stylesheet" type="text/css" href="../css/configuraciones/estilosConfiguraciones.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

		<script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
		<script type="text/javascript" src="../js/funciones.js"></script>
		<script type="text/javascript" src="../js/scriptsConfiguraciones.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</head>
	<body>
	<header class="fixed-nav">

		<div class="container">
	<div class="container row" id="menu">
			<div class="container btn btn-group">
<?php
		//conectarBD();
		$con2 = new mysqli("localhost","root","82537240Guitar","pdisospechosos");
		if($con2===false){
			die("ERROR, no se pudo conectar: ".mysqli_connect_error());
		}
		$resultado= $con2->query("SELECT * FROM pdisospechosos.tb_privilegios;");
		while($filas= $resultado->fetch_array()){
			switch($filas['id_privilegios']){
				case 1: echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-3 col-lg-3"   href="../principal/formularioFiltrarSospechoso.php"><span class="glyphicon glyphicon-search"></span> FILTRAR SOSPECHOSOS</a>';
					break;
				case 2:	echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-3 col-lg-3"   href="../mantenedores/mantenedorSospechosos.php"><span class="glyphicon glyphicon-list-alt"></span> SOSPECHOSOS</a>';
					break;
				/*case 3:	echo'<a href="mantenedorSospechosos.php">SOSPECHOSOS</a>';
					break;*/
				case 4:	echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-3 col-lg-3"  href="../mantenedores/mantenedoresPrincipal.php"><span class="glyphicon glyphicon-cog"></span> CONFIGURACIONES</a>';
					break;
			}
		}
								echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-3 col-lg-3"  href="../principal/cerrarSesion.php" ><span class="glyphicon glyphicon-remove-circle"></span> SALIR</a>';

?>
				</div>
			</div>
		</div>
	</header>

	<?php
}

function cargarMenuMantenedores(){
	?>
			<div class="container col-xs-4" id="divMenuMantenedores">

				<div class="cols-xs-12 btn-group-vertical">
					 <a href="../mantenedores/mantenedorUsuarios.php" class="btn btn-primary">Usuario</a>
					 <a href="../mantenedores/mantenedorGrupos.php" class="btn btn-primary">Privilegios</a>
					 <a href="../mantenedores/mantenedorDelitos.php" class="btn btn-primary">Delitos</a>
					 <a href="../mantenedores/mantenedorZonas.php" class="btn btn-primary">Zonas</a>
					 <a href="../mantenedores/mantenedorPoblacion.php" class="btn btn-primary">Poblaciones</a>
					 <a href="../mantenedores/mantenedorEquipos.php" class="btn btn-primary">Equipos</a>
				 </div>
			</div>
	<?Php
}

function cargarFooter(){
	?>
	<footer></footer>
	</body>
	</html>
	<?php
}

 ?>
