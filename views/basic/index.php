<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
$objBasic = new basicController();
$objDomain = new Domain_Controller();
$arrDomianData = $objDomain->get_domain();
if($_POST['st']=="st" && $_POST['po_id']!='')
{
	$objBasic->change_status($_POST['status'],$_POST['po_id']);
}

?>

<html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
	<?php require_once SOURCE_ROOT.'css.php'; ?>
    <link href="<?php echo SITE_CSS_URL ?>highlight.css" rel="stylesheet">
    <link href="<?php echo SITE_CSS_URL ?>bootstrap-switch.css" rel="stylesheet">
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
					<i class="fa fa-qrcode"></i> Basic <small>Quick overview of stats
						and Basic links created</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Basic</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content">



				<div class="contentpanel">

					<div class="panel panel-default">
						<div class="panel-heading">
							
							<!-- panel-btns -->
							<h3 class="panel-title">Last created links</h3>
							<p>Below you can see all links you've created previously</p>
						</div>
						<div class="panel-body">
							<div class="row text-center mb30">
								<a class="btn btn-primary" href="add.php"><i
									class="fa fa-link"></i> Create new link</a>
							</div>
							<div class="table-responsive">
								<table class="table table-hidaction table-hover mb30" >
									<thead>
										<tr>
											<th>Favicon</th>
											<th>Message</th>
											<th>Created</th>
											<th class="min-wid-75">Views</th>
											<th>Unique Views</th>
											<th>Published</th>
											<th class="min-wid-115"></th>
										</tr>
									</thead>
									<tbody id="basicDataGrid">										

									</tbody>
								</table>

							</div>
							<!-- table-responsive -->

						<!--	<div class="box-tools pull-right">
								<ul class="pagination pagination-sm inline">
									<li><a href="#">«</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">»</a></li>
								</ul>
							</div> -->
						</div>
						<!-- col-md-6 -->
					</div>
					<!-- panel -->

					<div class="row text-center">
						<a class="btn btn-primary" href="add.php"><i class="fa fa-link"></i>
							Create new link</a>
					</div>

					<script>
</script>
				</div>
	
	</div>


	</section>
	<!-- /.content -->
	</aside>
	<!-- /.right-side -->


	</div>




<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".blackscreen").show();
	$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/basic/getBasicData.php',
		data: {
		id:1
	},			
	success: function(response) {
		if(response!=''){
		$("#basicDataGrid").html(response);
		 $("a#copy-dynamic").zclip({
			   path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
		       copy:function(){return $(this).attr('data_tip');}
		    });
		} else 
		{
			var trData = "<td colspan='6' style='text-align: center;'>No Record Found!</td>";
			$("#basicDataGrid").html(trData);
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


</body>
</html>
