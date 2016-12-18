<?php
include_once '../clases/Conexion.php';

class Contextura extends Conexion{
      private $id_contextura;
      private $descripcion_contextura;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarContextura(){
    $estados= $this->registros("select * from tb_contextura");
    return $estados;
  }

  public function comprobarContextura(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_contextura from tb_contextura");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_contextura'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
