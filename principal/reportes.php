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
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Estadisticas de delitos cometidos.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:1f}</b>',

        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Cantidad',
            colorByPoint: true,
            data: [
              <?php
              $conexion = new Conexion();
              $resultado = $conexion->consultarBdR("SELECT COUNT(tb_delitosopechoso.id_delito) AS cuenta, tb_delitosopechoso.id_delito,descripcion_delito FROM tb_delitosopechoso
              INNER JOIN tb_delito ON tb_delito.id_delito= tb_delitosopechoso.id_delito
              GROUP BY tb_delitosopechoso.id_delito ORDER BY cuenta DESC");
              while($result = mysqli_fetch_array($resultado)){
                echo"{";
               ?>
                name: "<?php echo $result['descripcion_delito'];?>",
                y: <?php echo $result['cuenta'];?>

},
            <?php
          }
            ?>
           ]
        }]
    });
});
</script>
<?php
cargarFooter();
?>
