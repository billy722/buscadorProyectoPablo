<?php
include_once '../clases/Conexion.php';

class Grupos extends Conexion{
        private $_idGrupo;
        private $_grupo;
              // declarando variables de la tabla grupo en private
//Creacion de constructor y extension del constructor de la clase Conexion.
public function __construct(){
    parent::__construct();
}
  //Setters y Getters IdGrupo
  public function setIdGrupo($arg_idGrupo){
     $this->_idGrupo=$arg_idGrupo;
  }
  public function getIdGrupo(){
    return $this->_idGrupo;
  }
  //Setters y Getters Grupo
 public function setGrupo($arg_grupo){
     $this->_grupo=$arg_grupo;
  }
  public function getGrupo(){
    return $this->_grupo;
  }
 //--------------------------------
 //Función listar grupo que ordena los datos de la base de datos a la tabla del mantenerdor
 public function listarGrupos(){
    $grupos=$this->registros('select * from tb_grupousuario');
    return $grupos;
 }

  public function consultaUnGrupo(){
     $grupos=$this->registros('select * from tb_grupousuario where id_grupoUsuario='.$this->_idGrupo);
     return $grupos;
  }

  public function consultaPrivilegiosDeGrupo(){
     $grupos=$this->registros('select privilegio_idprivilegio as id from grupo_privilegio where grupo_idgrupo='.$this->_idGrupo);
     return $grupos;
  }

    //Funcion ingresar datos a la tabla region de la base de datos
  public function insertarGrupo(){
        $resultado= $this->registros("select max(idgrupo)+1 as ultimoId from grupo");
        $ultimoId= $resultado[0]['ultimoId'];
        //echo "el ultimo id es: ".$ultimoId;
        if($ultimoId==null){
            $ultimoId=1;
        }
                $verificar= $this->insertar('INSERT INTO `grupo` (`idgrupo`,`grupo`) VALUES ('.$ultimoId.',\''.$this->_grupo.'\');');

                if($verificar){
                      return $ultimoId;
                }else{
                    echo "fallo al ingresar grupo";
                }
  }

  public function asignarPrivilegioAlGrupo($arg_idPrivilegio){
    $consulta="insert into grupo_privilegio(grupo_idgrupo,privilegio_idprivilegio)
          values(".$this->_idGrupo.",".$arg_idPrivilegio.");";

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL ASIGNAR PRIVILEGIO: ".$consulta;
     }
  }

  public function eliminarPrivilegiosDeGrupo(){
      $consulta="delete from grupo_privilegio where grupo_idgrupo=".$this->_idGrupo;

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL eliminar PRIVILEGIOs de grupo: ".$consulta;
     }
  }

  public function actualizar(){
    $consulta='UPDATE grupo SET grupo=\''.$this->_grupo.'\' WHERE idgrupo='.$this->_idGrupo;

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL ASIGNAR PRIVILEGIO: ".$consulta;
     }
  }
  // Funcion eliminar datos de la tabla region
  public function eliminar(){
    $grupos=$this->insertar('DELETE FROM `grupo` WHERE `idGrupo`='.$this->_idGrupo.';');
    return $grupos;
  }
}
?>
