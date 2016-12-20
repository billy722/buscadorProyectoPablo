<?php
include_once '../clases/Conexion.php';

class Poblacion extends Conexion{
      private $_idPoblacion;
      private $_descripcion_poblacion;
      private $_estado;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }
  public function setIdPoblacion($arg_idPoblacion){
     $this->_idPoblacion=$arg_idPoblacion;
  }
  public function getIdPoblacion(){
    return $this->_idDelito;
  }
 public function setDescripcionPoblacion($arg_descripcionPoblacion){
    $this->_descripcion_poblacion=$arg_descripcionPoblacion;
 }
 public function getDescripcionPoblacion(){
   return $this->_descripcion_poblacion;
 }
public function setEstadoPoblacion($arg_estadoPoblacion){
   $this->_estado=$arg_estadoPoblacion;
}
public function getEstadoPoblacion(){
  return $this->_estado;
}
 //--------------------------------

 public function listarPoblacion(){
    $poblacion=$this->registros('select * from tb_poblacion inner join tb_estados on tb_estados.id_estado=tb_poblacion.estado');
    return $poblacion;
 }
 public function listarPoblacionesActivas(){
    $poblacion=$this->registros('select * from tb_poblacion where estado=1 order by descripcion_poblacion asc');
    return $poblacion;
 }
   //Funcion ingresar datos a la tabla
  public function ingresarPoblacion(){
      $poblacion=$this->insertar('INSERT INTO `tb_poblacion` (`id_poblacion`,`descripcion_poblacion`,`estado`) VALUES (null,\''.$this->_descripcion_poblacion.'\',\''.$this->_estado.'\');');
      if($poblacion){
        return true;
      }else{
        return false;
      }
  }
  public function actualizarPoblacion(){
        $poblacion=$this->insertar('UPDATE `tb_poblacion` SET `descripcion_poblacion`=\''.$this->_descripcion_poblacion.'\', `estado`=\''.$this->_estado.'\' WHERE `id_poblacion`='.$this->_idPoblacion.';');

        if($poblacion){
          return true;
        }else{
          return true;
        }
  }
  // Funcion eliminar datos de la tabla
  public function eliminarPoblacion(){
    $verificar;
    if($this->consultaExistencia("select * from tb_poblacionsospechoso where id_poblacion=".$this->_idPoblacion.";")){
        $verificar= $this->insertar("update tb_poblacion set
                                    estado=".$this->_estado."
                                    where id_poblacion=".$this->_idPoblacion.";");
}else{
    $verificar= $this->insertar("delete from tb_poblacion where id_poblacion=".$this->_idPoblacion."; ");
}
                if($verificar){
                      return true;
                }else{
                    echo "fallo al eliminar poblacion";
                }
  }
  public function comprobarNombre(){
    $consulta;
    if($this->_idPoblacion=="" || $this->_idPoblacion==null){
          $consulta="select descripcion_poblacion from tb_poblacion where descripcion_poblacion='".$this->_descripcion_poblacion."' ;";
    }else{

    $consulta="select descripcion_poblacion from tb_poblacion where descripcion_poblacion='".$this->_descripcion_poblacion."' and id_poblacion<>".$this->_idPoblacion.";";
    }
     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }
  public function comprobarPoblacion(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_poblacion from tb_poblacion");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_poblacion'];
    }
    if(in_array($this->_idPoblacion,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
}
?>
