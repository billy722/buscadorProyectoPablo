<?php

function cargarEncabezado(){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>SOSPECHOSOS</title>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/principal.css">
		<link rel="stylesheet" type="text/css" href="../css/configuraciones/estilosConfiguraciones.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="../js/funciones.js"></script>
		<script type="text/javascript" src="../js/scriptsConfiguraciones.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>

		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-3d.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/drilldown.js"></script>


		<link rel="stylesheet" href="../sweetalert/sweet-alert.css">
		<script src="../sweetalert/sweet-alert.min.js"></script>

		<!-- <script language="JavaScript">
		//Disable right click script III- By Renigade (renigade@mediaone.net)
		//For full source code, visit http://www.dynamicdrive.com
		var message = "";

		function clickIE(){
		if (document.all){
		(message);
		return false;
		}
		}

		function clickNS(e){
		if (document.layers || (document.getElementById && !document.all)){
		if (e.which == 2 || e.which == 3){
		(message);
		return false;
		}
		}
		}

		if (document.layers){
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown = clickNS;
		} else {
		document.onmouseup = clickNS;
		document.oncontextmenu = clickIE;
		}
		document.oncontextmenu = new Function("return false");
		</script> -->
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
			case 1: echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-2 col-lg-3"   href="../principal/formularioFiltrarSospechoso.php"><span class="glyphicon glyphicon-search"></span> FILTRAR SOSPECHOSOS</a>';
			break;
			case 2:	echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-2 col-lg-3"   href="../mantenedores/mantenedorSospechosos.php"><span class="glyphicon glyphicon-list-alt"></span> SOSPECHOSOS</a>';
			break;
			case 12:	echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-2 col-lg-2"   href="../principal/reportes.php"><span class="glyphicon glyphicon-list-alt"></span> Reportes</a>';
			break;
			case 5:	echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-2 col-lg-2"  href="../mantenedores/mantenedoresPrincipal.php"><span class="glyphicon glyphicon-cog"></span> CONFIGURACIONES</a>';
			break;
		}
	}

	}else{
		header("location: ../index.php");
	}
								echo'<a class="btn btn-default col-xs-12 col-sm-6 col-md-2 col-lg-2"  href="../principal/cerrarSesion.php" ><span class="glyphicon glyphicon-remove-circle"></span> SALIR</a>';

?>
				</div>
			</div>
		</div>
	</header>

	<?php
}

function cargarMenuMantenedores(){
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

		  echo'<div class="btn-group col-xs-12">';
			foreach($privilegios as $privilegio){

						switch($privilegio['id']){

									case 6:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorUsuarios.php" ><strong>Usuarios</strong></a>';//mantenedor
									break;
									case 7:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorGrupos.php" ><strong>Privilegios</strong></a>';//mantenedor
									break;
									case 8:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorDelitos.php" ><strong>Delitos</strong></a>';//mantenedor
									break;
									case 9:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorZonas.php" ><strong>Zonas</strong></a>';//mantenedor
									break;
									case 10:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorPoblacion.php" ><strong>Poblaciones</strong></a>';//mantenedor
									break;
									case 11:
											echo'<a class="btn btn-info col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorEquipos.php" ><strong>Equipos</strong></a>';//mantenedor
									break;
						}
			}
		  echo'</div>';

		}else{
			header("location: ../index.php");
		}


}

function cargarMenuReportes(){
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

		  echo'<div class="btn-group col-xs-12">';
			foreach($privilegios as $privilegio){

						switch($privilegio['id']){

									case 12:
											echo'<a class="btn btn-info col-xs-12 col-sm-12 col-md-4 botonesMenuConfiguraciones" href="reportes.php" ><strong>Estadisticas de Delitos Cometidos</strong></a>';//mantenedor
											echo'<a class="btn btn-info col-xs-12 col-sm-12 col-md-4 botonesMenuConfiguraciones" href="reportes2.php" ><strong>Delincuentes por zonas y poblacion</strong></a>';//mantenedor
											echo'<a class="btn btn-info col-xs-12 col-sm-12 col-md-4 botonesMenuConfiguraciones" href="reportes3.php" ><strong>Top ten Delincuentes identificados</strong></a>';//mantenedor
									break;

						}
			}
		  echo'</div>';

		}else{
			header("location: ../index.php");
		}


}

function cargarFooter(){
	?>
	<footer></footer>
	</body>
	</html>
	<?php
}

 ?>
