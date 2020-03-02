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



$objProfile = new Profile_Controller();
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink();
$arrData = $objProfile->get_profile();

include_once SOURCE_ROOT_CONTROLLER.'image/getProfileValueController.php';
$objProfile = new getProfileValueController();
$profileArrData = $objProfile->getProfileValue();

$pfimg=SITE_ROOT_URL."images/profile/".$profileArrData[0]['profile_image_path'];
//echo $pfimg;
//exit;
$profile_id=$arrData[0]['id'];
$profile_email=$arrData[0]['userId'];

include_once SOURCE_ROOT.'dapvalidation.php';

//var_dump($profileArrData);
//---

//include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
//$objCampaign = new campaign_Controller();
//$campArrData = $objCampaign->get_user_all_campaign();

//===
$objBasic = new basicController();


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

	<div class="wrapper row-offcanvas row-offcanvas-left" >
	
	
	
	
	
	
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once SOURCE_ROOT."sidebar.php"; ?>


		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-qrcode "></i> Polls <small>Create new Poll</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Polls</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content" style="padding:0px; height:0px;">

<div id="linksPopUpAdd" style="z-index: 50000; position: fixed; width: 700px; margin: auto; top: 20%; left: 30%; display: none;"></div>

				<div class="contentpanel">
					<div style="height: 40px;"></div>

					<div class="col-sm-12 col-sm-12">
						<div style="width: 50%; margin: auto;">

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
										
											<div class="input-group col-sm-12">
												<label for="generatorSource">Title</label> <label
													id="Err_title" style="color: red; font-size: 10px">*</label>
												<input id="inp_title" type="text" value=""
													placeholder="e.g. The title you want to share"
													class="form-control required" name="inp_title"
													aria-required="true" onChange="inputTitle()">


											</div>
											<div class="input-group col-sm-12">
												<label for="generatorSource">Content URL</label><label
													id="Err_contentUrl" style="color: red; font-size: 10px">*</label>
												<input id="inp_contentUrl" type="text" value=""
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
														$image = $profileArrData[$i]['profile_image_path'];
														?>

													<option value="<?php echo $id; ?>" image="<?php echo $image;?>">
														<?php echo $profile; ?>
													</option>
													<?php } ?>


												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>
											<div class="input-group col-sm-12">
												<label style="display: none"for="generatorSource">Campaign</label><label
													id="Err_Campaign" style="color: red; font-size: 10px"></label>
												<select style="display: none" class="form-control input-sm valid"
													id="inp_Campaign" name="inp_Campaign" aria-required="true"
													aria-invalid="false" onChange="selectMessage()" onBlur="getCampId()">
													<option value="selectCampaign">Select Campaign</option>

												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>

											<div id="normalpanel">
												<div class="input-group col-sm-12">
													<label for="generatorSource">Message</label><label
														id="Err_message" style="color: red; font-size: 10px">*</label>
													<input type="text" value="" class="form-control required"
														id="messsage" name="messsage" aria-required="true"
														placeholder="e.g. We offer Awesome Product"
														onKeyUp="msgtxt();" onChange="inputMessage()">

												</div>
												<div class="input-group col-sm-12">
													<label for="generatorSource">Your URL</label> <label
														id="Err_YourUrl" style="color: red; font-size: 10px;">*</label><input
														type="text" value="" class="form-control required"
														id="inp_YourUrl" name="inp_YourUrl" aria-required="true"
														placeholder="e.g. http://www.awesomeproduct.com"
														onchange="yoururlOnchange()" onKeyUp="urlChange();" onBlur="urlChange();">

												</div>
												<div class="input-group col-sm-12">
													<label for="generatorSource">Call To Action</label><label
														id="Err_callAction" style="color: red; font-size: 10px;">*</label>
													<input type="text" value="" class="form-control required"
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
												<button type="submit" name="submit" id="createid"
													class="btn btn-primary mb10" value="create"
													style="width: 100%;" onClick="savePollData()">Create new link</button>
											</div>
											<div class="input-group col-sm-12"
												style="padding-top: 10px; padding-bottom: 10px;">
												<input id="pophtml" type="hidden" name="pophtml"></input>
												<input id="pollans" type="hidden" name="pollans"></input>
												<input id="campId_hidden" type="hidden" name="campId_hidden"></input>
												<input id="messageId_hidden" type="hidden" name="messageId_hidden"></input>
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
														<option value="2">Speech Bar</option>
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
														<!--<label class="control-label"><label for="msgOpacity">Opacity</label>-->
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
												<div class="col-sm-4" style="margin-top: 10px;">
													<label class=""><label for="msgStyle">Poll answers</label>
													</div>
													<div class="col-sm-8" style="margin-top:10px;">
													
													<textarea rows="3" cols="40" id="ChangePolls" name="ChngPol" style="resize:none;"></textarea>
													<p style="padding-top:5px;">Please enter multiple choice with (<strong>,</strong>) seperator.</p>
													
												</div>
												
												
											</div>
											<div style="clear: both;"></div>
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
	<?php include_once SOURCE_ROOT."views/basic/Pollpop.php"; ?>

</body>
<script type="text/javascript">										


$(document).ready(function(){
	  
	$('#campaignpanel').hide();
	var pophtmls = $('#popbasic').html();

	$('#pophtml').attr("value",pophtmls);
	
	$("#createid").on('click',function(){
		var pollans=$("#ChangePolls").val();
		$('#pollans').attr("value",pollans);		
	}); 
	
	
	$.ajax({
		url:SITE_ROOT_URL+'ajax/basic/ajax_getFormsHistory.php',
		type:"post",
		 data: {
			    submit: "submit"
		   		          
			   },
			   success: function(response) { 
				   //alert(response);
				// $('.picture a img').attr('src','<?php echo $pfimg; ?>');
		//alert($('.picture a img').attr('src'));
				   $("#historyDetail").html(response);
				  selectBasicProfile();
				   }
	
	});


$(document).on('change','#ChangePolls',function(){
    
	 $('#questionsList').empty();
	  var pollsval=$("#ChangePolls").val();
	  var pollsvalsplit = pollsval.split(",");
	  $('#questionsList').append('<option>Please choose one of answers</option>');
if(pollsval != '')
	  {
	  for (var i = 0; i < pollsvalsplit.length; i++) {
           
	 $('#questionsList').append('<option value="' + pollsvalsplit[i] + '">' + pollsvalsplit[i] + '</option>');
}   
	  } 
	});





	
$(document).on('change', '#generatorDesign', function() {
var dropdownval=$("#ChangePolls").val();
var genval=$("#generatorDesign").val();
var mktmsg=$("#messsage").val();
var txtlink=$("#inp_Profile option:selected").text();
var toca=$("#ctoa").val();
var inpurl=$("#inp_YourUrl").val();
var impath=$('.picture a img').attr('src');
var clr=$(".message").css("background-color");
var profcolor=$(".titler .link").css("color");
var msgcolor=$(".texter p span").css("color");
var btnbg=$("#linkbgcl").css("background-color");
var btnclr=$("#linkbgcl").css("color");
if(mktmsg=='')
{
	 
	mktmsg = 'Your marketing message here ';
 }
if(toca=='')
{
	 toca='Submit';
}


if(genval==0)
{

	$("#popbasic").html("<div class='boxspeech msgbl tstylenorm' id='magic' style='left:0; bottom:0;'><div class='fold'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a> </div>  <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'>  <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div>  <div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p>  </div> </div> </div> <div style='display: none;' class='discusArea'> <div class='discussHeader' style='background-color: rgb(0, 174, 239);'><div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'>      <p>There are no messages yet, so be the first to participate!</p>  </div> </div> <div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div><div class='discussCopyright'> Powered by <a target='_blank' href='#'>Openr</a> </div></div> </div></div>");
	$("#magic").removeClass("magicsb");
	$(".fold").removeClass("foldsb");
	$("#pseudoCssId0").removeClass("pseudoCssId0sb");
	$("#linkbgcl").removeClass("linkbgclsb");

$("#mktmsg").append('<select id="questionsList"><option>Please choose one of answers</option></select>');
	 var pollsvalsplit = dropdownval.split(",");
if(dropdownval!= '')
	  {
	 for (var i = 0; i < pollsvalsplit.length; i++) {

	   $('#questionsList').append('<option>'+pollsvalsplit[i]+'</option>');
}
	 }

}
if(genval==1)
{
	$("#popbasic").html("<div class='msgbl tstylenorm boxsingle' id='magic'> <div class='fold' style='background-color: rgb(255, 255, 255);'> <div class='picture' style='position:relative;float:left;'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a>   </div> <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'> <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a>  <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div>  <div class='label'>             <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div><div class='texter'>        <p style='color: "+msgcolor+";'><span id='mktmsg'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p></div>  </div>  </div>  <div style='display: none;' class='discusArea'>      <div class='discussHeader' style='background-color: rgb(0, 174, 239);'>     <div class='discussTitle'>Discussion Title</div>   <div id='discussActionToggle' class='discussAction clicked'></div>  </div>  <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'>    <div id='discussCentral' class='discussBody'>   <div class='discussIntroduction'>                 <p>There are no messages yet, so be the first to participate!</p>   </div>  </div> <div class='discussSubmit'>    <input placeholder='Type here and hit enter to send'> </div>  </div> </div></div>");

$("#mktmsg").append('<select id="questionsList"><option>Please choose one of answers</option></select>');
	 var pollsvalsplit = dropdownval.split(",");
if(dropdownval!= '')
	  {
	 for (var i = 0; i < pollsvalsplit.length; i++) {

	   $('#questionsList').append('<option>'+pollsvalsplit[i]+'</option>');
}
	 }
	
}
if(genval==2)
{
$("#popbasic").html("<div class='boxspeech msgbl tstylenorm' id='magic' style='left:0; bottom:0;'><div class='fold'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a> </div>  <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'>  <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div>  <div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg'></span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p>  </div> </div> </div> <div style='display: none;' class='discusArea'> <div class='discussHeader' style='background-color: rgb(0, 174, 239);'><div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'>      <p>There are no messages yet, so be the first to participate!</p>  </div> </div> <div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div><div class='discussCopyright'> Powered by <a target='_blank' href='#'>Openr</a> </div></div> </div></div>");
$("#magic").addClass("magicsb");
$(".fold").addClass("foldsb");
$(".foldsb").removeClass("fold");
$("#pseudoCssId0").addClass("pseudoCssId0sb");
$("#linkbgcl").addClass("linkbgclsb");
$("#mktmsg").append(mktmsg);
$("#mktmsg").append('<select id="questionsList"><option>Please choose one of answers</option></select>');
	 var pollsvalsplit = dropdownval.split(",");
     if(dropdownval!= '')
	  {
	 for (var i = 0; i < pollsvalsplit.length; i++) {

	   $('#questionsList').append('<option>'+pollsvalsplit[i]+'</option>');
}
	 }

}

if(genval==3)
{
$("#popbasic").html("<div class='msgbl tstylenorm boxslide bslide' id='magic' style='background:"+clr+";' ><div class='fold forfold' style='background-color:"+clr+";'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='width:80px;height:80px;border-color: rgb(204, 204, 204);'></a> </div> <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'> <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'><div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div></div></div><div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg' style='display: block; width: 300px; margin-left: -9px; margin-bottom: 25px;'></span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+"; margin-left:-6px;' id='linkbgcl'>"+toca+"</a></p> </div> </div>  </div> <div style='display: none;' class='discusArea'>  <div class='discussHeader' style='background-color: rgb(0, 174, 239);'> <div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'><p>There are no messages yet, so be the first to participate!</p> </div></div><div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div> </div> </div></div>");
//$(".fold").addClass("foldsb");
//$("#pseudoCssId0").addClass("pseudoCssId0sb");
//$("#linkbgcl").addClass("linkbgclsb");
$("#mktmsg").append(mktmsg);
$("#mktmsg").append('<select id="questionsList"><option>Please choose one of answers</option></select>');
	 var pollsvalsplit = dropdownval.split(",");
       if(dropdownval!= '')
	  {
	 for (var i = 0; i < pollsvalsplit.length; i++) {

	   $('#questionsList').append('<option>'+pollsvalsplit[i]+'</option>');
}
	 }
}

});
$(document).on('change', '#msgStyle', function() {
	var genstyle=$("#msgStyle").val();
	if(genstyle==0)
	{
		$("#txtlink").attr("style","");
		$("#mktmsg").css("style","");
		$("#txtlink").css("font-size","11px");
		$("#mktmsg").css("font-size","14px");
		$("#txtlink").css("font-weight","400");
		$("#mktmsg").css("font-weight","400");
	}
	if(genstyle==1)
	{
		$("#txtlink").attr("style","");
		$("#mktmsg").css("style","");
		$("#txtlink").css("font-size","11px");
		$("#mktmsg").css("font-size","13px");
		$("#txtlink").css("font-weight","lighter");
		$("#mktmsg").css("font-weight","lighter");
	}
	if(genstyle==2)
	{
		$("#txtlink").attr("style","");
		$("#mktmsg").css("style","");
		$("#txtlink").css("font-size","11px");
		$("#mktmsg").css("font-size","14px");
		$("#txtlink").css("font-weight","600");
		$("#mktmsg").css("font-weight","600");
	}

});

});

</script>
</html>