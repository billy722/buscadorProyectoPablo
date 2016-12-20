<?php
include_once '../clases/Conexion.php';

class Imagen extends Conexion{
      private $id_imagen;
      private $nombre_imagen;
      private $fecha_imagen;
      private $foto_principal;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){
    parent::__construct();
  }

  public function listarImagen(){
    $estados= $this->registros("select * from tb_imagen");
    return $estados;
  }

  public function comprobarImagen(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_imagen from tb_imagen");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_imagen'];
    }
    if(in_array($this->id_imagen,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
  }
?>
