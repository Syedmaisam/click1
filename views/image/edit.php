<?php
include_once "../../config/config.php";

include_once SOURCE_ROOT_CONTROLLER.'image/imageController.php';
include_once SOURCE_ROOT_CONTROLLER.'image/getProfileValueController.php';

$objImage = new imageController();
$objProfile = new getProfileValueController();
$profileArrData = $objProfile->getProfileValue();
//$imgId = $_REQUEST['id'];
$imgId = explode('/',$_SERVER['PATH_INFO']);
$ImageArrData = $objImage->getImageDetailValue($imgId[1]);

if(isset($_POST['submit']) && $_POST['submit']=='create')
{
	$Id = explode('/',$_SERVER['PATH_INFO']);
	if($_FILES['inp_ImgLocation']['name']!="")
	{
        $objImage->editImageTab($_POST,$_FILES,$Id[1]);
		$objGenral->standardRedirect(SITE_ROOT_URL.'views/image');
	}
	else 
	{
		$objImage->editImageTabwithoOutImage($_POST,$Id[1]);
		$objGenral->standardRedirect(SITE_ROOT_URL.'views/image');
	}
	
   
}
?>
<?php 
											$timingArr = array('-1'=>'Exit Intent Popup',
													'1'=>'Scroll Popup','3'=>'3 Second Delay',
													'5'=>'5 Second Delay','10'=>'10 Second Delay',
													'15'=>'15 Second Delay','30'=>'30 Second Delay',
													'60'=>'60 Second Delay');
											
											$positionArr = array('0'=>'Center Screen','1'=>'Left Top',
													'2'=>'Left Bottom','3'=>'Top Right',
													'4'=>'Top Bottom');
											
											
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
				<i class="fa fa-picture-o"></i> Image <small>Quick overview of stats and
						Images created</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Image</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content">



				<div class="contentpanel">
					<div style="height: 40px;"></div>

					<div class="col-sm-12 col-sm-12">
						<div style="width: 60%; margin: auto;">

							<div class="nav-tabs-custom"
								style="box-shadow: 2px 1px 20px rgba(20, 9, 12, 0.19);">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab"><i
											class="fa fa-pencil"></i> Customize</a></li>

									

								</ul>
								<div class="tab-content">


									<div class="tab-pane active custurl" id="tab_1">
										<form id="imageForm" class="form-bordered"
											enctype="multipart/form-data" name="imageForm" method="post"
											action="<?php echo $_SERVER['PHP_SELF'];?>"
											onsubmit="return createImgCamp()">
											<div class="input-group col-sm-12">
												<label for="generatorSource">Title</label>
												&nbsp;&nbsp;&nbsp; <label id="Err_title"
													style="color: red; font-size: 10px">*</label> <input
													id="inp_title" type="text" value="<?php echo $ImageArrData[0]['title']?>"
													placeholder="e.g. The title you want to share"
													class="form-control required" name="inp_title"
													aria-required="true" onChange="inputTitle()">


											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Content URL</label>
												&nbsp;&nbsp;&nbsp; <label id="Err_contentUrl"
													style="color: red; font-size: 10px">*</label> <input
													id="inp_contentUrl" type="text" value="<?php echo $ImageArrData[0]['contentUrl']?>"
													placeholder="e.g. The content URL you want to share"
													class="form-control required" name="inp_contentUrl"
													aria-required="true" onChange="inputContentUrl()">


											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Profile</label>&nbsp;&nbsp;&nbsp;
												<label id="Err_Profile" style="color: red; font-size: 10px">*
												</label> <select class="form-control input-sm valid"
													id="inp_Profile" name="inp_Profile" aria-required="true"
													aria-invalid="false" onChange="selectProfile()">
													<option value="addprofile">Add new profile</option>



													<?php for($i = 0; $i < count($profileArrData); $i++)
													{
														$id = $profileArrData[$i]['id'];
														$profile = $profileArrData[$i]['profile_name'];
														?>

													<option value="<?php echo $id; ?>" <?php echo ($id==$ImageArrData[0]['profile'])?"selected":''; ?>>
														<?php echo $profile; ?>
													</option>
													<?php } ?>


												</select>
											</div>

										<div class="input-group col-sm-12"
												style="border: 1px solid rgb(204, 204, 204); padding: 10px; margin-top: 15px;">
												
												<label for="generatorSource">Image Location</label>&nbsp;&nbsp;&nbsp;
												<label id="Err_ImgLocation"
													style="color: red; font-size: 10px">*</label> <input
													type="file" value="" class="" id="inp_ImgLocation"
													name="inp_ImgLocation" aria-required="true"
													accept="image/*"
													placeholder="e.g. We offer Awesome Product"
													onchange="selectImage(this.value)" <?php if($ImageArrData[0]['imageLocation'] == '' && $ImageArrData[0]['imageLocation'] == null ) {echo "disabled='disabled'"; } ?> >
											<div id="imagePreview" style="height: 100px;width: 129px; background: url('<?php echo SITE_ROOT_URL.'/images/basic/'.$ImageArrData[0]['imageLocation'] ?>')" >
											<span class="clo_1" style="display: <?php if($ImageArrData[0]['imageLocation'] != ''){echo "block";} else {echo "none";}?>"><i class="fa fa-fw fa-times-circle-o" id="image_crossButton"  onclick="onclick_CrossButton()"></i></span>
											</div>
											</div>
											
											<div style="text-align: center;"> <h4 for="generatorSource" style="color: red"> OR </h5> </div>

											<div class="input-group col-sm-12">
												<label for="generatorSource">Image URL</label>
												&nbsp;&nbsp;&nbsp; <label id="Err_ImgUrl"
													style="color: red; font-size: 10px">*</label> <input
													type="text" value="<?php echo $ImageArrData[0]['imageUrl']?>" class="form-control required"
													id="inp_ImgUrl" name="inp_ImgUrl" aria-required="true"
													placeholder="e.g. http://www.awesomeproduct.com"
													onchange="imageurlOnchange()" <?php if($ImageArrData[0]['imageUrl'] == '' && $ImageArrData[0]['imageUrl'] == null){ echo "disabled='disabled'"; }?>>
											
											</div>


											<div class="input-group col-sm-12">
												<label for="generatorSource">Your URL</label>&nbsp;&nbsp;&nbsp;
												<label id="Err_YourUrl" style="color: red; font-size: 10px;">*</label>
												<input type="text" value="<?php echo $ImageArrData[0]['yourUrl']?>" class="form-control required"
													id="inp_YourUrl" name="inp_YourUrl" aria-required="true"
													placeholder="e.g. http://www.awesomeproduct.com"
													onchange="yoururlOnchange()">

											</div>

											<div class="input-group col-sm-6"
												style="float: left; margin-top: 15px;">
												<label for="generatorSource">Popup Dimensions (Height:px)</label>
												<label id="Err_height" style="color: red; font-size: 10px">*</label>
												<input type="text" value="<?php echo $ImageArrData[0]['popupHeight']?>" class="form-control required"
													id="inp_Height" name="inp_Height" aria-required="true"
													placeholder="e.g. 500" onChange="heightOnchange()">


											</div>

											<div class="input-group col-sm-6"
												style="float: left; margin-top: 15px;">
												<label for="generatorSource">Popup Dimensions (Width:px)</label>
												<label id="Err_width" style="color: red; font-size: 10px">*</label>
												<input type="text" value="<?php echo $ImageArrData[0]['popupWidth']?>" class="form-control required"
													id="inp_Width" name="inp_Width" aria-required="true"
													placeholder="e.g. 500" onChange="widthOnchange()">


											</div>


											
											<div class="input-group col-sm-12">
												<label for="generatorSource">Popup Timing</label> <label
													id="Err_timimg" style="color: red; font-size: 10px">*</label>
												<select class="form-control input-sm valid" id="inp_Timing"
													name="inp_Timing" aria-required="true" aria-invalid="false"
													onchange="timingOnchange()">
													<?php foreach ($timingArr as $index=>$val)
													{
														
														?>

													<option value="<?php echo $index; ?>" <?php echo ($index==$ImageArrData[0]['popupTiming'])?"selected":''; ?>>
														<?php echo $val; ?>
													</option>
													<?php } ?>
													<!-- <option value="0">On Page Load</option>
													<option value="-1">Exit Popup Only</option>
													<option value="3">3 Second Delay</option>
													<option value="5">5 Second Delay</option>
													<option value="10">10 Second Delay</option>
													<option value="15">15 Second Delay</option>
													<option value="30">30 Second Delay</option>
													<option value="60">60 Second Delay</option> -->
												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>
											
												<div class="input-group col-sm-12">
												<label for="generatorSource">Popup Position</label> <label
													id="Err_position" style="color: red; font-size: 10px"></label>
												<select class="form-control input-sm" id="msgPosition" name="position">
	<?php foreach ($positionArr as $index=>$val)
													{
														
														?>

													<option value="<?php echo $index; ?>" <?php echo ($index==$ImageArrData[0]['popup_position'])?"selected":''; ?>>
														<?php echo $val; ?>
													</option>
													<?php } ?>
</select><label id="linkposition-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>
											
						<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Disable Overlay</label> <span><input
	type="checkbox" id="check" name="check" <?php echo ($ImageArrData[0]['overlay']==1)?"checked":''; ?>></span></div>					
											

											<div class="input-group col-sm-12"
												style="padding-top: 10px; padding-bottom: 10px;">
												<!-- <input type="button" value="Create"
													class="btn btn-primary mb10" name="createmessage"
													style="width: 100%;"> -->
												<button type="submit" name="submit"
													class="btn btn-primary mb10" value="create"
													style="width: 100%;">Save Updates</button>
											</div>
										</form>
									</div>

									<!-- /.tab-pane -->


									<!-- /.tab-pane -->

								</div>
								<!-- /.tab-content -->
							</div>
							<div style="clear: both"></div>
						</div>

					</div>

				</div>

			</section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->


	</div>



	<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
</body>
<script type="text/javascript">

	
$(function() {
    $("#inp_ImgLocation").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
               // alert(this.result);
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>
</html>