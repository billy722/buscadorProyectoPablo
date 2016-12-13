<?php
include_once '../clases/Conexion.php';

class Equipo extends Conexion{
      private $_idEquipo;
      private $_descripcion_equipo;
      private $_estado;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }
  public function setIdEquipo($arg_idEquipo){
     $this->_idEquipo=$arg_idEquipo;
  }
  public function getIdEquipo(){
    return $this->_idEquipo;
  }
 public function setDescripcionEquipo($arg_descripcionEquipo){
    $this->_descripcion_equipo=$arg_descripcionEquipo;
 }
 public function getDescripcionEquipo(){
   return $this->_descripcion_equipo;
 }
public function setEstadoEquipo($arg_estadoEquipo){
   $this->_estado=$arg_estadoEquipo;
}
public function getEstadoEquipo(){
  return $this->_estado;
}
 //--------------------------------

 public function listarEquipo(){
    $equipo=$this->registros('select * from tb_equipofutbol inner join tb_estados on tb_estados.id_estado=tb_equipofutbol.estado');
    return $equipo;
 }
   //Funcion ingresar datos a la tabla
  public function ingresarEquipo(){
      $equipo=$this->insertar('INSERT INTO `tb_equipofutbol` (`id_equipo`,`descripcion_equipo`,`estado`) VALUES (null,\''.$this->_descripcion_equipo.'\',\''.$this->_estado.'\');');
      if($equipo){
        return true;
      }else{
        return false;
      }
  }
  public function actualizarEquipo(){
        $equipo=$this->insertar('UPDATE `tb_equipofutbol` SET `descripcion_equipo`=\''.$this->_descripcion_equipo.'\', `estado`=\''.$this->_estado.'\' WHERE `id_equipo`='.$this->_idEquipo.';');

        if($equipo){
            return true;
        }else{

           return false;
        }
  }
  // Funcion eliminar datos de la tabla
  public function eliminarEquipo(){
    $verificar;
    if($this->consultaExistencia("select * from tb_equiposospechoso where id_equipo=".$this->_idEquipo.";")){
        $verificar= $this->insertar("update tb_equipofutbol set
                                    estado=".$this->_estado."
                                    where id_equipo=".$this->_idEquipo.";");
}else{
    $verificar= $this->insertar("delete from tb_equipofutbol where id_equipo=".$this->_idEquipo."; ");
}
                if($verificar){
                      return true;
                }else{
                    echo "fallo al eliminar equipo de futbol";
                }
  }



}
?>
