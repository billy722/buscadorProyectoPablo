<?php
session_start();

if(isset($_SESSION['run'])==false &&
   isset($_SESSION['nombre'])==false &&
   isset($_SESSION['idDepartamento'])==false &&
   isset($_SESSION['descripcionDepartamento'])==false){

          header("location: ../index.php");

}else{

    require_once("../principal/comun.php");
    cargarEncabezado();
 ?>
<div class="container">

              <h1 class="col-xs-4 text text-primary">Sospechosos</h1>

              <div class="container col-xs-12">
                     <div class="row">

                          <div class="col-xs-5">
                            <div class="input-group ">
                                <span class="input-group-addon glyphicon glyphicon-search"></span>
                                <input placeholder="Buscar" onKeyUp="cambiarPagina(1)" id="txt_buscar" type="text" class="form-control">
                       		  </div>
              			      </div>

              			      <div class="col-xs-3">

                                  <label class="control-label col-xs-3" for="cmb_cantidadRegistros">Mostrar</label>
                                  <div class="col-xs-6">
                                      <select onChange="cambiarPagina(1)" name="cmb_cantidadRegistros" class="form-control" id="cmb_cantidadRegistros">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="60">60</option>
                                      </select>
                                  </div>
                          </div>

                          <!--BOTON QUE ABRE MODAL DE CREAR NUEVO -->

                              <a href="./formularioIngresoSospechosos.php" class=" btn btn-success col-xs-1 pull-right">Nuevo</a>


           		     </div>

                     <br>
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
                  data:"mant=7&func=3&buscar="+busqueda+"&pag="+pagina+"&cantidadReg="+$("#cmb_cantidadRegistros").val(),
                  success:function(respuesta){
                        $("#contenedorMantenedor").html(respuesta);
                  }
                });

            }
            cambiarPagina(1); //FIN SCRIPT PARA CARGAR TABLA Y PAGINADA
          </script>

<?php } ?>
