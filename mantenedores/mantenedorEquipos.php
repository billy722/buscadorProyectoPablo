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
	<div class="row ">
            <h1 class="col-xs-4 text text-primary">Equipos de futbol</h1>

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
        data:"mant=4&func=4&buscar="+busqueda+"&pag="+pagina+"&cantidadReg="+$("#cmb_cantidadRegistros").val(),
        success:function(respuesta){
              $("#contenedorMantenedor").html(respuesta);
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
              <h4 class="modal-title">Crear Equipos de futbol</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioCreacion" id="formularioCreacion" action="">

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                            <label class="control-label col-lg-2" for="txt_descripcionEquipoCrear">Descripcion</label>
                            <div class="col-lg-5">
                              <input required title="Complete este campo" placeholder="Descripcion Equipo" class="form-control" id="txt_descripcionEquipoCrear" name="txt_descripcionEquipoCrear" type="text" >

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
              function mostrarModalModificar(fila){//carga los datos de la fila a editar, en el modal

              $("#txt_idEquipoModificar").val($("#txt_idEquipo"+fila).html());
              $("#txt_descripcionEquipoModificar").val($("#txt_descripcionEquipo"+fila).html());
              $("#cmb_estadoEquipoModificar").val($("#txt_idEstado"+fila).val());

            }
      </script>

      <!--Modal modificar-->
      <div class="modal fade" id="ventanaModalModificar" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modificar Equipo de futbol</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioModificacion" id="formularioModificacion" action="">

                    <!--campos ocultos para guardar -->
                    <input type="hidden" id="txt_idEquipoModificar" name="txt_idEquipoModificar" >

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                            <label class="control-label col-lg-2" for="txt_descripcionEquipoModificar">Descripcion</label>
                            <div class="col-lg-5">
                              <input required title="Complete este campo" placeholder="Descripcion Equipo" class="form-control" id="txt_descripcionEquipoModificar" name="txt_descripcionEquipoModificar" type="text" >
                            </div>
                      </div>
                     <!-- CAMPO 6 DEL MODAL  -->
                <div class="form-group">
                      <label class="control-label col-lg-2" for="cmb_estadoEquipoModificar">Estado</label>
                      <div class="col-lg-5">
                          <select class="form-control" name="cmb_estadoEquipoModificar" id="cmb_estadoEquipoModificar">
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
           $("#formularioCreacion").submit(function(){//ENVIA FORMULARIO DE CREACION DE REGISTRO
              event.preventDefault();
              swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
                        $.ajax({
                        url:"./controladorMantenedores.php?mant=4&func=1",
                        data: $("#formularioCreacion").serialize(),
                        success:function(resultado){
                          //alert("INGRESADO CORRECTAMENTE");
                          swal("Operacion exitosa!", "Agregado Correctamente", "success");
                          cambiarPagina(1);
                        }

                    });
            });

            $("#formularioModificacion").submit(function(){//ENVIA FORMULARIO DE MODIFICACION DE REGISTRO
              event.preventDefault();
              swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
                        $.ajax({
                        url:"./controladorMantenedores.php?mant=4&func=2",
                        data: $("#formularioModificacion").serialize(),
                        success:function(resultado){
                              if(resultado=="2"){
                                      //alert("MODIFICADO CORRECTAMENTE");
                                      swal("Operacion exitosa!", "Modificado Correctamente", "success");
                                      cambiarPagina(1);
                              }else{
                                  alert(resultado);
                                  $("#error").html(resultado);
                              }
                        }
                    });
            });

          function eliminar(id){
            event.preventDefault();
            swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
                 $.ajax({
                  url:"controladorMantenedores.php",
                  data:"mant=4&func=3&id="+id,
                  success:function(respuesta){
                          if(respuesta=="2"){
                          //alert("ELIMINADO CORRECTAMENTE");
                          swal("Operacion exitosa!", "Eliminado Correctamente", "success");
                              cambiarPagina(1);
                          }else{
                              alert("error al eliminar: "+respuesta);
                          }
                  }
                });
            }

</script>
<?php
cargarFooter();
}
?>
