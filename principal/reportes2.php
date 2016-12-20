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
       printChart: "Imprimir Gráfico",
       drillUpText: "<- Volver"
     }
   });
    // Create the chart
    Highcharts.chart('container', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad de delincuentes Operando por Zonas'
        },
        subtitle: {
            text: 'Haga click sobre las zonas para ver la cantidad de delincuentes por cada población.'
        },
        xAxis: {
          title: {
              text: 'Zonas de la ciudad de Los Angeles'
          },
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total delincuentes que operan en cada zona'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>'
        },

        series: [{
            name: 'Zonas de los angeles',
            colorByPoint: true,
            data: [
              <?php
              $conexion = new Conexion();
              $resultado = $conexion->consultarBdR("SELECT COUNT(DISTINCT ps.run) AS cantidad,z.id_zona,z.descripcion_zona FROM tb_zona z
              INNER JOIN tb_poblacionzonas pz ON z.id_zona=pz.id_zona
              INNER JOIN tb_poblacion p ON pz.id_poblacion=p.id_poblacion
              INNER JOIN tb_poblacionsospechoso ps ON pz.id_poblacion=ps.id_poblacion
              GROUP BY z.id_zona");
              while($result = mysqli_fetch_array($resultado)){
                echo"{";
               ?>
                name: "<?php echo $result['descripcion_zona'];?>",
                y: <?php echo $result['cantidad'];?>,
                drilldown: "<?php echo $result['id_zona'];?>"

            },
            <?php } ?>
          ]
        }],
        drilldown: {
            series: [

                <?php
                $conexion = new Conexion();
                $resultado2 = $conexion->consultarBdR("select * from tb_zona");
                while($result2 = mysqli_fetch_array($resultado2)){
                  echo"{";
                 ?>
                name: "<?php echo $result2['descripcion_zona'];?>",
                id: "<?php echo $result2['id_zona'];?>",
                data: [
                  <?php
                  $resultado3 = $conexion->consultarBdR("SELECT COUNT(ps.run) AS cantidad,z.id_zona,
                  z.descripcion_zona,
                  p.id_poblacion,
                  p.descripcion_poblacion
                  FROM tb_zona z
                  INNER JOIN tb_poblacionzonas pz ON z.id_zona=pz.id_zona
                  INNER JOIN tb_poblacion p ON pz.id_poblacion=p.id_poblacion
                  INNER JOIN tb_poblacionsospechoso ps ON pz.id_poblacion=ps.id_poblacion
                  WHERE z.id_zona=".$result2['id_zona']." GROUP BY p.id_poblacion");

                  while($result3 = mysqli_fetch_array($resultado3)){ ?>
                    [

                        "<?php echo $result3['descripcion_poblacion'];?>",
                        <?php echo $result3['cantidad'];?>
                    ],
<?php } ?>
                ]
            },
            <?php } ?>

          ]
        }
    });
});
 </script>
 <?php
 cargarFooter();
 ?>
