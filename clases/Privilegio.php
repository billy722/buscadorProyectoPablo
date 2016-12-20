<?php
include_once '../clases/Conexion.php';

class Privilegio extends Conexion{
      private $_idPrivilegio;
      private $_privilegio;


  public function __construct(){
    parent::__construct();
  }

 public function listarPrivilegios(){
    $region=$this->registros('select * from tb_privilegios');
    return $region;
 }
 public function comprobarPrivilegios(){
   //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
   $comprobar = $this->consultarBdR("select id_privilegios from tb_privilegios");
   $resultarray = array();
   while ($row = mysqli_fetch_array($comprobar))
   {
     $resultarray[] = $row['id_lugarPiercing'];
   }
   if(in_array($this->$_idPrivilegio,$resultarray)){
     return true;
   }else{
     return false;
   }
 }



}
?>
