<?php
require_once '../clases/Conexion.php';
include("../principal/comun.php");
cargarEncabezado();
 ?>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<script>
$(function () {
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
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            name: 'Porcetanje',
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
