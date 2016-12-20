<?php
include_once '../clases/Conexion.php';

class TipoPelo extends Conexion{
      private $id_tipoPelo;
      private $descripcion_tipoPelo;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarTipoPelo(){
    $estados= $this->registros("select * from tb_tipopelo");
    return $estados;
  }

  public function comprobarTipoPelo(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_tipoPelo from tb_tipopelo");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_tipoPelo'];
    }
    if(in_array($this->id_tipoPelo,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
