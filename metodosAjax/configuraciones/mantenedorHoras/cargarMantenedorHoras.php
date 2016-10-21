<?php
	include("../../../comun.php");
    conectarBD();


?>

  <div id="divTablaNuevaHora">
	<form name="formularioNuevaHora" id="formularioNuevaHora">
		<table id="tablaNuevaHora">
			<caption>Agregar nueva hora</caption>
			<thead> 
            				<tr class="cabeceraTabla">
                                     <th>Nuevo Hora</th>
                                     <th></th>
            				</tr>
                        </thead>
                        <tbody>
			<tr class="filasTablaAgregarNuevaHora">
	            <td><input type="time" id="nuevaHora" name="nuevaHora" ></td>  
              <td><input type="button" onclick="guardarNuevaHora()" value="Agregar"></td>
      </tr>
    </tbody>	
	</table>	
</form>	
</div>


	 <form name="formularioMantenedorHoras" id="formularioMantenedorHoras">
        <table class="tablaMantenedorHoras">		
             <thead> 
            				<tr class="cabeceraTabla">
                                      <th>Hora</th>
                                     <th></th>
            				</tr>
             </thead>
             <tbody>
                <?php 
                   $resultado=$con->query("select * from horas order by hora asc");
                   $contadorFilas=0;

                   while($filas= $resultado->fetch_array()){
                      $contadorFilas++;
                        echo'<tr>';
                              echo'<input type="hidden" name="'.$contadorFilas.',1"  value="'.$filas['idHora'].'">';
                              echo'<td><input onBlur="guardarCambiosMantenedorHoras();" type="time" required name="'.$contadorFilas.',2" value="'.$filas['hora'].'"></td>';
                                                    
                              echo'<td><input type="button" class="botonEliminarMantenedores" onclick="eliminarHora('.$filas['idHora'].')" value="Eliminar" ></td>';

                        echo'</tr>';
                   }
                   echo'<input type="hidden" name="cantidadFilas" value="'.$contadorFilas.'">';
                 ?>
                      
             </tbody>
	       </table>
 </form>	
 