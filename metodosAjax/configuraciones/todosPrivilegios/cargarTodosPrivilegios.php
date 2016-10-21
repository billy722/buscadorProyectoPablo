<?php
	include("../../../comun.php");
    conectarBD();

    $idGrupo=$_REQUEST['idg'];
    $resultado=$con->query("select * from tb_privilegios");

?>
<div id="contenedorTodosPrivilegios">
	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table class="tablaMantenedorGrupo">
             <thead>
							 	<h1><label class="text-default" for=""><strong>Privilegios.</strong></label></h1>
            				<tr class="cabeceraTabla">
                                     <th>Codigo</th>
                                     <th>Privilegio</th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
              <?php

                while($filas= $resultado->fetch_array()){
                  echo'<tr>';
                     echo'<td><input class="form-control" type="text" readonly   value="'.$filas['id_privilegios'].'"></td>';
                     echo'<td><input class="form-control" readonly type="text" value="'.$filas['descripcion_privilegios'].'"></td>';
                     echo'<td><input type="button" class="btn btn-success" onclick="agregarPrivilegio('.$idGrupo.','.$filas['id_privilegios'].')" value="Añadir al grupo" ></td>';
                  echo'</tr>';
                }
              ?>

             </tbody>
	       </table>
 	</form>
</div>
