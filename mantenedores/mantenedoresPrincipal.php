<?php
session_start();

if(isset($_SESSION['run'])==false &&
   isset($_SESSION['nombre'])==false &&
   isset($_SESSION['idDepartamento'])==false &&
   isset($_SESSION['descripcionDepartamento'])==false){

          header("location: ./index.php");

}else{

    require("../principal/comun.php");
    conectarBD();
    cargarEncabezado();


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

            if($privilegio['id']==5){//privilegio MANTENEDOR
                $privilegioMantenedor=true;
            }
         }


         if($privilegioMantenedor==false){
            header("location: ../principal/menuPrincipal.php");
         }

     }else{
       echo "0";//usuario no existe
     }
 ?>
		<!-- <div id="contenedorMenuConfiguraciones" class="container">
        	<div class="container btn btn-group">

           <?php// $privilegios= $con->query("call privilegios(".$_SESSION['run'].");");
                //  $resultado="";
                //  while($filas = $privilegios->fetch_array()){
                //
                //     if($filas['id_privilegios']==4){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorUsuarios.php" ><strong>Usuarios</strong></a>';
                //     }
                //     if($filas['id_privilegios']==5){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="" ><strong>Privilegios</strong></a>';
                //     }
                //     if($filas['id_privilegios']==6){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorDelitos.php" ><strong>Delitos</strong></a>';
                //     }
                //    /*  if($filas['id_privilegios']==7){
                //         echo'<a type="a" class="botonesMenuConfiguraciones" value="Listado de solicitantes" onclick="cargarMantenedorSolicitantes()">';
                //     } */
           		// 	    if($filas['id_privilegios']==8){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="" ><strong>Zonas</strong></a>';
                //     }
                //     if($filas['id_privilegios']==9){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorPoblacion.php" ><strong>Poblaciones</strong></a>';
                //     }
                //     if($filas['id_privilegios']==10){
                //         echo'<a class="btn btn-default col-xs-6 col-sm-6 col-md-2 botonesMenuConfiguraciones" href="mantenedorEquipos.php" ><strong>Equipos</strong></a>';
                //     }
                //
                // }
              ?>
          </div>
    </div> -->

            <?php
              cargarMenuMantenedores();
            ?>

            <div class="container" id="divContenidoConfiguraciones"></div>

            <div class="col-xs-4 col-lg-4 container" id="divContenidoGrupos"></div>
            <div class="col-xs-4 col-lg-4" id="divContenidoGruposPrivilegio"></div>

            <div class="col-xs-4 col-lg-4" id="divPrivilegios"></div>
            <div id="divCargando"></div>

<?php
	cargarFooter();

}
 ?>
