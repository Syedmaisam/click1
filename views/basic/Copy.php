<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT_CONTROLLER.'image/imageController.php';
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
//$objProfile = new Profile_Controller();
//$objJustLink = new Justlink_Controller();
//$arrLinkData = $objJustLink->get_jusLink();
//$arrData = $objProfile->get_profile();

include_once SOURCE_ROOT_CONTROLLER.'image/getProfileValueController.php';
$objProfile = new getProfileValueController();
$profileArrData = $objProfile->getProfileValue();

$objBasic = new basicController();
$imgId = explode('/',$_SERVER['PATH_INFO']);
$ImageArrData = $objBasic->getBasicDetailValue($imgId[1]);
if(isset($_POST['submit']) && $_POST['submit']=='create')
{
	$htmls = $_POST['pophtml'];
	
	$objBasic->saveBasicTab($_POST,$_FILES, $htmls);
	$objGenral->standardRedirect(SITE_ROOT_URL.'views/basic/add.php');
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
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once SOURCE_ROOT."sidebar.php"; ?>


		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-qrcode"></i> Basic <small>Edit basic link</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Basic</a></li>

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
									<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-cube"></i>
											Modify Design</a></li>
									<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-history"></i>
											History</a></li>

								</ul>
								<div class="tab-content">
									<div class="tab-pane active custurl" id="tab_1">
										<form id="basicForm" class="form-bordered"
											enctype="multipart/form-data" name="basicForm" method="post"
											action="<?php echo $_SERVER['PHP_SELF'];?>"
											onsubmit="return createbasicCamp()">
											<div class="input-group col-sm-12">
												<label for="generatorSource">Title</label> <label
													id="Err_title" style="color: red; font-size: 10px">*</label>
												<input id="inp_title" type="text" value="<?php echo $ImageArrData[0]['title']?>"
													placeholder="e.g. The title you want to share"
													class="form-control required" name="inp_title"
													aria-required="true" onChange="inputTitle()">


											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Content URL</label><label
													id="Err_contentUrl" style="color: red; font-size: 10px">*</label>
												<input id="inp_contentUrl" type="text" value="<?php echo $ImageArrData[0]['contenturl']?>"
													placeholder="e.g. The content or article you want to share"
													class="form-control required" id="generatorSource"
													name="inp_contentUrl" aria-required="true"
													onchange="inputContentUrl()">

											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Profile</label><label
													id="Err_Profile" style="color: red; font-size: 10px">*</label>
												<select class="form-control input-sm valid" id="inp_Profile"
													name="inp_Profile" aria-required="true"
													aria-invalid="false" onChange="selectBasicProfile()">
													<!-- <option value="addprofile">Add new profile</option> -->



													<?php for($i = 0; $i < count($profileArrData); $i++)
													{
														$id = $profileArrData[$i]['id'];
														$profile = $profileArrData[$i]['profile_name'];
														?>

													<option value="<?php echo $id; ?>" <?php echo ($id==$ImageArrData[0]['profile'])?"selected":''; ?>>
														<?php echo $profile; ?>
													</option>
													<?php } ?>

												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>

											<div class="input-group col-sm-12">
												<label for="generatorSource">Campaign</label><label
													id="Err_Campaign" style="color: red; font-size: 10px"></label>
												<select class="form-control input-sm valid"
													id="inp_Campaign" name="inp_Campaign" aria-required="true"
													aria-invalid="false" onBlur="getCampId()">
													<option value="selectCampaign">Select Campaign</option>

												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>
											<div id="normalpanel">
											<div class="input-group col-sm-12">
												<label for="generatorSource">Message</label><label
													id="Err_message" style="color: red; font-size: 10px">*</label>
												<input type="text" value="<?php echo $ImageArrData[0]['message']?>" class="form-control required"
													id="messsage" name="messsage" aria-required="true"
													placeholder="e.g. We offer Awesome Product"
													onKeyUp="msgtxt();" onChange="inputMessage()">

											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Your URL</label> <label
													id="Err_YourUrl" style="color: red; font-size: 10px;">*</label><input
													type="text" value="<?php echo $ImageArrData[0]['yoururl']?>" class="form-control required"
													id="inp_YourUrl" name="inp_YourUrl" aria-required="true"
													placeholder="e.g. http://www.awesomeproduct.com"
													onchange="yoururlOnchange()" onKeyPress="urlChange();" onBlur="urlChange();">

											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Call To Action</label><label
													id="Err_callAction" style="color: red; font-size: 10px;">*</label>
												<input type="text" value="<?php echo $ImageArrData[0]['calltoaction']?>" class="form-control required"
													id="ctoa" name="ctoa" aria-required="true"
													placeholder="e.g. Try it now" onKeyUp="caltext();"
													onchange="callActionOnChange()">


											</div>
											</div>
											<div id="campaignpanel">
												<div class="input-group col-sm-12">
													<label for="generatorSource">Message</label><label
														id="Err_SelMessage" style="color: red; font-size: 10px"></label>
													<select class="form-control input-sm valid"
														id="inp_SelMessage" name="inp_SelMessage"
														aria-required="true" aria-invalid="false" onChange="ChangeMessageText()">
														
													</select><label id="linkProfile-error" class="error"
														for="linkProfile" style="display: inline-block;"></label>
												</div>
											</div>
											<div class="input-group col-sm-12"
												style="padding-top: 10px; padding-bottom: 10px;">
												<button type="submit" name="submit"
													class="btn btn-primary mb10" value="create"
													style="width: 100%;">Create new link</button>
											</div>
											<div class="input-group col-sm-12"
												style="padding-top: 10px; padding-bottom: 10px;">
												<input id="pophtml" type="hidden" name="pophtml" value="<?php echo $ImageArrData[0]['popuphtml']?>"></input>
												<input id="campId_hidden" type="hidden" name="campId_hidden" value="0"></input>
											</div>
										</form>
									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">

										<div id="custom" class="tab-pane form-inline active">
											<div class="row mb10" style="height: 50px;">
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="generatorDesign">Design</label> </label> <select
														class="form-control input-sm" id="generatorDesign"
														name="design"><option selected="selected" value="0">Speech
															box</option>
														<option value="1">Single box</option>
														<option value="2">Bar</option>
														<option value="3">Side box</option>
													</select>
												</div>
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="msgPosition">Position</label> </label> <select
														class="form-control input-sm" id="msgPosition"
														name="position"><option selected="selected" value="0">Bottom
															left</option>
														<option value="1">Bottom</option>
														<option value="2">Bottom right</option>
														<option value="3">Right</option>
														<option value="4">Top right</option>
														<option value="5">Top</option>
														<option value="6">Top left</option>
														<option value="7">Left</option>
													</select>
												</div>
											</div>
											<div class="row mb10" style="height: 50px;">
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="msgBackground">Background</label> </label> <input
														class="color boxcolor" value="66ff00" id="bkgcolor"
														onChange="pbgcolor();">
												</div>
												<div class="col-sm-6">
													<div class="col-sm-6 control-label">
														<label class="control-label"><label for="msgOpacity">Opacity</label>
														</label>
													</div>
													<div class="col-sm-4">
														<input type="hidden" value="5" data-slider-tooltip="hide"
															data-slider-selection="after"
															data-slider-orientation="horizontal"
															data-slider-value="4" data-slider-step="1"
															data-slider-max="5" data-slider-min="1" id="msgOpacity"
															name="opacity">
														<div
															class="slider-primary mb20 ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
															id="generatorOpacity" aria-disabled="false">
															<div
																class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
																style="width: 100%;"></div>
															<a href="#"
																class="ui-slider-handle ui-state-default ui-corner-all"
																style="left: 100%;"></a>
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div class="row mb10" style="height: 50px;">
												<div class="col-sm-6">

													<label class="col-sm-6 control-label"><label for="msgText">Text</label>
													</label> <input class="color boxcolor" value="66ff00"
														id="textcolor" onChange="txtcolor();">
												</div>
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label for="msgStyle">Style</label>
													</label> <select class="form-control input-sm"
														id="msgStyle" name="style"><option selected="selected"
															value="0">Normal</option>
														<option value="1">Light</option>
														<option value="2">Bold</option>
													</select>
												</div>
											</div>
											<div class="row mb10" style="height: 50px;">
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="msgLinkColor">Link</label> </label> <input
														class="color boxcolor" value="66ff00" id="linkcolor"
														onChange="linktxt();">
												</div>
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="msgLinkBg">Link background</label> </label> <input
														class="color boxcolor" value="66ff00" id="linkbgcolor"
														onChange=" linkbg();">
												</div>
											</div>
											<hr>
											<div class="row mb10" style="display: none;"
												id="accesstypefld">
												<div class="col-sm-6">
													<label class="col-sm-6 control-label"><label
														for="msgAccessType">Access type</label> </label> <select
														class="form-control input-sm" id="msgAccessType"
														name="accesstype"><option value="1">Public</option>
														<option value="2">Everyone with the link</option>
														<option value="3">Profile users</option>
													</select>
												</div>
											</div>
											<div style="display: none;" id="questionsFacility">
												<hr>
												<div class="row mb10">
													<label class="col-sm-3 control-label"><label
														for="questionsArray">Poll answers</label> </label>
													<div class="col-sm-7">
														<input type="text" value="" class="form-control"
															id="questionsArray" name="questionsArray"
															style="display: none;">
														<div class="tagsinput" id="questionsArray_tagsinput"
															style="width: auto; height: 100px;">
															<div id="questionsArray_addTag">
																<input data-default="add an answer" value=""
																	id="questionsArray_tag"
																	style="color: rgb(102, 102, 102); width: 68px;"
																	name="tmp_questionsArray_tags">
															</div>
															<div class="tags_clear"></div>
														</div>
													</div>
												</div>
											</div>
										</div>

									

									</div>
									<!-- /.tab-pane -->

									<div class="tab-pane" id="tab_3">
										<div class="table-responsive">
											<table class="table mb30">
												<thead>
													<tr>
														<th>#</th>
														<th>Title</th>
														<th>Created</th>
														<th></th>
													</tr>
												</thead>
												<tbody id="historyDetail">


												</tbody>
											</table>
										</div>
										
									</div>


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
	<?php include_once SOURCE_ROOT."views/basic/editIncpop.php"; ?>

</body>
<script type="text/javascript">
$(document).ready(function(){

	$('#campaignpanel').hide();
	
	
	$.ajax({
		url:SITE_ROOT_URL+'ajax/basic/ajax_getBasicHistory.php',
		type:"post",
		 data: {
			    submit: "submit"
		   		          
			   },
			   success: function(response) { 
				   //alert(response);
				   $("#historyDetail").html(response);
				    var pophtmls = $('#pophtml').val();
					$('#popbasic').html(pophtmls);
					selectBasicProfile();
				   }
	
	});
	
	});
//
</script>
</html>
