<?php
include_once '../clases/Conexion.php';

class ColorOjos extends Conexion{
      private $id_colorOjos;
      private $descripcion_colorOjos;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarColorOjos(){
    $estados= $this->registros("select * from tb_colorojos");
    return $estados;
  }

  public function comprobarColorOjos(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_colorOjos from tb_colorojos");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_colorOjos'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
