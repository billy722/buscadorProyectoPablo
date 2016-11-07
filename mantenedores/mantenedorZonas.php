<?php
session_start();

if(isset($_SESSION['run'])==false &&
   isset($_SESSION['nombre'])==false &&
   isset($_SESSION['idDepartamento'])==false &&
   isset($_SESSION['descripcionDepartamento'])==false){

          header("location: ../index.php");

}else{

    include("../principal/comun.php");
    conectarBD();
    cargarEncabezado();
    cargarMenuMantenedores();
?>
<div class="container">
 <div class="container col-xs-12" id="contenedorMantenedorUsuario">
  <!--INICIO PARTE SUPERIOR MANTENEDOR -->
    <div class="row ">
            <h1 class="col-xs-4 text text-primary">Zonas de la ciudad</h1>

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
                          <option value="3">3</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="60">60</option>
                        </select>
                    </div>
                </div>

                <!--BOTON QUE ABRE MODAL DE CREAR NUEVO -->
                <div class="col-xs-4">
                    <button class="pull-right col-xs-4 btn btn-success" data-toggle="modal" data-target="#ventanaModalCrear">Nuevo</button>
                </div>

          </div>
       <!-- FIN PARTE SUPERIOR MANTENEDOR-->

              <div class="row">
                <div id="contenedorMantenedor"></div><!-- DIV DONDE SE CARGA LA TABLA-->
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
        data:"mant=6&func=3&buscar="+busqueda+"&pag="+pagina+"&cantidadReg="+$("#cmb_cantidadRegistros").val(),
        success:function(respuesta){
              $("#contenedorMantenedor").html(respuesta);
        }
      });

  }
  cambiarPagina(1); //FIN SCRIPT PARA CARGAR TABLA Y PAGINADA
</script>




  <!-- MODAL NUEVO USUARIO NO SE MUESTRA HASTA QUE SE PRESIONA EL BOTON NUEVO-->
      <div class="modal fade" id="ventanaModalCrear" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Zona</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioCreacion" id="formularioCreacion" action="">

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                            <label class=" control-label col-lg-2" for="txt_descripcionCrear">Nombre</label>
                            <div class="col-lg-5">
                              <input type="text"  title="Complete este campo" placeholder="Nombre" id="txt_descripcionCrear" name="txt_descripcionCrear" type="text" class="form-control">
                            </div>
                      </div>
                    <hr>

                      <!-- CAMPO 2 DEL MODAL-->
                      <div class="form-group">
                          <label class="control-label col-lg-2" for="cmb_ciudadCrear">Poblaciones</label>
                          <div class="col-lg-5">
                          <?php
                              require_once '../clases/Poblacion.php';
                              $Poblacion= new Poblacion();
                              $lista= $Poblacion->listarPoblacion();

                              foreach($lista as $columnasC){
                               echo '<div class="row">';
                                  echo'<input type="checkbox" id="chb_poblacionCrear'.$columnasC['id_poblacion'].'" name="chb_poblacionCrear'.$columnasC['id_poblacion'].'">';
                                  echo'<label for="chb_poblacionCrear'.$columnasC['id_poblacion'].'" value="'.$columnasC['id_poblacion'].'">'.$columnasC['descripcion_poblacion'].'</label>';
                               echo '</div>';
                              }

                          ?>
                          </div>
                    </div>

                  <!-- BOTON QUE CIERRA MODAL-->
                  <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-1">
                      <input required type="submit" data-toggle="modal" data-target="#ventanaModalCrear" class="btn btn-success pull-right" value="Guardar">
                    </div>
                  </div>

                </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

        <script>
            function limpiarCamposCrear(){//FUNCION LIMPIA CAMPOS DE MODAL DE CREACION

          	  $("#txt_descripcionCrear").val("");

          	}

           function mostrarModalModificar(id){//carga los datos de la fila a editar, en el modal
          	//	$("#txt_nombreGrupo").val($("#txt_nombreGrupo"+fila).html());
              //alert("entro aqui");
                    $.ajax({
                        url:"controladorMantenedores.php",
                        data:"mant=6&func=5&id="+id,
                        beforeSend:function(){
                                $("#divPrivilegiosGrupo").html("Cargando...");
                        },
                        success:function(resultado){
                                  $("#divPrivilegiosGrupo").html(resultado);
                        }
                    });

          	}
      </script>
  <!-- MODAL MODIFICAR USUARIO NO SE MUESTRA HASTA QUE SE PRESIONA EL BOTON NUEVO-->
      <div class="modal fade" id="ventanaModalModificar" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modificar Zona</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioModificacion" id="formularioModificacion" action="">

                    <div id="divPrivilegiosGrupo"></div><!-- se cargar los privilegios que tiene el grupo-->

                  <!-- BOTON QUE CIERRA MODAL-->
                  <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-1">
                      <input required type="submit" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-success pull-right" value="Guardar">
                    </div>
                  </div>

                </form>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

<script>
           $("#formularioCreacion").submit(function(){
              event.preventDefault();

      //alert cargando
      swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});

                    $.ajax({
                        url:"controladorMantenedores.php?mant=6&func=1",
                        data: $("#formularioCreacion").serialize(),
                        success:function(resultado){
                          $("#error").html(resultado);
                              if(resultado=="2"){
                                      swal("Operacion exitosa!", "Agregado Correctamente", "success");
                                      limpiarCamposCrear();
                                      cambiarPagina(1);
                              }
                              else if(resultado=="3"){
                                sweetAlert("No permitido.", "Otro grupo ya utiliza el nombre que ha ingresado", "warning");
                              }
                              else if(resultado=="4"){
                                sweetAlert("No permitido.", "No puede ingresar campos vacios.", "warning");
                              }
                              else{
                                sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                                 // alert(resultado);
                                 // $("#error").html(resultado);
                              }
                        }
                    });
            });

            $("#formularioModificacion").submit(function(){
              event.preventDefault();

      //alert cargando
    //  swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});

                    $.ajax({
                        url:"controladorMantenedores.php?mant=6&func=2",
                        data: $("#formularioModificacion").serialize(),
                        success:function(resultado){

                            //alert(resultado);
                            $("#error").html(resultado);
                              if(resultado=="2"){
                                      swal("Operacion exitosa!", "Modificado Correctamente", "success");
                                      cambiarPagina(1);
                              }
                              else if(resultado=="3"){
                                sweetAlert("No permitido.", "Otro grupo ya utiliza el nombre que ha ingresado", "warning");
                              }
                              else if(resultado=="4"){
                                sweetAlert("No permitido.", "No puede ingresar campos vacios.", "warning");
                              }
                              else{
                                sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                                 // alert(resultado);
                                 // $("#error").html(resultado);
                              }
                        }
                    });
            });

          function eliminar(id){
            event.preventDefault();
      //alert cargando
      swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});

                 $.ajax({
                  url:"controladorMantenedores.php",
                  data:"mant=6&func=4&id="+id,
                  error:function(error){
                      alert(error);
                  },
                  success:function(respuesta){
                         //$("#error").html(respuesta);
                        swal("Operacion exitosa!", "Eliminado Correctamente", "success");
                        cambiarPagina(1);
                  }
                });
            }

</script>

<div id="error"></div>
</body>

</html>

<?php

}
?>
