<?php
require_once '../clases/Persona.php';

class Sospechoso extends Persona{

  // private $run;
  // private $dv;
  // private $nombre;
  // private $apellido_paterno;
  // private $apellido_materno;

  private $lugar_nacimiento;
  private $id_color_pelo;
  private $id_contextura;
  private $id_estado_civil;
  private $id_sexo;
  private $id_tez_piel;
  private $id_tipo_ojos;
  private $id_tipo_pelo;
  private $antecedentes;//boolean
  private $apodos;
  private $barba;
  private $lentes;
  private $pecas;
  private $acne;
  private $bigote;
  private $manchas;
  private $estatura;
  private $fecha_nacimiento;
  private $cantidad_identificaciones;


  public function __construct(){
      parent::__construct();
  }

  // public function setRun($arg_run){
  //     $this->run= $arg_run;
  // }
  // public function setDv($arg_dv){
  //     $this->dv= $arg_dv;
  // }
  // public function setNombre($arg_nombre){
  //     $this->nombre= $arg_nombre;
  // }
  // public function setApellidoPaterno($arg_apellidoPaterno){
  //   $this->apellido_paterno= $arg_apellidoPaterno;
  // }
  // public function setApellidoMaterno($arg_apellidoMaterno){
  //   $this->apellido_materno= $arg_apellidoMaterno;
  // }
  public function setLugarNacimiento($arg_variable){
    $this->lugar_nacimiento= $arg_variable;
  }
  public function setIdColorPelo($arg_variable){
    $this->id_color_pelo= $arg_variable;
  }
  public function setContextura($arg_variable){
    $this->id_contextura= $arg_variable;
  }
  public function setIdEstadoCivil($arg_variable){
    $this->id_estado_civil= $arg_variable;
  }
  public function setIdSexo($arg_variable){
    $this->id_sexo= $arg_variable;
  }
  public function setIdTezPiel($arg_variable){
    $this->id_tez_piel= $arg_variable;
  }
  public function setIdTipoOjos($arg_variable){
    $this->id_tipo_ojos= $arg_variable;
  }
  public function setIdTipoPelo($arg_variable){
    $this->id_tipo_pelo= $arg_variable;
  }
  public function setAntecedentes($arg_variable){
    $this->antecedentes= $arg_variable;
  }
  public function setApodos($arg_variable){
    $this->apodos= $arg_variable;
  }
  public function setBarba($arg_variable){
    $this->barba= $arg_variable;
  }
  public function setLentes($arg_variable){
    $this->lentes= $arg_variable;
  }
  public function setPecas($arg_variable){
    $this->pecas= $arg_variable;
  }
  public function setAcne($arg_variable){
    $this->acne= $arg_variable;
  }
  public function setBigote($arg_variable){
    $this->bigote= $arg_variable;
  }
  public function setManchas($arg_variable){
    $this->manchas= $arg_variable;
  }
  public function setEstatura($arg_variable){
    $this->estatura= $arg_variable;
  }
  public function setFechaNacimiento($arg_variable){
    $this->fecha_nacimiento= $arg_variable;
  }
  public function setCantidadIdentificaciones($arg_variable){
    $this->cantidad_identificaciones= $arg_variable;
  }

  public function vistasospechoso(){
    $consulta="select * from vistasospechoso where solorrun=".$this->run;

    $usuarios= $this->registros($consulta);
    return $usuarios;
  }

  public function consultarExisteSospechoso(){
     $consulta="SELECT run FROM tb_sospechoso where run=".$this->run;
     $resultado= $this->registros($consulta);
     return $resultado;
  }

  public function insertarModificarSospechosos(){
      $consulta="CALL insertarModificarSospechoso(
                ".$this->run.",
                '".$this->dv."',
               '".$this->nombre."',
               '".$this->apellido_paterno."',
               '".$this->apellido_materno."',
               '".$this->lugar_nacimiento."',
                ".$this->id_color_pelo.",
                ".$this->id_contextura.",
                ".$this->id_estado_civil.",
                ".$this->id_sexo.",
                ".$this->id_tez_piel.",
                ".$this->id_tipo_ojos.",
                ".$this->id_tipo_pelo.",
                ".$this->antecedentes.",
               '".$this->apodos."',
                ".$this->barba.",
                ".$this->lentes.",
                ".$this->pecas.",
                ".$this->acne.",
                ".$this->bigote.",
                ".$this->manchas.",
                ".$this->estatura.",
               '".$this->fecha_nacimiento."');";

      //echo $consulta;
      $resultado=$this->insertar($consulta);
      return $resultado;
  }

  public function eliminarCaracteristicasSospechosos(){
      $consulta="CALL eliminarCaracteristicasSospechosos(".$this->run.")";
      //echo $consulta;
      $resultado=$this->insertar($consulta);
      return $resultado;
  }

  function crearTablaTemporalBusqueda(){
     $resultado= $this->insertar("call creaTablaTemporalBusqueda()");
        return $resultado;

  }

  function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
  {
    // crear una imagen desde el original
    $img = ImageCreateFromJPEG($img_original);
    // crear una imagen nueva
    $thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
    // redimensiona la imagen original copiandola en la imagen
    ImageCopyResized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
    // guardar la nueva imagen redimensionada donde indicia $img_nueva
    ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
    ImageDestroy($img);
  }

  function gen_fun_create($ext){
    return "imagecreatefrom".$ext;
  }
  public function comprobarColorPelo(){
    //$estados= $this->registros("select * from tb_estados where id_estado <> 3");
    $comprobar = $this->consultarBdR("select id_colorPelo from tb_colorpelo");
    $resultarray = array();
    while ($row = mysqli_fetch_array($comprobar))
    {
      $resultarray[] = $row['id_colorPelo'];
    }
    if(in_array($this->$id_color_pelo,$resultarray)){
      return true;
    }else{
      return false;
    }

  }



}

?>
