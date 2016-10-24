<?php

switch($_REQUEST['mant']){//SELECCIONAR MANTENEDOR

    case '1'://MANTENEDOR USUARIOS
            require_once '../clases/Usuario.php';
            $Usuario= new Usuario();

            switch($_REQUEST['func']){//SELECCIONAR ACCION

                case '1'://Ingresar-Modificar usuario
                        $campoRut=$_REQUEST['txt_runCrear'];
                        $posicionGuion= strpos($campoRut,"-");
                        $rut= substr($campoRut,0,$posicionGuion);
                        $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                        $Usuario->setRun($rut);
                        $Usuario->setDV($dv);
                        $Usuario->setNombre($_REQUEST['txt_nombreCrear']);
                        $Usuario->setApellidoPaterno($_REQUEST['txt_apellidoPaternoCrear']);
                        $Usuario->setApellidoMaterno($_REQUEST['txt_apellidoMaternoCrear']);
                        $Usuario->setClave($_REQUEST['txt_clave1Crear']);
                        $Usuario->setTelefono($_REQUEST['txt_telefonoCrear']);
                        $Usuario->setCorreo($_REQUEST['txt_correoCrear']);
                        $Usuario->setGrupoUsuario($_REQUEST['select_tipoUsuarioCrear']);
                        $Usuario->setEstado("1");
                        $Usuario->insertarModificarUsuario();

                        break;

                case '2'://Eliminar USUARIOS


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
                                          $retorno= $Usuario->BuscarFiltarRegistros("vistausuarios","nombre",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg']);
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
                                                                     echo'<td><span id="txt_descripcionGrupoUsuario'.$contadorFilas.'">'.$filas['descripcion_grupoUsuario'].'</span></td>';
                                                                     echo'<td><span id="txt_descripcionEstadoUsuario'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span></td>';
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
                                          $retorno= $Delito->BuscarFiltarRegistros("tb_delito","descripcion_delito",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg']);
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<tr><td><span id="txt_idDelito'.$contadorFilas.'">'.$filas['id_delito'].'</span></td>';
                                                echo'<td><span id="txt_descripcionDelito'.$contadorFilas.'">'.$filas['descripcion_delito'].'</span></td>';
                                                echo'<td><span id="txt_estadoDelito'.$contadorFilas.'">'.$filas['estado'].'</span></td>';
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
                                          $retorno= $Poblacion->BuscarFiltarRegistros("tb_poblacion","descripcion_poblacion",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg']);
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<td><span id="txt_idPoblacion'.$contadorFilas.'">'.$filas['id_poblacion'].'</span></td>';
                                                echo'<td><span id="txt_descripcionPoblacion'.$contadorFilas.'">'.$filas['descripcion_poblacion'].'</span></td>';
                                                echo'<td><span id="txt_estadoPoblacion'.$contadorFilas.'">'.$filas['estado'].'</span></td>';
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
                $Equipo->setDescripcionEquipo($_REQUEST['txt_descripcionEquipoCrear']);
                $Equipo->setEstadoEquipo("1");
                $Equipo->ingresarEquipo();
              break;
              case '2'://Modificar equipo
                $Equipo->setIdEquipo($_REQUEST['txt_idEquipoModificar']);
                $Equipo->setDescripcionEquipo($_REQUEST['txt_descripcionEquipoModificar']);
                $Equipo->setEstadoEquipo($_REQUEST['cmb_estadoEquipoModificar']);
                if($Equipo->actualizarEquipo()){
                  echo "2";

                }
              break;
              case '3'://Eliminar equipo
                      $Equipo->setIdEquipo($_REQUEST['id']);
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
                                          $retorno= $Equipo->BuscarFiltarRegistros("tb_equipofutbol","descripcion_equipo",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg']);
                                          $listado=$retorno[0][0];


                                           $contadorFilas=0;
                                           foreach($listado as $filas){
                                               $contadorFilas++;
                                                echo'<td><span id="txt_idEquipo'.$contadorFilas.'">'.$filas['id_equipo'].'</span></td>';
                                                echo'<td><span id="txt_descripcionEquipo'.$contadorFilas.'">'.$filas['descripcion_equipo'].'</span></td>';
                                                echo'<td><span id="txt_estadoEquipo'.$contadorFilas.'">'.$filas['estado'].'</span></td>';
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
                     $retorno = $Grupo->BuscarFiltarRegistros("tb_grupousuario","descripcion_grupoUsuario",$_REQUEST['buscar'],$_REQUEST['pag'],$_REQUEST['cantidadReg']);

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
                                    foreach($privilegiosACtuales as $priActual){
                                            if($priActual['id']==$columnasC['id_privilegios']){
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
}


 ?>
