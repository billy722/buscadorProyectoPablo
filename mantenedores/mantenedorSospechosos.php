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
 ?>
            <div class="container" style="margin-top:25px;">
                <div class="row col-xs-4">
                  <input class="form-control" type="text" placeholder="Ingrese rut/ nombre/ apodo">
                </div>
                <div class="row">
                  <button class="col-xs-1 btn btn-warning">Buscar</button>
                  <a href="./formularioIngresoSospechosos.php" class="col-xs-2 col-xs-offset-5 btn btn-success">Nuevo</a>
                </div>
            </div>

            <div class="container" id="divListadoSospechosos">

              <table class="table table-bordered tablaLista table-striped">
                <thead>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Editar</th>
                </thead>
                <tbody>
                    <?php $privilegios= $con->query("select * from tb_sospechoso order by run");
                    $resultado="";
                    while($filas = $privilegios->fetch_array()){

                      echo'<tr>
                              <td>'.$filas["run"].'-'.$filas["dv"].'</td>
                              <td class="text-uppercase">'.$filas["nombres"].'</td>
                              <td class="text-uppercase">'.$filas["apellido_paterno"].'</td>
                              <td class="text-uppercase">'.$filas["apellido_materno"].'</td>
                              <td><a href="formularioIngresoSospechosos.php?id='.$filas['run'].'"><span class="glyphicon glyphicon-pencil"></a></td>
                          </tr>';
                    }
                    ?>
                </tbody>
              </table>
            </div>

            <div id="divCargando"></div>

<?php
	cargarFooter();

}
 ?>
