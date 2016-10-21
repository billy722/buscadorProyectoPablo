<?php
	include("../../../comun.php");
    conectarBD();

    $idGrupo=$_REQUEST['idg'];
    $resultado=$con->query("select * from tb_poblacion");

?>
	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table class="tablaMantenedorGrupo">
             <thead>
							 							 	<h1><label class="text-default" for=""><strong>Poblaciones.</strong></label></h1>
            				<tr class="cabeceraTabla">
                                     <th>Codigo</th>
                                     <th>Poblacion</th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
              <?php

                while($filas= $resultado->fetch_array()){
                  echo'<tr>';
                     echo'<td><input class="form-control" type="text" readonly   value="'.$filas['id_poblacion'].'"></td>';

                     echo'<td><input class="form-control" readonly type="text" value="'.$filas['descripcion_poblacion'].'"></td>';

                     echo'<td><input type="button" class="btn btn-success" onclick="agregarPoblacion('.$idGrupo.','.$filas['id_poblacion'].')" value="Añadir a Zona" ></td>';
                  echo'</tr>';
                }
              ?>

             </tbody>
	       </table>
 </form>
