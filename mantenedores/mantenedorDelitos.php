<?php
require_once '../clases/Usuario.php';
$UsuarioValidar= new Usuario();
$UsuarioValidar->verificarSesion();


    include("../principal/comun.php");
    cargarEncabezado();
    cargarMenuMantenedores();

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


         if($privilegioMantenedor==false){
            header("location: ../mantenedores/mantenedoresPrincipal.php");
         }

     }else{
       echo "0";//usuario no existe
     }
?>

<div class="container">
 <div class="container col-xs-12" id="contenedorMantenedorUsuario">
	<div class="row ">
            <h1 class="col-xs-4 text text-primary">Delitos</h1>

    </div>
    <div class="container col-xs-12">
           <div class="row">

                <div class="col-xs-4">
                  <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-search"></span>
                    <input placeholder="Buscar" onKeyUp="cambiarPagina(1)" id="txt_buscar" type="text" class="form-control">
           		  </div>
    			</div>
			<div class="col-xs-4">

                    <label class="control-label col-xs-3" for="cmb_cantidadRegistros">Mostrar</label>
                    <div class="col-xs-6">
                        <select onChange="cambiarPagina(1)" name="cmb_cantidadRegistros" class="form-control" id="cmb_cantidadRegistros">
                          <option value="5">5</option>
                          <option value="15">15</option>
                          <option value="30">30</option>
                          <option value="60">60</option>
                        </select>
                    </div>
            </div>

                <!--BOTON QUE ABRE MODAL DE CREAR NUEVO -->
                <div class="col-xs-4">
                    <button class="pull-right col-xs-4 btn btn-success" data-toggle="modal" data-target="#ventanaModalCrear">Nuevo</button>
                </div>
 		   </div>
 		   <div class="row">
                <div id="contenedorMantenedor"></div><!-- DIV DONDE SE CARGA LA TABLA-->
           </div>
</div>
</div>
</div>
<script>
var pagina;
//INICIO SCRIPT PARA CARGAR TABLA Y PAGINADA
  function cambiarPagina(arg_pagina){
       pagina= arg_pagina;
       listarTabla();
  }

  function listarTabla(){

      var busqueda= $("#txt_buscar").val();
      if(busqueda==null){
          busqueda="_";
      }

      $.ajax({
        url:"controladorMantenedores.php",
        data:"mant=2&func=4&buscar="+busqueda+"&pag="+pagina+"&cantidadReg="+$("#cmb_cantidadRegistros").val(),
        success:function(respuesta){
          if(respuesta==0){
               swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
               setTimeout(function(){
                     window.location="../principal/menuPrincipal.php";
                  },5000);

         }else{
           $("#contenedorMantenedor").html(respuesta);
         }
        }
      });

  }
  cambiarPagina(1); //FIN SCRIPT PARA CARGAR TABLA Y PAGINADA
</script>
<!--Modal para crear-->
 <div class="modal fade" id="ventanaModalCrear" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Delitos</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioCreacion" id="formularioCreacion" action="">

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                            <label class="control-label col-lg-2" for="txt_descripcionDelitoCrear">Descripcion</label>
                            <div class="col-lg-5">
                              <input required title="Complete este campo" placeholder="Descripcion Delito" class="form-control" id="txt_descripcionDelitoCrear" name="txt_descripcionDelitoCrear" type="text" >

                            </div>
                      </div>
                       <!-- BOTON QUE CIERRA MODAL-->
                  <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-1">
                      <input required type="submit" class="btn btn-success pull-right" value="Guardar">
                    </div>
                  </div>

                </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="botonCerrarModalCrear" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
          </div>
        </div>
      </div>

      <script>
              function mostrarModalModificar(fila){//carga los datos de la fila a editar, en el modal

              $("#txt_idDelitoModificar").val($("#txt_idDelito"+fila).html());
              $("#txt_descripcionDelitoModificar").val($("#txt_descripcionDelito"+fila).html());
              $("#cmb_estadoDelitoModificar").val($("#txt_idEstado"+fila).val());

            }
      </script>

      <!--Modal modificar-->
      <div class="modal fade" id="ventanaModalModificar" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modificar Delito</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioModificacion" id="formularioModificacion" action="">

                    <!--campos ocultos para guardar -->
                    <input type="hidden" id="txt_idDelitoModificar" name="txt_idDelitoModificar" >

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                            <label class="control-label col-lg-2" for="txt_descripcionDelitoModificar">Descripcion</label>
                            <div class="col-lg-5">
                              <input required title="Complete este campo" placeholder="Descripcion Delito" class="form-control" id="txt_descripcionDelitoModificar" name="txt_descripcionDelitoModificar" type="text" >
                            </div>
                      </div>
                     <!-- CAMPO 6 DEL MODAL  -->
                <div class="form-group">
                      <label class="control-label col-lg-2" for="cmb_estadoDelitoModificar">Estado</label>
                      <div class="col-lg-5">
                          <select required class="form-control" name="cmb_estadoDelitoModificar" id="cmb_estadoDelitoModificar">
                              <?php
                                  require_once '../clases/Estado.php';
                                  $Estados= new Estado();
                                  $listaEstados= $Estados->listarEstado();

                                  foreach($listaEstados as $columnaEstado) {
                                      echo'<option value="'.$columnaEstado['id_estado'].'">'.$columnaEstado['descripcion_estado'].'</option>';
                                  }

                               ?>
                          </select>
                      </div>
                </div>
                  <!-- BOTON QUE CIERRA MODAL-->
                  <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-1">
                      <input required type="submit"  class="btn btn-success pull-right" value="Guardar">
                    </div>
                  </div>

                </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="botonCerrarModalModificar" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>




<script>
           $("#formularioCreacion").submit(function(){//ENVIA FORMULARIO DE CREACION DE REGISTRO
              event.preventDefault();
              swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
                    $.ajax({
                        url:"./controladorMantenedores.php?mant=2&func=1",
                        data: $("#formularioCreacion").serialize(),
                        success:function(resultado){
                          //alert(resultado);
                          if(resultado==0){
                               swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
                               setTimeout(function(){
                                     window.location="../principal/menuPrincipal.php";
                                  },5000);

                         }else if(resultado=="1"){
                                  swal("Operacion exitosa!", "Agregado Correctamente", "success");
                                  cambiarPagina(1);
                                  $("#botonCerrarModalCrear").click();
                                  $("#formularioCreacion")[0].reset();
                          }else if(resultado=="2"){
                                  sweetAlert("Ocurrió un error", "Hay campos vacios", "error");
                          }else if(resultado=="4"){
                            $("#txt_descripcionDelitoCrear").focus();
                            sweetAlert("No permitido.", "Este delito ya se encuentra registrado.", "warning");
                          }else{
                            sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                          }

                        }

                    });
            });

            $("#formularioModificacion").submit(function(){//ENVIA FORMULARIO DE MODIFICACION DE REGISTRO
              event.preventDefault();
              swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
                    $.ajax({
                        url:"./controladorMantenedores.php?mant=2&func=2",
                        data: $("#formularioModificacion").serialize(),
                        success:function(resultado){
                          if(resultado==0){
                               swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
                               setTimeout(function(){
                                     window.location="../principal/menuPrincipal.php";
                                  },5000);

                         }else if(resultado=="1"){
                                      //alert("MODIFICADO CORRECTAMENTE");
                                      swal("Operacion exitosa!", "Modificado Correctamente", "success");
                                      cambiarPagina(1);
                                      $("#botonCerrarModalModificar").click();
                              }else if(resultado=="2"){
                                sweetAlert("Ocurrió un error", "Hay campos vacios", "error");

                              }else if(resultado=="3"){
                                sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                              }else if(resultado=="4"){
                                $("#txt_descripcionDelitoModificar").focus();
                                sweetAlert("No permitido.", "Este delito ya se encuentra registrado.", "warning");
                              }else{
                                sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                              }
                        }
                    });
            });

          function eliminar(id){
            event.preventDefault();
            // swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
            //      $.ajax({
            //       url:"controladorMantenedores.php",
            //       data:"mant=2&func=3&id="+id,
            //       success:function(respuesta){
            //         if(respuesta==0){
            //              swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
            //              setTimeout(function(){
            //                    window.location="../principal/menuPrincipal.php";
            //                 },5000);
            //
            //        }else if(respuesta=="1"){
            //               //alert("ELIMINADO CORRECTAMENTE");
            //               swal("Operacion exitosa!", "Eliminado Correctamente", "success");
            //                   cambiarPagina(1);
            //               }else{
            //                   alert("error al eliminar: "+respuesta);
            //               }
            //       }
            //     });
            swal({
              title: "Está seguro?",
              text: "Una vez eliminada no podrá retroceder.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Si, Borrar!",
              cancelButtonText: "No, Detener!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if (isConfirm) {
                        $.ajax({
                          url:"controladorMantenedores.php",
                          data:"mant=2&func=3&id="+id,
                          error:function(error){
                              alert(error);
                          },
                          success:function(resultado){
                            if(resultado==0){
                                   swal("No permitido", "Ya no tiene privilegios para realizar esta accion. La página se cerrará", "error");
                                   setTimeout(function(){
                                         window.location="../principal/menuPrincipal.php";
                                      },5000);

                             }else if(resultado=="1"){
                                swal("Operacion exitosa!", "Eliminado Correctamente", "success");
                                cambiarPagina(1);
                                $("#botonCerrarModalCrear").click();
                              }else if(resultado=="2"){
                                sweetAlert("No permitido.", "No puede ingresar campos vacios.", "warning");

                              }else{
                                sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                              }

                          }
                       });
              } else {
                swal("Cancelado", "No se eliminó el registro :)", "error");
              }
            });
            }

</script>

<?php
cargarFooter();
?>
