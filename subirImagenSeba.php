<?php
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("SITE_ROOT") ? null : define("SITE_ROOT", "D:".DS."XAMP".DS."htdocs".DS."mobileFirst");

$img = $_FILES['img'];
$nombreImg = $img['name'];
$tipoImg = $img['type'];
$rutaPrevisional = $img['tmp_name'];
$size = $img['size'];
$dimensiones = getimagesize($rutaPrevisional);
$width = $dimensiones[0];
$height = $dimensiones[1];
$carpeta = "image/portada";


$id = $_REQUEST['id'];
$titulo = $_REQUEST['titulo'];
$contenido = $_REQUEST['contenido'];
$src = "../image/portada/".$nombreImg;

if($tipoImg != 'image/jpeg' && $tipoImg != 'image/jpeg' && $tipoImg != 'image/png'){
	echo "El Archivo a subir no es una imagen";
}else if($size > 1024*1024){
	echo "Tamaño de imagen muy grande";
}else if($width > 5000 || $height > 5000){
	echo "La anchura y altura maxima para la imagen es 5000px";
}else if($width < 60 || $height < 60){
	echo "La anchura y altura minima para la imagen es de 60px";
}else{
	$resultado = $portada->actualizarPortada($id, $titulo, $src, $contenido);
	if($resultado){
		$file_upload_to= SITE_ROOT . DS . $carpeta;
		move_uploaded_file($rutaPrevisional, $file_upload_to . DS . $nombreImg);
		echo "Portada actualizada con exito";
	}else{
		echo "Ha ocurrido un error al actualizar la portada";
	}
?>
