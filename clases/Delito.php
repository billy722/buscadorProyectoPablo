<?php
include_once '../clases/Conexion.php';

class Delito extends Conexion{
      private $_idDelito;
      private $_descripcion_delito;
      private $_estado;

//Creacion de constructor y extension del constructor de la clase Conexion.
  public function __construct(){

    parent::__construct();
  }
  public function setIdDelito($arg_idDelito){
     $this->_idDelito=$arg_idDelito;
  }
  public function getIdDelito(){
    return $this->_idDelito;
  }
 public function setDescripcionDelito($arg_descripcionDelito){
    $this->_descripcion_delito=$arg_descripcionDelito;
 }
 public function getDescripcionDelito(){
   return $this->_descripcion_delito;
 }
public function setEstadoDelito($arg_estadoDelito){
   $this->_estado=$arg_estadoDelito;
}
public function getEstadoDelito(){
  return $this->_estado;
}
 //--------------------------------

 public function listarDelitos(){
    $delitos=$this->registros('select * from tb_delito inner join tb_estados on tb_estados.id_estado=tb_delito.estado');
    return $delitos;
 }

 public function listarDelitosActivos(){
    $delitos=$this->registros('select * from tb_delito where estado=1 order by descripcion_delito');
    return $delitos;
 }
 public function listarDelitosUnSospechoso($arg_run){
    $delitos=$this->registros('select d.descripcion_delito
from tb_delito d
inner join tb_delitosopechoso ds on ds.id_delito=d.id_delito
where ds.run_sospechoso='.$arg_run);
    return $delitos;
 }
  //  public function paginar($pagina){
  //   $postPorPagina = 4;
  //   $inicio = ($pagina > 1 ) ? ($pagina * $postPorPagina - $postPorPagina) : 0;
  //   $consulta="select SQL_CALC_FOUND_ROWS * from region limit '".$inicio."','".$postPorPagina."'";

  //   //$region=$this->registros($consulta);
  //   //return $region;
  // }

   //Funcion ingresar datos a la tabla region de la base de datos
  public function ingresarDelito(){
      $delitos=$this->insertar('INSERT INTO `tb_delito` (`id_delito`,`descripcion_delito`,`estado`) VALUES (null,\''.$this->_descripcion_delito.'\',\''.$this->_estado.'\');');
      //return $delitos;
      if($delitos){
         return true;
      }else{
        return false;
      }
  }


  public function actualizarDelito(){
        $delitos=$this->insertar('UPDATE `tb_delito` SET `descripcion_delito`=\''.$this->_descripcion_delito.'\', `estado`=\''.$this->_estado.'\' WHERE `id_delito`='.$this->_idDelito.';');

        if($delitos){
            return true;
        }else{

           return false;
        }
  }
  // Funcion eliminar datos de la tabla region
  public function eliminarDelito(){
    $verificar;
    if($this->consultaExistencia("select * from tb_delitosopechoso where id_delito=".$this->_idDelito.";")){
        $verificar= $this->insertar("update tb_delito set
                                    estado=".$this->_estado."
                                    where id_delito=".$this->_idDelito.";");
    }else{
        $verificar= $this->insertar("delete from tb_delito where id_delito=".$this->_idDelito."; ");
    }
                if($verificar){
                      return true;
                }else{
                    return false;
                }
  }
  public function comprobarNombre(){
    $consulta;
    if($this->_idDelito=="" || $this->_idDelito==null){
          $consulta="select descripcion_delito from tb_delito where descripcion_delito='".$this->_descripcion_delito."' ;";
    }else{

    $consulta="select descripcion_delito from tb_delito where descripcion_delito='".$this->_descripcion_delito."' and id_delito<>".$this->_idDelito.";";
    }
     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }
  public function comprobarDelitos(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_delito from tb_delito");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_delito'];
    }
    if(in_array($this->_idDelito,$resultarray)){
      return true;
    }else{
      return false;
    }

  }
}
?>
