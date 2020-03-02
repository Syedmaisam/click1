<?php 
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink_byRand($arrUrl[1]);
if($arrUrl[1]!='' && $arrLinkData!=NULL){
$linkData = $arrLinkData[0];
?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT_URL; ?>popup/css/style.css" />
<script type="text/javascript" src="http://cdn.asif18.com/js/jquery-1.9.1.js"></script>
<script type="text/javascript">
function load_as_lightbox(){ 
	var DocumentHeight = $(document).height();
	$('.as_lightbox_wrapper').css('height', DocumentHeight); // Set document height for As_Lightbox wrapper
}
function ShowLightBox(DivId){
	$('.as_lightbox_wrapper').show(); // Show the wrapper
	$('#'+DivId+'').show('slow'); // Show the Lightbox div, you can use another jQuery view functions such as fadeIn, fadeToggle for animations
}
function HideLightBox(DivId){
	$('.as_lightbox_wrapper').hide('slow'); // Hide the As_Lightbox wrapper
	$('#'+DivId+'').hide(); // Hide the div
}
$(document).ready(function(){
	load_as_lightbox(); 
	setTimeout(function(){ ShowLightBox('Simple_Lightbox'); }, 30);
	//ShowLightBox('Simple_Lightbox');// call this function after document loads
	
	$('#as_lightbox_close').click(function(){
		HideLightBox('Simple_Lightbox'); // call the As_Lightbox close function
		return false;
	});
});
</script>
<style type="text/css">
.as_wrapper{
	font-family:Arial;
	color:#333;
	font-size:14px;
	padding:20px;
	border:2px dashed #17A3F7;
	width:500px;
	margin:0 auto;
	margin-top:50px;
}
</style>

<!-- AS_lightbox div (division) starts -->
<div class="as_lightbox_wrapper" style="background: url('<?php echo SITE_ROOT_URL; ?>popup/images/as_popup_wrapper_bg.png')"></div> <!-- As_lightbox wrapper (half transparent background) -->
<div class="as_lightbox_container" id="Simple_Lightbox"> <!-- Set ID As_Lightbox here -->
	<div class="as_lightbox">
		<div class="as_lightbox_close" id="as_lightbox_close">
        	<img src="<?php echo SITE_ROOT_URL; ?>popup/images/close_flat_icon.png" alt="Close Lightbox" title="Close" />
        </div> <!-- As_Lightbox close icon -->
        <div class="as_clear"></div>
        <!-- As_Lightbox contents will starts here-->
        <div>
<iframe id="linkUrl" name="linkUrl" src="<?php echo $linkData['link_url']; ?>" style="height: 100%; width: 100%; border:none;"></iframe>
        
        </div>
        
        
        <!-- As_Lightbox contents ends here -->
	</div>
</div>
<!-- AS_lightbox div (division) Ends -->
<!--<div>
  <a id="Show_Lightbox" class="as_a">click</a></h1>
</div>
-->


<iframe id="destinationUrl" name="destinationUrl" src="<?php echo $linkData['destination_url']; ?>" style="height: 100%; width: 100%; border:none;">
</iframe>
<?php } else { ?>

<html>
<head>
<meta charset="UTF-8">
<title>Linx</title>
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
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        500 Error Page
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">500 error</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="error-page">
                        <h2 class="headline">500</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Something went wrong.</h3>
                            <p>
                                Page not found! Invalid url <a href='<?php echo SITE_ROOT_URL; ?>'>return to dashboard</a> or try using the search form.
                            </p>
                           
                        </div>
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


</body>
</html>

<?php } ?>