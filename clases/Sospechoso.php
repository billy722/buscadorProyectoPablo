<?php
require_once '../clases/Conexion.php';

class Sospechoso extends Conexion{

  private $run;
  private $dv;
  private $nombre;
  private $apellidoPaterno;
  private $apellidoMaterno;
  private $clave;
  private $telefono;
  private $correo;
  private $grupoUsuario;
  private $estado;

  public function __construct(){
      parent::__construct();
  }

  public function setRun($arg_run){
      $this->run= $arg_run;
  }
  public function setDv($arg_dv){
      $this->dv= $arg_dv;
  }
  public function setNombre($arg_nombre){
      $this->nombre= $arg_nombre;
  }
  public function setApellidoPaterno($arg_apellidoPaterno){
    $this->apellidoPaterno= $arg_apellidoPaterno;
  }
  public function setApellidoMaterno($arg_apellidoMaterno){
    $this->apellidoMaterno= $arg_apellidoMaterno;
  }
  public function setClave($arg_clave){
    $this->clave= $arg_clave;
  }
  public function setTelefono($arg_telefono){
    $this->telefono= $arg_telefono;
  }
  public function setCorreo($arg_correo){
      $this->correo= $arg_correo;
  }
  public function setGrupoUsuario($arg_grupoUsuario){
     $this->grupoUsuario= $arg_grupoUsuario;
  }
  public function setEstado($arg_estado){
      $this->estado= $arg_estado;
  }


public function vistasospechoso(){
  $consulta="select * from vistasospechoso where solorrun=".$this->run;

  $usuarios= $this->registros($consulta);
  return $usuarios;
}

  public function validarRut($rut)
  {
      if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
          return false;
      }
      $rut = preg_replace('/[\.\-]/i', '', $rut);
      $dv = substr($rut, -1);
      $numero = substr($rut, 0, strlen($rut) - 1);
      $i = 2;
      $suma = 0;
      foreach (array_reverse(str_split($numero)) as $v){
          if ($i == 8)
              $i = 2;
          $suma += $v * $i;
          ++$i;
      }
      $dvr = 11 - ($suma % 11);
      if ($dvr == 11)
          $dvr = 0;
      if ($dvr == 10)
          $dvr = 'K';
      if ($dvr == strtoupper($dv))
          echo "1";
      else
          echo "2";
  }
  public function cantidadUsuarios(){
    $cantidad= $this->cantidadRegistros("select run from tb_usuarios");
    return $cantidad;
  }

  public function listarUsuarios(){
    $usuarios= $this->consultaRegistros("select * from vistausuarios");
    return $usuarios;
  }

  public function insertarModificarUsuario(){
        $verificar;
        $verificar=$this->insertar("call insertarModificarUsuario($this->run,'$this->dv','$this->nombre','$this->apellidoPaterno','$this->apellidoMaterno','$this->clave','$this->telefono','$this->correo','$this->grupoUsuario',$this->estado)");
        if($verificar){
          echo "1";
        }else{
          echo "2";
        }

  }
  public function eliminarUsuario(){
    $verificar;

    $verificar= $this->insertar("delete from tb_usuarios where run=".$this->run.";");

                if($verificar){
                      return true;
                }else{
                    echo "fallo al eliminar el Usuario";
                }
  }


}

?>
