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




}
?>
