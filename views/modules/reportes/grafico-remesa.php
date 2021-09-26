<?php 

if (isset($_GET['fechaInicial'])) {
    $fechaInicial=$_GET['fechaInicial'];
    $fechaFinal=$_GET['fechaFinal'];
}else{
    $fechaInicial=null;
    $fechaFinal=null;

}
$respuesta = RemesasController::ctrRengoFechaRemesas($fechaInicial,$fechaFinal);
$arrayFecha = array();
foreach($respuesta as $key => $value){
    
    $fecha=substr($value['created_at'],0,7);
    
    array_push($arrayFecha,$fecha);
}
var_dump($arrayFecha);

?>
<div class="card bg-gradient-info">
<div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Reporte de Remesas
                </h3>
              </div>
    <div id="line-chart-remesas" style="height: 250px;"></div>
</div>
<script>

new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'line-chart-remesas',
    resize: true,
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [

            <?php 
            foreach($arrayFecha as $key => $value){
                echo "{y: '".$value."', remesa: 20},";
        }
        // echo "{y: '2020', remesa: 20}"
            ?>

    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'y',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['remesa'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Remesa'],
    lineColors: ['#efefef'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: '#fff',
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor: '#efefef',
    gridTextFamily: 'Open Sans',
    gridTextSize: 10,
  });
</script>