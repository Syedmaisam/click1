<?php

include "function_dates.php"; 
include "googleanalytics.class.php";

$fecha2 = date('Y-m-d');
$fecha1 = strtotime ( '-15 day' , strtotime ( $fecha2 ) ) ;
$fecha1 = date ( 'Y-m-d' , $fecha1 );
$fechas = createDateRangeArray($fecha1,$fecha2);
$days = count($fechas);
$data = 'ga:pageviews,ga:visits';
//echo $data = urlencode($data);exit;
try {

	$ga = new GoogleAnalytics('your email','your password');
	$ga->setProfile('ga:your id');
        $ga->setDateRange($fecha1,$fecha2);
        $report = $ga->getReport(

         array('dimensions'=>urlencode('ga:date'),
         'metrics'=>urlencode($data),
        'filters'=>urlencode('ga:pagePath==/click/views/basic/view.php/haHeQ'),
        'sort'=>'ga:date'
                                            )
                              );

$i = 0; $serie_dim = null; $serie_val = null;

$count=1;
foreach ($report as $valor){

    $serie_dim .= "'".$fechas[$i]."', ";
    $serie_val .= $valor['ga:pageviews'].", ";
    $sec .= $valor['ga:visits'].", ";
    $i++;

}

$serie_dim = substr($serie_dim, 0, -2); $serie_val = substr($serie_val, 0, -2);

$script1 = "<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({chart:{renderTo:'container',defaultSeriesType:'area',marginRight:130,marginBottom:25},title:{text:'VISITAS POR DÍA (Últimos 15 días, excepto desde Italia)',x:-20},subtitle:{text:'Fuente: Google Analytics',x:-20},xAxis:{categories:[".
$serie_dim.
"]},yAxis:{title:{text:'Visitas'},plotLines:[{value:0,width:1,color:'#808080'}]},tooltip:{formatter:function(){return'<b>'+this.series.name+'</b><br/>'+
this.x+': '+this.y+'';}},legend:{layout:'vertical',align:'right',verticalAlign:'top',x:-10,y:100,borderWidth:0},series:[{name:'Views',data:[".
$serie_val.
"]},{name:'Visitors',data:[".
$sec.
"]}]});});</script>".
"<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'src='highcharts.js'></script><script type='text/javascript'src='exporting.js'></script><div id='container'style='width: 1200px; height: 600px; margin: 0 auto'></div>";

}catch (Exception $e) {

               //print 'Error: ' . $e->getMessage();

}

echo $script1;

?>