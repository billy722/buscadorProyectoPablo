<?php
require_once '../clases/Usuario.php';
$UsuarioValidar= new Usuario();
$UsuarioValidar->verificarSesion();

	include("./comun.php");

	cargarEncabezado();
	cargarFooter();
 ?>
