<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$objDomain = new Domain_Controller();
$arrDomainData =$objDomain->get_domain();
if($_POST['status']!='' && $_POST['id']!='')
{
	$objDomain->update_status($_POST);
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Cliks</title>
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
<h1><i class="fa fa-desktop"></i> Profile <small>Domain masking settings</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Domain masking settings</a></li>
</ol>
</section> <!-- Main content --> <section class="content">
<div class="contentpanel">

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">Domain masking settings</h4>
</div>
<form id="profileForm" class="form-bordered" method="post"></form>
<div class="row">
<div class="col-md-6" style="padding:20px;">
	<div class="form-group">
                                            <label for="exampleInputEmail1">Enter your domain name</label>
                                            <input type="text" class="form-control" id="domain_name" placeholder="domain.example.com">
                                        </div>
                                        <div id="errorDom" style="display: none;" class="form-group has-error"><label for="inputError" class="control-label">Please enter valid domain example "example.com".</label></div>
                                        <div class="form-group">
                                           
                                            <button type="button" class="btn btn-primary" onclick="addDomain()">Submit</button>
                                        </div>
</div>
<div class="col-xs-10" style="left: 17px">
<div class="box">
<div class="box-header">
<h3 class="box-title">Domain Masking Detail</h3>

</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
	<tbody>
		<tr>
			<th>S.No.</th>
			<th>Domain Name</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Name Server</th>
			<th>Action</th>
		</tr>
		<?php if(count($arrDomainData) > 0){ ?>
		<tr>
			<td>1.</td>
			<td><?php echo $arrDomainData[0]['domain_name']; ?></td>
			<td>
			<div><input id="switch-size"
				class="check_<?php echo $arrDomainData[0]['id']; ?>" type="checkbox"
				<?php echo ($arrDomainData[0]['domain_status']==1)?"checked":''; ?>
				data-size="mini" data-on-text="On"
				onChange="update_status('<?php echo $arrDomainData[0]['id']; ?>')"
				data-label-width="20"></div>
			</td>
			<td><?php  echo $objJustLink->getTimes($arrDomainData[0]["created_date"]); ?></td>
						<td><small><b>ns1.instantdomainsniper.com</b></small><br/><small><b>ns1.instantdomainsniper.com</b></small></td>
			<td><i style="cursor: pointer;" title="Edit" onclick="edit_domain('<?php echo $arrDomainData[0]['domain_name']; ?>')" class="fa fa-fw fa-pencil-square-o"></i></td>
		</tr>
		<?php } else { ?>
		<tr>
			<td colspan="6" style="text-align: center">
			<div class="form-group has-error"><label for="inputError"
				class="control-label">No record found yet!</label></div>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<!-- /.box-body --></div>
<!-- /.box --></div>
</div>
<div class="alert alert-info alert-dismissable" style="width: 52%;display: none;" id="sus_msg">
                                        <i class="fa fa-info"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Success!</b> Info alert preview. This alert is dismissable.
                                    </div>

<div class="alert alert-danger alert-dismissable" id="error_msg" style="width: 52%;display: none;">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b> This Domain is already registered !.
                                    </div>

<div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                       
                                        <b>Notice!</b> After submit a domain name please update your nameservers : "ns1.instantdomainsniper.com" , "ns2.instantdomainsniper.com"
                                    </div>
</div>
</div>
<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
		    <script src="<?php echo SITE_ROOT_URL; ?>js/highlight.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/bootstrap-switch.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/main.js"></script> 
<script type="text/javascript">
function update_status(links)
{
	if($(".check_"+links).is(":checked"))
	{
		var status = 1;

	} else 
	{
		var status = 0;

	}
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
		status: status,
		id:links
	},   
	success: function(response) {

	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	});  
}
function addDomain()
{
	var domain_name = $("#domain_name").val();
	var urlRegex = '(http)|(ww)';  
	var domain_reg = new RegExp(urlRegex);
	if(domain_name!='')
		{
	if(domain_name.match(domain_reg)){
			$("#domain_name").css('border','1px solid red');
			$("#errorDom").show();
			
		} else {
		$(".blackscreen").show();
		$(".loader_popup").show();
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'Domain_masking/masking.php',
			data: {
			domain_name:domain_name
		},			
		success: function(response) {
			//$("#addLinkdata").html(response);
			if(response=="added")
				{
					$("#sus_msg").show();
 location.reload(); 
				} else 
				{
					$("#error_msg").show();
				}
			$(".blackscreen").hide();
			$(".loader_popup").hide();

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
		}); 
		}
		} else 
		{
			$("#domain_name").css('border','1px solid red');
		}
	//alert(domain_name);
}
function edit_domain(domain_name)
{
	var urlRegex = '(http)|(ww)'; 
	 var domain_reg = new RegExp(urlRegex);
	if(domain_name.match(domain_reg))
		{
		 alert("mathch");
		} else 
			{
			$("#domain_name").focus();
			$("#domain_name").val(domain_name);
			}

}
</script>
</section><!-- /.content --> </aside><!-- /.right-side --></div>
</body>
</html>