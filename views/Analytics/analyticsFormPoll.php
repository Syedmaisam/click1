<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
include_once SOURCE_ROOT.'grafico/function_dates.php';
include_once SOURCE_ROOT.'grafico/googleanalytics.class.php';
$objBasic = new basicController();
$highChart = SITE_ROOT_URL."grafico/highcharts.js";
$exportChart = SITE_ROOT_URL."grafico/exporting.js";
$arrLinkData=$objBasic->getFormPollDetails($arrUrl[1]);

$userid = $_SESSION['user']['id'];
$addurl = $arrUrl[1];
$jaihanuman = "ga:pagePath==/click/{$addurl}";
//echo $newaddurl;
if($arrUrl[2]!='' && $arrUrl[3]!='')
{
	$startdate = $arrUrl[2];//$_GET['fromDate'];
	$enddate = $arrUrl[3];//$_GET['toDate'];
}
else {
	$enddate = date('Y-m-d');
	$startdate = strtotime ( '-15 day' , strtotime ( $enddate ) ) ;
	$startdate = date ( 'Y-m-d' , $startdate );
	//echo "543543";
}
//include_once SOURCE_ROOT_CLASSES.'basic/class_getBasicHistory.php';
$fechas = createDateRangeArray($startdate,$enddate);
$noOfResult = count($fechas);
//echo $noOfResult;
for($k = 0; $k < $noOfResult; $k++)
{
	$dat = createDateRangeArray($fechas[$k],$fechas[$k]);
}
$days = count($fechas);
$data = 'ga:pageviews,ga:avgTimeOnPage,ga:uniquePageviews';
//echo $data = urlencode($data);exit;
try {

	$ga = new GoogleAnalytics('clikitclick@gmail.com','click@123');
	$ga->setProfile('ga:99392878');
	$ga->setDateRange($startdate,$enddate);
	$report = $ga->getReport(

			array('dimensions'=>urlencode('ga:date,ga:pagePath'),'metrics'=>urlencode($data),
					'filters'=>urlencode($jaihanuman),
					'sort'=>'ga:date'
			)
	);
	$Countryreport = $ga->getReport(

			array('dimensions'=>urlencode('ga:date,ga:country'),
					'metrics'=>urlencode('ga:pageviews'),'filters'=>urlencode($jaihanuman),
					'sort'=>'ga:date'
			)
	);
	
	$Socialreport = $ga->getReport(

			array('dimensions'=>urlencode('ga:medium,ga:socialNetwork,ga:pagePath'),
					'metrics'=>urlencode('ga:users'),
					'filters'=>urlencode($jaihanuman)

			)
	);
	$i = 0; $serie_dim = null; $serie_val = null;

//var_dump($report);exit;
	
	$totaltimeonpage=0;
	$totalview = 0;
	$totalvisit = 0;
	foreach ($report as $valor){

		$serie_dim .= "'".$fechas[$i]."', ";


		$serie_val .= $valor['ga:pageviews'].", ";
		//count total view on page
		$pgview = $valor['ga:pageviews'];
		$totalview = ($totalview + $pgview);


		$sec .= $valor['ga:uniquePageviews'].", ";
		// count total visit on page
		$pgvisit = $valor['ga:uniquePageviews'];
		$totalvisit = ($totalvisit + $pgvisit);


		$clk .= $valor['ga:uniquePageviews'].", ";


		$timeonpage = $valor['ga:avgTimeOnPage'].", ";
		//count total time on page
		$totaltimeonpage = ($totaltimeonpage + $timeonpage);
		//echo $totaltimeonpage."-";
		$timeonpageinmin .= ($timeonpage/60).", ";
		$i++;

	}
	//code to get country report -----------------------------------------------------------
	$key = array_keys($Countryreport);
	$country='';
	$arrCountryData='';

	$duplCountryArry;
	for ($k=0;$k<count($key);$k++){

		//$serie_dim .= "'.$fechas[$i]."', ";
		$arrCountryData = explode("~~",$key[$k]);
		$country =$arrCountryData[1];

		$pgview = $Countryreport[$key[$k]]['ga:pageviews'];

		if(array_key_exists($country,$duplCountryArry))
		{
			$newval = $duplCountryArry[$country]+$pgview;
			$duplCountryArry[$country] = $newval;
		}
		else
		{
			$duplCountryArry[$country] = $pgview;
		}



	}
	$country_pageview = "country::view,";
	foreach ($duplCountryArry as $country=>$views){

		$country_pageview .= $country."::".$views.',';
	}
	$country_pageview = trim($country_pageview,",");
	//code end to get countries report -----------------------------------------------------------------------------------
	//code to get social report -----------------------------------------------------------
	$Skey = array_keys($Socialreport);
	$fbshare_count=0;
	$twittershare_count = 0;
	$arrSocialData='';

	$duplCountryArry;
	for ($w=0;$w<count($Skey);$w++)
	{

		//$serie_dim .= "'.$fechas[$i]."', ";
		$arrSocialData = explode("~~",$Skey[$w]);
		$isreferral =trim($arrSocialData[0]," ");
		if($isreferral == "referral")
		{
			$socialName = trim($arrSocialData[1]," ");
			if($socialName == "Facebook")
			{
				$fbshare_count++;
			}
			else if($socialName == "Twitter")
			{
				$twittershare_count++;
			}
		}

	}

	//end of getting social report ---------------------------------------------------------------------
	//var_dump($country_pageview);
	$serie_dim = substr($serie_dim, 0, -2); $serie_val = substr($serie_val, 0, -2);

	$script1 = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({chart:{renderTo:'area-chart',defaultSeriesType:'area',marginRight:130,marginBottom:35},title:{text:'',x:-20},subtitle:{text:'Fuente: Google Analytics',x:-20},xAxis:{categories:[".
			$serie_dim.
			"]},yAxis:{title:{text:''},plotLines:[{value:0,width:1,color:'#808080'}]},tooltip:{formatter:function(){return'<b>'+this.series.name+'</b><br/>'+
			this.x+': '+this.y+'';}},legend:{layout:'vertical',align:'right',verticalAlign:'top',x:-10,y:100,borderWidth:0},series:[{name:'Click',data:[".
			$clk.
			"]},{name:'Views',data:[".
			$serie_val.
			"]},{name:'Visitors',data:[".
			$sec.
			"]}]});});</script>".
			"<script type='text/javascript'src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'  src='".$highChart."'></script><script type='text/javascript' src='".$exportChart."'></script>".
			"";

	$script2 = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript'>var chart;$(document).ready(function(){chart=new Highcharts.Chart({chart:{renderTo:'avgtime',defaultSeriesType:'line',marginRight:130,marginBottom:35},title:{text:'',x:-20},subtitle:{text:'Fuente: Google Analytics',x:-20},xAxis:{categories:[".
			$serie_dim.
			"]},yAxis:{title:{text:''},plotLines:[{value:0,width:1,color:'#808080'}]},tooltip:{formatter:function(){return'<b>'+this.series.name+'</b><br/>'+
			this.x+': '+this.y+'';}},legend:{layout:'vertical',align:'right',verticalAlign:'top',x:-10,y:100,borderWidth:0},series:[{name:'Views',data:[".
			$timeonpageinmin.
			"]}]});});</script>".
			"<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script><script type='text/javascript' src='".$highChart."'></script><script type='text/javascript' src='".$exportChart."'></script>".
			"";

}catch (Exception $e) {

	print 'Error: ' . $e->getMessage();exit;

}

?><html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php require_once SOURCE_ROOT.'css.php'; ?>
<link href="<?php echo SITE_CSS_URL ?>highlight.css" rel="stylesheet">
<link href="<?php echo SITE_CSS_URL ?>bootstrap-switch.css"
	rel="stylesheet">
</head>
<body class="skin-blue">

	<?php //exit; ?>
	<?php include_once SOURCE_ROOT."header.php"; ?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once SOURCE_ROOT."sidebar.php"; ?>


		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-bar-chart-o"></i> Analytics <small>Quick overview
						of stats and links created</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Analytics</a></li>

				</ol>
			</section>


			<div class="row"
				style="width: 97%; margin-top: 20px !important; margin: auto;">
				<div class="col-sm-13">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-btns"></div>
							<h3 class="panel-title">Link Info</h3>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<input id="ids" type="hidden"
												value="<?php echo $arrLinkData[0]['randomlink'];?>">
											<td>Link</td>
											<td>
												<div style="position: relative;">
													<a><?php echo $arrLinkData[0]['randomlink'];?> </a>
													&ndash; <a data-href="http://openr.co/2M4"
														data-original-title="Copy link to clipboard" type="button"
														data-toggle="tooltip" data-placement="bottom"
														title="Copy link to clipboard" class="link-copy-btn"><i
														class="fa  fa-clipboard"></i> </a>
													<div class="zclip" id="zclip-ZeroClipboardMovie_1"
														style="position: absolute; left: 48px; top: 3px; width: 14px; height: 15px; z-index: 99;">
														<embed width="14" height="15" align="middle"
															wmode="transparent"
															flashvars="id=1&amp;width=14&amp;height=15"
															pluginspage="http://www.macromedia.com/go/getflashplayer"
															type="application/x-shockwave-flash"
															allowfullscreen="false" allowscriptaccess="always"
															name="ZeroClipboardMovie_1" bgcolor="#ffffff"
															quality="best" menu="false" loop="false"
															src="http://openr.co/private/swf/ZeroClipboard.swf"
															id="ZeroClipboardMovie_1">
													
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>Content Url</td>
											<td><a target="_blank"
												href="<?php echo $arrLinkData[0]['contenturl'];?>"><?php echo $arrLinkData[0]['contenturl'];?>
											</a></td>
										</tr>
										<tr>
											<td>Title</td>
											<td><?php echo $arrLinkData[0]['title'];?></td>
										</tr>
										<tr>
											<td>Message Text</td>
											<td><?php echo $arrLinkData[0]['message'];?></td>
										</tr>
										<tr>
											<td>Action Text</td>
											<td><?php echo $arrLinkData[0]['calltoaction'];?></td>
										</tr>
										<tr>
											<td>Action Link</td>
											<td><a target="_blank"
												href="<?php echo $arrLinkData[0]['yoururl'];?>"><?php echo $arrLinkData[0]['yoururl'];?>
											</a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>




			<div class="row" style="width: 99%; margin: auto; margin-top: 20px;">
				<div class="col-sm-8 col-md-9">
					<div class="panel  panel-default panel-stat">
						<div class="panel-heading">

							<h3 class="panel-title">Overall Views and Visitors</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">

									<div style="height: 260px; position: relative;" id="area-chart">
										<?php echo $script1;?>
									</div>

								</div>
								<!-- col-sm-8 -->

							</div>
							<!-- row -->
						</div>
						<!-- panel-body -->
					</div>
					<!-- panel -->

					<div class="panel  panel-default panel-stat">
						<div class="panel-heading">
							<h3 class="panel-title">Average time on page</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">

									<div style="height: 260px; position: relative;" id="avgtime">
										<?php echo $script2;?>
									</div>
									<!-- <div style="height: 120px; position: relative;" id="avgtime">
										
										
									</div> -->

								</div>
								<!-- col-sm-8 -->

							</div>
							<!-- row -->
						</div>
						<!-- panel-body -->
					</div>
					<!-- panel -->
					<div class="panel  panel-default panel-stat">
						<div class="panel-heading">
							<h3 class="panel-title">Country</h3>
							<input id="countryid" type="hidden"
								value="<?php echo $country_pageview;?>">
						</div>
						<div class="panel-body">



							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
							<script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

    	
    	 var countries = $('#countryid').val();
    	 var countryArry = countries.split(","); 
    	 //var text ='';
    	 var textArray=[];
    	 var i;
    	 for (i = 0; i < countryArry.length; i++) 
         {
             var  text = [];
             
	          var countryVisit = countryArry[i];
	       	  var keyvaluepair = countryVisit.split("::");
	       	  var country = keyvaluepair[0];
	       	  var visit = parseInt(keyvaluepair[1]);
	       	  if(i == 0 ){
	       			text[0] =  'country';
	       			text[1] = 'total view';
		       	  textArray[0] = text;
	       	  } else {
	       	text[0] =  country;
   			text[1] = visit;
	       	textArray[i] = text;
	       	  }
	       	 // text.push(textArray);
			//  text+= "['"+country+"',"+visit+"],";  //['Country', 'Popularity'],
		  }
    	 
    	 //text = text.slice(0,text.length - 1);
    	 //text = text.replace(/\"/,'');
    	 //alert(textArray);
         var data = google.visualization.arrayToDataTable(textArray);
         //alert(data);
        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>

							<div id="regions_div" style="width: 900px; height: 500px;"></div>




							<!-- row -->
						</div>
						<!-- panel-body -->
					</div>

				</div>
				<!-- col-sm-9 -->

				<div class="col-sm-4 col-md-3">


					<div class="panel panel-success panel-stat panel-stat-equal">
						<div class="panel-heading">

							<h3 class="panel-title">Stats</h3>
						</div>
						<div class="panel-body">
							<div class="stat">
								<div class="row">
									<div class="col-xs-6">
										<small class="stat-label">Views</small>
										<h1>
											<?php echo $totalview;?>
										</h1>
									</div>
									<div class="col-xs-6">
										<small class="stat-label">Visitors</small>
										<h1>
											<?php echo $totalvisit;?>
										</h1>
									</div>
								</div>
								<!-- row -->

								<div class="mb15"></div>

								<div class="row">
									<div class="col-xs-6">
										<small class="stat-label">Time on page</small>
										<h4>
											<?php echo gmdate("H:i:s", $totaltimeonpage);?>
										</h4>
									</div>
									
									<!--                            <div class="col-xs-6">
                                <small class="stat-label"></small>
                                <h4></h4>
                            </div>-->
								</div>
								<!-- row -->
								<hr>
								

								

							</div>
							<!-- stat -->

						</div>
						<!-- panel-heading -->
					</div>
					<!-- panel -->


					<div class="panel panel-default panel-stat-header">
						<div class="panel-heading">

							<h3 class="panel-title">Date Range</h3>
						</div>
						<form id="dateForm" class="form-bordered"
							enctype="multipart/form-data" name="dateForm" method="post"
							onsubmit="return makehrefDate()" action="">
							<div class="panel-body">

								<div class="input-group date">
									<input type="text" value="<?php echo $startdate; ?>" id="datepickerstart"
										placeholder="yy-mm-dd" name="fromDate"
										class="form-control hasDatepicker"><span
										class="input-group-addon"><button type="button"
											class="ui-datepicker-trigger">
											<i class="fa fa-calendar"></i>
										</button> </span>
									<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
								</div>

								<div class="input-group date">
									<input type="text" value="<?php echo $enddate; ?>" id="datepickerend"
										placeholder="yy-mm-dd" name="toDate"
										class="form-control hasDatepicker"><span
										class="input-group-addon"><button type="button"
											class="ui-datepicker-trigger">
											<i class="fa fa-calendar"></i>
										</button> </span>
									<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
								</div>
								<button type="submit" name="submit"
									class="mt10 btn btn-block btn-primary"
									style="margin-top: 10px;">Apply</button>

							</div>
						</form>
					</div>
					<div class="panel panel-default panel-stat-header">
						<div class="panel-heading">

							<h3 class="panel-title">Regions</h3>
						</div>
						<div class="panel-body"
							style="width: 100%;>

							<script 
							
							
							
							
							
							type="text/javascript" src="https://www.google.com/jsapi">
							</script>
							<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
    	  var countries = $('#countryid').val();
     	 var countryArry = countries.split(","); 
     	 //var text ='';
     	 var textArray=[];
     	 var i;
     	 for (i = 0; i < countryArry.length; i++) 
          {
              var  text = [];
              
 	          var countryVisit = countryArry[i];
 	       	  var keyvaluepair = countryVisit.split("::");
 	       	  var country = keyvaluepair[0];
 	       	  var visit = parseInt(keyvaluepair[1]);
 	       	  if(i == 0 ){
 	       			text[0] =  'country';
 	       			text[1] = 'total view';
 		       	  textArray[0] = text;
 	       	  } else {
 	       	text[0] =  country;
    			text[1] = visit;
 	       	textArray[i] = text;
 	       	  }
 	       	 // text.push(textArray);
 			//  text+= "['"+country+"',"+visit+"],";  //['Country', 'Popularity'],
 		  }
		  
        var data = google.visualization.arrayToDataTable(textArray);

        var options = {
          pieHole: 0.6,
          pieSliceTextStyle: {
            color: 'black'
          },
          legend: 'none',
          'width':250,
         'height':250
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
        chart.draw(data, options);
      }
    </script>
							<div id="donut_single" style=""></div>
						</div>



					</div>
					<div class="panel panel-default panel-stat-header">
						<!--  top referrels --------------------------  -->
						<div class="panel-heading">

							<h3 class="panel-title">Top Referral</h3>
						</div>
						<input id="fbcount" type="hidden"
							value="<?php echo $fbshare_count;?>"> <input id="twtcount"
							type="hidden" value="<?php echo $twittershare_count;?>">
						<div class="panel-body"
							style="width: 100%;>

							<script 
							
							type="text/javascript" src="https://www.google.com/jsapi">
							</script>
							<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChartSocial);
      
      function drawChartSocial() {
    	  var fbcount = $('#fbcount').val();
    	  var twtcount = $('#twtcount').val();
    	  //fbcount = 4;
    	  //twtcount = 7;
    	  var socialtextArray=[];
    	  var t;
    	  for (t = 0; t < 4; t++) 
          {
    		  var  text = [];
    		  if(t == 0)
    		  {
    			  text[0] =  'Social Network';
        		  text[1] = 'Referral';
        		  socialtextArray[0] = text;
    		  }
    		  if(t == 1)
    		  {
    			  text[0] =  'Facebook';
    				text[1] = fbcount;
    				socialtextArray[1] = text;
    		  }
    		  if(t == 2)
    		  {
    			  text[0] =  'Twitter';
    				text[1] = twtcount;
    				socialtextArray[2] = text;
    		  }
    		  
          }
     	
		  
        var data = google.visualization.arrayToDataTable(socialtextArray);

        var options = {
          pieHole: 0.6,
          pieSliceTextStyle: {
            color: 'black'
          },
          legend: 'none',
         'width':250,
         'height':250
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single_social'));
        chart.draw(data, options);
      }
    </script>
							<div id="donut_single_social" style=""></div>
						</div>



					</div>
					<!--  end of top referrels --------------------------  -->
				</div>
				<!-- col-sm-3 -->
			</div>

			</section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->


	</div>




</body>
<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT_URL; ?>css/datepickr.css" />
<script type="text/javascript" src="<?php echo SITE_ROOT_URL; ?>js/datepickr.js"></script>
<script>
function makehrefDate()
{
	var ids = $('#ids').val();
	var startdate =$('#datepickerstart').val();
	var enddate = $('#datepickerend').val();
	var href = SITE_ROOT_URL+"views/basic/analyticsFormPoll.php/"+ids+"/"+startdate+"/"+enddate;
	$('#dateForm').attr("action",href);
	return  true;
}
$(document).ready(function(){
	$(".highcharts-subtitle tspan").remove();
	});
</script>
<script type="text/javascript">
					
			new datepickr('datepickerstart',{
				'dateFormat': 'Y-m-d'
			});
//$("#datepickerstart").datepicker("setDate", +15);
			new datepickr('datepickerend', {
				'dateFormat': 'Y-m-d'
			});
			
		</script>
</html>