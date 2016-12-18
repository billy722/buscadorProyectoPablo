<?php
include_once '../clases/Conexion.php';

class ColorPelo extends Conexion{
      private $id_colorPelo;
      private $descripcion_colorPelo;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarColorPelo(){
    $estados= $this->registros("select * from tb_colorpelo");
    return $estados;
  }

  public function comprobarColorPelo(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_colorPelo from tb_colorpelo");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_colorPelo'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
