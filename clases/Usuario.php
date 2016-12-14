<?php
require_once '../clases/Conexion.php';

class Usuario extends Conexion{

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
          return true;
        }else{
          return false;
        }

  }
  public function eliminarUsuario(){
    $verificar;

    $verificar= $this->insertar("delete from tb_usuarios where run=".$this->run.";");

                if($verificar){
                      return true;
                }else{
                    return false;
                }
  }

  public function guardarHistorial($arg_direccionip,$arg_tipoaccion,$arg_rut,$arg_informacionadicional){
    $consulta="INSERT INTO registro_acciones (direccion_ip,tipo_accion,run_usuario,informacion_adicional)
			 VALUES ('".$arg_direccionip."',".$arg_tipoaccion.",".$arg_rut.",'".$arg_informacionadicional."')";

    $verificar= $this->insertar($consulta);

                if($verificar){
                      return true;
                }else{
                    return false;
                }
  }

  public function comprobarExisteRun(){
     $consulta="select run from tb_usuarios where run=".$this->run;

     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }

  public function comprobarUsuario(){
      $filas= $this->registros("CALL comprobarDatosIngreso('$this->run')");

      if($filas){
          $claveBD=$filas[0]['clave'];

          $claveRecibida=$this->clave;
            if(crypt($this->clave, $claveBD) == $claveBD){
                    session_start();
                    $_SESSION['run']=$filas[0]['run'];
                    $_SESSION['nombre']=$filas[0]['nombre']." ".$filas[0]['apellidoPaterno']." ".$filas[0]['apellidoMaterno'];
                    //$_SESSION['grupo']=$filas[0]['id_grupoUsuario'];
                return true;
              }else{
                return false;
              }
      }else{
            return false;
      }
  }

  public function verificarSesion(){

    @session_start();

    if(!isset($_SESSION['run'])){
        header("location: ../index.php");
    }
  }
  public function cerrarSesion($rutaInicial){
      session_start();

      // Destruir todas las variables de sesión.
      $_SESSION = array();

      //borra también la cookie de sesión.
      if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }

      // Finalmente, destruir la sesión.
      session_destroy();
      header('location: '.$rutaInicial);
  }

    function obtenerIpReal(){
      if(!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
         if($_SERVER['REMOTE_ADDR']=="::1"){
            $ip="127.0.0.1";
         }else{
           $ip = $_SERVER['REMOTE_ADDR'];
         }
      }
      return $ip;

  }


}

?>
