<?php
include_once '../clases/Conexion.php';

class RangoEdad extends Conexion{
      private $id_rangoEdad;
      private $limite_inferior;
      private $limite_superior;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarRangoEdad(){
    $estados= $this->registros("select * from tb_rangoedad");
    return $estados;
  }

  public function comprobarRangoEdad(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_rangoEdad from tb_rangoedad");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_rangoEdad'];
    }
    if(in_array($this->_idEstado,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
