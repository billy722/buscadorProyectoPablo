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

                case '2'://Modificar Usuario
                $campoRut=$_REQUEST['txt_runModificar'];
                $posicionGuion= strpos($campoRut,"-");
                $rut= substr($campoRut,0,$posicionGuion);
                $dv= substr($campoRut,$posicionGuion+1,$posicionGuion+1);
                $Usuario->setRun($rut);
                $Usuario->setDV($dv);
                $Usuario->setNombre($_REQUEST['txt_nombreModificar']);
                $Usuario->setApellidoPaterno($_REQUEST['txt_apellidoPaternoModificar']);
                $Usuario->setApellidoMaterno($_REQUEST['txt_apellidoMaternoModificar']);
                $Usuario->setClave($_REQUEST['txt_clave1Modificar']);
                $Usuario->setTelefono($_REQUEST['txt_telefonoModificar']);
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
                                                                     echo'<td><span id="txt_descripcionGrupoUsuario'.$contadorFilas.'">'.$filas['descripcion_grupoUsuario'].'</span>
                                                                     <input type="hidden" id="txt_idGrupoUsuario'.$contadorFilas.'" value="'.$filas['id_grupoUsuario'].'" ></td>';
                                                                     echo'<td><span id="txt_descripcionEstadoUsuario'.$contadorFilas.'">'.$filas['descripcion_estado'].'</span>
                                                                     <input type="hidden" class="form-control" id="txt_idEstadoUsuario'.$contadorFilas.'" value="'.$filas['id_estado'].'" ></td>';
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
                          case '5'://emininar

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
}


 ?>
