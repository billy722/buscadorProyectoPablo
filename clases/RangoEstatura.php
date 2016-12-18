<?php
include_once '../clases/Conexion.php';

class RangoEstatura extends Conexion{
      private $id_rangoEstatura;
      private $descripcion_rangoEstatura;
      private $limite_inferior;
      private $limite_superior;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarRangoEstatura(){
    $estados= $this->registros("select * from tb_rangoestatura");
    return $estados;
  }

  public function comprobarRangoEstatura(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_rangoEstatura from tb_rangoestatura");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_rangoEstatura'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
