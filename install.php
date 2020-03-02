<?php include_once "config/config.php";

include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';
$objuserData = new user_Controller();
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
  <body class="login-page"  style="background-color:rgb(89, 103, 120)" >
  
  
  <div class="container col-top col-form">
  
    <div class="row">
    
    <div class="col-md-6 col-sm-6 col-img">
     <div class="login-logo">
					<img src="images/clogoimg.png" style="width: 416; height: 160px;">
				</div>
      </div>
      
      <!-- /.login-logo -->
      
      <div class="col-md-6 col-sm-6 col-form-body">
      <p class="login-box-msg"
			style="background:#fff;color: #3d3d3d;font-size: 2.3em;padding-top:25px; padding-bottom:20px; text-align: left; ">Setup Admin Credentials</p>
      <div class="login-box-body">
       
     
       <div style="display:none;" class="callout alrtsuccess">
                    <h4>Message</h4>
                    <p></p>
                  </div>
         
           <div><small id="adminemail_req" style="color: #fdb508;display: none;"> REQUIRED</small></div>
          <div class="form-group has-feedback">
            <input type="name" class="form-control" placeholder="Enter your Email Id"  style="height:40px;" id="adminemail"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div><small id="adminpass_req" style="color: #fdb508;display: none;"> REQUIRED</small></div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password"  style="height:40px;" id="adminpass"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
                        <button type="submit" class="col-loging btn-block btn-flat"  style="height:40px;" onclick="setupapp()" >SETUP</button>
          

      </div><!-- /.login-box-body -->
      </div>
    
    </div><!-- /.login-box -->
    
    </div>
    <script type="text/javascript">
var SITE_ROOT_URL = "<?php echo SITE_ROOT_URL; ?>";
 
</script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/custom_white.js"></script>
   
  </body>
</html>