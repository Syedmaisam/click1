<?php 
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';
$objuserData = new user_Controller();
$colorData=$objuserData->get_all_settings();
?>


<style>
	.blackscreen
	{
		width:100%;
		height:100%;
		position:fixed;
		background:#000;
		opacity:0.7;
		left:0;
		top:0;
		z-index:1500;
	}
	.loader_popup
	{
		width:30px;
		height:30px;
		position:absolute;
		z-index:2000;
		top:45%;
		left:50%;
	}
	.loader_popup img
	{
		width:50px;
		height:50px;
	}
	</style>
    <script type="text/javascript" src="<?php echo SITE_ROOT_URL.'js/ga_social_tracking.js'; ?>"></script>
 
<!--share popup -->
    <?php 
    if($_SESSION['logeid']=="")
    
    {
    	
    	header("location:".SITE_ROOT_URL."login.php");
    }
    ?>



<div id="sharepopup" style="display:none;z-index: 50000; position: fixed; width: 700px; margin: auto; top:20%; left:30%;">
       
    </div>


<!-- End share Popup -->





<header class="header">
<a
	href="<?php echo SITE_ROOT_URL."index.php"; ?>" class="logo"  style="background-color:<?php echo $colorData[0]['LandPColor'] ?>"> <!-- Add the class icon to your logo image or logo icon to add the margining -->
<?php if($colorData[0]['logoType']=='Image') {?><img src="<?php echo SITE_ROOT_URL; ?>images/<?php echo $colorData[0]['logoImage']; ?>" style="width:147px; height:46px;float:left;padding-top:3px; margin-right:10px;"><?php } else {?><span class="logotx"><?php echo $colorData[0]['logoTxt']; ?></span><?php }?> </a>
<!-- Header Navbar: style can be found in header.less -->
<nav
	class="navbar navbar-static-top" role="navigation" style="background-color:<?php echo $colorData[0]['TopBarBgColor'] ?>">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas"
	role="button"> <span class="sr-only">Toggle navigation</span> <span
	class="icon-bar"></span> <span class="icon-bar"></span> <span
	class="icon-bar"></span> </a>
	<?php if($_SESSION['user_control']=='0'){ ?>
	<a class="btn btn-success" href="#" onclick="backtoadmin()" style="margin-top: 8px; margin-left: 38%;">Back to Admin</a>
	<?php } ?>
<div class="navbar-right"  style="background-color:<?php echo $colorData[0]['LandPColor'] ?>">
<ul class="nav navbar-nav">
	<!-- Messages: style can be found in dropdown.less-->

	<!-- Notifications: style can be found in dropdown.less -->

	<!-- Tasks: style can be found in dropdown.less -->

	<!-- User Account: style can be found in dropdown.less -->
	<li class="dropdown user user-menu"><a style="padding:10px!important;" href="#" class="dropdown-toggle"
		data-toggle="dropdown"><?php if($_SESSION['userpicpath']=="") { ?> <i class="glyphicon glyphicon-user" style="border-radius: 25px; background: #5c8cca; height: 32px; width: 32px; text-align: center; line-height: 26px;"></i> <span><?php echo $_SESSION['userName']; ?>
	<i class="caret"></i></span><?php } else {?><img src="<?php echo SITE_ROOT_URL; ?>images/profile/<?php echo $_SESSION['userpicpath']; ?>" class="img-circle" alt="User Image" style='height:32px;width:32px;' /><?php } ?> </a>
	<ul class="dropdown-menu">
		<!-- User image -->
		<li class="user-header bg-light-blue"><?php if($_SESSION['userpicpath']=="") { ?>
		<img src="<?php echo SITE_ROOT_URL; ?>img/defaultuser.png" class="img-circle" alt="User Image" /> <?php } else { ?>
		<img src="<?php echo SITE_ROOT_URL; ?>images/profile/<?php echo $_SESSION['userpicpath']; ?>" class="img-circle" alt="User Image" /> <?php } ?>
		<p>Welcome - <?php echo $_SESSION["logeid"]; ?> </p>
		</li>
		<!-- Menu Body -->
		<li class="user-body">
		<div class="col-xs-4 text-center"><a></a></div>
		<div class="col-xs-4 text-center"><a></a></div>
		<div class="col-xs-4 text-center"><a></a></div>
		</li>
		<!-- Menu Footer-->
		<li class="user-footer">
		<div class="pull-left"><a href="<?php echo SITE_ROOT_URL.'views/Profile'; ?>"
			class="btn btn-default btn-flat">Profile </a></div>
		<div class="pull-right"><a href="<?php echo SITE_ROOT_URL; ?>logout.php"
			class="btn btn-default btn-flat">Sign out</a></div>
		</li>
	</ul>
	</li>
</ul>
</div>
</nav>



</header>

<div class="blackscreen" style="display:none;"></div>
<div class="loader_popup" style="display:none;"><img src="<?php echo SITE_ROOT_URL; ?>images/loader.GIF" /></div>
<div id="main-wrapper">
<script type="text/javascript">
var SITE_ROOT_URL = "<?php echo SITE_ROOT_URL; ?>";
 
</script>


