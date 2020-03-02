<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
$arrUrl= explode("/",$_SERVER["PATH_INFO"]);

include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objProfile = new Profile_Controller();
$objCampaign = new campaign_Controller();
$arrMessageCampaign=$objCampaign->getEditMessage($arrUrl[1],$arrUrl[2]);
$arrMessageEditData=$arrMessageCampaign[0];
$arrCampaign=$objCampaign->getEditCampaignDetails($arrUrl[1]);
$arrCampaignList=$objCampaign->getcampaignList($arrUrl[1],$arrUrl[2],$arrUrl[3]);

$arrMessageEditCampaign=$arrCampaign[0];
$arrobj=$objProfile->get_profile();

$arrUserMessageData=$objCampaign->get_user_Message($arrobj[0]['id']);
$arrUserCampaignData=$objCampaign->get_User_EditCampaign($arrobj[0]['id']);
if($arrUrl[1]!='' && count($arrUserMessageData) > 0)
{
if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
	$objCampaign->update_Message($_POST);
}
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
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> 


   <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      <i class="fa fa-briefcase"></i> Campaign
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Links</a></li>
						<input type="hidden" name="id" id="id" value="<?php echo $arrUrl[1]; ?>"/>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<div class="contentpanel">
         
         
   <div class="panel panel-default">
             <div class="panel-heading">
                    <div class="panel-btns" style="float: right;">
                        <a href="" class="minimize"></a>
                    </div><!-- panel-btns -->
                    <h3 class="panel-title"><i class="fa fa-pencil"></i>Edit Message Details</h3>
                </div>
  
            <div class="panel-body">
            <input type="hidden" id="msgid" value="<?php echo $arrUrl[2]; ?>">
                <div class="form-group" style="height:40px;">
                <div style="margin-left:17.8%;"><small id="campaignSel_req" style="color: red;display: none;"> Required</small></div>
                    <label class="col-sm-2 control-label">
                        <label for="linkProfile">Campaigns for profile</label></label>
                    <div class="col-sm-10">
                 
                                               <select class="form-control input-sm valid" disabled="disabled" id="linkProfile" name="profile" aria-required="true" aria-invalid="false" onChange="changeProfileonPopUp();">
                        <option value="">Select Profile</option>
						<?php foreach ($arrobj as $dataP){ ?>
                            <option pim="<?php echo ($dataP['profile_image_path']); ?>" value="<?php echo ($dataP['id']); ?>" <?php if($dataP['id']==$arrUrl[3]){ echo "selected='selected'";} ?>><?php echo $dataP['profile_name']; ?></option>
                            <?php } ?>
                            </select>
                    </div>
                                    </div>
                                    <div class="form-group" style="height:40px;">
                                    <div style="margin-left:17.8%;"><small id="campaignName_req" style="color: red;display: none;"> Required</small> </div>
                        <label class="col-sm-2 control-label"><label for="linkCampaign">Campaign</label></label>
                        <div class="col-sm-10">
                              
                            <span style="display: none;" id="allCampaigns">
                                <option data-name="my campaingn" data-profileid="769" value="125">my campaingn</option><option data-name="my camp 2" data-profileid="769" value="133">my camp 2</option><option data-name="dbcampaing" data-profileid="769" value="163">dbcampaing</option>                            </span>
                            <select class="form-control input-sm" id="linkCampaign" name="campaignId" onChange="ChangeCampaignId();">
                                <option value="<?php echo $arrCampaign[0]['campaign_name'];?>">Select campaign</option>
                               <?php foreach ($arrCampaignList as $dataP){ ?>
                            <option value="<?php echo ($dataP['id']); ?>" <?php echo ($dataP['campaign_name'])?'selected':''; ?>><?php echo $dataP['campaign_name']; ?></option>
                            <?php } ?>
                            </select>
                                                    </div>
                    </div>

                    
                                <div class="form-group" style="height:40px;">
                                <div style="margin-left:17.8%;"><small id="campaignMessage_req" style="color: red;display: none;"> Required</small> </div>
                    <label class="col-sm-2 control-label"><label >Message</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $arrMessageCampaign[0]['message']; ?>"  onkeyup="msgtxtcampaign();" maxlength="255" placeholder="e.g. We offer an awesome product" id="generatorMessageText" class="form-control" required name="messageText" aria-required="true">                    
                        </div>
                                    </div>
                                    

                <div class="form-group" style="height:40px;">
                <div style="margin-left:17.8%;"><small id="campaignAction_req" style="color: red;display: none;">Required</small> </div>
                    <label class="col-sm-2 control-label"><label for="generatorActionText">Action Text</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $arrMessageCampaign[0]['actionText']; ?>" onKeyUp="caltextcampaign();" maxlength="32" placeholder="e.g. Try it now" id="generatorActionText" class="form-control" required name="actionText" aria-required="true">                    </div>
                                    </div>

                <div class="form-group" style="height:40px;">
                <div style="margin-left:17.8%;"><small id="campaignActionLink_req" style="color: red;display: none;"> Required</small> </div>
                   <div style="margin-left:17.8%;"><small id="ValidateLinkUrl" style="color: red;display: none;">InValid Url</small> </div>
                    <label class="col-sm-2 control-label"><label for="generatorActionLink">Action Link</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $arrMessageCampaign[0]['actionLink']; ?>"  maxlength="455" placeholder="e.g. http://www.mycompany.com/signup" id="generatorActionLink" class="form-control" required name="actionLink" aria-required="true">                    </div>
                                    </div>
            </div>
        </div>      
         
         
         <div class="panel panel-default">
<div class="panel-heading">
                <div class="panel-btns" style="float:right;">
                    <a href="" class="minimize">−</a>
                </div><!-- panel-btns -->
                <h3 class="panel-title"><i class="fa fa-cube"></i> Message Design</h3>
            </div>
            
            <div class="panel-body">
            <div id="custom" class="tab-pane form-inline active">
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="generatorDesign">Design</label></label>
                        <select class="form-control input-sm" id="generatorDesign" name="design"><option selected="selected" value="0">Speech box</option>
<option value="1">Single box</option>
<option value="2">Bar</option>
<option value="3">Side box</option></select>                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgPosition">Position</label></label>
<select class="form-control input-sm" id="msgPosition" name="position"><option selected="selected" value="0">Bottom Left</option>
<option value="1">Bottom</option>
<option value="2">Bottom Right</option>
<option value="3">Right</option>
<option value="4">Top Right</option>
<option value="5">Top</option>
<option value="6">Top Left</option>
<option value="7">Left</option></select>                    </div>
                </div>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgBackground">Background</label></label>
<input class="color boxcolor" value="66ff00" id="bkgcolor"  onChange="pbgcolor();">                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-6 control-label">
                            <!--<label class="control-label"><label for="msgOpacity">Opacity</label></label>-->
                        </div>
                        <div class="col-sm-4">
<input type="hidden" value="5" data-slider-tooltip="hide" data-slider-selection="after" data-slider-orientation="horizontal" data-slider-value="4" data-slider-step="1" data-slider-max="5" data-slider-min="1" id="msgOpacity" name="opacity">                            <div class="slider-primary mb20 ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="generatorOpacity" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 100%;"></div><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></a></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">

                        <label class="col-sm-6 control-label"><label for="msgText">Text</label></label>
<input class="color boxcolor" value="66ff00" id="textcolor" onChange="txtcolor();"> </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgStyle">Style</label></label>
<select class="form-control input-sm" id="msgStyle" name="style"><option selected="selected" value="0">Normal</option>
<option value="1">Light</option>
<option value="2">Bold</option></select>                    </div>
                </div>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgLinkColor">Link</label></label>
<input class="color boxcolor" value="66ff00" id="linkcolor" onChange="linktxt();">  </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgLinkBg">Link background</label></label>
<input class="color boxcolor" value="66ff00" id="linkbgcolor" onChange=" linkbg();">    </div>
                </div>
            </div>
           
</div>
         
         
                  </div>
 <div class="row text-center mb100">
        <button type="submit" class="btn btn-primary" onClick="edit_Message_Campaign();">Update</button>
        
    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<?php include_once SOURCE_ROOT."views/campaign/incpop.php"; ?>
</body>
<script type="text/javascript">	
$(document).ready(function(){
//changeProfileonPopUp();
 var value = $(this).find('option:selected').attr("pim");
 var path=SITE_ROOT_URL+"images/profile/"+value;
 $(".picture a img").attr("src",path);
$("#txtlink").html($('#linkProfile option:selected').html());
$("#mktmsg").html($("#generatorMessageText").val());
$("#linkbgcl").html($("#generatorActionText").val());
 var popdata='<?php echo html_entity_decode($arrMessageEditData['popData'])?>';
$("#popbasic").html(popdata);
});


function ChangeCampaignId()
{
	
	var CampId=$("#linkCampaign").val();
	$("#id").val(CampId);
}

function changeProfileonPopUp()
{
	var profId = $('#linkProfile option:selected').html();
	var ID=$("#linkProfile").val();
	if(profId=="Select Profile")
	{
		profId="Profile Name";
	}
	$('#txtlink').html(profId);
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'views/campaign/ProfileImage.php',
		data: {
			ProfileID: profId,
			ID:ID

		},   
		success: function(response) {
			//alert(response);
			var path=response.split('$');
			var imgpath=path[0];
			var remaining=path[1];
			var msg=remaining.split('#');
			var message=msg[0];
			var messageRemaining=msg[1];
			var txt=messageRemaining.split('*');
			var actiontext=txt[0];
			var actionRemaining=txt[1];
			var link=actionRemaining.split('%');
			var actionlink=link[0];
			var campaignId=link[1];
			
			//alert(actionlink);
		    var path=SITE_ROOT_URL+"images/profile/"+imgpath;
			 $(".picture a img").attr("src",path);
			$("#generatorMessageText").val(message);
			$("#generatorActionText").val(actiontext);
			$("#generatorActionLink").val(actionlink);
			$("#mktmsg").html(message);
			$("#linkbgcl").html(actiontext);
 
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
	
}

$(document).on('change', '#generatorDesign', function() {

var genval=$("#generatorDesign").val();
var mktmsg=$("#generatorMessageText").val();
var txtlink=$("#linkProfile option:selected").text();
var toca=$("#generatorActionText").val();
var inpurl=$("#generatorActionLink").val();
var impath=$('.picture a img').attr('src');
var clr=$(".message").css("background-color");
var profcolor=$(".titler .link").css("color");
var msgcolor=$(".texter p span").css("color");
var btnbg=$("#linkbgcl").css("background-color");
var btnclr=$("#linkbgcl").css("color");
if(genval==0)
{

	$("#popbasic").html("<div class='boxspeech msgbl tstylenorm' id='magic' style='left:0; bottom:0;'><div class='fold'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a> </div>  <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'>  <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div>  <div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p>  </div> </div> </div> <div style='display: none;' class='discusArea'> <div class='discussHeader' style='background-color: rgb(0, 174, 239);'><div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'>      <p>There are no messages yet, so be the first to participate!</p>  </div> </div> <div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div>");
	$("#magic").removeClass("magicsb");
	$(".fold").removeClass("foldsb");
	$("#pseudoCssId0").removeClass("pseudoCssId0sb");
	$("#linkbgcl").removeClass("linkbgclsb");

}
if(genval==1)
{
	$("#popbasic").html("<div class='msgbl tstylenorm boxsingle' id='magic'> <div class='fold' style='background-color: rgb(255, 255, 255);'> <div class='picture' style='position:relative;float:left;'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a>   </div> <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'> <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a>  <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div>  <div class='label'>             <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div><div class='texter'>        <p style='color: "+msgcolor+";'><span id='mktmsg'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p></div>  </div>  </div>  <div style='display: none;' class='discusArea'>      <div class='discussHeader' style='background-color: rgb(0, 174, 239);'>     <div class='discussTitle'>Discussion Title</div>   <div id='discussActionToggle' class='discussAction clicked'></div>  </div>  <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'>    <div id='discussCentral' class='discussBody'>   <div class='discussIntroduction'>                 <p>There are no messages yet, so be the first to participate!</p>   </div>  </div> <div class='discussSubmit'>    <input placeholder='Type here and hit enter to send'> </div>  </div> </div></div>");
	
}
if(genval==2)
{
$("#popbasic").html("<div class='boxspeech msgbl tstylenorm' id='magic' style='left:0; bottom:0;'><div class='fold'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='border-color: rgb(204, 204, 204);'></a> </div>  <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'>  <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+");' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'> <div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div> </div>  <div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+";' id='linkbgcl'>"+toca+"</a></p>  </div> </div> </div> <div style='display: none;' class='discusArea'> <div class='discussHeader' style='background-color: rgb(0, 174, 239);'><div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'>      <p>There are no messages yet, so be the first to participate!</p>  </div> </div> <div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div>");
$("#magic").addClass("magicsb");
$(".fold").addClass("foldsb");
$(".foldsb").removeClass("fold");
$("#pseudoCssId0").addClass("pseudoCssId0sb");
$("#linkbgcl").addClass("linkbgclsb");

}

if(genval==3)
{
$("#popbasic").html("<div class='msgbl cilcolor tstylenorm boxslide bslide' id='magic' style='background:"+clr+";' ><div class='fold forfold' style='background-color:"+clr+";'> <div class='picture'> <a title='Profile picture' href='#'><img id='user_profile_img' alt='Profile picture' src='"+impath+"' style='width:80px;height:80px;border-color: rgb(204, 204, 204);'></a> </div> <div class='message' style='background-color: "+clr+"; border-color: rgb(204, 204, 204);' id='pseudoCssId0'> <div class='titler'> <a title='YourProfile Twitter' href='#' class='link' style='color: "+profcolor+";' id='txtlink'>"+txtlink+"</a> <div id='closeWrapper' style='width: 0px;'><div id='closeCall'> <a href='#' class='closeCall'>x</a> </div> </div> <div class='label'> <div class='label'> <a href='#'><img  alt='close' id='closebp' src='<?php echo SITE_ROOT_URL.'images/close_btn.png'; ?>' onclick='closebpcall();'></a> </div></div></div><div class='texter'> <p style='color: "+msgcolor+";'><span id='mktmsg' style='display: block; width: 300px; margin-left: -9px; margin-bottom: 25px;'>"+mktmsg+"</span><a href='"+inpurl+"' style='color: "+btnclr+"; background-color: "+btnbg+"; margin-left:-6px;' id='linkbgcl'>"+toca+"</a></p> </div> </div>  </div> <div style='display: none;' class='discusArea'>  <div class='discussHeader' style='background-color: rgb(0, 174, 239);'> <div class='discussTitle'>Discussion Title</div> <div id='discussActionToggle' class='discussAction clicked'></div> </div> <div style='display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);' class='discussContent'> <div id='discussCentral' class='discussBody'> <div class='discussIntroduction'><p>There are no messages yet, so be the first to participate!</p> </div></div><div class='discussSubmit'> <input placeholder='Type here and hit enter to send'> </div> </div> </div></div>");
//$(".fold").addClass("foldsb");
//$("#pseudoCssId0").addClass("pseudoCssId0sb");
//$("#linkbgcl").addClass("linkbgclsb");

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


</script>
</html>


