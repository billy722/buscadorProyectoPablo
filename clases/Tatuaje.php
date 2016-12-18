<?php
include_once '../clases/Conexion.php';

class Tatuaje extends Conexion{
      private $id_lugarTatuaje;
      private $descripcion_lugarTatuaje;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarTatuaje(){
    $estados= $this->registros("select * from tb_tatuaje order by descripcion_lugarTatuaje asc");
    return $estados;
  }

  public function comprobarTatuaje(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_lugarTatuaje from tb_tatuaje");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_lugarTatuaje'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
