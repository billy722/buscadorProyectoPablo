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
            <h1 class="col-xs-4 text text-primary">Lista de Usuarios</h1>

    </div>
    <div class="container col-xs-12">
           <div class="row">

                <div class="col-xs-4">
                  <div class="input-group">
                    <span class="input-group-addon "></span>
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
        data:"mant=1&func=3&buscar="+busqueda+"&pag="+pagina+"&cantidadReg="+$("#cmb_cantidadRegistros").val(),
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
              <h4 class="modal-title">Ingresar Nuevos Usuarios</h4>
            </div>
            <div id="modbody" class="modal-body">

              <form class="form-horizontal" name="formularioCreacion" id="formularioCreacion" action="">

                    <!-- CAMPO 1 DEL MODAL-->
                      <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_runCrear">Run</label>
                  <div class="col-lg-3">
                    <input  required minlenght="12" title="Complete este campo" placeholder="Ej.12123456-7" class="form-control" id="txt_runCrear" name="txt_runCrear" type="text" >
                  </div>
            </div>

            <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_nombreCrear">Nombres</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Nombre" id="txt_nombreCrear" name="txt_nombreCrear" type="text" class="form-control">
                  </div>
            </div>

            <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_apellidoPaternoCrear">Apellido Paterno</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Apellido Paterno" id="txt_apellidoPaternoCrear" name="txt_apellidoPaternoCrear" type="text" class="form-control">
                  </div>
            </div>

			<div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_apellidoMaternoCrear">Apellido Materno</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Apellido Materno" id="txt_apellidoMaternoCrear" name="txt_apellidoMaternoCrear" type="text" class="form-control">
                  </div>
            </div>

            <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_correoCrear">Correo</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Correo" id="txt_correoCrear" name="txt_correoCrear" type="text" class="form-control">
                  </div>
            </div>

            <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_telefonoCrear">Telefono</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" required maxlenght="9" placeholder="Telefono" id="txt_telefonoCrear" name="txt_telefonoCrear" type="number" class="form-control">
                  </div>
            </div>

            <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="select_tipoUsuarioCrear">Tipo Usuario</label>
                  <div class="col-lg-3">
                    <select id="select_tipoUsuarioCrear" class="form-control" name="select_tipoUsuarioCrear">
                        <?php
                         require '../clases/Grupos.php';
                         $TipoUsuario= new Grupos();
                         $filas= $TipoUsuario->listarGrupos();

                         foreach ($filas as $columna) {
                          echo"<option value=".$columna['id_grupoUsuario'].">".$columna['descripcion_grupoUsuario']."</option>";
                         }
                        ?>
                    </select>
                  </div>
            </div>

            <div id="divClave1" class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_clave1Crear">Contraseña</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Contraseña" id="txt_clave1Crear" name="txt_clave1Crear" type="password" class="form-control">
                  </div>
            </div>

              <div id="divClave2" class="form-group">
                  <label class="sr-only control-label col-lg-2" for="txt_clave2Crear">Repita Contraseña</label>
                  <div class="col-lg-3">
                    <input required title="Complete este campo" placeholder="Confirme Contraseña" id="txt_clave2Crear" name="txt_clave2Crear" type="password" class="form-control">
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
			 function mostrarModalModificar(fila){

			 		$("#txt_runModificar").val($("#txt_run"+fila).html());
			 		$("#txt_nombreModificar").val($("#txt_nombre"+fila).html());
					$("#txt_apellidoPaternoModificar").val($("#txt_apellidoPaterno"+fila).html());
					$("#txt_apellidoMaternoModificar").val($("#txt_apellidoMaterno"+fila).html());
					$("#txt_correoModificar").val($("#txt_correo"+fila).html());
					$("#txt_telefonoModificar").val($("#txt_telefono"+fila).html());
          $("#select_tipoUsuarioModificar").val($("#txt_idGrupoUsuario"+fila).val());
          $("#select_estadoUsuarioModificar").val($("#txt_idEstadoUsuario"+fila).val());

		 	}

		</script>

	<!-- Modal Modificar-->
	<div class="modal fade" id="ventanaModalModificar" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modificar Usuario</h4>
				</div>
				<div id="modbody" class="modal-body">

					<form class="form-horizontal" name="formularioModificacion" id="formularioModificacion" action="">

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_runModificar">Run</label>
									<div class="col-lg-3">
										<input  required minlenght="12" readonly title="Complete este campo" placeholder="Run" class="form-control" id="txt_runModificar" name="txt_runModificar" type="text" >
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_nombreModificar">Nombre</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Nombre" id="txt_nombreModificar" name="txt_nombreModificar" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_apellidoPaternoModificar">Apellido Paterno</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Apellido Paterno" id="txt_apellidoPaternoModificar" name="txt_apellidoPaternoModificar" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_apellidoMaternoModificar">Apellido Materno</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Apellido Materno" id="txt_apellidoMaternoModificar" name="txt_apellidoMaternoModificar" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_correoModificar">Correo</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Correo" id="txt_correoModificar" name="txt_correoModificar" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_telefonoModificar">Telefono</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Telefono" id="txt_telefonoModificar" name="txt_telefonoModificar" type="text" class="form-control">
									</div>
						</div>

            <div class="form-group">
                              <label class="sr-only control-label col-lg-2" for="select_tipoUsuarioModificar">Tipo Usuario</label>
                              <div class="col-lg-3">
                                  <select class="form-control" name="select_tipoUsuarioModificar" id="select_tipoUsuarioModificar">
                                      <?php
                                          require_once '../clases/Grupos.php';
                                          $Tipo= new Grupos();
                                          $listaTipo= $Tipo->listarGrupos();

                                          foreach($listaTipo as $columnaEstado) {
                                              echo'<option value="'.$columnaEstado['id_grupoUsuario'].'">'.$columnaEstado['descripcion_grupoUsuario'].'</option>';
                                          }

                                       ?>
                                  </select>
                      </div>
              </div>
              <div class="form-group">
                  <label class="sr-only control-label col-lg-2" for="select_estadoUsuarioModificar">Estado Usuario</label>
                  <div class="col-lg-3">
                      <select class="form-control" name="select_estadoUsuarioModificar" id="select_estadoUsuarioModificar">
                          <?php
                              require_once '../clases/Estado.php';
                              $Estado= new Estado();
                              $listaEstado= $Estado->listarEstado();

                              foreach($listaEstado as $columnaEstado) {
                                  echo'<option value="'.$columnaEstado['id_estado'].'">'.$columnaEstado['descripcion_estado'].'</option>';
                              }

                           ?>
                      </select>
                  </div>
            </div>
						<div id="divClave1" class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_clave1Modificar">Contraseña</label>
									<div class="col-lg-3">
										<input title="Complete este campo" placeholder="Contraseña" id="txt_clave1Modificar" name="txt_clave1Modificar" type="password" class="form-control">
									</div>
						</div>

							<div id="divClave2" class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_clave2Modificar">Repita Contraseña</label>
									<div class="col-lg-3">
										<input title="Complete este campo" placeholder="Confirme Contraseña" id="txt_clave2Modificar" name="txt_clave2Modificar" type="password" class="form-control">
									</div>
							</div>

							<div  class="form-group">
								<div class="col-lg-4 col-lg-offset-2">
										<div id="mensaje" class=""></div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-4 col-lg-offset-1">
									<input required type="submit" data-toggle="modal" data-target="#ventanaModalModificar" class="btn btn-success pull-right" value="Guardar">
								</div>
							</div>
						</form>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

  <script type="text/javascript">

  $("#formularioCreacion").submit(function(){
      event.preventDefault();

        var clave1= $("#txt_clave1Crear").val();
        var clave2= $("#txt_clave2Crear").val();
swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
        if(clave1==clave2){
            $.ajax({
                url:"./controladorMantenedores.php?mant=1&func=1",
                data: $("#formularioCreacion").serialize(),
                success:function(resultado){
                  if(resultado=="1"){
                          swal("Operacion exitosa!", "Agregado Correctamente", "success");
                          cambiarPagina(1);
                        }else{
                          //alert(resultado);
                          sweetAlert("Ocurrió un error", "No se pudo concretar la operacion", "error");
                        }}
            });
          }else{
            //alert("claves no coinciden");
          sweetAlert("Ocurrió un error", "No se pudo concretar la operacion, claves no coinciden!", "error");
          }
    });
    $("#formularioModificacion").submit(function(){//ENVIA FORMULARIO DE MODIFICACION DE REGISTRO
      event.preventDefault();
      swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
            $.ajax({
                url:"./controladorMantenedores.php?mant=1&func=2",
                data: $("#formularioModificacion").serialize(),
                success:function(resultado){
                      if(resultado=="1"){
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

    function eliminar(run){
      event.preventDefault();
      swal({title:"Cargando", text:"Espere un momento.", showConfirmButton:true,allowOutsideClick:false,showCancelButton: false,closeOnConfirm: false});
           $.ajax({
            url:"./controladorMantenedores.php",
            data:"mant=1&func=5&run="+run,
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
