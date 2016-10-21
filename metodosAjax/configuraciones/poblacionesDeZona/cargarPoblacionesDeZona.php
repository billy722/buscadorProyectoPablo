<?php
	include("../../../comun.php");
    conectarBD();

    $idGrupo=$_REQUEST['id'];

    $resultado=$con->query("select tb_poblacionzonas.id_zona,
                           tb_poblacion.id_poblacion,
                           tb_poblacion.descripcion_poblacion
                           from tb_poblacion
                          inner join tb_poblacionzonas on tb_poblacion.id_poblacion=tb_poblacionzonas.id_poblacion
                          where id_zona=".$idGrupo);

    if($resultado->num_rows!=0){
?>

	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table class="tablaMantenedorGrupo">
             <thead>
							 			<h1><label class="text-default" for=""><strong>Poblaciones de Zona.</strong></label></h1>
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

                              echo'<td><input type="button" class="btn btn-danger" onclick="quitarPoblacion('.$idGrupo.','.$filas['id_poblacion'].')" value="Quitar" ></td>';

                        echo'</tr>';
                   }
                 ?>

             </tbody>
	       </table>
 </form>
 <?php
}else{
      echo'<p>ESTA ZONA AUN NO TIENE POBLACIONES ASIGNADAS</p>';
}
  ?>
