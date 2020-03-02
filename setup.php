<?php
session_start ();
if (isset ( $_POST ['dbhostname'] )) {
	
	$dbhostname = $_POST ['dbhostname'];
	$dbusername = $_POST ['dbusername'];
	$dbpassword = $_POST ['dbpassword'];
	$dbname = $_POST ['dbname'];
	
	@$conn = new mysqli ( $dbhostname, $dbusername, $dbpassword, $dbname );
	// Check connection
	if (@$conn->connect_error) {
		
		$_SESSION ['conerror'] = "Invalid Database Credentials";
		header ( "location:setup.php" );
	} else {
		$_SESSION ['conerror'] = "";
	}
	
	$applicationfolder = $_POST ['applicationfolder'];
	$Content = "<mainnode>
					<dbhostname>$dbhostname</dbhostname>
					<dbusername>$dbusername</dbusername>
					<dbpassword>$dbpassword</dbpassword>
					<dbname>$dbname</dbname>
					<applicationfolder>$applicationfolder</applicationfolder>
	</mainnode>";
	$handle = fopen ( "configXML.xml", "w" );
	fwrite ( $handle, $Content );
	fclose ( $handle );
	
	header ( 'Content-Type: application/octet-stream' );
	header ( 'Content-Disposition: attachment; filename=' . basename ( 'configXML.xml' ) );
	header ( 'Expires: 0' );
	header ( 'Cache-Control: must-revalidate' );
	header ( 'Pragma: public' );
	header ( 'Content-Length: ' . filesize ( 'configXML.xml' ) );
	readfile ( 'configXML.xml' );
	exit ();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Application | Installation</title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- Bootstrap 3.3.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->

<!-- Theme style -->
<link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body class="login-page" style="background-color: rgb(89, 103, 120);">
	<div class="container col-top3 col-form">

		<div class="row">

			<div class="col-md-6 col-sm-6 col-img3">
				<div class="login-logo">
					<img src="images/clogoimg.png" style="width: 416; height: 160px;">
				</div>
				<!-- /.login-logo -->
			</div>


			<div class="col-md-6 col-sm-6 col-form-body">
				<form  action="<?php echo $_SERVER['PHP_SELF']?>" class="subtheform" onsubmit="return CallNewFunc()"
					method="post">

					<p class="login-box-msg"
						style="background: #fff; color: #3d3d3d; font-size: 2.3em; padding-top: 25px; padding-bottom: 20px; text-align: left;">Setup
						Application</p>
					<div class="login-box-body">
						<div>
							<small id="dberror" style="color: #fdb508; display: block;"> <?php  if(isset($_SESSION['conerror'])){ echo $_SESSION['conerror']; } ?></small>
						</div>
						<div>
							<small id="adminemail_req" style="color: #fdb508; display: none;">
								REQUIRED</small>
						</div>
						<div class="form-group has-feedback">
							<input type="name" class="form-control"
								placeholder="Database host name" style="height: 40px;"
								name="dbhostname" required="required" /> <span
								class="glyphicon glyphicon-envelope form-control-feedback"></span>
						</div>


						<div>
							<small id="adminpass_req" style="color: #fdb508; display: none;">
								REQUIRED</small>
						</div>
						<div class="form-group has-feedback">
							<input class="form-control" placeholder="Database user name"
								style="height: 40px;" name="dbusername" required="required" /> <span
								class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>


						<div>
							<small id="adminpass_req" style="color: #fdb508; display: none;">
								REQUIRED</small>
						</div>
						<div class="form-group has-feedback">
							<input type="password" class="form-control"
								placeholder="Database password" style="height: 40px;"
								name="dbpassword" /> <span
								class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>


						<div>
							<small id="adminpass_req" style="color: #fdb508; display: none;">
								REQUIRED</small>
						</div>
						<div class="form-group has-feedback">
							<input class="form-control" placeholder="Database name"
								style="height: 40px;" id="adminpass" name="dbname"
								required="required" /> <span
								class="glyphicon glyphicon-cog form-control-feedback"></span>
						</div>



						<div>
							<small id="adminpass_req" style="color: #fdb508; display: none;">
								REQUIRED</small>
						</div>
						<div class="form-group has-feedback">
							<input class="form-control" placeholder="Application folder name"
								style="height: 40px;" name="applicationfolder"
								required="required" /> <span
								class="glyphicon glyphicon-folder-open form-control-feedback"></span>
						</div>
						<div class="col-xs-12 bsetup" style="padding-left: 0px;">
							<button type="submit" name="submit" 
								class="col-loging btn-block btn-flat"
								style="height: 40px; float: left;">SETUP</button>
						</div>
						<div class="col-xs-12" id="myshowdiv"
							style="padding: 0px; display: none;">
							<button onclick="ChangeUrl()" type="button" name="submit"
								class="col-loging btn-block btn-flat">NEXT</button>
						</div>

					</div>
					<!-- /.login-box-body -->


				</form>

			</div>



		</div>
		<!-- /.login-box -->

	</div>

	<script type="text/javascript"> 
	
	function CallNewFunc()
	{
		$("#dberror").html("");
		var url= window.location.href;
		url= url.split("/");
		 
		
		var hostname=$("input[name='dbhostname']").val();
		var dbusername=$("input[name='dbusername']").val();
		var dbname=$("input[name='dbname']").val();
		var applicationfolder=$("input[name='applicationfolder']").val();
		if(hostname != "" && dbusername != "" && dbname != "" && applicationfolder != "")
		{			
			if(applicationfolder==url[3])
			{												
				$("#myshowdiv").show();
				$(".bsetup").hide();
				$("#dberror").html("");
				return true;	
				//document.getElementById("subtheform").submit();
			}	
			else
			{
				$("#dberror").html("Invalid Application Folder Name");		
				return false;		
			}
		
		}
	}
	function ChangeUrl()
    {
        var previousurl = window.location.href;
        var UrlColl = previousurl.split("/");        
        var newurl = UrlColl[0]+'//'+UrlColl[2]+'/'+UrlColl[3]+'/'+'install.php';
        location.assign(newurl);
        
    }
</script>
	
	

</body>
</html>