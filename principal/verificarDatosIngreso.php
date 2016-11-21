<?php
require_once '../clases/Usuario.php';
$Usuario = new Usuario();

 	$usuario = $_REQUEST["u"];
 	$contrasena = $_REQUEST["c"];

  $usuario= $Usuario->limpiarTexto($usuario);
  $usuario= $Usuario->limpiarNumeroEntero($usuario);

  $contrasena= $Usuario->limpiarTexto($contrasena);
  $contrasena= $Usuario->limpiarNumeroEntero($contrasena);



  if(!$Usuario->validarRut($usuario)){
        echo "3"; //rut no valido
  }else{


     	$posicionGuion = strpos($usuario,'-');
    	$soloRunConPuntos = substr($usuario,0,$posicionGuion);
    	$soloRun=str_replace(".", "", $soloRunConPuntos);


      if(is_numeric($soloRun)){

            	$Usuario->setRun($soloRun);
            	$Usuario->setClave($contrasena);

            	if($Usuario->comprobarUsuario()){
                    echo "1";
              }else{
                    echo "2";
              }
      }else{
        echo "2";//NO ES UN NUMERO, HAY LETRAS
      }

    }

 ?>
