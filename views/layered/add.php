<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';

include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();


$objProfile = new Profile_Controller();
$objLayered = new Layered_Controller();
$arrData = $objProfile->get_profile();
$arrLayeredData = $objLayered->get_layered();
$getCustomPopup_Name = $objLayered->get_custom_popup_name();
$profile_id=$arrData[0]['id'];
$profile_email=$arrData[0]['userId'];
include_once SOURCE_ROOT.'dapvalidation.php';
?>
<html>
<head>
<style>
#popupform .ulp-content
{
model:900;
z-index:999;
}
.ulp_useroptions {
	width: 100%;
	font-family: 'Arial';
}

.ulp_useroptions th,.ulp_useroptions td {
	height: 60px;
	font-size: 14px;
}

.ulp_useroptions td em {
	line-height: 25px;
	font-size: 12px;
}

#mailerTbl {
	width: 95%;
	margin: auto;
}

#mailerTbl td {
	border: 1px solid #ccc;
	padding: 8px;
}

#mailerTbl th {
	border: 1px solid #ccc;
	padding: 8px;
	font-weight: bold;
}
.ui-resizable
{
display:none!important;
}
</style>

<link rel='stylesheet' type='text/css' href="<?php echo SITE_ROOT_URL; ?>custom_template/jscss/a.css" />
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
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"> <!-- Content Header (Page header) --> <section
	class="content-header">
<h1><i class="fa fa-ticket"></i> Templates <small>Quick overview of stats
and links created</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Templates</a></li>

</ol>
</section> <!-- Main content --> <section class="content">

<div class="contentpanel">
<div id="suc_msg" style="height: 40px;"></div>

<div class="col-sm-12 col-sm-12">
<div style="width: 100%; margin: auto;">

<div class="nav-tabs-custom"
	style="box-shadow: 2px 1px 20px rgba(20, 9, 12, 0.19);">
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab_1" data-toggle="tab"><i
		class="fa fa-pencil"></i> Customize</a></li>
	<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-history"></i>
	History</a></li>

</ul>
<div class="tab-content">
<div class="tab-pane active custurl" id="tab_1">

<div class="input-group col-sm-12"><label for="generatorSource">Popups <small
	style="color: red;">*</small> </label> <small id="link_name_req"
	style="color: red; display: none;"> Required</small> <select
	class="form-control input-sm valid" id="layered_popup_template"
	name="layered_popup" aria-required="true" aria-invalid="false">
	<option value="">Select Popup</option>
	<option value="1">Subscribe Form</option>
	<option value="2">Terms & Conditions</option>
	<option value="3">Social Email 1</option>
	<option value="4">Contact Form 1</option>
	<option value="5">Subscribe Form 2</option>
	<option value="6">Subscribe Newsletter 1</option>
	<option value="7">Contact Form 2</option>
	<option value="8">Report Form 1</option>
	<option value="9">Social Email 2</option>
	<option value="10">Subscribe Newsletter 2</option>
	<option value="11">Massive Traffic 1</option>
	<option value="12">Massive Traffic 2</option>
	<option value="13">Social Email 3</option>
         

	<!--	<option value="14">Massive Traffic 3</option>-->
	<option value="15">Subscribe Form 3</option>
	<option value="16">Product Overlay</option>
	<option value="17">Video Overlay</option>
<option value="18">Chat1</option>
	<option value="19">Chat2</option>
	<option value="20">Chat3</option>
	<option value="21">Chat4</option>
<option value="22">Chat5</option>
<option value="23">Subscribe Form 4</option>
	<?php for($i = 0; $i < count($getCustomPopup_Name); $i++)
												{
													$id = $getCustomPopup_Name[$i]['id'];
													$profile = $getCustomPopup_Name[$i]['popup_name'];
													//$image = $profileArrData[$i]['profile_image_path'];
													?>
												<option value="<?php echo $id; ?>">
													<?php echo $profile; ?>
												</option>
												<!-- <option value="<?php echo $id; ?>"
													image="<?php echo $image;?>">
													<?php echo $profile; ?>
												</option> -->
												<?php } ?>
</select> <input type="button" value="Edit"
												class="btn btn-success" style="margin-top: 10px;"
												onClick="edit_custom_popup();"> <input type="button"
												value="Preview" class="btn btn-info"
												style="margin-top: 10px;margin-left:3px;margin-right:3px;" onClick="layered_popup_view();">
												<?php $custom_template= SITE_ROOT_URL.'custom_template'; ?>
												 <input type="button"
												value="Create Custom Template" class="btn btn-info"
												style="margin-top: 10px;" onClick="window.open('<?php echo $custom_template; ?>','_blank')">
										</div>

<div class="input-group col-sm-12"><label for="generatorSource">Title <small
	style="color: red;">*</small> </label> <small id="linkProfile_req"
	style="color: red; display: none;"> Required</small> <input type="text"
	value="" class="form-control required" id="title" name="title"
	aria-required="true" placeholder="Enter popup title"></div>

<!--<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Popup Dimensions (Height:px) <span
	style="color: red; display: none;"><small>Please enter only numeric
value</small></span></label> <input type="text" value=""
	class="form-control required numreq" id="hieght" name="source"
	aria-required="true" placeholder="e.g. 500"></div> -->

<!--<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Popup Dimensions (Width:px) <span
	style="color: red; display: none;"><small>Please enter only numeric
value</small></span></label> <input type="text" value=""
	class="form-control required numreq" id="width" name="source"
	aria-required="true" placeholder="e.g. 500"></div> -->

<div class="input-group col-sm-12"><label for="generatorSource">Link Url
<small style="color: red;">*</small> </label> <small id="linkUrl_req"
	style="color: red; display: none;">Valid Url Required</small> <input
	type="text" value="" class="form-control required" id="linkurl"
	name="linkurl" aria-required="true"
	placeholder="Enter Link URL eg: http://www.awesomeproduct.com/"></div>

<div class="input-group col-sm-12"><label class="control-label">Position</label>
<select name="position" id="msgPosition" class="form-control input-sm">
	<option value="0" selected="selected">Bottom left</option>
	<option value="1">Bottom</option>
	<option value="2">Bottom Right</option>
	<option value="3">Right</option>
	<option value="4">Top Right</option>
	<option value="5">Top</option>
	<option value="6">Top Left</option>
	<option value="7">Left</option>
</select></div>

<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Disable Overlay</label> <span><input
	type="checkbox" id="check"></span></div>

<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Overlay Color</label> <input
	class="color boxcolor" value="66ff00" id="textcolor"
	style="display: block;"></div>




<div class="input-group col-sm-6" style="float: left; margin-top: 15px;">
<label for="generatorSource">Overlay Opacity</label> <span><select
	name="position" id="overlay_op" class="form-control input-sm">
	<option value="1" selected="selected">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="0">0</option>
</select> </span></div>

<!--<div class="input-group col-sm-6" style="float: left; margin-top: 15px;" id="mprovider">
<label for="generatorSource">Email Provider<small style="color: red;">*</small></label><small
	id="layeredEmail_req" style="color: red; display: none;"> Required</small>
<select name="position" id="responsemail" class="form-control input-sm">
	<option value="" selected="selected">Please Select</option>
	<option value="1">Getresponse</option>
	<option value="2">Aweber</option>
	<option value="3">MailChimp</option>
	<option value="4">ActiveCampaigan</option>
	<option value="5">MailerLite</option>
	<option value="6">ConstantContact</option>
<option value="7">iContact</option>

</select></div> -->

<div class="input-group col-sm-6"  style="top: 15px">
												<label for="generatorSource">Popup Timing</label> <label
													id="Err_timimg" style="color: red; font-size: 10px">*</label>
												<select class="form-control input-sm valid" id="inp_Timing"
													name="inp_Timing" aria-required="true" aria-invalid="false"
													>
													<option value="0">On Page Load</option>
													<option value="-1">Exit Intent Popup </option>
													<option value="1">Scroll Popup</option>
													<option value="3">3 Second Delay</option>
													<option value="5">5 Second Delay</option>
													<option value="10">10 Second Delay</option>
													<option value="15">15 Second Delay</option>
													<option value="30">30 Second Delay</option>
													<option value="60">60 Second Delay</option>
												</select><label id="linkProfile-error" class="error"
													for="linkProfile" style="display: inline-block;"></label>
											</div>


 <!-- Add Days area start -->
<div class="row countD col-sm-12" style="display: none;">
<label class="label_class">Select
Your Date <small style="color: red;">*</small></label><span
	style="color: red; display: none;" id="select_date_error">Required</span><span
	style="color: red; display: none;" id="select_date_ivalid">Invalid Form
Code</span>
<div class="input-group col-sm-12"><input type="text" id="datepicker"
	value="<?php echo date("Y-m-d"); ?>"></div>
</div>
<!-- Add Days area End --> 


<!-- Text area start -->											
		
		<div class="input-group col-sm-12" id="apiforms">
		<label class="label_class">Please enter your html code <small style="color: red;">*</small></label><span style="color:red;display: none;" id="textarea_error">Required</span><span style="color: red;display: none;" id="textarea_error_ivalid">Invalid Form Code</span>
			<textarea placeholder="Paste html code here.." class="textarea_class"></textarea>
		</div>						

<!-- Text area End -->

<!-- Get Response -->
<div id="getResponseBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th width="259">Enable GetResponse:</th>
			<td width="593"><input type="checkbox"
				 name="ulp_getresponse_enable" id="ulp_getresponse_enable">
			Submit contact details to GetResponse <br>
			<em>Please tick checkbox if you want to submit contact details to
			GetResponse.</em></td>
		</tr>
		<tr>
			<th>API Key<small style="color: red;"> *</small>:<small
				id="layeredapi_req" style="color: red; display: none;"> Required</small>
			</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_getresponse_api_key" value=""
				name="ulp_getresponse_api_key" id="ulp_getresponse_api_key"> <br>
			<em>Enter your GetResponse API Key. You can get your API Key <a
				target="_blank" style="cursor: pointer;"
				onClick="get_campaign_list()">here</a>.</em></td>
		</tr>
		<tr>
			<th>Campaign ID<small style="color: red;"> *</small>: <small
				id="layeredcamp_req" style="color: red; display: none;"> Required</small>
			</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_getresponse_campaign_id" id="ulp_getresponse_campaign_id">
			<br>
			<em> Enter your List ID. You can get List ID fromEnter your List ID.
			You can get List ID from <a style="cursor: pointer;"
				class="getresponsepopup">this table</a>. </em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- EndGet Response --> <!-- Aweber Account -->
<div id="getAweberBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th width="259">Authorization code::</th>
			<td width="593"><input type="text"
				placeholder="AWeber authorization code" class="widefat form-control"
				value="" id="ulp_aweber_oauth_id" style="margin-top: 20px;"> <br>
			<em>Get your authorization code <a
				href="https://auth.aweber.com/1.0/oauth/authorize_app/fd4c9a9d"
				target="_blank">here</a>. </em></td>
		</tr>

		<tr>
			<th>List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_mailerlite_campaign_id"
				id="ulp_getresponse__awaber_campaign_id"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_mailerlite_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>

		<!--<tr>
						<th></th>
						<td>
							<input type="button" onClick="return ulp_aweber_connect();" value="Make Connection" class="btn btn-success">
							
						</td>
					</tr>
					
				-->
	</tbody>
</table>
</div>
<!-- End Aweber Account --> <!-- Mailer Lite -->
<div id="getMailerliteBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th width="259">Enable MailerLite:</th>
			<td width="593"><input type="checkbox"
				"="" name="ulp_getresponse_enable" id="ulp_getresponse_enable">
			Submit contact details to MailerLite <br>
			<em>Please tick checkbox if you want to submit contact details to
			MailerLite.</em></td>
		</tr>
		<tr>
			<th>API Key:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_getresponse_api_key" value=""
				name="ulp_getresponse_api_key" id="ulp_getresponse_api_key_mailer">
			<br>
			<em>Enter your MailerLite API Key. You can get your API Key <a
				target="_blank" href="https://app.mailerlite.com/subscribe/api/">Developer
			API page</a>.</em></td>
		</tr>
		<tr>
			<th>List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_mailerlite_campaign_id"
				id="ulp_getresponse__mailer_campaign_id"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_mailerlite_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- End mailer Lite --> <!-- MailChimp -->
<div id="getmailchimpBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th>API Key:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_getresponse_api_key" value=""
				name="ulp_getresponse_api_key"
				id="ulp_getresponse_api_key_mailchimp"> <br>
			<em>Enter your Mailchimp API Key. You can get your API Key <a
				target="_blank" href="https://apidocs.mailchimp.com/">Developer
			API page</a>.</em></td>
		</tr>
		<tr>
			<th>List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_mailerlite_campaign_id"
				id="ulp_getresponse__mailchimp_campaign_id"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_mailchimp_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- End MailChimp -->

 <!-- Active Campaign -->
<div id="getActiveCampaiganBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th>API URL:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_activeCamp_api_url" value=""
				name="ulp_getresponse_api_key" id="ulp_activeCamp_api_url" placeholder="Enter your api url eg. http://abc.activecampaigan.com">
			<br>
			</td>
		</tr>
		<tr>
			<th>API Key:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_activeCamp_api_key" value=""
				name="ulp_getresponse_api_key" id="ulp_activeCamp_api_key" placeholder="Enter your api key eg. 1adv1234fdfsvbfgfADVS1F">
			<br>
			</td>
		</tr>
		<tr>
			<th>List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_mailerlite_campaign_id"
				id="ulp_activeCamp_campaign_id" placeholder="Enter your List-id eg. 123"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_mailerlite_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- End mailer Lite --> 




<!-- Constant Contact Campaign -->
<div id="getconstantbox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th>API Key</th>
			<td><input type="text" 
				class="form-control" value=""
				name="ulp_constant_api_key" id="ulp_constant_api_key" placeholder="Enter your api Key">
		<br>
			<em>Enter your Constant Contact API Key. You can get your API Key <a
				target="_blank" href="https://constantcontact.mashery.com/login/login"> Developer
			API page</a>.</em>
			</td>
		</tr>
		<tr>
			<th>Access Token</th>
			<td><input type="text" 
				class="form-control" value=""
				name="ulp_constant_access_token" id="ulp_constant_access_token" placeholder="Enter Access Token">
			<em>Enter your Constant Contact Access Token. You can get your Access Token<a
				target="_blank" href="https://constantcontact.mashery.com/login/login"> Developer
			API page</a>.</em>
			</td>
		</tr>
		<tr>
			<th>Contact List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_mailerlite_campaign_id"
				id="ulp_constant_campaign_id" placeholder="Enter your List-id eg. 123"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_constant_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- End Constant Contact --> 

<!-- iContact -->
<div id="iContactBox" class="col-sm-12"
	style="display: none; border: 1px solid rgb(204, 204, 204); margin-top: 26px; background: none repeat scroll 0% 0% rgb(248, 248, 248);">

<table class="ulp_useroptions">
	<tbody>
		<tr>
			<th>APP ID:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control iContact_appid" value=""
				name="ulp_iContact_appid" id="ulp_iContact_appid" placeholder="Enter your IContact appid">
			<br>
			</td>
		</tr>
		<tr>
			<th>iContact User Name:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_iContact_user_name" value=""
				name="ulp_iContact_user_name" id="ulp_iContact_user_name" placeholder="Enter your IContact User name">
			<br>
			</td>
		</tr>
		<tr>
			<th>iContact Password:</th>
			<td><input type="text" onChange="ulp_getresponse_handler();"
				class="form-control ulp_iContact_user_name" value=""
				name="ulp_iContact_user_password" id="ulp_iContact_user_password" placeholder="Enter your IContact password">
			<br>
			</td>
		</tr>
		<tr>
			<th>List ID</th>
			<td><input type="text" class="widefat form-control" value=""
				name="ulp_iContact_campaign_id"
				id="ulp_iContact_campaign_id" placeholder="Enter your List-id eg. 123"> <br>
			<em>Enter your List ID. You can get List ID from<em>Enter your List
			ID. You can get List ID from <a title="Available Lists"
				id="ulp_mailerlite_lists" class="getresponsepopup"
				style="cursor: pointer;">this table</a>.</em></td>
		</tr>
	</tbody>
</table>
</div>
<!-- End iContact -->


<div class="input-group col-sm-12"
	style="padding-top: 10px; padding-bottom: 10px;"><input type="button"
	value="Create new popup" onClick="create_layered_popup()"
	class="btn btn-primary mb10" name="createmessage" style="width: 100%;">
</div>

</div>

<div class="tab-pane" id="tab_3">
<div class="table-responsive">
<table class="table mb30">
	<thead>
		<tr>
			<th>#</th>
			<th>Message</th>
			<th>Created</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="data_layered">
	<?php $j=0; foreach ($arrLayeredData as $layeredData){ $j=$j+1; ?>
		<tr>
			<td><?php echo $j; ?></td>
			<td><a data-questions-array="" data-generator-action-link="#"
				data-generator-action-text="Techp"
				data-generator-message-text="welcome to my dashboard"
				data-link-profile="769" data-msg-white-label="0"
				data-msg-action-type="0" data-msg-link-bg="#00aeef"
				data-msg-link-color="#ffffff" data-msg-style="0"
				data-msg-text="#36393D" data-msg-opacity="5"
				data-msg-background="#ff0000" data-msg-position="0"
				data-generator-design="0" class="history-link"
				href="<?php echo $linkdata['../basic - Copy/link_url']; ?>"><?php echo $layeredData['popup_title']; ?></a></td>
			<td><?php echo $objJustLink->getTimes($layeredData['popup_created_date']);  ?></td>
			<td class="table-action"><a
				data-confirm-message="Do you want to edit this message?"
				data-confirm-title="Edit message" class="ui-confirm-edit-link"
				href="<?php echo SITE_ROOT_URL.'views/layered/edit.php/'.$layeredData['poup_id']; ?>"><i
				class="fa fa-pencil"></i></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<div class="text-center"><input type="button"
	value="Create Layered Popup" class="btn btn-primary mb10"
	name="createmessage"
	onclick="window.location='<?php echo SITE_ROOT_URL.'views/layered/add.php'; ?>'"></div>
</div>
</div>
<div id="popup_content_data"></div>
<div style="display: none;" id="edit_layer_popup">
<div class="panel panel-default">

<div class="panel-heading" style="margin-bottom: 30px;">
<div style="text-align: right;" class="panel-btns"></div>
<!-- panel-btns -->
<h3 class="panel-title">Edit Popup</h3>
<p>Below you can Change colors labels and Placeholder of Content :</p>
</div>
<input type="hidden" id="template_ival" value="0">
<div id="content_ajax_popup"></div>
		<?php //include SOURCE_ROOT.'views/layered/animatemaster/index.php'; ?>
</div>
</div>
</div>
</div>
<!-- /.tab-content --></div>
<div style="clear: both"></div>
</div>
</div>
</div>

</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
</div>
<div id="layeredPopUpAdd" style="z-index: 50000; position: fixed; width: 700px; margin: auto; top: 20%; left: 30%; display: none;"></div>

<div id="getresponseCampaigns"
	style="width: 600px; height: 400px; margin: auto; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); position: fixed; z-index: 2000; left: 32%; top: 20%; display: none; border-radius: 15px;">
<h3
	style="font-size: 20px; font-family: Arial, Helvetica, sans-serif; padding-left: 27px;">Select
Campaign <a href="#" onClick="getresponse_close();"
	style="float: right; margin-right: 12px; margin-top: -3px;">X—</a></h3>
<div id="campainData"
	style="width: 95%; margin: auto; height: 310px; overflow-y: scroll;"></div>
</div>

		<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".numreq").keydown(function(event) {
		// Allow only backspace and delete
		if( !(event.keyCode == 8                           		   // backspace
				|| event.keyCode == 46   || event.keyCode == 190   // delete
				|| (event.keyCode >= 35 && event.keyCode <= 40)    // arrow keys/home/end
				|| (event.keyCode >= 48 && event.keyCode <= 57)    // numbers on keyboard
				|| (event.keyCode >= 96 && event.keyCode <= 105))  // number on keypad
		) {
			$(this).parents('div').children('label').children('span').show();
			event.preventDefault();     // Prevent character input
		} else 
			{
			$(this).parents('div').children('label').children('span').hide();
			}
	});
	$(".getresponsepopup").click(function()
	{
		var get_response_api_key = '';
		var get_res_val = $("#responsemail").val();
		var get_response_api_url = '';
		var iContactPassword = '';
		if(get_res_val==1)
			{
			get_response_api_key = $("#ulp_getresponse_api_key").val();
		}else if(get_res_val==5)
		{
			get_response_api_key = $("#ulp_getresponse_api_key_mailer").val();
		}
		else if(get_res_val==3)
		{
			get_response_api_key = $("#ulp_getresponse_api_key_mailchimp").val();
		}
		else if(get_res_val==2)
		{
			get_response_api_key = $("#ulp_aweber_oauth_id").val();
		}
		else if(get_res_val==4)
		{
			get_response_api_key = $("#ulp_activeCamp_api_key").val();
			get_response_api_url = $("#ulp_activeCamp_api_url").val();
		}
		else if(get_res_val==6)
		{
			
			get_response_api_key = $("#ulp_constant_api_key").val();
			get_response_api_url = $("#ulp_constant_access_token").val();
	
		}
                else if(get_res_val==7)
		{
			get_response_api_key = $("#ulp_iContact_appid").val();
			get_response_api_url = $("#ulp_iContact_user_name").val();
			iContactPassword = $("#ulp_iContact_user_password").val();
		}
		if(get_response_api_key!=''){
			$(".blackscreen").show();
			$(".loader_popup").show();
			//$("#getresponseCampaigns").show();
			$("#ulp_getresponse_api_key").css('border','1px solid #cccccc');
		 $.ajax({
			  type: "post",
			  url: SITE_ROOT_URL+"ajax/campaignList/getResponse.php",
			  data: {
			  api_key: get_response_api_key,
			  api_url:get_response_api_url,
			  get_res_val:get_res_val,
                          iContactPassword: iContactPassword
			 },   
			 success: function(response) {
				 $(".loader_popup").hide();
				 $("#getresponseCampaigns").fadeIn("slow");
				 $("#ulp_getresponse_api_key").attr('disabled',true);
				 $("#campainData").html(response);
			 },
			 error:function 
			 (XMLHttpRequest, textStatus, errorThrown) {
			 }
			 }); 
		} else 
		{
			if(get_res_val==1){
			$("#ulp_getresponse_api_key").css('border','1px solid red');
			} else if(get_res_val==5)
			{
				$("#ulp_getresponse_api_key_mailer").css('border','1px solid red');
			}
			else if(get_res_val==3)
			{
				get_response_api_key = $("#ulp_getresponse_api_key_mailchimp").css('border','1px solid red');
			}
			else if(get_res_val==4)
			{
				get_response_api_key = $("#ulp_activeCamp_api_url").css('border','1px solid red');
			}
			else if(get_res_val==2)
			{
				get_response_api_key = $("#ulp_aweber_oauth_id").css('border','1px solid red');
			}
			else if(get_res_val==6)
			{
				get_response_api_key = $("#ulp_constant_api_key").css('border','1px solid red');
			}
		}
	});
});
function getresponse_close()
	{
		$("#getresponseCampaigns").hide();
		$(".blackscreen").hide();
		
		
	}
function ulp_self_close()
{
$("#popupform_preview").hide();
$("#blackscreen").hide();
}
</script>
</body>
</html>