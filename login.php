<?php
include_once "config/config.php";
include_once SOURCE_ROOT_CONTROLLER . 'User/adduser.php';
$objuserData = new user_Controller ();
$colorData = $objuserData->get_all_settings ();

$udatap = $objuserData->get_All_User ();

if ($udatap == "" || $udatap == null) {
	header ( "location:" . SITE_ROOT_URL . "install.php" );
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- Bootstrap 3.3.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    

    
</head>
<body class="login-page"   style="background-color:<?php echo $colorData[0]['LoginPageBgColor'] ?>">

	<div class="container col-top col-form">

		
		<!-- /.login-box-body -->
		<div class="row">

			<div class="col-md-6 col-sm-6 col-img">
				<div class="login-logo">
					<a href="#"><?php if($colorData[0]['logoType']=='Image') {?><img
						src="<?php echo SITE_ROOT_URL; ?>images/<?php echo $colorData[0]['logoImage']; ?>"
						style="width: 416; height: 160px;"><?php } else {?><span
						class="logotx"><?php echo $colorData[0]['logoTxt']; ?></span><?php }?></a>
				</div>
				<!-- /.login-logo -->
			</div>



			<div class="col-md-6 col-sm-6 col-form-body">
			<p class="login-box-msg"
			style="background:#fff;color: #3d3d3d;font-size: 2.3em;padding-top:25px; padding-bottom:20px; text-align: left; ">Login
			to your account</p>
		<div class="login-box-body">
			<div style="display: none;" class="callout alrtsuccess">
				<h4>Message</h4>
				<p></p>
			</div>
			<div>
				<small id="usermail_req" style="color: #fdb508; display: none;">
					REQUIRED</small>
			</div>
			<div class="form-group has-feedback ">
				<input type="text" class="form-control" placeholder="Email"
					 id="mailid" /> <span
					class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div>
				<small id="upassword_req" style="color: #fdb508; display: none;">
					REQUIRED</small>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password"
					id="pword" /> <span
					class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>



			<!--  <a href="#">I forgot my password</a><br> -->
				<button type="submit" class="col-loging btn-block btn-flat"
					style="height: 40px;" onclick="verifylogin()">Login</button>
<a href="forgotpassword.php" style="line-height: 60px;">Forgot Password </a>

		</div>

			</div>
			<!-- /.col -->
		</div>
	</div>

	<!-- /.login-box -->
	<script type="text/javascript">
var SITE_ROOT_URL = "<?php echo SITE_ROOT_URL; ?>";
 
</script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/custom_white.js"></script>

	<script type="text/javascript">
$(".login-page").keypress(function(event) {
	
    if (event.which == 13) {        
        $(".btn-flat").click();
     }
});
</script>

</body>
</html>