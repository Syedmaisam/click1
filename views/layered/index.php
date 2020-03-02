<!Doctype html>
<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
$objJustLink = new Justlink_Controller();
$objLayered = new Layered_Controller();
$objDomain = new Domain_Controller();
$arrDomianData = $objDomain->get_domain();
$j=0;
$limit_from= ($arrUrl[1]-1)*5;
$limit_to= 5;
$limit = ($arrUrl[1]!='')?" $limit_from,$limit_to":5;
$j=($arrUrl[1]!='')?($arrUrl[1]-1)*5:0;
$arrLayeredData = $objLayered->get_layered('','','',$limit);
$arrCountLayered = $objLayered->get_layered();
$total_records = count($arrCountLayered);
$total_pages = ceil($total_records / 5);
if($_POST['q']=='delete' && $_POST['i']!='')
{
	$objLayered->delete_layered($_POST['i']);
}
if($_POST['st']=='st' && $_POST['status']!='' && $_POST['po_id']!='')
{
	$objLayered->change_status($_POST['status'],$_POST['po_id']);
}
include_once SOURCE_ROOT.'controller/image/getProfileValueController.php';
$objProfile  = new getProfileValueController();
$arrProfileData = $objProfile->getProfileImage();
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

<?php include_once SOURCE_ROOT."header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"> <!-- Content Header (Page header) --> <section
	class="content-header">
<h1><i class="fa fa-ticket"></i> Templates <small>Quick overview of stats and
links created</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Templates</a></li>

</ol>
</section> <!-- Main content --> <section class="content">



<div class="contentpanel">

<div class="panel panel-default">
<div class="panel-heading">

<h3 class="panel-title">Last created links</h3>
<p>Below you can see all links you've created previously</p>
</div>
<div class="panel-body">
<div class="row text-center mb30"><a class="btn btn-primary"
	href="<?php echo SITE_ROOT_URL.'views/layered/add.php' ?>"><i class="fa fa-link"></i> Create new
link</a></div>
<div class="table-responsive">
<table class="table table-hidaction table-hover mb30">
	<thead>
		<tr>
			<th>
			<div class="col-xs-4"><i class="fa fa-picture-o"></i></div>
			</th>
			<th>Message</th>
			<th>Created</th>
			<!--<th class="min-wid-75">Submits</th> -->
			<th>Impressions</th>
			<th>Published</th>
			<th class="min-wid-115">Action</th>
		</tr>
	</thead>
	<tbody>
	<!--	Start Popup View	-->
	<?php  foreach ($arrLayeredData as $layeredData){ $j=$j+1; ?>
	<tr class="del_<?php echo $layeredData['poup_id']; ?>">
			<td>
			<div class="col-xs-4"><?php echo $j; ?></div>
			</td>
			<td class="col-md-6"><small id="sharetitle_<?php echo $layeredData['poup_id']?>"><?php echo $layeredData['popup_title']; ?></small>
			<div class="input-group mt10 col-md-10"><input id="sharelink_<?php echo $layeredData['poup_id']?>" type="text" value="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$layeredData['layered_randUrl']:SITE_ROOT_URL.$layeredData['layered_randUrl']; ?>"
				class="form-control linkContentSelect" placeholder=""> <span
				class="input-group-btn"> <a 
				data-original-title="Copy to clipboard" id="copy-dynamic_<?php echo $j ;?>"
				data-placement="bottom"
				title="Copy link to clipboard"
				class="link-copy-btn btn btn-primary mr10 button-right" data_tip='<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$layeredData['layered_randUrl']:SITE_ROOT_URL.$layeredData['layered_randUrl']; ?>' ><i
				class="fa fa-copy"></i> <span>Copy</span></a> <a
				class="btn btn-primary button-left"
				data-original-title="View Layered Popup" data-toggle="tooltip"
				data-placement="bottom" title="View Layered Popup" target="_blank"
				href="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$layeredData['layered_randUrl']:SITE_ROOT_URL.$layeredData['layered_randUrl']; ?>"><i class="fa fa-eye"></i> <span>View</span></a>
				<a
				class="btn btn-primary button-left"
				data-original-title="Share Popup" data-toggle="tooltip"
				data-placement="bottom" title="Share Popup"onclick="showsharepopup(<?php echo $layeredData['poup_id']?>);"><i
				class="fa fa-share"></i><span>Share</span></a>
				</div>
			</td>
			<td><small><?php echo $objJustLink->getTimes($layeredData['popup_created_date']); ?></small></td>
			<!--<td><span><i class="fa fa-eye"></i> <?php //$submitdata = $objLayered->getSubmitCount($layeredData['poup_id']); echo (count($submitdata) > 0 && $submitdata[0]['submit_count']!='0')?$submitdata[0]['submit_count']:0; ?></span></td> -->
			<td style="text-align: center;"><span><i class="fa fa-user"></i> <?php $arrCountData = $objLayered->onloadImpression($layeredData['layered_randUrl']); echo $arrCountData[0]["count(id)"] ?> </span></td>
			<td>
			<div >
			<input id="switch-size" class="check_<?php echo $layeredData['poup_id']; ?>" type="checkbox" <?php echo ($layeredData['popup_status']==1)?"checked":''; ?> data-size="mini" data-on-text="Publish" onChange="change_status('<?php echo $layeredData['poup_id']; ?>')" data-label-width="20">
			</div>
			</td>

			<td>
			<div style="width: 80px;" class="btn-group pull-right  mr10"><a class="btn btn-primary"
				href="<?php echo SITE_ROOT_URL.'views/layered/edit.php/'.$layeredData['poup_id']; ?>">Edit</a>
			<button style="height: 34px;" data-toggle="dropdown"
				class="btn btn-primary dropdown-toggle" type="button"><span
				class="caret"></span> <span class="sr-only">Toggle Dropdown</span></button>
			<ul role="menu" class="dropdown-menu">
				<li><a href="<?php echo SITE_ROOT_URL.'views/layered/edit.php/'.$layeredData['poup_id']; ?>">Edit</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo SITE_ROOT_URL.'views/layered/analytics.php/'.$layeredData['layered_randUrl']; ?>">Analytics</a></li>
				<li class="divider"></li>
				<li><a data-del-callback-func="deleteRowItem"
					data-href="/links/delete/9061"
					data-confirm-message="Are you sure want to delete this link?"
					data-confirm-title="Delete link?" class="ui-confirm-delete-link"
					style="cursor: pointer;" onClick="delete_layered('<?php echo $layeredData['poup_id']; ?>')">Delete</a></li>
			</ul>
<input type="hidden" id="hid_<?php echo $layeredData['poup_id'];?>" value="<?php echo SITE_ROOT_URL.'/images/profile/'.$arrProfileData[0]['profile_image_path'];?>">
			</div>
			<!-- btn-group --></td>
		</tr>
			<!--	End Popup View	-->
			<?php } ?>
		
	</tbody>
</table>

</div>
<!-- table-responsive -->

<div class="box-tools pull-right">
<ul class="pagination pagination-sm inline">

	<li><a href="<?php echo SITE_ROOT_URL.'views/layered/index.php/1'; ?>">«</a></li>
	<?php for ($p=1;$p<=$total_pages;$p++){  ?>
	<li><a  href="<?php echo SITE_ROOT_URL.'views/layered/index.php/'.$p; ?>"><?php echo $p; ?></a></li>
	<?php }//exit;} ?>
	<li><a href="<?php echo SITE_ROOT_URL.'views/layered/index.php/'.$total_pages; ?>">»</a></li>
</ul>
</div>
</div>
<!-- col-md-6 --></div>
<!-- panel -->
<div class="row text-center"><a class="btn btn-primary"
	href="<?php echo SITE_ROOT_URL.'/views/layered/add.php' ?>"><i class="fa fa-link"></i> Create new
link</a></div>
</div>
</div>
	<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
    <script src="<?php echo SITE_ROOT_URL; ?>js/highlight.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/bootstrap-switch.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/main.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
var j = 1;
 var from =<?php echo ($limit_from<0)?1:$limit_from ?>;
 var limitto = 5+from;
 for(j=from;j<=limitto; j++)
 {
 $("#copy-dynamic_"+j).zclip({
     path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
        copy:function(){return $(this).attr('data_tip');}
     });
 }
});
</script>
</body>
</html>

