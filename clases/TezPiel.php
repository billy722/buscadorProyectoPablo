<?php
include_once '../clases/Conexion.php';

class TezPiel extends Conexion{
      private $id_tezPiel;
      private $descripcion_tezPiel;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarTezPiel(){
    $estados= $this->registros("select * from tb_tezpiel");
    return $estados;
  }

  public function comprobarTezPiel(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_tezPiel from tb_tezpiel");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_tezPiel'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
