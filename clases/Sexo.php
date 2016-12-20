<?php
include_once '../clases/Conexion.php';

class Sexo extends Conexion{
      private $id_sexo;
      private $descripcion_sexo;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }

  public function listarSexo(){
    $estados= $this->registros("select * from tb_sexo");
    return $estados;
  }

  public function comprobarSexo(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_sexo from tb_sexo");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_sexo'];
    }
    if(in_array($this->$id_sexo,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
