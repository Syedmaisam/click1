<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT.'session_redirect.php';

$usermailid=$_SESSION['logeid'];

$sql = "SELECT userId FROM tbl_profile where userid='$usermailid'";
$result = mysql_query($sql);
$rowcount=mysql_num_rows($result);

if($rowcount==0 || ($_SESSION['product_level']==5 && $rowcount <100))
{

} 
else
{
$profilepg = SITE_ROOT_URL.'views/Profile';
$_SESSION['profile_msg']="You have limited access to add another profile...";
header("location:$profilepg");
header("location:$profilepg");
}

if($rowcount==0)
{
$sql="INSERT INTO tbl_profile(userId) VALUES ('$usermailid')";
mysql_query($sql);
$profilepg = SITE_ROOT_URL.'views/Profile';
header("location:$profilepg");
}

include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$objProfile = new Profile_Controller();
if(isset($_POST['submit']) && $_POST['submit']=='save')
{
	$objProfile->create_profile($_POST,$_FILES);
	$objGenral->standardRedirect(SITE_ROOT_URL.'views/Profile');
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
</head>
<body class="skin-blue">
<?php include_once SOURCE_ROOT."header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"> <!-- Content Header (Page header) --> <section
	class="content-header">
<h1><i class="fa fa-desktop"></i> Profile <small>Quick overview of stats
and links created</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Profile</a></li>
</ol>
</section> <!-- Main content --> <section class="content">
<div class="contentpanel">

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">Basic info</h4>
</div>
<form id="profileForm" class="form-bordered"
	enctype="multipart/form-data" name="profileForm" method="post"
	action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate><input type="hidden" value=""
	class="field" id="profileid" name="id"><input type="hidden"
	value="20a8e610444c0ee5dd407d2e65aeba3b-52a336cb309cb2c9533207a056140a52"
	name="profilecsrf">
<div class="panel-body">
<div class="form-group">
<div class="col-sm-12"><label class="ccontrol-label">Profile name <small style="color: red;">*</small></label><span style="color: red;display: none;" id="link_name"> Required</span>
<input type="text" value="" placeholder="e.g. Awesome company"
	class="form-control required" id="profilename" name="profilename"
	aria-required="true"> <span class="help-block">Enter the profile name
or title. It will be visible on your LINX window.</span></div>
</div>
<div class="form-group">
<div class="col-sm-12"><label class="control-label">Profile link <small style="color: red;">*</small></label><span style="color: red;display: none;" id="link_profile"> Required</span>
<input type="text" value=""
	placeholder="e.g. http://www.awesomecompany.com"
	class="form-control required" id="profilelink" name="profilelink"
	aria-required="true"> <span class="help-block">Enter a link for your
profile (this is link that will be linked from profile name)</span></div>
</div>
<div class="form-group">
<div class="col-sm-12"><label class="control-label">Profile picture</label>
<div id="logoFile_preview" class="imagefielddisplay">
<div class="media"><a href="javascript:void(0);" class="pull-left">
<div class="image"></div>
</a>
<div class="media-body">
<input type="file" id="profileLogoUploadBtn" name="profileLogoUploadBtn">
<span class="help-block">(200x200 px)</span>
<div id="imagePreview" style="height: 100px;width: 129px;"></div>
</div>
</div>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-12"><label class="control-label">Profile type</label>
<select class="form-control input-sm mb15" id="profileType"
	name="profileType">
	<option value="">Select profile type</option>
	<option value="Website">Website</option>
	<option value="Twitter">Twitter</option>
	<option value="Facebook">Facebook</option>
	<option value="LinkedIn">LinkedIn</option>
	<option value="Google+">Google+</option>
	<option value="Vkontakte">Vkontakte</option>
</select> <span class="help-block">Selecting the right type of profile
helps us target your customers better.</span></div>
</div>
</div>
<div class="panel-footer">
<div class="row text-center">
<div class="btn-group">
<button class="btn btn-primary" type="submit" name="submit" onClick="return profile_form_validate()" value="save">Add new profile</button>
<!--<button data-href="/account/profiles"
	data-confirm-message="Are you sure want to cancel?"
	data-confirm-title="Cancel changes?"
	class="btn btn-default ui-confirm-cancel-link" name="cancel_changes"
	type="button">Cancel</button>-->
</div>
</div>
</div>
</form>
</div>
</div>
</section><!-- /.content --> </aside><!-- /.right-side --></div>
<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script type="text/javascript">
$(function() {
    $("#profileLogoUploadBtn").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>
</body>
</html>
