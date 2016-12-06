<?php
include_once '../clases/Conexion.php';

class Estado extends Conexion{
      private $_idEstado;
      private $_descripcionEstado;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }
  public function listarEstado(){
  	$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    return $estados;

  }
  }
?>
