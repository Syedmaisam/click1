<?php 
include_once "config/config.php";
//include_once SOURCE_ROOT.'session_redirect.php';
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';

$_SESSION['logeid']="";
$_SESSION['username']="";
$_SESSION['user']="";
$_SESSION['id']="";
$_SESSION['user_control']="";
$_SESSION ['trialuser'];
session_unset();
session_destroy();

$url=$_SERVER['REQUEST_URI'];

$uex=explode("/", $url);

$token=$_REQUEST['regcode'];

$objuserData = new user_Controller();


$udatap=$objuserData->get_All_User();


if($udatap=="" || $udatap==null)
{
	header("location:".SITE_ROOT_URL."install.php");
}


$arrData=$objuserData->verify_token($token);


$colorData=$objuserData->get_all_settings();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo SITE_TITLE; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
  <body class="login-page" style="background-color:<?php echo $colorData[0]['LoginPageBgColor'] ?>">
  <div class="container col-top2 col-form">
 
    <div class="row">
    <div class="col-md-6 col-sm-6 col-img2">
      <div class="login-logo">
        <a href="#"><?php if($colorData[0]['logoType']=='Image') {?><img style="width:416px;height:160px;" src="<?php echo SITE_ROOT_URL; ?>images/<?php echo $colorData[0]['logoImage']; ?>"><?php } else {?><span class="logotx"><?php echo $colorData[0]['logoTxt']; ?></span><?php }?></a>
      </div>
      </div><!-- /.login-logo -->
      <div class="col-md-6 col-sm-6 col-form-body2">
      <p class="login-box-msg"
			style="background:#fff;color: #3d3d3d;font-size: 2.3em;padding-top:25px; padding-bottom:20px; text-align: left; ">Register New Account</p>
      <div class="login-box-body ">
      <p class="col-error">
       <?php 
       if(end($uex)=="registration.php")
       {
       	echo "Invalid URL";
       }
       else if($arrData[0]==NULL)
       {
       	echo "Invalid registration code";
       }
       else if($arrData[0]['SignupStatus']=='Signup Disabled')
       {
       	echo "Registration is currently Disabled by admin...";
       }
       else
       {
       ?>
       </p>
       <div style="display:none;" class="callout alrtsuccess">
                    <h4>Message</h4>
                    <p></p>
                  </div>
          <div><small id="name_req" style="color: #fdb508;display: none;"> REQUIRED</small></div>
          <div class="form-group has-feedback">
           
            <input type="text" class="form-control" placeholder="Your Name" style="height:40px;" id="name"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            
          </div>
          
          <div><small id="mailaddress_req" style="color: #fdb508;display: none;"> REQUIRED : </small> <small id="mailaddress_confirm" style="color: #fdb508;display: none;"> Please enter valid Email address...</small></div>
    
           <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email Address" style="height:40px;" id="mailaddress"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div><small id="pword_req" style="color: #fdb508;display: none;"> REQUIRED</small></div>
           <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" style="height:40px;" id="pword"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div><small id="repword_req" style="color: #fdb508;display: none;"> REQUIRED</small></div>
          <div><small id="repword_req_confirm" style="color: #fdb508;display: none;"> Password not matched...</small></div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype Password"  style="height:40px;" id="repword"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
        
  <button type="submit" class="col-loging btn-flat"  style="height:40px;" onclick="signupuser()">Register</button>
     

      </div><!-- /.login-box-body -->
      
          <?php 
       }
          ?>
    </div>
    </div></div><!-- /.login-box -->
    <script type="text/javascript">
var SITE_ROOT_URL = "<?php echo SITE_ROOT_URL; ?>";
 
</script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/custom_white.js"></script>
   
  </body>
</html>