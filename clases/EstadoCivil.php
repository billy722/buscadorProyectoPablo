<?php
include_once '../clases/Conexion.php';

class EstadoCivil extends Conexion{
      private $id_estadoCivil;
      private $descripcion_estadoCivil;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarEstadoCivil(){
    $estados= $this->registros("select * from tb_estadocivil");
    return $estados;
  }

  public function comprobarEstadoCivil(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_estadoCivil from tb_estadocivil");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_estadoCivil'];
    }
    if(in_array($this->id_estadoCivil,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
