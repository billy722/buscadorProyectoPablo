<?php
include_once '../clases/Conexion.php';

class Piercing extends Conexion{
      private $id_lugarPiercing;
      private $descripcion_lugarPiercing;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarPiercing(){
    $estados= $this->registros("select * from tb_piercing");
    return $estados;
  }

  public function comprobarPiercing(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_lugarPiercing from tb_piercing");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_lugarPiercing'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
