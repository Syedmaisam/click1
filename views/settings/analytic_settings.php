<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
 if($_SESSION['usertype']!="admin")
                        {
header("location:".SITE_ROOT_URL."index.php");
}
include_once SOURCE_ROOT.'controller/User/Profile.php';

$analyticobj = new Profile_Controller();

if (isset ( $_POST ['submit'] )) {	

	$target_dir = SOURCE_ROOT.'p/';
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$databasepath = basename($_FILES["fileToUpload"]["name"]);	
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
		$check = true;//getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {				
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		} 
	}	
	$analyticobj->SaveAnalyticData($_POST, $databasepath);	
}
//echo "<pre>";
$result = $analyticobj->GetAnalyticData();
//var_dump($result); exit;

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
<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> 


   <!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-bar-chart-o"></i> Analytic Settings <small>Set Credentials</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Analytic Settings</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content">



				<div class="contentpanel">

					<div class="content-js-nocss">

						<div class="box box-info">

							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> 

								<div class="box-body">
									<div class="callout callout-success alert-success alrtsuccess"
										style="display: none;">
										<h4>Message</h4>
										<p>Analytic Settings updated successfully...</p>
									</div>
									<!-- Color Picker -->
									<div class="row">
										<div class="form-group col-md-6">
											<label>Track ID</label> <input type="text" value="<?php echo $result[0]['trackid']?>"
												class="form-control" id="trackid" name="trackid">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Google Service Account Email Address</label> <input value="<?php echo $result[0]['serviceaccount']?>"
												type="text" class="form-control" id="serviceaccount" 
												name="serviceaccount">

										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Google Application Name</label> <input type="text" value="<?php echo $result[0]['applicationname']?>"
												class="form-control" id="applicationname"
												name="applicationname">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Track Code</label> 
												<textarea placeholder="" style="height: 200px;" id="trackcode" class="form-control" name="trackcode"><?php echo $result[0]['trackcode']?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-4">
											<label>Select P12 File</label>
											<div class="input-group ">
												<input type="file" name="fileToUpload" class="form-control" 
												id="logoimage" accept=".p12" onChange="Checkfiletype('this')"
													style="padding-bottom: 40px;">

											</div>
											
											<!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->
											<!-- /.input group -->
										</div>										
									</div>
									<div class="row">
										<div class="col-md-6">
											<button type="submit" name="submit"
												onclick="return checkanalyticdata()"
												class="btn btn-primary btn-block btn-flat"
												style="height: 40px;">Save</button>
										</div>
									</div>

								</div>

							</form>
						</div>
						<!-- /.box-body -->

					</div>
				</div>
				<!-- /.box-body -->
	
	</div>


	<!-- panel -->


	</div>
	</div>


	</section>
	<!-- /.content -->
	</aside>
	<!-- /.right-side -->


	</div>

<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script type="text/javascript">
function checkanalyticdata()
{
	var trackid = $("#trackid").val();
	var serviceaccount = $("#serviceaccount").val();
	var applicationname = $("#applicationname").val();
	var trackcode = $("#trackcode").val();
	var ext= $("#logoimage").val();
	if(trackid != "" && serviceaccount != "" && applicationname != "" && trackcode != "" && ext.indexOf(".p12") !== -1)
	{
		// Ready to submit
		return true;
	}
	else
	{
		if(ext.indexOf(".p12") !== -1)
		{
			alert("All fields Required");
		}
		else
		{
			alert("Please enter a valid file");
		}		

		return false;
	}
}
function Checkfiletype(oForm)
{
	var ext= $("#logoimage").val();
	if(ext.indexOf(".p12") !== -1)
	{
		//alert("Correct");
	}
	else
	{
		$("#logoimage").val("");
	}	
}

</script>

</body>
</html>
