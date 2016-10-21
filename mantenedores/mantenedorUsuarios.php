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
 <div class="container col-xs-9" id="contenedorMantenedorUsuario">
	<div class="row ">
            <h1 class="col-xs-4 text text-primary">Lista de Usuarios</h1>
           
    </div>
    <div class="container col-xs-12">
           <div class="row">

                <div class="col-xs-4">
                  <div class="input-group">
                    <span class="input-group-addon "></span>
                    <input placeholder="Buscar" onKeyUp="listarTabla()" id="txt_buscar" type="text" class="form-control">
           		  </div>
    			</div>
			<div class="col-xs-4">

                    <label class="control-label col-xs-3" for="cmb_cantidadRegistros">Mostrar</label>
                    <div class="col-xs-6">
                        <select onChange="listarTabla()" name="cmb_cantidadRegistros" class="form-control" id="cmb_cantidadRegistros">
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
                    <input  onBlur="validarRut();" required minlenght="12" title="Complete este campo" placeholder="Rut" class="form-control" id="txt_runCrear" name="txt_runCrear" type="text" >
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
			 function mostrarModal(fila){

			 		$("#txt_run").val($("#txt_run"+fila).html());
			 		$("#txt_nombre").val($("#txt_nombre"+fila).html());
					$("#txt_apellidoPaterno").val($("#txt_apellidoPaterno"+fila).html());
					$("#txt_apellidoMaterno").val($("#txt_apellidoMaterno"+fila).html());
					$("#txt_correo").val($("#txt_correo"+fila).html());
					$("#txt_telefono").val($("#txt_telefono"+fila).html());
					$("#txt_privilegios").val($("#txt_telefono"+fila).html());
		 	}

		</script>

	<!-- Modal Modificar-->
	<div class="modal fade" id="ventanaModalModificar" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div id="modbody" class="modal-body">

					<form class="form-horizontal" name="formulario" id="formulario" action="">

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_run">Run</label>
									<div class="col-lg-3">
										<input  onBlur="validarRut();" required minlenght="12" title="Complete este campo" placeholder="Rut" class="form-control" id="txt_run" name="txt_run" type="text" >
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_nombre">Nombres</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Nombre" id="txt_nombre" name="txt_nombre" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_apellidoPaterno">Apellido Paterno</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Apellido" id="txt_apellidoPaterno" name="txt_apellidoPaterno" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_apellidoMaterno">Apellido Materno</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Apellido" id="txt_apellidoMaterno" name="txt_apellidoMaterno" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_correo">Correo</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Correo" id="txt_correo" name="txt_correo" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_telefono">Telefono</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Correo" id="txt_telefono" name="txt_telefono" type="text" class="form-control">
									</div>
						</div>

						<div class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_privilegios">Privilegios</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Correo" id="txt_privilegios" name="txt_privilegios" type="text" class="form-control">
									</div>
						</div>


						<div id="divClave" class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_clave_actual">Contraseña</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Contraseña Actual" id="txt_clave_actual" name="txt_clave_actual" type="password" class="form-control">
									</div>
						</div>

						<div id="divClave1" class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_clave1">Contraseña</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Contraseña" id="txt_clave1" name="txt_clave1" type="password" class="form-control">
									</div>
						</div>

							<div id="divClave2" class="form-group">
									<label class="sr-only control-label col-lg-2" for="txt_clave2">Repita Contraseña</label>
									<div class="col-lg-3">
										<input required title="Complete este campo" placeholder="Confirme Contraseña" id="txt_clave2" name="txt_clave2" type="password" class="form-control">
									</div>
							</div>

							<div  class="form-group">
								<div class="col-lg-4 col-lg-offset-2">
										<div id="mensaje" class=""></div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-4 col-lg-offset-1">
									<input required type="submit" onclick="crearUsuario()" class="btn btn-success pull-right" value="Guardar">
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

        if(clave1==clave2){
            $.ajax({
                url:"./controladorMantenedores.php?mant=1&func=1",
                data: $("#formularioCreacion").serialize(),
                success:function(resultado){
                  if(resultado=="1"){
                          alert("INGRESADO CORRECTAMENTE");
                          cambiarPagina(1);
                        }else{
                          alert("error");
                        }}
            });
          }else{
            $("#mensaje").html('<p class="text-danger" >Contraseñas no coinciden</p>');
            $("#divClave2").addClass("has-warning");
            $("#divClave1").addClass("has-warning");
          }
    });
        function validarRut(){
        var rut= $("#txt_runCrear").val();
        //alert(rut);
        $.ajax({
          url:"./controladorMantenedores.php?mant=1&func=4",
          data:"txt_run="+rut,
          success:function(respuesta){
              if(respuesta=="1"){
                  alert("RUT CORRECTO");
              }else if(respuesta=="2"){
                  alert("RUT INCORRECTO");
              }else{
                  alert(respuesta);
              }
          }
        });
    }
  </script>
<?php
cargarFooter();
}
?>
