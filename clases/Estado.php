<?php
include_once '../clases/Conexion.php';

class Estado extends Conexion{
      private $_idEstado;
      private $_descripcionEstado;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }
  public function setIdEstado($arg_idEstado){
     $this->_idEstado=$arg_idEstado;
  }
  public function getIdEquipo(){
    return $this->_idEstado;
  }
 public function setDescripcionEstado($arg_descripcionEstado){
    $this->_descripcion_estado=$arg_descripcionEstado;
 }
 public function getDescripcionEquipo(){
   return $this->_descripcion_estado;
 }
  public function listarEstado(){
  	$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    return $estados;

  }
  public function listarEstados(){
    $estados= $this->registros("select * from tb_estados where id_estado <> 3");
    return $estados;

  }
  public function comprobarEstado(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_estado from tb_estados");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_estado'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
