<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objProfile = new Profile_Controller();

$uid = $_SESSION['user']['id'];

if(isset($_POST['submit']) && $_POST['submit']!='')
{
	$script = $_POST['savescript'];
	if($script != '' && $script != null)
	{
		$arrData = $objProfile->save_SciptData($uid,$script);
	}
	
}
$result = $objProfile->get_SciptData($uid);
$result_script = $result[0]["script"];

?>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<script type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<style>
.mpopup {
	background: rgb(244, 244, 244);
	margin: 8% auto auto 10px;
	padding: 1px;
	position: absolute;
	text-align: left;
	width: 95%;
	z-index: 100;
	border-radius: 6px;
	border: 1px solid #333;
}

.mpopup ul li {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 31px;
	list-style: none;
}

.mpopup a {
	float: right;
}

.mpopup ul {
	margin-top: 20px;
	margin-bottom: 20px;
}

.round-button {
	display: block;
	width: 22px;
	height: 22px;
	line-height: 18px;
	border: 2px solid #f5f5f5;
	border-radius: 50%;
	color: #f5f5f5;
	text-align: center;
	text-decoration: none;
	background: #464646;
	box-shadow: 0 0 3px gray;
	font-size: 20px;
	font-weight: bold;
	float: right;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}

.round-button:hover {
	background: #262626;
}
</style>

</style>


<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php require_once SOURCE_ROOT.'css.php'; ?>
</head>

<script type="text/javascript">
      $(function() {
        var moveLeft = 20;
        var moveDown = 10;
        
        $('a#trigger').hover(function(e) {
          $('div#pop-up').show();
          
        }, function() {
          $('div#pop-up').hide();
        });
        
        $('a#trigger').mousemove(function(e) {
          $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
        
      });
    </script>


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
					<i class="fa fa-facebook"></i> Custom Audiences <small>Create Custom Audiences from Your Website</small>
				</h1>

				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Custom Audiences</a></li>

				</ol>

				<div id="mpopup" class="mpopup" style="display: none;">
					<a onClick="closeBox()" href="#"><img
						src="<?php echo SITE_ROOT_URL; ?>img/close_button.png"> </a>
					<ul>

						<li>1. Go to your Facebook Ads Manager</li>
						<li>2. Select Audiences from the left side tab</li>
						<li>3. Click on Custom Audiences from Your Website.</li>
						<li>4. Agree to the Terms of Service beforehand.</li>
						<li>5. You will be taken to a lightbox asking for Audience Name
							and Visited URLs. Here you can input any page, keywords, or URLs
							where the pixel will be executed on your site. This can also
							include args or any advanced query strings or parameters within
							the URL if needed.</li>
						<li>6. You will also have the ability provide negative statements
							where "doesn't contain" will be an option. An example could be,
							contains any "/plane/" and doesn't contain "accessories."</li>
						<li>7. Set the retention window for how long you would like people
							to remain in this Website Custom Audience. You can input a few as
							1 and as many as 180 days.</li>
						<li>8. Make sure to double check your Audience rule to ensure that
							there are no errors.</li>
						<li>9. Once completed, click on the View Custom Audience pixel
							link. Copy and paste this javascript into the box and save.</li>
					</ul>
				</div>
			</section>


			<!-- Main content -->
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				<section class="content">
					<input type="button" value="Help window"
						class="btn btn-primary mb10"
						style="margin-top: 15px; margin-left: 15px; margin-bottom: 15px"
						onclick="openBox()" style="width: 100%;"> <small
						style="color: red; display: none;" id="script_req"> invalid
						script</small>
					<div class="contentpanel">
						<div class="col-sm-12">
							<textarea placeholder="Facebook Pixel Code"
								style="height: 60%; padding: 11px;" class="form-control"
								name=savescript id="campaignMessage"> <?php echo $result_script; ?>
							</textarea>
						</div>


						<div class="input-group col-sm-12"
							style="padding-top: 10px; padding-bottom: 10px;"></div>

						<input type="submit" value="Save Data"
							class="btn btn-primary mb10"
							style="margin-top: 15px; margin-left: 15px;" name="submit"
							style="width: 100%;" onclick="return validateScript()">
					</div>


				</section>
			</form>
			<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
<script type="text/javascript">
function openBox()
{
	$("#mpopup").show();
}
function closeBox()
{
	$("#mpopup").hide();
}
function validateScript()
{
	var scriptVal= $("#campaignMessage").val();
	
	if (scriptVal.indexOf("<script>") >= 0 && scriptVal.indexOf("https://www.facebook.com/tr?id=") >= 0 && scriptVal.indexOf("</noscript>") >= 0)
	{
		$("#script_req").hide();
		return true;
	}
	else
	{
		$("#script_req").show();
		return false;
	}
	
}
</script>
</html>