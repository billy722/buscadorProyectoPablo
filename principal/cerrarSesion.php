<?php
include_once '../clases/Usuario.php';

@session_start();
$UsuarioHistorial= new Usuario();
$UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),25,$_SESSION['run'],"");

$Usuario= new Usuario();
$Usuario->cerrarSesion("../index.php");


 ?>
