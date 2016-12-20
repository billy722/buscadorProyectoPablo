<?php
include_once '../clases/Conexion.php';

class Cicatriz extends Conexion{
      private $id_lugarCicatriz;
      private $descripcion_lugarCicatriz;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarCicatriz(){
    $estados= $this->registros("select * from tb_cicatriz order by descripcion_lugarCicatriz asc");
    return $estados;

  }
  public function comprobarCicatriz(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_lugarCicatriz from tb_cicatriz");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_lugarCicatriz'];
    }
    if(in_array($this->id_lugarCicatriz,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
