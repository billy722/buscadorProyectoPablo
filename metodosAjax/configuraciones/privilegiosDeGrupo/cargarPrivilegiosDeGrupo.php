<?php
	include("../../../comun.php");
    conectarBD();

    $idGrupo=$_REQUEST['id'];

    $resultado=$con->query("select tb_grupoprivilegio.id_grupoUsuario,
     tb_privilegios.id_privilegios,
     tb_privilegios.descripcion_privilegios
     from tb_privilegios
    inner join tb_grupoprivilegio on tb_privilegios.id_privilegios=tb_grupoprivilegio.id_privilegio
    where id_grupoUsuario=".$idGrupo);

    if($resultado->num_rows!=0){
?>
<div id="contenedorPrivilegiosDeGrupo" class="">
	 <form name="formularioMantenedorGrupo" id="formularioMantenedorGrupo">
        <table >
             <thead>
							 				<h3><label class="text-default" for=""><strong>Privilegios Del Grupo.</strong></label></h3>
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
                              echo'<td><input type="button" class="btn btn-danger" onclick="quitarPrivilegio('.$idGrupo.','.$filas['id_privilegios'].')" value="Quitar" ></td>';

                        echo'</tr>';
                   }
                 ?>

             </tbody>
	       </table>
 </form>
</div>

 <?php
}else{
      echo'<p>ESTE GRUPO AUN NO TIENE PRIVILEGIOS ASIGNADOS</p>';
}
  ?>
