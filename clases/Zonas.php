<?php
include_once '../clases/Conexion.php';

class Zonas extends Conexion{
        private $_idZona;
        private $_zona;
              // declarando variables de la tabla grupo en private
//Creacion de constructor y extension del constructor de la clase Conexion.
public function __construct(){
    parent::__construct();
}
  //Setters y Getters IdGrupo
  public function setIdZona($arg_idZona){
     $this->_idZona=$arg_idZona;
  }
  public function getIdZona(){
    return $this->_idZona;
  }
  //Setters y Getters Grupo
 public function setZona($arg_zona){
     $this->_zona=$arg_zona;
  }
  public function getZona(){
    return $this->_zona;
  }
  public function consultaUnaZona(){
     $grupos=$this->registros('select * from tb_zona where id_zona='.$this->_idZona);
     return $grupos;
  }

  public function consultaPoblacionesDeZona(){
     $grupos=$this->registros('select id_poblacion as id from tb_poblacionzonas where id_zona='.$this->_idZona);
     return $grupos;
  }

    //Funcion ingresar datos a la tabla region de la base de datos
  public function insertarZona(){
        $resultado= $this->registros("select max(id_zona)+1 as ultimoId from tb_zona");
        $ultimoId= $resultado[0]['ultimoId'];
        //echo "el ultimo id es: ".$ultimoId;
        if($ultimoId==null){
            $ultimoId=1;
        }
                $verificar= $this->insertar('INSERT INTO `tb_zona` (`id_zona`,`descripcion_zona`) VALUES ('.$ultimoId.',\''.$this->_zona.'\');');

                if($verificar){
                      return $ultimoId;
                }else{
                    echo "fallo al ingresar";
                }
  }

  public function asignarPoblacionAZona($arg_poblacion){
    $consulta="insert into tb_poblacionzonas(id_poblacion,id_zona)
          values(".$arg_poblacion.",".$this->_idZona.");";

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL ASIGNAR POBLACION: ".$consulta;
     }
  }

  public function eliminarPrivilegiosDeGrupo(){
      $consulta="delete from tb_poblacionzonas where id_zona=".$this->_idZona.";";

     if($this->insertar($consulta)){
return true;
     }else{
         echo "ERROR AL eliminar PRIVILEGIOS de grupo: ".$consulta;
     }
  }

  public function actualizar(){
    $consulta='UPDATE tb_zona SET descripcion_zona=\''.$this->_zona.'\' WHERE id_zona='.$this->_idZona;

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL ASIGNAR POBLACION: ".$consulta;
     }
  }
  // Funcion eliminar datos de la tabla region
  public function eliminarZona(){
    $resultado=$this->insertar('DELETE FROM `tb_zona` WHERE `id_zona`='.$this->_idZona.';');
    return $resultado;}

  public function comprobarNombre(){
    $consulta;
    if($this->_idZona=="" || $this->_idZona==null){
          $consulta="select descripcion_zona from tb_zona where descripcion_zona='".$this->_zona."' ;";
    }else{

    $consulta="select descripcion_zona from tb_zona where descripcion_zona='".$this->_zona."' and id_zona<>".$this->_idZona.";";
    }

     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }
}
?>
