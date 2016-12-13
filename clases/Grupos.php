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
    $consulta='select id_privilegio as id from tb_grupoprivilegio where id_grupoUsuario='.$this->_idGrupo;

     $grupos=$this->registros($consulta);
     return $grupos;
  }

    //Funcion ingresar datos a la tabla region de la base de datos
  public function insertarGrupo(){
        $resultado= $this->registros("select max(id_grupoUsuario)+1 as ultimoId from tb_grupousuario");
        $ultimoId= $resultado[0]['ultimoId'];
        //echo "el ultimo id es: ".$ultimoId;
        if($ultimoId==null){
            $ultimoId=1;
        }
                $verificar= $this->insertar('INSERT INTO `tb_grupousuario` (`id_grupoUsuario`,`descripcion_grupoUsuario`) VALUES ('.$ultimoId.',\''.$this->_grupo.'\');');

                if($verificar){
                      return $ultimoId;
                }else{
                    return false;
                }
  }

  public function asignarPrivilegioAlGrupo($arg_idPrivilegio){
    $consulta="insert into tb_grupoprivilegio(id_privilegio,id_grupoUsuario)
          values(".$arg_idPrivilegio.",".$this->_idGrupo.");";

     if($this->insertar($consulta)){
       return true;
     }else{
       echo "ERROR AL ASIGNAR PRIVILEGIO: ".$consulta;
     }
  }

  public function eliminarPrivilegiosDeGrupo(){
      $consulta="delete from tb_grupoprivilegio where id_grupoUsuario=".$this->_idGrupo.";";

     if($this->insertar($consulta)){
        return true;
     }else{
         echo "ERROR AL eliminar PRIVILEGIOS de grupo: ".$consulta;
     }
  }

  public function actualizar(){
    $consulta='UPDATE tb_grupousuario SET descripcion_grupoUsuario=\''.$this->_grupo.'\' WHERE id_grupoUsuario='.$this->_idGrupo;

     if($this->insertar($consulta)){
       return true;
     }else{
       return false;
     }
  }
  // Funcion eliminar datos de la tabla region
  public function eliminarGrupo(){
      if($this->consultaExistencia("select run from tb_usuarios where id_grupoUsuario= '".$this->_idGrupo."'")){
          echo "3";//hay usuarios con este grupo asignado
      }else{

            if($this->insertar('delete from tb_grupoprivilegio where id_grupoUsuario='.$this->_idGrupo)){

                if($this->insertar('DELETE FROM tb_grupousuario WHERE id_grupoUsuario='.$this->_idGrupo.';')){
                  return true;
                }else{
                  return false;
                }

            }else{
              return false;//ocurrio un error
            }
      }

  }

  public function comprobarNombre(){
    $consulta;
    if($this->_idGrupo=="" || $this->_idGrupo==null){
          $consulta="select descripcion_grupoUsuario from tb_grupousuario where descripcion_grupoUsuario='".$this->_grupo."' ;";
    }else{

    $consulta="select descripcion_grupoUsuario from tb_grupousuario where descripcion_grupoUsuario='".$this->_grupo."' and id_grupoUsuario<>".$this->_idGrupo.";";
    }

     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }
}
?>
