<?php
@session_start();
// defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
// defined("SITE_ROOT") ? null : define("SITE_ROOT", "D:".DS."XAMPP".DS."htdocs".DS."buscador");

switch($_REQUEST['mant']){//SELECCIONAR MANTENEDOR

    case '1'://MANTENEDOR USUARIOS

    $privilegioMantenedor=false;

    @session_start();
    require_once '../clases/Usuario.php';
    require_once '../clases/Grupos.php';
    $Usuario= new Usuario();
    $Usuario->setRun($_SESSION['run']);
    $resultadoUsuario= $Usuario->consultaUnUsuario();
    if($resultadoUsuario){

         $Grupo = new Grupos();
         $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
         $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

         foreach($privilegios as $privilegio){

            if($privilegio['id']==6){//privilegio MANTENEDOR
                $privilegioMantenedor=true;
            }
         }


         if($privilegioMantenedor==true){




            require_once '../clases/Usuario.php';
            $Usuario= new Usuario();

            switch($_REQUEST['func']){//SELECCIONAR ACCION

                case '1'://Ingresar usuario
                      $campoRut=$_REQUEST['txt_runCrear'];
                      $nombre= $_REQUEST['txt_nombreCrear'];
                      $apellidoPaterno= $_REQUEST['txt_apellidoPaternoCrear'];
                      $apellidoMaterno= $_REQUEST['txt_apellidoMaternoCrear'];
                      $clave= $_REQUEST['txt_clave1Crear'];
                      $telefono= $_REQUEST['txt_telefonoCrear'];
                      $correo= $_REQUEST['txt_correoCrear'];
                      $tipoUsuario= $_REQUEST['select_tipoUsuarioCrear'];

                      if($campoRut=="" || $nombre=="" || $apellidoPaterno=="" || $apellidoMaterno=="" || $clave=="" || $tipoUsuario==""){
                            echo "2";//HAY CAMPOS VACIOS

                      }else{
                            $posicionGuion= strpos($campoRut,"-");
                            $rut= substr($campoRut,0,$posicionGuion);
                            $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                            $Usuario->setRun($Usuario->limpiarNumeroEntero($rut));

                           if($Usuario->comprobarExisteRun($rut)){
                                echo "4"; //RUT QUE INTENTA INGRESAR YA EXISTE
                           }else{

                             // Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
                             $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
                             // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
                             $salt = strtr($salt, array('+' => '.'));
                             // Generamos el hash
                             $password = crypt($clave, '$2y$10$' . $salt);

                               $Usuario->setDV($dv);
                               $Usuario->setNombre($Usuario->limpiarTexto($nombre));
                               $Usuario->setApellidoPaterno($Usuario->limpiarTexto($apellidoPaterno));
                               $Usuario->setApellidoMaterno($Usuario->limpiarTexto($apellidoMaterno));
                               $Usuario->setClave($password);
                               $Usuario->setTelefono($Usuario->limpiarTexto($telefono));
                               $Usuario->setCorreo($Usuario->limpiarCorreo($correo));
                               $Usuario->setGrupoUsuario($Usuario->limpiarNumeroEntero($tipoUsuario));
                               $Usuario->setEstado("1");
                                if($Usuario->insertarModificarUsuario()){
                                  echo "1";
                                   $UsuarioHistorial= new Usuario();
                         			  	 $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),7,$_SESSION['run'],"Usuario creado: ".$rut);
                                }else{
                                  echo "3";//error
                                }
                           }
                      }

                        break;

                case '2'://Modificar Usuario
                $campoRut=$_REQUEST['txt_runModificar'];
                $posicionGuion= strpos($campoRut,"-");
                $rut= substr($campoRut,0,$posicionGuion);
                $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                $clave = $_REQUEST['txt_clave1Modificar'];
                $estado = $_REQUEST['select_estadoUsuarioModificar'];
                $tipo = $_REQUEST['select_tipoUsuarioModificar'];
                $nombre = $_REQUEST['txt_nombreModificar'];
                $apellidoP = $_REQUEST['txt_apellidoPaternoModificar'];
                $apellidoM = $_REQUEST['txt_apellidoMaternoModificar'] ;
                $telefono = $_REQUEST['txt_telefonoModificar'];
                $correo = $_REQUEST['txt_correoModificar'];
                if($campoRut=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $tipo=="" || $estado=="" || $telefono=="" || $correo==""){
                      echo "2";//HAY CAMPOS VACIOS

                }else{
                // Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
                $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
                // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
                $salt = strtr($salt, array('+' => '.'));
                // Generamos el hash
                $password = crypt($clave, '$2y$10$' . $salt);


                $Usuario->setRun($Usuario->limpiarNumeroEntero($rut));
                $Usuario->setDV($dv);
                $Usuario->setNombre($Usuario->limpiarTexto($nombre));
                $Usuario->setApellidoPaterno($Usuario->limpiarTexto($apellidoP));
                $Usuario->setApellidoMaterno($Usuario->limpiarTexto($apellidoM));
                $Usuario->setClave($password);
                $Usuario->setTelefono($Usuario->limpiarTexto($telefono));
                $Usuario->setCorreo($Usuario->limpiarCorreo($correo));
                $Usuario->setGrupoUsuario($Usuario->limpiarNumeroEntero($tipo));
                $Usuario->setEstado($Usuario->limpiarNumeroEntero($estado));
                //
                // $comprobar = $Usuario->consultarBdR("select id_estado from tb_estados");
                // //$regis=$Usuario->arregloDatosBd($comprobar);
                // $resultarray = array();
                // while ($row = mysqli_fetch_array($comprobar))
                // {
                //   $resultarray[] = $row['id_estado'];
                // }

                require_once '../clases/Estado.php';
                $Estado= new Estado();
                $Estado->setIdEstado($estado);
                require_once '../clases/Grupos.php';
                $Grupos= new Grupos();
                $Grupos->setIdGrupo($tipo);
                if($Estado->comprobarEstado() || $Grupos->comprobarGrupo()){
                  // $comprobar2 = $Usuario->consultarBdR("select id_grupoUsuario from tb_grupousuario");
                  // $resultarray2 = array();
                  // while ($row = mysqli_fetch_array($comprobar2))
                  // {
                  //   $resultarray2[] = $row['id_grupoUsuario'];
                  // }

                  //if($Grupos->comprobarGrupo()){
                  if($Usuario->insertarModificarUsuario()){
                    echo "1";
                    $UsuarioHistorial= new Usuario();
                    $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),8,$_SESSION['run'],"Usuario modificado: ".$rut);
                  }else{
                    echo "3";//errors
                  }
                //}
                //else{
                    //echo "3";
                  //}
                }else {
                    echo "3";//errors
                  }
                }

                        break;
                case '3'://Listar USUARIOS
                        ?>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <caption ></caption>
                            <thead>
                                      <th>Run</th>
                                      <th>Nombre</th>
                                      <th>Apellido P</th>
                                      <th>Apellido M</th>
                                      <th>Correo</th>
                                      <th>Telefono</th>
                                      <th>Privilegios</th>
                                      <th>Estado</th>
                                      <th>Modificar</th>
                                      <th>Eliminar</th>
                            </thead>
                            <tbody>

                                         <?php
                                          $retorno= $Usuario->BuscarFiltarRegistros("vistausuarios","run nombre apellidoPaterno apellidoMaterno telefono correo descripcion_grupoUsuario descripcion_estado",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<td><span id="txt_run'.$contadorFilas.'">'.$filas['run'].'</span></td>';
                                                                     echo'<td><span id="txt_nombre'.$contadorFilas.'">'.$filas['nombre'].'</span></td>';
                                                                     echo'<td><span id="txt_apellidoPaterno'.$contadorFilas.'">'.$filas['apellidoPaterno'].'</span></td>';
                                                                     echo'<td><span id="txt_apellidoMaterno'.$contadorFilas.'">'.$filas['apellidoMaterno'].'</span></td>';
                                                                     echo'<td><span id="txt_correo'.$contadorFilas.'">'.$filas['correo'].'</span></td>';
                                                                     echo'<td><span id="txt_telefono'.$contadorFilas.'">'.$filas['telefono'].'</span></td>';
                                                                     echo'<td><span id="txt_descripcionGrupoUsuario'.$contadorFilas.'">'.$filas['descripcion_grupoUsuario'].'</span>
                                                                     <input type="hidden" id="txt_idGrupoUsuario'.$contadorFilas.'" value="'.$filas['id_grupoUsuario'].'"></td>';
                                                                     echo'<td><span id="txt_descripcionEstadoUsuario'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                                     <input type="hidden" id="txt_idEstadoUsuario'.$contadorFilas.'" value="'.$filas['id_estado'].'"></td>';
                                                  //CAMPOS OCULTOS CON IDS

                                                echo'<td>
                                                             <button type="button"  onclick="mostrarModalModificar('.$contadorFilas.')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                              </button>
                                                </td>
                                                <td>
                                                             <button class="btn btn-danger" onclick="eliminar(\''.$filas['run'].'\')">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                              </button>
                                                          </td>
                                                    </tr>';

                                             }

                                        ?>
                                            <tr>
                                              <td colspan="10">
                                                <center>
                                                <?php
                                                  echo $retorno[0][1];
                                                ?>

                                              </center>
                                              </td>
                                            </tr>
                           </tbody>
                        </table>
                      </div>
                    <?php
                        break;
                        case '4'://validad rut
                           $Usuario->validarRut($_REQUEST['txt_run']);
                          break;
                        case '5'://eliminar Usuario
                        $campoRut=$_REQUEST['run'];
                        $posicionGuion= strpos($campoRut,"-");
                        $rut= substr($campoRut,0,$posicionGuion);
                        $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                        $Usuario->setRun($Usuario->limpiarNumeroEntero($rut));

                        $verificarExito= $Usuario->eliminarUsuario();

                        if($verificarExito==true){
                              echo "1";
                              $UsuarioHistorial= new Usuario();
                              $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),9,$_SESSION['run'],"Usuario eliminado: ".$rut);
                        }else{
                              echo "3";//error
                        }
                            break;
            }
        }else{
           echo "0";
        }

      }else{
        echo "0";//usuario no existe
      }
    break;

    case '2'://Mant delito

    $privilegioMantenedor=false;

    @session_start();
    require_once '../clases/Usuario.php';
    require_once '../clases/Grupos.php';
    $Usuario= new Usuario();
    $Usuario->setRun($_SESSION['run']);
    $resultadoUsuario= $Usuario->consultaUnUsuario();
    if($resultadoUsuario){

         $Grupo = new Grupos();
         $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
         $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

         foreach($privilegios as $privilegio){

            if($privilegio['id']==8){//privilegio MANTENEDOR
                $privilegioMantenedor=true;
            }
         }


         if($privilegioMantenedor==true){


            require_once '../clases/Delito.php';
            $Delito=new Delito();

            switch($_REQUEST['func']){
              case '1': //Ingresar nuevo delito

                if($_REQUEST['txt_descripcionDelitoCrear']==""){
                      echo "2";//HAY CAMPOS VACIOS

                }else{
                  $descripcion=$Delito->limpiarTexto($_REQUEST['txt_descripcionDelitoCrear']);

                  $Delito->setDescripcionDelito($descripcion);
                if($Delito->comprobarNombre()==false){//comprueba nombre de usuario

                $Delito->setEstadoDelito("1");
                if($Delito->ingresarDelito()){
                  echo "1";
                  $UsuarioHistorial= new Usuario();
                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),10,$_SESSION['run'],"Delito creado: ".$descripcion);
                }else{
                  echo "3";//error
                }
              }else{
                echo "4";//nombre ya existe
              }}

              break;
              case '2'://Modificar delito
              if($_REQUEST['txt_descripcionDelitoModificar']=="" || $_REQUEST['txt_idDelitoModificar']=="" || $_REQUEST['cmb_estadoDelitoModificar']==null){
                    echo "2";//HAY CAMPOS VACIOS

              }else{
               $idDelito=$Delito->limpiarNumeroEntero($_REQUEST['txt_idDelitoModificar']);
               $descripcion=$Delito->limpiarTexto($_REQUEST['txt_descripcionDelitoModificar']);
               $estado = $Delito->limpiarNumeroEntero($_REQUEST['cmb_estadoDelitoModificar']);

                require_once '../clases/Estado.php';
                $Estado= new Estado();
                $Estado->setIdEstado($estado);
                if($Estado->comprobarEstado()){
                  $Delito->setIdDelito($idDelito);
                  $Delito->setDescripcionDelito($descripcion);
                  $Delito->setEstadoDelito($estado);
                  if($Delito->comprobarNombre()==false){//comprueba nombre de usuario
                if($Delito->actualizarDelito()){
                  echo "1";
                  $UsuarioHistorial= new Usuario();
                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),11,$_SESSION['run'],"Delito modificado: ".$descripcion);
                }else{
                  echo "3";//error
                }
              }else{
                echo "4";
              }
              }else{
                echo "3";
              }
              }
              break;
              case '3'://Eliminar delito
                     $idDelito=$Delito->limpiarNumeroEntero($_REQUEST['id']);

                      $Delito->setIdDelito($idDelito);
                      $Delito->setEstadoDelito("3");
                      if($Delito->eliminarDelito()){
                        echo "1";
                        $UsuarioHistorial= new Usuario();
                        $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),12,$_SESSION['run'],"Delito eliminado: ".$idDelito);
                      }else{
                        echo "3";//error
                      }

              break;
              case '4'://listar tabla
              ?>
              <div class="table-responsive">
              <table class="table table-striped">
                            <caption ></caption>
                            <thead>
                                <th>Codigo</th>
                                <th>Descripcion Delito</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>

                                         <?php
                                          $retorno= $Delito->BuscarFiltarRegistros("vistadelitos","descripcion_delito descripcion_estado",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<tr><td><span id="txt_idDelito'.$contadorFilas.'">'.$filas['id_delito'].'</span></td>';
                                                echo'<td><span id="txt_descripcionDelito'.$contadorFilas.'">'.$filas['descripcion_delito'].'</span></td>';
                                                echo'<td><span id="txt_estadoDelito'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                <input required type="hidden" id="txt_idEstado'.$contadorFilas.'" value="'.$filas['estado'].'"></td>';
                                                  //CAMPOS OCULTOS CON IDS

                                                echo'<td>
                                                             <button type="button"  onclick="mostrarModalModificar('.$contadorFilas.')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                              </button>
                                                </td>
                                                <td>
                                                             <button class="btn btn-danger" onclick="eliminar(\''.$filas['id_delito'].'\')">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                              </button>
                                                          </td>
                                                    </tr>';

                                             }

                                        ?>
                                            <tr>
                                              <td colspan="7">
                                                <center>
                                                <?php
                                                  echo $retorno[0][1];
                                                ?>

                                              </center>
                                              </td>
                                            </tr>
                           </tbody>
                        </table>
                      </div>
                                 <?php
              break;

            }

          }else{
             echo "0";//no tiene privilegios
          }

        }else{
          echo "0";//usuario no existe
        }

            break;

case '3'://Mant Poblacion

$privilegioMantenedor=false;

@session_start();
require_once '../clases/Usuario.php';
require_once '../clases/Grupos.php';
$Usuario= new Usuario();
$Usuario->setRun($_SESSION['run']);
$resultadoUsuario= $Usuario->consultaUnUsuario();
if($resultadoUsuario){

     $Grupo = new Grupos();
     $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
     $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

     foreach($privilegios as $privilegio){

        if($privilegio['id']==10){//privilegio MANTENEDOR
            $privilegioMantenedor=true;
        }
     }


     if($privilegioMantenedor==true){



            require_once '../clases/Poblacion.php';
            $Poblacion=new Poblacion();

            switch($_REQUEST['func']){
              case '1': //Ingresar nueva poblacion
              if($_REQUEST['txt_descripcionPoblacionCrear']==""){
                echo "2"; //valores vacios.
              }else{
                $descripcion=$Poblacion->limpiarTexto($_REQUEST['txt_descripcionPoblacionCrear']);
                $Poblacion->setDescripcionPoblacion($descripcion);
                if($Poblacion->comprobarNombre()==false){//comprueba nombre de usuario
                $Poblacion->setEstadoPoblacion("1");

                if($Poblacion->ingresarPoblacion()){
                  echo "1";
                  $UsuarioHistorial= new Usuario();
                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),13,$_SESSION['run'],"Poblacion creada: ".$descripcion);
                }else{
                  echo "3";//ERROR
                }
              }else{
                echo "4";
              }
              }
              break;

              case '2'://Modificar Poblacion
              if($_REQUEST['txt_idPoblacionModificar']=="" || $_REQUEST['txt_descripcionPoblacionModificar']=="" || $_REQUEST['cmb_estadoPoblacionModificar']==""){
                echo "2";
              }else{
                $idPoblacion=$Poblacion->limpiarNumeroEntero($_REQUEST['txt_idPoblacionModificar']);
                $descripcion=$Poblacion->limpiarTexto($_REQUEST['txt_descripcionPoblacionModificar']);
                $estadoPoblacion=$Poblacion->limpiarNumeroEntero($_REQUEST['cmb_estadoPoblacionModificar']);
                require_once '../clases/Estado.php';
                $Estado= new Estado();
                $Estado->setIdEstado($estadoPoblacion);
                if($Estado->comprobarEstado()){
                  $Poblacion->setIdPoblacion($idPoblacion);
                  $Poblacion->setDescripcionPoblacion($descripcion);
                  $Poblacion->setEstadoPoblacion($estadoPoblacion);
                  if($Poblacion->comprobarNombre()==false){

                if($Poblacion->actualizarPoblacion()){
                  echo "1";
                  $UsuarioHistorial= new Usuario();
                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),14,$_SESSION['run'],"Poblacion modificada: ".$descripcion);
                }else{
                  echo "3";
                }
              }else{
                echo "4";
              }
              }else{
                echo "3";
              }
              }
              break;
              case '3'://Eliminar Poblacion
                      $idPoblacion=$Poblacion->limpiarNumeroEntero($_REQUEST['id']);

                      $Poblacion->setIdPoblacion($idPoblacion);
                      $Poblacion->setEstadoPoblacion("3");
                      $verificarExito= $Poblacion->eliminarPoblacion();

                      if($verificarExito==true){
                            echo "1";
                            $UsuarioHistorial= new Usuario();
                            $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),15,$_SESSION['run'],"Poblacion eliminada: ".$idPoblacion);
                      }else{
                        echo "3";
                      }
              break;
              case '4'://listar tabla
              ?>
              <div class="table-responsive">
              <table class="table table-striped">
                            <caption ></caption>
                            <thead>
                                <th>Codigo</th>
                                <th>Descripcion Poblacion</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>

                                         <?php
                                          $retorno= $Poblacion->BuscarFiltarRegistros("vistapoblaciones","descripcion_poblacion descripcion_estado",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<td><span id="txt_idPoblacion'.$contadorFilas.'">'.$filas['id_poblacion'].'</span></td>';
                                                echo'<td><span id="txt_descripcionPoblacion'.$contadorFilas.'">'.$filas['descripcion_poblacion'].'</span></td>';
                                                echo'<td><span id="txt_estadoPoblacion'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                <input type="hidden" id="txt_idEstado'.$contadorFilas.'" value="'.$filas['estado'].'"></td>';
                                                  //CAMPOS OCULTOS CON IDS

                                                echo'<td>
                                                             <button type="button"  onclick="mostrarModalModificar('.$contadorFilas.')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                              </button>
                                                </td>
                                                <td>
                                                             <button class="btn btn-danger" onclick="eliminar(\''.$filas['id_poblacion'].'\')">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                              </button>
                                                          </td>
                                                    </tr>';

                                             }

                                        ?>
                                            <tr>
                                              <td colspan="7">
                                                <center>
                                                <?php
                                                  echo $retorno[0][1];
                                                ?>

                                              </center>
                                              </td>
                                            </tr>
                           </tbody>
                        </table>
                      </div>
                                 <?php
              break;

            }

          }else{
             echo "0";//no tiene privilegios
          }

        }else{
          echo "0";//usuario no existe
        }


            break;
  case '4'://Mant Equipos

  $privilegioMantenedor=false;

  @session_start();
  require_once '../clases/Usuario.php';
  require_once '../clases/Grupos.php';
  $Usuario= new Usuario();
  $Usuario->setRun($_SESSION['run']);
  $resultadoUsuario= $Usuario->consultaUnUsuario();
  if($resultadoUsuario){

       $Grupo = new Grupos();
       $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
       $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

       foreach($privilegios as $privilegio){

          if($privilegio['id']==11){//privilegio MANTENEDOR
              $privilegioMantenedor=true;
          }
       }


       if($privilegioMantenedor==true){


            require_once '../clases/Equipo.php';
            $Equipo=new Equipo();

            switch($_REQUEST['func']){
              case '1': //Ingresar nuevo equipo
              if($_REQUEST['txt_descripcionEquipoCrear']==""){
                echo "2";
              }else {
                $Equipo->setDescripcionEquipo($Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoCrear']));
                if($Equipo->comprobarNombre()==false){
                $Equipo->setEstadoEquipo("1");
                if($Equipo->ingresarEquipo()){
                    echo "1";
                    $UsuarioHistorial= new Usuario();
                    $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),16,$_SESSION['run'],"Equipo creado: ".$Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoCrear']));
                }else{
                    echo "3";
                }
              }else{
                echo "4";
              }
              }
              break;
              case '2'://Modificar equipo
              if($_REQUEST['txt_idEquipoModificar']=="" || $_REQUEST['txt_descripcionEquipoModificar']=="" || $_REQUEST['cmb_estadoEquipoModificar']==""){
                echo "2";
              }else{
                $Equipo->setIdEquipo($Equipo->limpiarNumeroEntero($_REQUEST['txt_idEquipoModificar']));
                $Equipo->setDescripcionEquipo($Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoModificar']));
                $estado = $_REQUEST['cmb_estadoEquipoModificar'];
                $Equipo->setEstadoEquipo($Equipo->limpiarNumeroEntero($estado));
                require_once '../clases/Estado.php';
                $Estado= new Estado();
                $Estado->setIdEstado($estado);
                if($Estado->comprobarEstado()){
                  if($Equipo->comprobarNombre()==false){
                if($Equipo->actualizarEquipo()){
                  echo "1";
                  $UsuarioHistorial= new Usuario();
                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),17,$_SESSION['run'],"Equipo modificado: ".$Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoModificar']));
                }else{
                  echo "3";
                }
              }else{
                echo "4";
              }
              }else{
                echo "3";
              }
              }
              break;
              case '3'://Eliminar equipo
                      $Equipo->setIdEquipo($Equipo->limpiarNumeroEntero($_REQUEST['id']));
                      $Equipo->setEstadoEquipo("3");
                      $verificarExito= $Equipo->eliminarEquipo();

                      if($verificarExito==true){
                        echo "1";
                        $UsuarioHistorial= new Usuario();
                        $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),18,$_SESSION['run'],"Equipo eliminado: ".$Equipo->limpiarNumeroEntero($_REQUEST['id']));
                      }else{
                           echo "3";
                      }
              break;
              case '4'://listar tabla
              ?>
              <div class="table-responsive">
              <table class="table table-striped">
                            <caption ></caption>
                            <thead>
                                <th>Codigo</th>
                                <th>Descripcion Equipo</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>

                                         <?php
                                          $retorno= $Equipo->BuscarFiltarRegistros("vistaequipos","descripcion_equipo descripcion_estado",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<td><span id="txt_idEquipo'.$contadorFilas.'">'.$filas['id_equipo'].'</span></td>';
                                                echo'<td><span id="txt_descripcionEquipo'.$contadorFilas.'">'.$filas['descripcion_equipo'].'</span></td>';
                                                echo'<td><span id="txt_estadoEquipo'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                <input type="hidden" id="txt_idEstado'.$contadorFilas.'" value="'.$filas['estado'].'"></td>';
                                                  //CAMPOS OCULTOS CON IDS

                                                echo'<td>
                                                             <button type="button"  onclick="mostrarModalModificar('.$contadorFilas.')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                              </button>
                                                </td>
                                                <td>
                                                             <button class="btn btn-danger" onclick="eliminar(\''.$filas['id_equipo'].'\')">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                              </button>
                                                          </td>
                                                    </tr>';

                                             }

                                        ?>
                                            <tr>
                                              <td colspan="7">
                                                <center>
                                                <?php
                                                  echo $retorno[0][1];
                                                ?>

                                              </center>
                                              </td>
                                            </tr>
                           </tbody>
                        </table>
                      </div>
                                 <?php
              break;

            }

      }else{
         echo "0";//no tiene privilegios
      }

    }else{
      echo "0";//usuario no existe
    }


            break;

case "5"://MANTENEDOR GRUPOS DE USUARIOS

$privilegioMantenedor=false;

@session_start();
require_once '../clases/Usuario.php';
require_once '../clases/Grupos.php';
$Usuario= new Usuario();
$Usuario->setRun($_SESSION['run']);
$resultadoUsuario= $Usuario->consultaUnUsuario();
if($resultadoUsuario){

     $Grupo = new Grupos();
     $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
     $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

     foreach($privilegios as $privilegio){

        if($privilegio['id']==7){//privilegio MANTENEDOR
            $privilegioMantenedor=true;
        }
     }


     if($privilegioMantenedor==true){

        require_once '../clases/Grupos.php';
        $Grupo = new Grupos();

        switch($_REQUEST['func']){

            case '1': //mantenedor Ingresar GRUPO

            if($_REQUEST['txt_descripcionCrear']==""){
                  echo "2";//hay campos vacios

            }else{//los campos no estan vacios

                        //limpia variables de comillas
                        $nombreGrupo=$Grupo->limpiarTexto($_REQUEST['txt_descripcionCrear']);

                            $Grupo->setGrupo($nombreGrupo);

                            if($Grupo->comprobarNombre()==false){//comprueba nombre de usuario

                                    $idGrupoIngresado= $Grupo->insertarGrupo();
                                    if($idGrupoIngresado){
                                          echo "1";
                                          $UsuarioHistorial= new Usuario();
                                          $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),19,$_SESSION['run'],"Grupo Creado: ".$nombreGrupo);

                                          $Grupo->setIdGrupo($idGrupoIngresado);

                                          require_once '../clases/Privilegio.php';
                                          $Privilegio= new Privilegio();
                                          $listaPrivilegios= $Privilegio->listarPrivilegios();

                                          foreach($listaPrivilegios as $columna){
                                                  $priv='chb_privilegioCrear'.$columna['id_privilegios'];
                                                  //echo "id texto privilegio: ".$priv;

                                                  if(isset($_REQUEST[$priv])){
                                                         $Grupo->asignarPrivilegioAlGrupo($columna['id_privilegios']);
                                                  }
                                          }
                                      }else{
                                        echo "3";//error
                                      }

                            }else{
                                echo "4";//EL NOMBRE INGRESADO YA EXISTE
                            }

            }
            break;
            case '2': //Mantenedor modificar - GRUPO
                    //echo "id recibido: ".$_REQUEST['txt_idGrupo'];

                  if($_REQUEST['txt_idGrupo']=="" or $_REQUEST['txt_nombreGrupo']==""){
                        echo "2";//hay campos vacios

                  }else{//los campos no estan vacios

                          //limpia variables de comillas y asigna
                          $idGrupo=$Grupo->limpiarNumeroEntero($_REQUEST['txt_idGrupo']);
                          $nombreGrupo=$Grupo->limpiarTexto($_REQUEST['txt_nombreGrupo']);

                          $Grupo->setIdGrupo($idGrupo);
                          $Grupo->setGrupo($nombreGrupo);

                          if($Grupo->comprobarNombre()==false){//comprueba nombre de usuario

                                if($Grupo->actualizar()){

                                      if($Grupo->eliminarPrivilegiosDeGrupo()){

                                          require_once '../clases/Privilegio.php';
                                          $Privilegio= new Privilegio();
                                          $listaPrivilegios= $Privilegio->listarPrivilegios();

                                          foreach($listaPrivilegios as $columna){
                                                  $priv='chb_privilegio'.$columna['id_privilegios'];
                                                  //echo "id texto privilegio: ".$priv;

                                                  if(isset($_REQUEST[$priv])){
                                                         $Grupo->asignarPrivilegioAlGrupo($columna['id_privilegios']);
                                                  }
                                          }
                                           echo "1";
                                           $UsuarioHistorial= new Usuario();
                                           $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),20,$_SESSION['run'],"Grupo Modificado: ".$nombreGrupo);

                                      }else{
                                        echo "3";
                                      }

                                  }else{
                                    echo "3";//error
                                  }
                          }
                          else{
                            echo "4";//nombre ya existe
                          }
                      }

                break;
            case '3'://Listar registro en la tabla con paginador - GRUPO
             echo'<div class="table-responsive">
             <table class="table table-striped">
                <thead>
                    <th>Nombre Grupo</th>
                    <th></th>
                    <th></th>
                </thead>
             ';
                     $retorno = $Grupo->BuscarFiltarRegistros("tb_grupousuario","descripcion_grupoUsuario",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");

                      $contadorFilas=0;
                      foreach($retorno[0][0] as $column){
                        $contadorFilas++;

                      echo '<tr>
                              <td><span id="txt_nombreGrupo'.$contadorFilas.'" >'.$column['descripcion_grupoUsuario'].'</span></td>
                           <td>
                                <button type="button"  onclick="mostrarModalModificar('.$column['id_grupoUsuario'].')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </td>
                            <td>
                                  <button class="btn btn-danger" onclick="eliminar(\''.$column['id_grupoUsuario'].'\')">
                                    <span class="glyphicon glyphicon-trash"></span>
                                  </button>
                              </td>
                        </tr>';

                         }
                          echo'<tr>
                            <td colspan="7">
                              <center>';
                                echo $retorno[0][1];
                            echo'</center>
                            </td>
                          </tr>
                       </tbody>
                    </table>
                    </div>';

            break;

            case '4'://eliminar
                 $Grupo->setIdGrupo($Grupo->limpiarNumeroEntero($_REQUEST['id']));
                 if($Grupo->eliminarGrupo()){
                      echo "1";
                      $UsuarioHistorial= new Usuario();
                      $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),21,$_SESSION['run'],"Grupo Eliminado: ".$Grupo->limpiarNumeroEntero($_REQUEST['id']));
                 }else{
                      echo "3";//error
                 }

            break;

            case '5'://carga informacion del formulario modificar

            if(isset($_REQUEST['id'])){

                 $Grupo->setIdGrupo($Grupo->limpiarNumeroEntero($_REQUEST['id']));
                 $resultado= $Grupo->consultaUnGrupo();
                 $privilegiosACtuales= $Grupo->consultaPrivilegiosDeGrupo();

            echo'
                                        <!-- CAMPO 1 DEL MODAL-->

                <!--campos ocultos para guardar -->
                <input type="hidden" id="txt_idGrupo" name="txt_idGrupo" value="'.$resultado[0]['id_grupoUsuario'].'" >

                  <div class="form-group">
                        <label class="sr-only control-label col-lg-2" for="txt_nombreGrupo">Nombre</label>
                        <div class="col-lg-5">
                          <input type="text" value="'.$resultado[0]['descripcion_grupoUsuario'].'" required title="Complete este campo" placeholder="Nombre" id="txt_nombreGrupo" name="txt_nombreGrupo" type="text" class="form-control">
                        </div>
                  </div>
                <hr>';


             echo '<!-- CAMPO 2 DEL MODAL-->
                  <div class="form-group">
                      <label class="control-label col-lg-2" for="">Privilegios</label>
                      <div class="col-lg-5">';

                          require_once '../clases/Privilegio.php';
                          $Privilegio= new Privilegio();
                          $lista= $Privilegio->listarPrivilegios();

                          foreach($lista as $columnasC){
                           echo '<div class="row">';

                                    echo'<input type="checkbox"';
                                    foreach($privilegiosACtuales as $pobActua){
                                            if($pobActua['id']==$columnasC['id_privilegios']){
                                                echo' checked ';
                                            }
                                    }
                                    echo 'id="chb_privilegio'.$columnasC['id_privilegios'].'" name="chb_privilegio'.$columnasC['id_privilegios'].'">';

                              echo'<label for="chb_privilegio'.$columnasC['id_privilegios'].'" value="'.$columnasC['id_privilegios'].'">'.$columnasC['descripcion_privilegios'].'</label>';
                           echo '</div>';
                          }

              echo' </div>
                </div>';

            }else{
                echo "3";//error
            }

            break;
       }

    }else{
       echo "0";//no tiene privilegios
    }

  }else{
    echo "0";//usuario no existe
  }
break;


case "6"://MANTENEDOR ZONAS

$privilegioMantenedor=false;

@session_start();
require_once '../clases/Usuario.php';
require_once '../clases/Grupos.php';
$Usuario= new Usuario();
$Usuario->setRun($_SESSION['run']);
$resultadoUsuario= $Usuario->consultaUnUsuario();
if($resultadoUsuario){

     $Grupo = new Grupos();
     $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
     $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

     foreach($privilegios as $privilegio){

        if($privilegio['id']==9){//privilegio MANTENEDOR
            $privilegioMantenedor=true;
        }
     }


     if($privilegioMantenedor==true){


      require_once '../clases/Zonas.php';
      $Zonas = new Zonas();

      switch($_REQUEST['func']){

            case '1': //mantenedor Ingresar ZONA

            if($_REQUEST['txt_descripcionCrear']==""){
                  echo "2";//hay campos vacios

            }else{//los campos no estan vacios

                        //limpia variables de comillas
                        $nombreZona=$Zonas->limpiarTexto($_REQUEST['txt_descripcionCrear']);

                            $Zonas->setZona($nombreZona);

                            if($Zonas->comprobarNombre()==false){//comprueba nombre de usuario

                                    $idZonaIngresada= $Zonas->insertarZona();
                                    if($idZonaIngresada){
                                          echo "1";
                                          $UsuarioHistorial= new Usuario();
                                          $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),22,$_SESSION['run'],"Zona Creada: ".$nombreZona);



                                          $Zonas->setIdZona($idZonaIngresada);

                                          require_once '../clases/Poblacion.php';
                                          $Poblacion= new Poblacion();
                                          $listaPoblaciones= $Poblacion->listarPoblacion();

                                          foreach($listaPoblaciones as $columna){
                                                  $pob='chb_poblacionCrear'.$columna['id_poblacion'];
                                                  //echo "id texto privilegio: ".$pob;

                                                  if(isset($_REQUEST[$pob])){
                                                         $Zonas->asignarPoblacionAZona($columna['id_poblacion']);
                                                  }
                                          }
                                    }else{
                                      echo "3";//error
                                    }

                            }else{
                                echo "4";//EL NOMBRE INGRESADO YA EXISTE
                            }

            }
            break;
            case '2': //Mantenedor modificar - ZONA
                    //echo "id recibido: ".$_REQUEST['txt_idGrupo'];

                  if($_REQUEST['txt_idZonas']=="" or $_REQUEST['txt_nombreZonas']==""){
                        echo "2";//hay campos vacios

                  }else{//los campos no estan vacios

                          //limpia variables de comillas y asigna
                          $idZona=$Zonas->limpiarNumeroEntero($_REQUEST['txt_idZonas']);
                          $nombreZona=$Zonas->limpiarTexto($_REQUEST['txt_nombreZonas']);

                          $Zonas->setIdZona($idZona);
                          $Zonas->setZona($nombreZona);

                          if($Zonas->comprobarNombre()==false){//comprueba nombre de usuario

                              $Zonas->actualizar();
                              if($Zonas->eliminarPoblacionesDeZona()){
                                   echo "1";
                                   $UsuarioHistorial= new Usuario();
                                   $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),23,$_SESSION['run'],"Zona Modificada: ".$nombreZona);


                                        require_once '../clases/Poblacion.php';
                                        $Poblacion= new Poblacion();
                                        $listaPoblaciones= $Poblacion->listarPoblacion();

                                        foreach($listaPoblaciones as $columna){
                                                $pobl='chb_poblacion'.$columna['id_poblacion'];
                                                //echo "id texto privilegio: ".$pobl;

                                                if(isset($_REQUEST[$pobl])){
                                                       $Zonas->asignarPoblacionAZona($columna['id_poblacion']);
                                                }
                                        }
                                }else{
                                  echo "3";//error
                                }

                          }else{
                            echo "4";//nombre ya existe
                          }
                      }

                break;
            case '3'://Listar registro en la tabla con paginador - ZONA
             echo'<div class="table-responsive">
             <table class="table table-striped">
                <thead>
                    <th>Nombre Zona</th>
                    <th></th>
                    <th></th>
                </thead>
             ';
                     $retorno = $Zonas->BuscarFiltarRegistros("tb_zona","descripcion_zona",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");

                      $contadorFilas=0;
                      foreach($retorno[0][0] as $column){
                        $contadorFilas++;

                      echo '<tr>
                              <td><span id="txt_nombreGrupo'.$contadorFilas.'" >'.$column['descripcion_zona'].'</span></td>
                           <td>
                                <button type="button"  onclick="mostrarModalModificar('.$column['id_zona'].')" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-info">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </td>
                            <td>
                                  <button class="btn btn-danger" onclick="eliminar(\''.$column['id_zona'].'\')">
                                    <span class="glyphicon glyphicon-trash"></span>
                                  </button>
                              </td>
                        </tr>';

                         }
                          echo'<tr>
                            <td colspan="7">
                              <center>';
                                echo $retorno[0][1];
                            echo'</center>
                            </td>
                          </tr>
                       </tbody>
                    </table>
                    </div>';

            break;

            case '4'://ELIMINAR ZONA
                 $idZona=$Zonas->limpiarNumeroEntero($_REQUEST['id']);

                 $Zonas->setIdZona($idZona);
                 if($Zonas->eliminarZona()){
                   echo "1";
                   $UsuarioHistorial= new Usuario();
                   $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),24,$_SESSION['run'],"Zona Eliminada: ".$idZona);
                 }else{
                   echo "3";//error
                 }
            break;

            case '5'://carga informacion del formulario modificar

               $Zonas->setIdZona($_REQUEST['id']);
               $resultado= $Zonas->consultaUnaZona();
               $privilegiosACtuales= $Zonas->consultaPoblacionesDeZona();

            echo'
                                        <!-- CAMPO 1 DEL MODAL-->

                <!--campos ocultos para guardar -->
                <input type="hidden" id="txt_idZonas" name="txt_idZonas" value="'.$resultado[0]['id_zona'].'" >

                  <div class="form-group">
                        <label class="sr-only control-label col-lg-2" for="txt_nombreZonas">Nombre</label>
                        <div class="col-lg-5">
                          <input type="text" value="'.$resultado[0]['descripcion_zona'].'" required title="Complete este campo" placeholder="Nombre" id="txt_nombreZonas" name="txt_nombreZonas" type="text" class="form-control">
                        </div>
                  </div>
                <hr>';


             echo '<!-- CAMPO 2 DEL MODAL-->
                  <div class="form-group">
                      <label class="control-label col-lg-2" for="">Poblaciones</label>
                      <div class="col-lg-5">';

                          require_once '../clases/Poblacion.php';
                          $Poblacion= new Poblacion();
                          $lista= $Poblacion->listarPoblacion();

                          foreach($lista as $columnasC){
                           echo '<div class="row">';

                                    echo'<input type="checkbox"';
                                    foreach($privilegiosACtuales as $poblActual){
                                            if($poblActual['id']==$columnasC['id_poblacion']){
                                                echo' checked ';
                                            }
                                    }
                                    echo 'id="chb_poblacion'.$columnasC['id_poblacion'].'" name="chb_poblacion'.$columnasC['id_poblacion'].'">';

                              echo'<label for="chb_poblacion'.$columnasC['id_poblacion'].'" value="'.$columnasC['id_poblacion'].'">'.$columnasC['descripcion_poblacion'].'</label>';
                           echo '</div>';
                          }

              echo' </div>
                </div>';

            break;
      }

    }else{
       echo "0";//no tiene privilegios
    }

  }else{
    echo "0";//usuario no existe
  }
break;


case "7": //mantenedor sospechosos
        require_once '../clases/Sospechoso.php';
        $Sospechoso= new Sospechoso();

        switch($_REQUEST['func']){

              case '1': // Ingresar sospechosos

          if(isset($_POST['run'])){

            $privilegioIngresar=false;

            @session_start();
            require_once '../clases/Usuario.php';
            require_once '../clases/Grupos.php';
            $Usuario= new Usuario();
            $Usuario->setRun($_SESSION['run']);
            $resultadoUsuario= $Usuario->consultaUnUsuario();
            if($resultadoUsuario){

                 $Grupo = new Grupos();
                 $Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
                 $privilegios=$Grupo->consultaPrivilegiosDeGrupo();

                 foreach($privilegios as $privilegio){

                    if($privilegio['id']==3){//privilegio modificar sospechosos
                        $privilegioIngresar=true;
                    }
                 }


                 if($privilegioIngresar==true){

                  $run="";
                       if(isset($_REQUEST['mod'])){
                         $run=$_SESSION['sospechosoModificando'];
                       }else{
                         $run=$_POST['run'];
                      }

                $posicionGuion = strpos($run,'-');
                $soloRun = substr($run,0,$posicionGuion);

                $digitoVerificador = substr($run,$posicionGuion+1,strlen($run));
                  $soloRun=$Sospechoso->limpiarNumeroEntero($soloRun);
                 $nombre=$Sospechoso->limpiarTexto($_POST['nombre']);
                 $apellidoP=$Sospechoso->limpiarTexto($_POST['apellidoPaterno']);
                 $apellidoM=$Sospechoso->limpiarTexto($_POST['apellidoMaterno']);
                 $fechaNacimiento=$Sospechoso->limpiarTexto($_POST['edad']);
                 $apodo=$Sospechoso->limpiarTexto($_POST['apodo']);
                 $lugarNacimiento=$Sospechoso->limpiarTexto($_POST['lugarNacimiento']);
                 $estatura=$Sospechoso->limpiarNumeroEntero($_REQUEST['estatura']);
                 //combobox
                 $colorPelo=$Sospechoso->limpiarNumeroEntero($_REQUEST['colorPelo']);
                 $contextura=$Sospechoso->limpiarNumeroEntero($_POST['contextura']);
                 $estadoCivil=$Sospechoso->limpiarNumeroEntero($_POST['estadoCivil']);
                 $sexo=$Sospechoso->limpiarNumeroEntero($_REQUEST['sexo']);
                 $tezPiel=$Sospechoso->limpiarNumeroEntero($_REQUEST['tezPiel']);
                 $tipoOjos=$Sospechoso->limpiarNumeroEntero($_REQUEST['tipoOjos']);
                 $tipoPelo=$Sospechoso->limpiarNumeroEntero($_REQUEST['tipoPelo']);
                 //radiobuttons
                 $acne=$Sospechoso->limpiarNumeroEntero($_REQUEST['acne']);
                 $barba=$Sospechoso->limpiarNumeroEntero($_REQUEST['barba']);
                 $bigote=$Sospechoso->limpiarNumeroEntero($_REQUEST['bigote']);
                 $manchas=$Sospechoso->limpiarNumeroEntero($_REQUEST['manchas']);
                 $lentes=$Sospechoso->limpiarNumeroEntero($_REQUEST['lentes']);
                 $pecas=$Sospechoso->limpiarNumeroEntero($_REQUEST['pecas']);
                 $antecedentes=$Sospechoso->limpiarNumeroEntero($_REQUEST['antecedentes']);

                   if($estatura==""){
                   	$estatura=0;
                   }



                  if($soloRun=="" || $digitoVerificador=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNacimiento=="" || $estatura==""
                  || $colorPelo=="" || $contextura=="" || $estadoCivil=="" || $sexo=="" || $tezPiel=="" || $tipoOjos=="" || $tipoPelo==""
                  || $acne=="" || $barba=="" || $bigote=="" || $manchas=="" || $lentes=="" || $pecas=="" || $antecedentes=="" ){

                        echo "2";
                  }else{//ENTRA SINO HAY CAMPOS VACIOS

                    $Sospechoso->setRun($soloRun);

                    $Sospechoso->setRun($soloRun);
                    $Sospechoso->setDv($digitoVerificador);
                    $Sospechoso->setNombre($nombre);
                    $Sospechoso->setApellidoPaterno($apellidoP);
                    $Sospechoso->setApellidoMaterno($apellidoM);

                    $Sospechoso->setLugarNacimiento($lugarNacimiento);
                    $Sospechoso->setIdColorPelo($colorPelo);
                    $Sospechoso->setContextura($contextura);
                    $Sospechoso->setIdEstadoCivil($estadoCivil);
                    $Sospechoso->setIdSexo($sexo);
                    $Sospechoso->setIdTezPiel($tezPiel);
                    $Sospechoso->setIdTipoOjos($tipoOjos);
                    $Sospechoso->setIdTipoPelo($tipoPelo);
                    $Sospechoso->setAntecedentes($antecedentes);
                    $Sospechoso->setApodos($apodo);
                    $Sospechoso->setBarba($barba);
                    $Sospechoso->setLentes($lentes);
                    $Sospechoso->setPecas($pecas);
                    $Sospechoso->setAcne($acne);
                    $Sospechoso->setBigote($bigote);
                    $Sospechoso->setManchas($manchas);
                    $Sospechoso->setEstatura($estatura);
                    $Sospechoso->setFechaNacimiento($fechaNacimiento);

                       if($Sospechoso->insertarModificarSospechosos()){

                           if($Sospechoso->eliminarCaracteristicasSospechosos()){



                               	$contadorDelitos= $_REQUEST['contadorDelitos'];
                               	$contadorEquiposFutbol= $_REQUEST['contadorEquiposFutbol'];
                               	$contadorOpcionesCicatriz= $_REQUEST['contadorOpcionesCicatriz'];
                               	$contadorOpcionesTatuaje= $_REQUEST['contadorOpcionesTatuaje'];
                               	$contadorOpcionesPiercing= $_REQUEST['contadorOpcionesPiercing'];
                               	$contadorPoblaciones=$_REQUEST['contadorPoblaciones'];
                               	$contadorFotos=$_REQUEST['contadorFotos'];



                               /*PREPARAR BUSQUEDA DELITOS*/
                               	$delitos="";
                               	for($c=1;$c<=$contadorDelitos;$c++){

                               		if(isset($_REQUEST['delito'.$c])){

                               				if($delitos==""){
                               					$delitos= $delitos.$_REQUEST['delito'.$c];
                               				}else{
                               					$delitos= $delitos.";".$_REQUEST['delito'.$c];
                               				}

                               		}
                               	}
                               	$arrayDelitos= explode(";",$delitos);
                                if($delitos!=""){

                                   	foreach ($arrayDelitos as $key => $de) {

                                   		//echo $de."\n";
                                   		$consultaDelitos= "INSERT INTO tb_delitosopechoso(id_delito,run_sospechoso) VALUES('$de','$soloRun');";
                                   		$Sospechoso->insertar($consultaDelitos);
                                   		//echo $consultaDelitos;
                                   	}
                                  }
                               	/*FIN DELITOS*/

                               	/*PREPARAR BUSQUEDA EQUIPOS*/
                               	$equipos="";
                               	for($c=1;$c<=$contadorEquiposFutbol;$c++){
                               		if(isset($_REQUEST['equipo'.$c])){

                               				if($equipos==""){
                               					$equipos= $equipos.$_REQUEST['equipo'.$c];
                               				}else{
                               					$equipos= $equipos.";".$_REQUEST['equipo'.$c];
                               				}

                               		}
                               	}
                               	$arrayEquipos= explode(";",$equipos);
                                if($equipos!=""){
                                 	foreach ($arrayEquipos as $key => $eq) {

                                 		//echo $eq."\n";
                                 		$consultaDelitos= "insert into tb_equiposospechoso(id_equipo,run) VALUES('$eq','$soloRun');";
                                 		$Sospechoso->insertar($consultaDelitos);
                                 		//echo $consultaDelitos;
                                 	}
                                }
                               	/*FIN EQUIPOS*/

                               	/*PREPARAR BUSQUEDA POBLACIONES*/
                               	$poblaciones="";

                               	for($c=1;$c<=$contadorPoblaciones;$c++){
                               		if(isset($_REQUEST['poblacion'.$c])){

                               				if($poblaciones==""){
                               					$poblaciones= $poblaciones.$_REQUEST['poblacion'.$c];
                               				}else{
                               					$poblaciones= $poblaciones.";".$_REQUEST['poblacion'.$c];
                               				}

                               		}
                               	}


                               	$arrayPoblaciones= explode(";",$poblaciones);
                            if($poblaciones!=""){
                               	foreach ($arrayPoblaciones as $key => $pob) {

                               		//echo $pob."\n";
                               		$consultaDelitos= "insert into tb_poblacionsospechoso(id_poblacion,run) VALUES('$pob','$soloRun');";
                               		$Sospechoso->insertar($consultaDelitos);
                               		//echo $consultaDelitos;
                               	}
                             }
                               	/*FIN POBLACIONES*/

                               	/*PREPARAR BUSQUEDA CICATRIZ*/
                               	$cicatriz="";
                               	for($c=1;$c<=$contadorOpcionesCicatriz;$c++){
                               		if(isset($_REQUEST['cicatriz'.$c])){

                               				if($cicatriz==""){
                               					$cicatriz= $cicatriz.$_REQUEST['cicatriz'.$c];
                               				}else{
                               					$cicatriz= $cicatriz.";".$_REQUEST['cicatriz'.$c];
                               				}

                               		}
                               	}
                               	$arrayCicatrices= explode(";",$cicatriz);
                                if($cicatriz!=""){
                               	foreach ($arrayCicatrices as $key => $cic) {

                               		//echo $cic."\n";
                               		$consultaDelitos= "insert into tb_cicatrizsospechoso(id_lugarCicatriz,run) VALUES('$cic','$soloRun');";
                               		$Sospechoso->insertar($consultaDelitos);
                               		//echo $consultaDelitos;
                               	}
                              }
                               	/*FIN CICATRIZ*/

                               	/*PREPARAR BUSQUEDA TATUAJE*/
                               	$tatuaje="";
                               	for($c=1;$c<=$contadorOpcionesTatuaje;$c++){
                               		if(isset($_REQUEST['tatuaje'.$c])){

                               				if($tatuaje==""){
                               					$tatuaje= $tatuaje.$_REQUEST['tatuaje'.$c];
                               				}else{
                               					$tatuaje= $tatuaje.";".$_REQUEST['tatuaje'.$c];
                               				}

                               		}
                               	}
                               	$arrayTatuaje= explode(";",$tatuaje);
                                if($tatuaje!=""){
                               	foreach ($arrayTatuaje as $key => $tat) {

                               		//echo $tat."\n";
                               		$consultaDelitos= "insert into tb_tatuajesospechoso(id_lugarTatuaje,run) VALUES('$tat','$soloRun');";
                               		$Sospechoso->insertar($consultaDelitos);
                               		//echo $consultaDelitos;
                               	}
                              }
                               	/*FIN TATUAJE*/

                               	/*PREPARAR BUSQUEDA PIERCING*/
                               	$piercing="";
                               	for($c=1;$c<=$contadorOpcionesPiercing;$c++){
                               		if(isset($_REQUEST['piercing'.$c])){

                               				if($piercing==""){
                               					$piercing= $piercing.$_REQUEST['piercing'.$c];
                               				}else{
                               					$piercing= $piercing.";".$_REQUEST['piercing'.$c];
                               				}

                               		}
                               	}
                               	$arrayPiercing= explode(";",$piercing);
                                if($piercing!=""){
                               	foreach ($arrayPiercing as $key => $pi) {

                               		//echo $pi."\n";
                               		$consultaDelitos= "insert into tb_piercingsospechoso(id_lugarPiercing,run) VALUES('$pi','$soloRun');";
                               		$Sospechoso->insertar($consultaDelitos);
                               		//echo $consultaDelitos;
                               	}
                               }
                               	/*FIN PIERCING*/



                               		for($c=1;$c<=$contadorFotos;$c++){
                                   			$campo= "foto".$c;
                                   			$fechaFoto= "fechaFoto".$c;
                                   			$tipoFoto= "tipoFoto".$c;

                                   			if(isset($_REQUEST[$tipoFoto])){
                                   					$tipoFoto=2;
                                   			}else{
                                   					$tipoFoto=1;
                                   			}


                                                    $numeroRandom= rand(5,1000).date("d").date("m").date("Y");
                                                    $nombreImagenActual=$numeroRandom.basename( $_FILES[$campo]['name']);
                                                    $nombreImagenActual=str_replace("ñ","n",$nombreImagenActual);
                                                    //echo "nuevo nombre imagen: ".$nombreImagenActual;

                                                        $target_path = "../imagenes/";
                                                        $target_path = $target_path.$nombreImagenActual;

                                                    	  str_replace("�","n",$target_path);

                                                                //--------------cambia a jpg---------------
                                                                      $imagen=getimagesize($_FILES[$campo]['tmp_name']);//obtenemos el tipo
                                                                      $extencion=image_type_to_extension($imagen[2],false);//aqui obtenemos la extencion de la imagen
                                                                      $imagecreate=$Sospechoso->gen_fun_create($extencion);//generamos el nombre de la funcion a la que hay que llamar
                                                                      $nimagent=$imagecreate($_FILES[$campo]['tmp_name']);//creamos la imagen con la funcion creada
                                                                          $archivo=$target_path;
                                                                          if(imagejpeg($nimagent,$target_path.'.jpg')){

                                                                            // $origen=$target_path;
                                                                            // $destino="../imagenes/nuevaimagen.jpg";
                                                                            // $destino_temporal=tempnam("./","tmp");
                                                                            // $Sospechoso->redimensionar_jpeg($origen, $destino_temporal, 300, 350, 100);
                                                                            //
                                                                            // // guardamos la imagen
                                                                            // $fp=fopen($destino,"w");
                                                                            // fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
                                                                            //fclose($fp);

                                                                              $consultaFotos="call guardarImagen('".$nombreImagenActual.".jpg','".$_REQUEST[$fechaFoto]."',".$tipoFoto.",".$soloRun.");";
                                                                              //echo $consultaFotos;
                                                                              $Sospechoso->insertar($consultaFotos);
                                                                          }//escribimos la imagen nueva como jpg


                                                                //  if(move_uploaded_file($_FILES[$campo]['tmp_name'], $target_path)){
                                                                    //echo "El archivo ". $nombreImagenActual. " ha sido subido";
                                                                   //echo "tipo foto es: ".$tipoFoto;


                                                                  //-------------comprime-----------------
                                                                  //
                                                                  // $origen=$target_path;
                                                                  // $destino="../imagenes/nuevaimagen.jpg";
                                                                  // $destino_temporal=tempnam("tmp/","tmp");
                                                                  // $Sospechoso->redimensionar_jpeg($origen, $destino_temporal, 300, 350, 100);
                                                                  //
                                                                  // // guardamos la imagen
                                                                  // $fp=fopen($destino,"w");
                                                                  // fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
                                                                  // fclose($fp);
                                                                  //
                                                                  // // mostramos la imagen
                                                                  // echo "<img src='../imagenes/nuevaimagen.jpg'>";

                                                                  // }else{
                                                           			 //    	echo "Ha ocurrido un error al guardar imagen, trate de nuevo!";
                                                           			// 	}
                                   		  }

                                  echo "1";
                                  $UsuarioHistorial= new Usuario();
                                  $UsuarioHistorial->guardarHistorial($UsuarioHistorial->obtenerIpReal(),4,$_SESSION['run'],"Sospechoso Creado: ".$soloRun);

                          }else{
                              echo "3";//NO SE BORRARON LAS CARACTERISTICAS ANTES DE ELIMINARLAS
                          }

                       }else{
                            echo "3";
                       }//cierre de if que indica que se ingreso el sospechoso

                     }//cierre de else de campos vacios


                   }else{
                       echo "0";
                    }
                }else{
                  echo "0";//usuario no existe
                }

          }else{
           echo "0";
          }


                      break;
             case '2': // modificar sospechosos


                     break;
             case '3': // listar sospechosos

$privilegioVer=false;
$privilegioModificar=false;

             @session_start();
             require_once '../clases/Usuario.php';
             require_once '../clases/Grupos.php';
             $Usuario= new Usuario();
             $Usuario->setRun($_SESSION['run']);
             $resultadoUsuario= $Usuario->consultaUnUsuario();
             if($resultadoUsuario){

                 	$Grupo = new Grupos();
                 	$Grupo->setIdGrupo($resultadoUsuario[0]['id_grupoUsuario']);
                 	$privilegios=$Grupo->consultaPrivilegiosDeGrupo();

                 	foreach($privilegios as $privilegio){

                     if($privilegio['id']==2){//privilegio ver sospechosos
                         $privilegioVer=true;
                     }
                     if($privilegio['id']==4){//privilegio modificar sospechosos
                         $privilegioModificar=true;
                     }
                 	}

             	}else{
             		echo "0";//no tiene los privilegios
             	}


              if($privilegioVer==true){

                     echo'<div class="table-responsive">
                     <table class="table table-bordered tablaLista table-striped">
                           <thead>
                               <th>Rut</th>
                               <th>Nombre</th>
                               <th>Apellido Paterno</th>
                               <th>Apellido Materno</th>
                               <th>Lugar Nacimiento</th>
                               <th></th>
                           </thead>
                           <tbody>
                     ';
                             $retorno = $Sospechoso->BuscarFiltarRegistros("vistasospechoso","campoBuscar",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");

                              $contadorFilas=0;
                              foreach($retorno[0][0] as $column){
                                $contadorFilas++;

                                echo'<tr>
                                        <td>'.$column["run"].'</td>
                                        <td class="text-uppercase">'.$column["nombres"].'</td>
                                        <td class="text-uppercase">'.$column["apellido_paterno"].'</td>
                                        <td class="text-uppercase">'.$column["apellido_materno"].'</td>
                                        <td class="text-uppercase">'.$column["lugar_deNacimiento"].'</td>';

                                     if($privilegioModificar==true){
                                          echo '<td><a href="formularioModificacionSospechosos.php?id='.$column['solorrun'].'"><span class="glyphicon glyphicon-pencil"></a></td>';
                                        }
                                echo '</tr>';

                                 }
                                  echo'<tr>
                                    <td colspan="7">
                                      <center>';
                                        echo $retorno[0][1];
                                    echo'</center>
                                    </td>
                                  </tr>
                               </tbody>
                            </table>
                            </div>';

              }else{//SI NO TIENE EL PRIVILEGIO PARA VER SE DEVUELVE AL MENU PRINCIPAL
                echo "0";//no tiene los privilegios
              }
                     break;

          case '4'://MOSTRAR IMAGENES SOSPECHOSO
                $run=$_SESSION['sospechosoModificando'];
                $posicionGuion = strpos($run,'-');
                $run = substr($run,0,$posicionGuion);

        			 echo' <div class="col-xs-12" id="fotosInformacionSospechoso">';

         				$consulta2="select * from tb_imagen
        				inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
        				where run_sospechoso=".$run;
        				//echo $consulta2;
        				$resultado2=$Sospechoso->registros($consulta2);

        					foreach($resultado2 as $filas2){

        						echo'
        						<div class="img-thumbnail">
        						<div class="img-thumbnail col-xs-12" id=""
        						 style="background-image: url(\'../imagenes/'.$filas2['nombre_imagen'].'\');
        							background-size: cover;
        							background-position: center;
                      width:100px;
        							height:100px;
        							float:left;
        							margin-left:3px;
        							border-style: dotted;
        							border-width:1px;
        							border-radius:5px;
        							" >

        							</div>
        							<div>
        									<label for="">Fecha: '.$filas2['fecha_imagen'].'</label>
        									<input class="col-xs-6 btn btn-danger" type="button" onclick="eliminarFoto('.$filas2['id_imagen'].','.$run.')" value="Eliminar">
        									<input ';
                          if($filas2['foto_principal']==2){
                            echo ' class="col-xs-6 btn btn-success" ';
                          }
                          else{
                             echo ' class="col-xs-6 btn btn-default" ';
                          }

                          echo 'type="button" onclick="fotoPrincipal('.$filas2['id_imagen'].','.$run.')" value="Principal">
        							</div>
        							</div>
        							';
        					}
        			 echo'</div>';
                  break;

            case '5'://ELIMINAR IMAGEN SOSPECHOSO
            $idFoto=$Sospechoso->limpiarNumeroEntero($_REQUEST['idFoto']);
            $nombreImagen=$Sospechoso->registros("select nombre_imagen from tb_imagen where id_imagen=".$idFoto);//para borrar imagen del servidor

            $run=$_SESSION['sospechosoModificando'];
            $posicionGuion = strpos($run,'-');
            $run = substr($run,0,$posicionGuion);

             $compruebaCantidadImagenes=$Sospechoso->registros("select count(id_imagen) as cantidad from tb_imagensospechoso where run_sospechoso=".$run);
            if($compruebaCantidadImagenes[0]['cantidad']>1){// SI HAY MAS DE UNA IMAGEN BORRA

                  $consultaE= "delete from tb_imagensospechoso where id_imagen=".$idFoto." and run_sospechoso=".$run;
                  if($Sospechoso->insertar($consultaE)){

                      $consultaE2= "delete from tb_imagen where id_imagen=".$idFoto;
                      if($Sospechoso->insertar($consultaE2)){
                        echo "1";//eliminada

                         if($nombreImagen){

                             $file = "../imagenes/".$nombreImagen[0]['nombre_imagen'];
                              $do = unlink($file);
                              // if($do != true){
                              //  echo "There was an error trying to delete the file" . $f->foto . "<br />";
                              //  }
                            }
                      }else{
                        echo "3";//error
                      }
                  }else{
                    echo "3";//error
                  }

            }else{
              echo "2";//el sospechoso debe tener al menos una imagen
            }
            break;

            case '6'://CAMBIAR IMAGEN PRINCIPAL
            $idFoto= $Sospechoso->limpiarNumeroEntero($_REQUEST['idFoto']);

            $run=$_SESSION['sospechosoModificando'];
            $posicionGuion = strpos($run,'-');
            $run = substr($run,0,$posicionGuion);

            $quitaPrincipales= "UPDATE  tb_imagen
                        inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
                        set foto_principal=1
                        where tb_imagensospechoso.run_sospechoso=".$run;

            if($Sospechoso->insertar($quitaPrincipales)){

                  $agregaPrincipal= "update tb_imagen set foto_principal=2 where id_imagen=".$idFoto;

                  if($Sospechoso->insertar($agregaPrincipal)){
                    echo "1";//cambiada
                  }
            }
            break;

            case '7'://identifica sospechosos, aumenta contador veces identificado

            $rut=$Sospechoso->limpiarNumeroEntero($_REQUEST['rut']);
            $Sospechoso->setRun($rut);

            if($Sospechoso->identificarSospechoso()){
              echo "1";//cambiada
            }else{
              echo "2";
            }
              break;


            case '8'://verifica si rut existe

            $rut=$Sospechoso->limpiarNumeroEntero($_REQUEST['rut']);
            $Sospechoso->setRun($rut);

            if($Sospechoso->consultarExisteSospechoso()){
              echo "1";//cambiada
            }else{
              echo "2";
            }
              break;
        }

break;
}


 ?>
