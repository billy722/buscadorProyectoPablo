<?php
require_once '../clases/Conexion.php';
require_once '../clases/Usuario.php';
$UsuarioValidar= new Usuario();
$UsuarioValidar->verificarSesion();

    include("../principal/comun.php");
    cargarEncabezado();
    cargarMenuReportes();

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

            if($privilegio['id']==12){//privilegio MANTENEDOR
                $privilegioMantenedor=true;
            }
         }


         if($privilegioMantenedor==false){
            header("location: ../mantenedores/mantenedoresPrincipal.php");
         }

     }else{
       echo "0";//usuario no existe
     }
?>
<div id="container" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
<script>
$(function () {
 Highcharts.setOptions({
   lang:{
     downloadPDF: "Descargar en PDF",
     downloadJPEG: "Descargar Imagen JPEG",
     downloadPNG: "Descargar Imagen PNG",
     downloadSVG: "Descargar en SVG",
     printChart: "Imprimir Gráfico"
   }
 });
 //Crearte chart
   Highcharts.chart('container', {
       chart: {
           type: 'column'
       },
       title: {
           text: 'Top ten Delincuentes mas identificados.'
       },
       
       xAxis: {
           type: 'category',
           labels: {
               rotation: -45,
               style: {
                   fontSize: '13px',
                   fontFamily: 'Verdana, sans-serif'
               }
           }
       },
       yAxis: {
           min: 0,
           title: {
               text: 'Cantidad de veces identificado'
           }
       },
       legend: {
           enabled: false
       },
       tooltip: {
         enabled: false,
           pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
       },
       series: [{
           name: 'lalalallalalalalallalalallalal',
           data: [
             <?php
             $conexion = new Conexion();
             $resultado = $conexion->consultarBdR("SELECT veces_identificado, run, CONCAT (UPPER(nombres),' ',UPPER (apellido_materno),' ',UPPER (apellido_materno)) AS datos FROM tb_sospechoso
             ORDER BY veces_identificado DESC LIMIT 10 ");
             while($result = mysqli_fetch_array($resultado)){
              ?>
             ["<?php echo $result['run'];?>", <?php echo $result['veces_identificado'];?>],
             <?php
             }
             ?>
           ],
           dataLabels: {
               enabled: true,
               rotation: 0,
               color: '#FFFFFF',
               align: 'center',
               format: '{point.y:1f}', // one decimal
               y: 30, // 10 pixels down from the top
               style: {
                   fontSize: '13px',
                   fontFamily: 'Verdana, sans-serif'
               }
           }
       }]
       });
   });
</script>
<?php
cargarFooter();
?>
