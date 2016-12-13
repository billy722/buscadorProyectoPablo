<?php
require_once '../clases/Usuario.php';
$UsuarioValidar= new Usuario();
$UsuarioValidar->verificarSesion();

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
<?php

$privilegioVer=false;
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

        if($privilegio['id']==2){//privilegio ver sospechosos
            $privilegioVer=true;
        }
        if($privilegio['id']==3){//privilegio modificar sospechosos
            $privilegioIngresar=true;
        }
     }


     if($privilegioVer==true){
           if($privilegioIngresar==true){
                 echo '<a href="./formularioIngresoSospechosos.php" class=" btn btn-success col-xs-1 pull-right">Nuevo</a>';
           }
     }else{
        header("location: ../principal/menuPrincipal.php");
     }

 }else{
   echo "0";//usuario no existe
 }

 ?>



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

                    if(respuesta==0){
                      //sweetAlert("Acceso Denegado", "No tiene los privilegios necesarios", "error");
                      window.location="../principal/menuPrincipal.php";
                    }else{
                      $("#contenedorMantenedor").html(respuesta);
                    }
                  }
                });

            }
            cambiarPagina(1); //FIN SCRIPT PARA CARGAR TABLA Y PAGINADA
          </script>
