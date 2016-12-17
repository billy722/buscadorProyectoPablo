<?php
require_once '../clases/Conexion.php';
include("../principal/comun.php");
cargarEncabezado();
$conexion = new Conexion();
$result = $conexion->reporte2();
 ?>
 <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
 <script>
 $(function () {
     var chart = Highcharts.chart('container', {

         chart: {
             type: 'column'
         },

         title: {
             text: 'Cantidad de delitos'
         },

         subtitle: {
             text: 'cometidos por zonas.'
         },

         legend: {
             align: 'right',
             verticalAlign: 'middle',
             layout: 'vertical'
         },

         xAxis: {
             categories: ['Apples', 'Oranges', 'Bananas'],
             labels: {
                 x: -10
             },
             title:{
               text: 'Nombre delincuente'
             }
         },

         yAxis: {
             allowDecimals: false,
             title: {
                 text: 'Cantidad por delito'
             }
         },

         series: [{
             name: 'Christmas Eve',
             data: [1, 4, 3]
         }, {
             name: 'Christmas Day before dinner',
             data: [6, 4, 2]
         }, {
             name: 'Christmas Day after dinner',
             data: [8, 4, 3]
         }],

         responsive: {
             rules: [{
                 condition: {
                     maxWidth: 500
                 },
                 chartOptions: {
                     legend: {
                         align: 'center',
                         verticalAlign: 'bottom',
                         layout: 'horizontal'
                     },
                     yAxis: {
                         labels: {
                             align: 'left',
                             x: 0,
                             y: -5
                         },
                         title: {
                             text: null
                         }
                     },
                     subtitle: {
                         text: null
                     },
                     credits: {
                         enabled: false
                     }
                 }
             }]
         }
     });

     $('#small').click(function () {
         chart.setSize(400, 300);
     });

     $('#large').click(function () {
         chart.setSize(600, 300);
     });

 });
 </script>
 <?php
 cargarFooter();
 ?>
