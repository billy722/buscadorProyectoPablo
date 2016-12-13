<?php
$con;
function conectarBD(){
		global $con;
		$con = new mysqli("localhost","root","","pdisospechosos");
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

		<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="../js/funciones.js"></script>
		<script type="text/javascript" src="../js/scriptsConfiguraciones.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="../sweetalert/sweet-alert.css">
		<script src="../sweetalert/sweet-alert.min.js"></script>

	</head>
	<body>
	<header class="fixed-nav">

		<div class="container">
	<div class="container row" id="menu">
			<div class="container btn btn-group">
<?php
@session_start();

require_once '../clases/Usuario.php';
require_once '../clases/Grupos.php';

$Usuario= new Usuario();
$Usuario->setRun($_SESSION['run']);
$resultadoUsuario= $Usuario->consultaUnUsuario();
if($resultadoUsuario){

	$Grupo = new Grupos();
	$Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
	$privilegios=$Grupo->consultaPrivilegiosDeGrupo();

	foreach($privilegios as $privilegio){

		switch($privilegio['id']){
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

	}else{
		header("location: ../index.php");
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

		echo'<div class="btn-group col-xs-12">
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorUsuarios.php" ><strong>Usuarios</strong></a>
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorGrupos.php" ><strong>Privilegios</strong></a>
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorDelitos.php" ><strong>Delitos</strong></a>
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorZonas.php" ><strong>Zonas</strong></a>
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorPoblacion.php" ><strong>Poblaciones</strong></a>
						<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorEquipos.php" ><strong>Equipos</strong></a>
			</div>
	';
}

function cargarFooter(){
	?>
	<footer></footer>
	</body>
	</html>
	<?php
}

 ?>
