<?php
// defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
// defined("SITE_ROOT") ? null : define("SITE_ROOT", "D:".DS."XAMPP".DS."htdocs".DS."buscador");

switch($_REQUEST['mant']){//SELECCIONAR MANTENEDOR

    case '1'://MANTENEDOR USUARIOS
            require_once '../clases/Usuario.php';
            $Usuario= new Usuario();

            switch($_REQUEST['func']){//SELECCIONAR ACCION

                case '1'://Ingresar-Modificar usuario
                      $campoRut=$_REQUEST['txt_runCrear'];
                      $nombre= $_REQUEST['txt_nombreCrear'];
                      $apellidoPaterno= $_REQUEST['txt_apellidoPaternoCrear'];
                      $apellidoMaterno= $_REQUEST['txt_apellidoMaternoCrear'];
                      $clave= $_REQUEST['txt_clave1Crear'];
                      $telefono= $_REQUEST['txt_telefonoCrear'];
                      $correo= $_REQUEST['txt_correoCrear'];
                      $tipoUsuario= $_REQUEST['select_tipoUsuarioCrear'];

                      if($campoRut=="" || $nombre="" || $apellidoPaterno=="" || $clave=="" || $tipoUsuario==""){
                            echo "2";//HAY CAMPOS VACIOS

                      }else{
                            $posicionGuion= strpos($campoRut,"-");
                            $rut= substr($campoRut,0,$posicionGuion);
                            $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                            $Usuario->setRun($rut);

                           if($Usuario->comprobarExisteRun($rut)){
                                echo "3"; //RUT QUE INTENTA INGRESAR YA EXISTE
                           }else{
                             $password = crypt($clave);
                               $Usuario->setDV($dv);
                               $Usuario->setNombre($Usuario->limpiarTexto($nombre));
                               $Usuario->setApellidoPaterno($Usuario->limpiarTexto($apellidoPaterno));
                               $Usuario->setApellidoMaterno($Usuario->limpiarTexto($apellidoMaterno));
                               $Usuario->setClave($password);
                               $Usuario->setTelefono($Usuario->limpiarTexto($telefono));
                               $Usuario->setCorreo($Usuario->limpiarCorreo($correo));
                               $Usuario->setGrupoUsuario($Usuario->limpiarNumeroEntero($tipoUsuario));
                               $Usuario->setEstado("1");
                               $Usuario->insertarModificarUsuario();
                           }
                      }

                        break;

                case '2'://Modificar Usuario
                $campoRut=$_REQUEST['txt_runModificar'];
                $posicionGuion= strpos($campoRut,"-");
                $rut= substr($campoRut,0,$posicionGuion);
                $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                $clave = $_REQUEST['txt_clave1Modificar'];
                $password = crypt($clave);
                $Usuario->setRun($rut);
                $Usuario->setDV($dv);
                $Usuario->setNombre($Usuario->limpiarTexto($_REQUEST['txt_nombreModificar']));
                $Usuario->setApellidoPaterno($Usuario->limpiarTexto($_REQUEST['txt_apellidoPaternoModificar']));
                $Usuario->setApellidoMaterno($Usuario->limpiarTexto($_REQUEST['txt_apellidoMaternoModificar']));
                $Usuario->setClave($password);
                $Usuario->setTelefono($Usuario->limpiarTexto($_REQUEST['txt_telefonoModificar']));
                $Usuario->setCorreo($_REQUEST['txt_correoModificar']);
                $Usuario->setGrupoUsuario($_REQUEST['select_tipoUsuarioModificar']);
                $Usuario->setEstado($_REQUEST['select_estadoUsuarioModificar']);
                $Usuario->insertarModificarUsuario();

                        break;
                case '3'://Listar USUARIOS
                        ?>
                        <table class="table">
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
                                          $retorno= $Usuario->BuscarFiltarRegistros("vistausuarios","nombre apellidoPaterno apellidoMaterno telefono correo",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
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
                        $Usuario->setRun($rut);

                        $verificarExito= $Usuario->eliminarUsuario();

                        if($verificarExito==true){
                              echo "2";
                        }
                            break;
            }

            break;
    case '2'://Mant delito
            require_once '../clases/Delito.php';
            $Delito=new Delito();

            switch($_REQUEST['func']){
              case '1': //Ingresar nuevo delito
                $Delito->setDescripcionDelito($_REQUEST['txt_descripcionDelitoCrear']);
                $Delito->setEstadoDelito("1");
                $Delito->ingresarDelito();
              break;
              case '2'://Modificar delito
                $Delito->setIdDelito($_REQUEST['txt_idDelitoModificar']);
                $Delito->setDescripcionDelito($_REQUEST['txt_descripcionDelitoModificar']);
                $Delito->setEstadoDelito($_REQUEST['cmb_estadoDelitoModificar']);
                if($Delito->actualizarDelito()){
                  echo "2";
                }
              break;
              case '3'://Eliminar delito
                      $Delito->setIdDelito($_REQUEST['id']);
                      $Delito->setEstadoDelito("3");
                      $verificarExito= $Delito->eliminarDelito();

                      if($verificarExito==true){
                            echo "2";
                      }
              break;
              case '4'://listar tabla
              ?>
               <table class="table">
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
                                          $retorno= $Delito->BuscarFiltarRegistros("vistadelitos","descripcion_delito",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<tr><td><span id="txt_idDelito'.$contadorFilas.'">'.$filas['id_delito'].'</span></td>';
                                                echo'<td><span id="txt_descripcionDelito'.$contadorFilas.'">'.$filas['descripcion_delito'].'</span></td>';
                                                echo'<td><span id="txt_estadoDelito'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                <input type="hidden" id="txt_idEstado'.$contadorFilas.'" value="'.$filas['estado'].'"></td>';
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
                                 <?php
              break;

            }
            break;
case '3'://Mant Poblacion
            require_once '../clases/Poblacion.php';
            $Poblacion=new Poblacion();

            switch($_REQUEST['func']){
              case '1': //Ingresar nueva poblacion
                $Poblacion->setDescripcionPoblacion($_REQUEST['txt_descripcionPoblacionCrear']);
                $Poblacion->setEstadoPoblacion("1");
                $Poblacion->ingresarPoblacion();
              break;
              case '2'://Modificar Poblacion
                $Poblacion->setIdPoblacion($_REQUEST['txt_idPoblacionModificar']);
                $Poblacion->setDescripcionPoblacion($_REQUEST['txt_descripcionPoblacionModificar']);
                $Poblacion->setEstadoPoblacion($_REQUEST['cmb_estadoPoblacionModificar']);
                if($Poblacion->actualizarPoblacion()){
                  echo "2";

                }
              break;
              case '3'://Eliminar Poblacion
                      $Poblacion->setIdPoblacion($_REQUEST['id']);
                      $Poblacion->setEstadoPoblacion("3");
                      $verificarExito= $Poblacion->eliminarPoblacion();

                      if($verificarExito==true){
                            echo "2";
                      }
              break;
              case '4'://listar tabla
              ?>
               <table class="table">
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
                                          $retorno= $Poblacion->BuscarFiltarRegistros("vistapoblaciones","descripcion_poblacion",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
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
                                 <?php
              break;

            }
            break;
  case '4'://Mant Equipos
            require_once '../clases/Equipo.php';
            $Equipo=new Equipo();

            switch($_REQUEST['func']){
              case '1': //Ingresar nuevo equipo
                $Equipo->setDescripcionEquipo($Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoCrear']));
                $Equipo->setEstadoEquipo("1");
                $Equipo->ingresarEquipo();
              break;
              case '2'://Modificar equipo
                $Equipo->setIdEquipo($Equipo->limpiarNumeroEntero($_REQUEST['txt_idEquipoModificar']));
                $Equipo->setDescripcionEquipo($Equipo->limpiarTexto($_REQUEST['txt_descripcionEquipoModificar']));
                $Equipo->setEstadoEquipo($Equipo->limpiarNumeroEntero($_REQUEST['cmb_estadoEquipoModificar']));
                if($Equipo->actualizarEquipo()){
                  echo "2";

                }
              break;
              case '3'://Eliminar equipo
                      $Equipo->setIdEquipo($Equipo->limpiarNumeroEntero($_REQUEST['id']));
                      $Equipo->setEstadoEquipo("3");
                      $verificarExito= $Equipo->eliminarEquipo();

                      if($verificarExito==true){
                            echo "2";
                      }
              break;
              case '4'://listar tabla
              ?>
               <table class="table">
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
                                          $retorno= $Equipo->BuscarFiltarRegistros("vistaequipos","descripcion_equipo",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg'],"");
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
                                 <?php
              break;

            }
            break;

case "5"://MANTENEDOR GRUPOS DE USUARIOS

require_once '../clases/Grupos.php';
$Grupo = new Grupos();

      switch($_REQUEST['func']){

            case '1': //mantenedor Ingresar GRUPO

            if($_REQUEST['txt_descripcionCrear']==""){
                  echo "4";//hay campos vacios

            }else{//los campos no estan vacios

                        //limpia variables de comillas
                        $nombreGrupo=$Grupo->limpiarTexto($_REQUEST['txt_descripcionCrear']);

                            $Grupo->setGrupo($nombreGrupo);

                            if($Grupo->comprobarNombre()==false){//comprueba nombre de usuario

                                    $idGrupoIngresado= $Grupo->insertarGrupo();
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
                                    echo "2";//CORRECTO

                            }else{
                                echo "3";//EL NOMBRE INGRESADO YA EXISTE
                            }

            }
            break;
            case '2': //Mantenedor modificar - GRUPO
                    //echo "id recibido: ".$_REQUEST['txt_idGrupo'];

                  if($_REQUEST['txt_idGrupo']=="" or $_REQUEST['txt_nombreGrupo']==""){
                        echo "4";//hay campos vacios

                  }else{//los campos no estan vacios

                          //limpia variables de comillas y asigna
                          $idGrupo=$Grupo->limpiarNumeroEntero($_REQUEST['txt_idGrupo']);
                          $nombreGrupo=$Grupo->limpiarTexto($_REQUEST['txt_nombreGrupo']);

                          $Grupo->setIdGrupo($idGrupo);
                          $Grupo->setGrupo($nombreGrupo);

                          if($Grupo->comprobarNombre()==false){//comprueba nombre de usuario

                              $Grupo->actualizar();
                              $Grupo->eliminarPrivilegiosDeGrupo();

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
                              echo "2";//todo correcto
                          }
                          else{
                            echo "3";//nombre ya existe
                          }
                      }

                break;
            case '3'://Listar registro en la tabla con paginador - GRUPO
             echo'<table class="table">
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
                    </table>';

            break;

            case '4'://mostrar info para actualizar editar - GRUPO
                 $Grupo->setIdGrupo($_REQUEST['id']);
                 $Grupo->eliminarGrupo();
            break;

            case '5'://carga informacion del formulario modificar

               $Grupo->setIdGrupo($_REQUEST['id']);
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

            break;
      }
break;


case "6"://MANTENEDOR ZONAS

require_once '../clases/Zonas.php';
$Zonas = new Zonas();

      switch($_REQUEST['func']){

            case '1': //mantenedor Ingresar ZONA

            if($_REQUEST['txt_descripcionCrear']==""){
                  echo "4";//hay campos vacios

            }else{//los campos no estan vacios

                        //limpia variables de comillas
                        $nombreZona=$Zonas->limpiarTexto($_REQUEST['txt_descripcionCrear']);

                            $Zonas->setZona($nombreZona);

                            if($Zonas->comprobarNombre()==false){//comprueba nombre de usuario

                                    $idZonaIngresada= $Zonas->insertarZona();
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
                                    echo "2";//CORRECTO

                            }else{
                                echo "3";//EL NOMBRE INGRESADO YA EXISTE
                            }

            }
            break;
            case '2': //Mantenedor modificar - ZONA
                    //echo "id recibido: ".$_REQUEST['txt_idGrupo'];

                  if($_REQUEST['txt_idZonas']=="" or $_REQUEST['txt_nombreZonas']==""){
                        echo "4";//hay campos vacios

                  }else{//los campos no estan vacios

                          //limpia variables de comillas y asigna
                          $idZona=$Zonas->limpiarNumeroEntero($_REQUEST['txt_idZonas']);
                          $nombreZona=$Zonas->limpiarTexto($_REQUEST['txt_nombreZonas']);

                          $Zonas->setIdZona($idZona);
                          $Zonas->setZona($nombreZona);

                          if($Zonas->comprobarNombre()==false){//comprueba nombre de usuario

                              $Zonas->actualizar();
                              $Zonas->eliminarPrivilegiosDeGrupo();

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
                              echo "2";//todo correcto
                          }
                          else{
                            echo "3";//nombre ya existe
                          }
                      }

                break;
            case '3'://Listar registro en la tabla con paginador - ZONA
             echo'<table class="table">
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
                    </table>';

            break;

            case '4'://ELIMINAR ZONA
                 $Zonas->setIdZona($_REQUEST['id']);
                 $Zonas->eliminarZona();
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
break;


case "7": //mantenedor sospechosos


        require_once '../clases/Sospechoso.php';
        $Sospechoso= new Sospechoso();

        switch($_REQUEST['func']){

              case '1': // Ingresar sospechosos

              $run=$_POST['run'];
                $posicionGuion = strpos($run,'-');
                $soloRun = substr($run,0,$posicionGuion);
                $digitoVerificador = substr($run,$posicionGuion+1,strlen($run));

           $nombre=$_POST['nombre'];
           $apellidoP=$_POST['apellidoPaterno'];
           $apellidoM=$_POST['apellidoMaterno'];
           $fechaNacimiento=$_POST['edad'];
           $apodo=$_POST['apodo'];
           $lugarNacimiento=$_POST['lugarNacimiento'];
           $colorPelo=$_REQUEST['colorPelo'];
           $contextura=$_POST['contextura'];
           $estadoCivil=$_POST['estadoCivil'];
           $sexo=$_REQUEST['sexo'];
           $tezPiel=$_REQUEST['tezPiel'];
           $tipoOjos=$_REQUEST['tipoOjos'];
           $tipoPelo=$_REQUEST['tipoPelo'];
           $acne=$_REQUEST['acne'];
           $barba=$_REQUEST['barba'];
           $bigote=$_REQUEST['bigote'];
           $manchas=$_REQUEST['manchas'];
           $lentes=$_REQUEST['lentes'];
           $pecas=$_REQUEST['pecas'];
           $antecedentes=$_REQUEST['antecedentes'];
           $estatura=$_REQUEST['estatura'];

           if($estatura==""){
           	$estatura=0;
           }

           /*INGRESAR NUEVO SOSPECHOSO*/
           $consultaIngreso="INSERT INTO `pdisospechosos`.`tb_sospechoso`
           (`run`,`dv`,`nombres`,`apellido_paterno`,`apellido_materno`,`lugar_deNacimiento`,`id_colorPelo`,`id_contextura`,`id_estadoCivil`,
           `id_sexo`,`id_tezPiel`,`id_tipoOjos`,`id_tipoPelo`,`antecedentes_penales`,`apodos`,`barba`,`lentes`,`pecas`,`acne`,`bigote`,`manchas`,
           `estatura`,`fecha_nacimiento`)
           VALUES('$soloRun','$digitoVerificador','$nombre','$apellidoP','$apellidoM','$lugarNacimiento','$colorPelo','$contextura','$estadoCivil',
           '$sexo','$tezPiel','$tipoOjos','$tipoPelo','$antecedentes','$apodo','$barba','$lentes','$pecas','$acne','$bigote','$manchas','$estatura','$fechaNacimiento');";

           if($Sospechoso->insertar($consultaIngreso)){


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
                     					$delitos= $delitos.$c;
                     				}else{
                     					$delitos= $delitos.";".$c;
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
                     					$equipos= $equipos.$c;
                     				}else{
                     					$equipos= $equipos.";".$c;
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
                     					$poblaciones= $poblaciones.$c;
                     				}else{
                     					$poblaciones= $poblaciones.";".$c;
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
                     					$cicatriz= $cicatriz.$c;
                     				}else{
                     					$cicatriz= $cicatriz.";".$c;
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
                     					$tatuaje= $tatuaje.$c;
                     				}else{
                     					$tatuaje= $tatuaje.";".$c;
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
                     					$piercing= $piercing.$c;
                     				}else{
                     					$piercing= $piercing.";".$c;
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
                     					$tipoFoto=1;
                     			}else{
                     					$tipoFoto=2;
                     			}
                     				$target_path = "../imagenes/";
                     				$target_path = $target_path . basename( $_FILES[$campo]['name']);

                     				str_replace("�","n",$target_path);

                     				if(move_uploaded_file($_FILES[$campo]['tmp_name'], $target_path)) {
                     				   //echo "El archivo ". basename( $_FILES[$campo]['name']). " ha sido subido";

                     				  $consultaFotos="call guardarImagen('".basename( $_FILES[$campo]['name'])."','".$_REQUEST[$fechaFoto]."',".$tipoFoto.",".$soloRun.");";
                     				          //echo $consultaFotos;
                     				          $Sospechoso->insertar($consultaFotos);


                     				} else{
                     				echo "Ha ocurrido un error, trate de nuevo!";
                     				}
                     		}
                        echo "1";
      }

              //
              //
              //                 $img = $_FILES['txt_imagen'];
              //                 $nombreImg = $img['name'];
              //                 $tipoImg = $img['type'];
              //                 $rutaPrevisional = $img['tmp_name'];
              //                 $size = $img['size'];
              //                 $dimensiones = getimagesize($rutaPrevisional);
              //                 $width = $dimensiones[0];
              //                 $height = $dimensiones[1];
              //                 $carpeta = "../imagenes";
              //
              //
              //                 $src = "../imagenes/".$nombreImg;
              //
              //                 if($tipoImg != 'image/jpeg' && $tipoImg != 'image/jpg' && $tipoImg != 'image/png'){
              //                 	echo "El Archivo a subir no es una imagen";
              //                 }else if($size > 1024*1024){
              //                 	echo "Tamaño de imagen muy grande";
              //                 }else if($width > 5000 || $height > 5000){
              //                 	echo "La anchura y altura maxima para la imagen es 5000px";
              //                 }else if($width < 60 || $height < 60){
              //                 	echo "La anchura y altura minima para la imagen es de 60px";
              //                 }else{
              //
              //                 	//consulta
              //                         		//$file_upload_to= SITE_ROOT . DS . $carpeta;
              //                         		if(move_uploaded_file($rutaPrevisional, $carpeta ."/". $nombreImg)){
              //                                 echo "Portada actualizada con exito";
              //                             }else{
              //                                 echo "Error al subir";
              //                             }
              //                 }

                      break;
             case '2': // modificar sospechosos


                     break;
             case '3': // listar sospechosos
             echo'<table class="table table-bordered tablaLista table-striped">
                   <thead>
                       <th>Rut</th>
                       <th>Nombre</th>
                       <th>Apellido Paterno</th>
                       <th>Apellido Materno</th>
                       <th>Lugar Nacimiento</th>
                       <th>Editar</th>
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
                                <td class="text-uppercase">'.$column["lugar_deNacimiento"].'</td>
                                <td><a href="formularioModificacionSospechosos.php?id='.$column['solorrun'].'"><span class="glyphicon glyphicon-pencil"></a></td>
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
                    </table>';

                     break;

          case '4'://MOSTRAR IMAGENES SOSPECHOSO
          $run= $_REQUEST['run'];

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
                          if($filas2['foto_principal']==1){
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
            $idFoto= $_REQUEST['idFoto'];
            $run=$_REQUEST['run'];

            $consultaE= "delete from tb_imagensospechoso where id_imagen=".$idFoto." and run_sospechoso=".$run;
            if($Sospechoso->insertar($consultaE)){
              echo "1";//eliminada
            }
            break;

            case '6'://CAMBIAR IMAGEN PRINCIPAL
            $idFoto= $_REQUEST['idFoto'];
            $run=$_REQUEST['run'];

            $quitaPrincipales= "UPDATE  tb_imagen
                        inner join tb_imagensospechoso on tb_imagen.id_imagen=tb_imagensospechoso.id_imagen
                        set foto_principal=2
                        where tb_imagensospechoso.run_sospechoso=".$run;

            if($Sospechoso->insertar($quitaPrincipales)){
                  $agregaPrincipal= "update tb_imagen set foto_principal=1 where id_imagen=".$idFoto;

                  if($Sospechoso->insertar($agregaPrincipal)){
                    echo "1";//cambiada
                  }
            }
            break;
        }

break;
}


 ?>
