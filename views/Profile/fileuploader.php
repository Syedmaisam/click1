<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$objDomain = new Domain_Controller();
$uploadedFiles = $objDomain->getUploadedFiles();
$arrDomainData =$objDomain->get_domain();
if($_POST['status']!='' && $_POST['id']!='')
{
	$objDomain->update_status($_POST);
}
?>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>

<style>
.class_new_error
{
	border:1px solid red;
}

.btn {
  font-size: 3vmin;
  padding: 0.75em 1.5em;
  background-color: #fff;
  border: 1px solid #bbb;
  color: #333;
  text-decoration: none;
  display: inline;
  border-radius: 4px;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.btn:hover {
  background-color: #ddd;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.btn-small {
  padding: .75em 1em;
  font-size: 0.8em;
}

.clicks-boxpopup {
  display: none;
  position: absolute;
  z-index: 1000;
  width: 98%;
  background: white;
  border-bottom: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(0, 0, 0, 0.1);
  background-clip: padding-box;
}
@media (min-width: 32em) {

.clicks-boxpopup { width: 70%; }
}

.clicks-boxpopup header,
.clicks-boxpopup .modal-header {
  padding: 1.25em 1.5em;
  border-bottom: 1px solid #ddd;
}

.clicks-boxpopup header h3,
.clicks-boxpopup header h4,
.clicks-boxpopup .modal-header h3,
.clicks-boxpopup .modal-header h4 { margin: 0; }

.clicks-boxpopup .modal-body { padding: 2em 1.5em; }

.clicks-boxpopup footer,
.clicks-boxpopup .modal-footer {
  padding: 1em;
  border-top: 1px solid #ddd;
  background: rgba(0, 0, 0, 0.02);
  text-align: right;
}

.clicksmain-body {
  opacity: 0;
  filter: alpha(opacity=0);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3) !important;
}

a.close {
    color: #bbb;
    font-size: 1.5em;
    line-height: 1;
    position: absolute;
    right: 0;
    text-decoration-color: -moz-use-text-color;
    text-decoration-line: none;
    text-decoration-style: solid;
    top: 5px;
}

a.close:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}
</style>

<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php require_once SOURCE_ROOT.'css.php'; ?>
    <link href="<?php echo SITE_CSS_URL ?>highlight.css" rel="stylesheet">
    <link href="<?php echo SITE_CSS_URL ?>bootstrap-switch.css" rel="stylesheet">
</head>
<body class="skin-blue">
<?php //include_once SOURCE_ROOT."header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left" style="margin-top:15px;"><!-- Left side column. contains the logo and sidebar -->
<?php //include_once SOURCE_ROOT."sidebar.php"; ?> <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side" style="margin-left:40px!important;margin-right:40px!important;"> <!-- Content Header (Page header) --> <section
	class="content-header">
<h1><i class="fa fa-fw fa-upload"></i> File Upload <small></small></h1>
</section> <!-- Main content --> <section class="content" style=" border: 1px solid #ccc!important;">
<div class="contentpanel">

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">Upload Files On Server</h4>
</div>
<?php if(isset($_SESSION) && $_SESSION['file_msg']=="upload"){ ?>
<!-- Start model popup -->
<div class="alert alert-success alert-dismissable col-sm-12" style="width: 98%;">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Success!</b> File uploaded successfully.
                                    </div>
<?php } ?>
<div class="row">
<div class="modal-body">
    <p>Please upload your file here. </p>
    <form action="http://cliks.it/click/upload_files.php" method="post" enctype="multipart/form-data">
    <div class="row">
    			<div class="form-group col-sm-8">
                                            <label>Domain Name</label>
                                            <input type="text" name="domain_name" value="<?php echo $arrDomainData[0]['domain_name']; ?>" readonly placeholder="Enter ..." class="form-control">
                 </div>
    			 <div class="row">
    			<div class="form-group col-sm-12 class_error" style="float: left;margin-left: 2%;">
                                            <label for="exampleInputFile">Select Your File</label>
                                            <input type="file" name="fileToUpload[]" id="exampleInputFile1">
                                            <p style="color: red;" class="exampleInputFile1"></p>
                 </div>
                 <div class="form-group col-sm-12 class_error" style="float: left;margin-left: 2%;">
                                            <label for="exampleInputFile">Select Your File</label>
                                            <input type="file" name="fileToUpload[]" id="exampleInputFile2">
                                            <p style="color: red;" class="exampleInputFile2"></p>
                 </div>
                 <div class="form-group col-sm-12 class_error" style="float: left;margin-left: 2%;">
                                            <label for="exampleInputFile">Select Your File</label>
                                            <input type="file" name="fileToUpload[]" id="exampleInputFile3">
                                             <p style="color: red;" class="exampleInputFile3"></p>
                 </div>
                 <div class="box-footer col-sm-12" style="margin-top: 1.6%;margin-left: 2.2%;">
                                        	<button class="btn btn-primary" onClick="return checkFileValidation()" type="submit" name="submit">Upload</button>
                 </div>
                                   	</div>
                                   	</div>
    </form>
    <p style="color: red;" id="file_error"></p>
  </div>
  
  <div class="box-body table-responsive no-padding col-sm-8" style="margin-left: 3%">
<table class="table table-hover">
	<tbody>
		<tr>
			<th>S.No.</th>
			<th>Uploaded File Url</th>
		</tr>
		<?php if(count($uploadedFiles) > 0){
$j=0;
foreach ($uploadedFiles as $upFiles){
$j=$j+1;
        ?>
		<tr>
			<td><?php echo $j; ?></td>
			<td><a target="_blank" href="http://<?php echo $upFiles['domain_name'].'/'.$upFiles['file_name']; ?>"><?php echo $upFiles['domain_name'].'/'.$upFiles['file_name']; ?></a></td>
		</tr>
		<?php } } else { ?>
		<tr>
			<td colspan="6" style="text-align: center">
			<div class="form-group has-error"><label for="inputError"
				class="control-label">No File Found Yet!</label></div>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
  
</div>


<!-- End model popup -->

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
                                       
                                        <b>Notice!</b> After submit a domain name please update your nameservers : "ns1.inspiredsoft.com" , "ns2.inspiredsoft.com"
                                    </div>
</div>
</div>
<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
		    <script src="<?php echo SITE_ROOT_URL; ?>js/highlight.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/bootstrap-switch.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/main.js"></script> 
    <script>

$(function(){
var appendthis = ("<div class='clicksmain-body clicks_close'></div>");

	$('a[clicskit]').click(function(e) {
    $("body").append();
    $(".clicksmain-body").fadeTo(550, 0.7);
    $(".blackscreen").fadeTo(550, 0.7);
		var mianbox = $(this).attr('clicskit');
		$('#'+mianbox).fadeIn($(this).data());
	});  
  
$(".clicks_close, .clicksmain-body").click(function() {
	$(".blackscreen").fadeOut(550);
	$(".class_error").removeClass('class_new_error');
	$("#file_error").html('');
    $(".clicks-boxpopup, .clicksmain-body").fadeOut(550, function() {
        $(".clicksmain-body").remove();
    });
 
});
 
$(window).resize(function() {
    $(".clicks-boxpopup").css({
        top: ($(window).height() - $(".clicks-boxpopup").outerHeight()) / 2,
        left: ($(window).width() - $(".clicks-boxpopup").outerWidth()) / 2
    });
});
 
$(window).resize();
 
});
</script>
<script type="text/javascript">
var isValid=0;
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

function checkFileValidation()
{
	var file_name = $("input[name='fileToUpload[]']").val();
	var splited_file = file_name.split('.');
	if(isValid==1){
		$(".class_error").removeClass('class_new_error');
		$("#file_error").html('');
		return true;
	} else {
		if(file_name==0)
			{
			$(".exampleInputFile3").html("Please select atleast one file!");
			}
		return false;
	}
	
}


$("input[type='file']").change(function() {
	$(".exampleInputFile3").html("");
    var ele = document.getElementById($(this).attr('id'));
    var idFile = $(this).attr('id');
    var result = ele.files;
    for(var x = 0;x< result.length;x++){
     var fle = result[x];
     var splitUrl = fle.name.split('.');
    // alert(splitUrl[1]);
     if(splitUrl[1]=='html'){
    	 $("."+idFile).html('');
    	 isValid=1;
        $("#output ul").append("<li>" + fle.name + "(TYPE: " + fle.type + ", SIZE: " + fle.size + ")</li>");  
     } else 
         {
         $("."+idFile).html('Please select only html file');
    	 $(this).val('');
         }      
    }
    
});

</script>
</section><!-- /.content --> </aside><!-- /.right-side --></div>
<?php unset($_SESSION['file_msg']); ?>
</body>
</html>