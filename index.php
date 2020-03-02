<?php

include_once "config/config.php";
//var_dump($_SESSION); exit;
if($_SESSION['logeid']=="")

{

	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT . 'checkinstall.php';
include_once SOURCE_ROOT . 'grafico/function_dates.php';
include_once SOURCE_ROOT . 'grafico/googleanalytics.class.php';
include_once SOURCE_ROOT_CONTROLLER . 'User/Profile.php';
include_once SOURCE_ROOT . 'grafico/Google/autoload.php';
$objProfile = new Profile_Controller ();
$analyticColl = $objProfile->GetAnalyticData();
$picpath=$objProfile->get_profilepicpath();
$_SESSION['userpicpath']=$picpath[0]['profile_image_path'];

$namess = $_SESSION ['fullname'];
$usermailid = $_SESSION ['logeid'];

$sqle = "SELECT COUNT(*) FROM tbl_profile WHERE userId='$usermailid'";

$res = mysql_query ( $sqle );
$numrow = mysql_fetch_row ( $res );

if ($numrow [0] == 0 && $usermailid != null && $usermailid != '') {
	
	$sqins = "INSERT INTO tbl_profile(userId,profile_name) VALUES ('$usermailid','$namess')";
	mysql_query ( $sqins );
}
include_once SOURCE_ROOT_CONTROLLER . 'justLink/Justlink.php';
$objJustLink = new Justlink_Controller ();
$arrLinkData = $objJustLink->get_jusLink ();

// On Load GetStat
$userid = $_SESSION ['user'] ['id'];
$statResult = $objJustLink->onLoad_GetStat ( $userid );
if ($_POST ['submit'] == "delete" && $_POST ['lnkId'] != '') {
	$objJustLink->delete_link_Dashboard ( $_POST ['lnkId'], $_POST ['tblName'] );
}
if ($_POST ['st'] == "st" && $_POST ['po_id'] != '') {
	$objJustLink->change_status_Dashboard ( $_POST ['status'], $_POST ['po_id'], $_POST ['tblName'] );
}



$userid = $_SESSION ['user'] ['id'];

$profilestat = $objProfile->get_all_profile_links ( $userid );

try {

	// Analytics Code start
 $enddate = date('Y-m-d');
 $startdate = strtotime ( '-365 day' , strtotime ( $enddate ) ) ;
 $startdate = date ( 'Y-m-d' , $startdate );
 
 $fechas = createDateRangeArray($startdate,$enddate);
 $noOfResult = count($fechas);
 $days = count($fechas);
 
 /* $client_id = GOOGLE_CLIENT_ID;
 $Email_address = GOOGLE_EMAIL_ADDRESS;
 $key_file_location = GOOGLE_KEYFILE; */
 
 $client_id = "No Need";
 $Email_address = $analyticColl[0]['serviceaccount'];
 $key_file_location = SOURCE_ROOT.'p/'.$analyticColl[0]['p12'];
 $applicationname = $analyticColl[0]['applicationname'];
 $trackid = 'ga:'.$analyticColl[0]['trackid'];
//var_dump($key_file_location); exit;
 
 $config = new Google_Config();
 $config->setClassConfig('Google_Cache_File', array('directory' => '/tmp/cache'));
 $client = new Google_Client($config);
 

 $client->setAccessType('offline');
 $client->setApplicationName($applicationname);
 $key = file_get_contents($key_file_location);
 
 // seproate additional scopes with a comma
 $scopes ="https://www.googleapis.com/auth/analytics.readonly";
 
 $cred = new Google_Auth_AssertionCredentials($Email_address,
 		array($scopes),
 		$key);

 
 $client->setAssertionCredentials($cred);

 if($client->getAuth()->isAccessTokenExpired()) { 	
 	$client->getAuth()->refreshTokenWithAssertion($cred); 	
 }
 
 $service = new Google_Service_Analytics($client); 
 $metrics = 'ga:pageviews,ga:uniquePageviews,ga:avgTimeOnPage,ga:timeOnPage'; 
 $totalinkcreated = 0;
 for($k = 0; $k < count ( $profilestat ); $k ++) {
 	$rndurl = $profilestat [$k] ['rLink'];
 	$rndurl = trim ( $rndurl, " " );
 	if ($rndurl != "") {
 		$addurl .= "ga:pagePath==/" . ANALYTICS_FOLDER . "/" . $rndurl . ",";
 		$totalinkcreated ++;
 	}
 }
 $jaihanuman = trim ( $addurl, "," );
 
 // Will remove when app gets live
 //$jaihanuman = "ga:pagePath==/googleana/view.php,ga:pagePath==/googleana/index.php,ga:pagePath==/googleana/";

 $report = $service->data_ga->get($trackid, $startdate , $enddate , $metrics, array(
 		'dimensions'    => 'ga:date',
 		'filters'       => $jaihanuman,
 		'sort'          => 'ga:date',
 ));

$totalclk = 0;
$totaltimeonpage=0;
$totaltimeonpageforSITE = 0;

foreach ($report->getRows() as $row){	
	
	$totalclk = ($totalclk + $row[2] + $row[1]);
	$totaltimeonpage = ($totaltimeonpage +  $row[3]);
	$totaltimeonpageforSITE = ($totaltimeonpageforSITE + $row[4]);

}

} catch ( Exception $e ) {
	//var_dump($e); exit;
}


?>
<html>
<head>
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '654212584724991']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php require_once SOURCE_ROOT.'css.php'; ?>
    <link href="<?php echo SITE_CSS_URL ?>highlight.css"
	rel="stylesheet">
<link href="<?php echo SITE_CSS_URL ?>bootstrap-switch.css"
	rel="stylesheet">
</head>
<body class="skin-blue">

<?php include_once "header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
<?php include_once "sidebar.php"; ?> 


   <!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-dashboard"></i> Dashboard <small>Quick overview of
						stats and links created</small>

				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Dashboard</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content">



				<div class="row">

					<div class="col-sm-4 col-md-3">

						<div
							data-intro="&lt;b&gt;The visitors box&lt;/b&gt; quickly shows the stats for the links you've created and shared."
							data-step="3" class="box box-solid box-success">
							<div class="box-header">
								<!-- panel-btns -->
								<h3 class="box-title">Visitors / Last 24h</h3>
							</div>
							<div class="panel-body" style='min-height: 200px;'>
								<div class="stat">
									<div class="row">
										<div class="col-xs-4">
											<img alt="" src="<?php echo SITE_ROOT_URL; ?>img/users.png">
										</div>
										<div class="col-xs-8">
											<small class="stat-label">Views Today</small>
											<h1><?php echo $statResult[0][viewscount] ?></h1>
										</div>
									</div>
									<!-- row -->

									<div class="mb15"></div>

									<div class="row">
										<div class="col-xs-6">
											<small class="stat-label">Visitors</small>
											<h4><?php echo $statResult[0][visitorcount] ?></h4>
										</div>

										<div class="col-xs-6">
											<small class="stat-label">% New visits</small>
											<h4><?php echo round($statResult[0][visitorcount]/$statResult[0][viewscount]*100, 2)?>%</h4>
										</div>
									</div>
									<!-- row -->
								</div>
								<!-- stat -->

							</div>
							<!-- panel-heading -->
						</div>


					</div>


					<div class="col-lg-3 col-xs-3">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>
                                        <?php echo gmdate("H:i:s", $totaltimeonpage);?>
                                    </h3>
								<p>AVG TIME ON LANDING PAGE</p>
								<i class="fa fa-clock-o"
									style="font-size: 50px; margin-top: 24px;"></i>
							</div>
							<div class="icon">
								<!-- <i class="ion ion-bag"></i>-->
							</div>
							<a href="#" class="small-box-footer"> <!-- More info <i class="fa fa-arrow-circle-right"></i>-->
							</a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-3">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<h3>
                                       <?php echo gmdate("H:i:s", $totaltimeonpageforSITE);?>
                                    </h3>
								<p>AVG TIME ON WEBSITE</p>
								<i class="fa fa-clock-o"
									style="font-size: 50px; margin-top: 24px;"></i>
							</div>
							<div class="icon">
								<!-- <i class="ion ion-stats-bars"></i>-->
							</div>
							<a href="#" class="small-box-footer"> <!--More info <i class="fa fa-arrow-circle-right"></i>-->
							</a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-3">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
								<h3>
                                        <?php echo $totalclk;?>
                                    </h3>
								<p>TOTAL CLICKS</p>
								<i class="fa fa-hand-o-up"
									style="font-size: 50px; margin-top: 24px;"></i>
							</div>
							<div class="icon">
								<!--<i class="ion ion-person-add"></i>-->
							</div>
							<a href="#" class="small-box-footer"> <!--More info <i class="fa fa-arrow-circle-right"></i>-->
							</a>
						</div>
					</div>
					<!-- ./col -->

					<div style="clear: both;"></div>
					<!-- <div class="col-sm-3 col-md-3">

<div data-intro="The &lt;b&gt;engagement box&lt;/b&gt; shows a snapshot of the conversion from your links." data-step="4" class="box box-solid box-danger">
            <div class="box-header">
         
                <h3 class="box-title">Engagement / Last 24h</h3>
            </div>
            <div class="panel-body">

                <div class="stat">
                    <div class="row">
                        <div class="col-xs-4">
                            <img alt="" src="<?php //echo SITE_ROOT_URL; ?>img/conversion.png">
                        </div>
                        <div class="col-xs-8">
                            <small class="stat-label">Conversion</small>
                            <h1>0%</h1>
                        </div>
                    </div>

                    <div class="mb15"></div>

                    <small class="stat-label">Clicks</small>
                    <h4>0</h4>
                </div>
            </div>
        </div>
</div>
</div>-->





					<!--<div class="row" style="margin:1px;"> 
    <div class="panel panel-default panel-stat-header">
<div class="panel-heading">
								
								<h3 class="panel-title">avg time on landing page - <?php //echo gmdate("H:i:s", $totaltimeonpage);?></h3>
								<br>
								
								<p>avg time on site - <?php // echo gmdate("H:i:s", $totaltimeonpageforSITE);?></p>
<p>click - <?php //echo $totalclk;?></p>
<p>link created - <?php //echo $totalinkcreated;?></p>
							</div>-->
					<div class="panel-heading"
						style="background: #eee; border-bottom: 1px solid #ff6363;">
						<!-- panel-btns -->
						<h3 class="panel-title">
							<b>Last created links</b>
						</h3>
						<p>You can view quick snapshot of last 10 created links</p>
					</div>
					<div class="panel-body">

						<div class="table-responsive">
							<table class="table table-hidaction table-hover mb30">
								<thead>
									<tr>
										<th>Favicon</th>
										<th>Message</th>
										<th>Created</th>
										<th>Views</th>
										<th>Unique Views</th>
										<th>Published</th>
										<th class="min-wid-95"><i class="fa fa-gear"></i> Actions</th>
									</tr>
								</thead>
								<tbody id="linktbody">

								</tbody>
							</table>
						</div>
						<!-- table-responsive -->
					</div>
				</div>
			</section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->


	</div>

<?php include_once "js/javascript.php"; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".blackscreen").show();
	$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/dashboardData.php',
		data: {
		id:1
	},			
	success: function(response) {
		if(response!=''){
			$("#linktbody").html(response);
			$("a#copy-dynamic").zclip({
				   path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
			       copy:function(){return $(this).attr('data_tip');}
			    });
			} else 
			{
				var trData = "<td colspan='6' style='text-align: center;'>No Record Found!</td>";
				$("#linktbody").html(trData);
			}
		$(".blackscreen").hide();
		$(".loader_popup").hide();
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	}); 
});
</script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60807101-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>