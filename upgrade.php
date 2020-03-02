<?php
include_once "config/config.php";
include_once SOURCE_ROOT.'session_redirect.php';

include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink();
// On Load GetStat
$userid = $_SESSION['user']['id'];
$statResult = $objJustLink->onLoad_GetStat($userid);
if($_POST['submit']=="delete" && $_POST['lnkId']!='' )
{
	$objJustLink->delete_link($_POST['lnkId']);
}
if($_POST['st']=="st" && $_POST['po_id']!='')
{
	$objJustLink->change_status($_POST['status'],$_POST['po_id']);
}

$acctype=$_SESSION['product_level'];

if($acctype==2)
{
	$acc_name="Cliks Power";
	$buildlink=15;
	$sharelink=15;
	$campmonth=5;
	$profilelimit=1;
}
elseif($acctype==3)
{
	$acc_name="Cliks Power Pro";
	$buildlink=50;
	$sharelink=50;
	$campmonth=25;
	$profilelimit=1;
}
elseif($acctype==4)
{
	$acc_name="Cliks Enterprise";
	$buildlink=25;
	$sharelink=25;
	$campmonth=10;
	$profilelimit=1;
}
elseif($acctype==5)
{
	$acc_name="Cliks Agency";
	$buildlink="Unlimited";
	$sharelink="Unlimited";
	$campmonth="Unlimited";
	$profilelimit=100;
}
elseif($acctype==6)
{
	$acc_name="Cliks Free User";
	$buildlink=5;
	$sharelink=5;
	$campmonth=1;
	$profilelimit=1;
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

<?php include_once "header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once "sidebar.php"; ?> 


   <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      <i class="fa fa-dashboard"></i> Dashboard
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Dashboard</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Your account limit reach exeeded</h4>
    </div>
    <div class="panel-body">
        <h5>Account Type : <?php echo $acc_name; ?></h5>
        <h5>Profile Limit : <?php echo $profilelimit; ?></h5>
        <h5>Link Build Per Day Limit : <?php echo $buildlink; ?></h5>
       <!-- <h5>Link Share Per Day Limit : <?php echo $sharelink; ?></h5>-->
        <h5>Campaign Build Limit Per Month : <?php echo $campmonth; ?></h5>
           <!-- <input type="hidden" value="845" name="id">
            <button value="Yes" class="btn btn-primary" name="del" type="submit">Yes</button>
            <button value="No" class="btn btn-default" name="del" type="submit">No</button>-->
        </div><!-- panel-body -->
</div>                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>

<?php include_once "js/javascript.php"; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".blackscreen").show();
	$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: location.protocol + '//' + location.host+'/click/ajax/justLink/justLinkData.php',
		data: {
		id:1
	},			
	success: function(response) {
		if(response!=''){
			$("#linktbody").html(response);
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
</body>
</html>
