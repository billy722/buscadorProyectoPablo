<?php
require_once '../clases/Conexion.php';

class Persona extends Conexion{

  protected $run;
  protected $dv;
  protected $nombre;
  protected $apellido_paterno;
  protected $apellido_materno;

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
  public function setApellidoPaterno($arg_apellido_paterno){
    $this->apellido_paterno= $arg_apellido_paterno;
  }
  public function setApellidoMaterno($arg_apellido_materno){
    $this->apellido_materno= $arg_apellido_materno;
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


  public function consultaUnUsuario(){
    $consulta="select * from tb_usuarios where run=".$this->run;

    $resultado= $this->registros($consulta);
    return $resultado;
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
          return true;
      else
          return false;
  }
}

?>
