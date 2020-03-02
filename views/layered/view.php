<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 <?php 
$regex_pattern_pdf = "/([.]pdf)/";
$regex_pattern_img = "/([.]png)|([.]gif)|([.]jpeg)|([.]psd)|([.]bit)|([.]bmp)|([.]tga)|([.]tiff)/";
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$randUrl = explode("/",$_SERVER["ORIG_PATH_INFO"]);
$objProfile = new Profile_Controller();
$fbScript = $objProfile->Onload_SciptData($randUrl[1]);
echo html_entity_decode($fbScript[0]['script']);
$arrUrl = explode("/",$_SERVER["ORIG_PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
include_once SOURCE_ROOT.'getResponse/GetResponseAPI.class.php';
include_once SOURCE_ROOT_CONTROLLER."Apis/mailerlite.php";
include_once SOURCE_ROOT_CONTROLLER."Apis/mailchimp.php";
include_once SOURCE_ROOT_CONTROLLER."Apis/constant_controllar.php";
include_once SOURCE_ROOT."icontact/lib/iContactApi.php";
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
require_once(SOURCE_ROOT.'Awaber/aweber_api/aweber_api.php');
require_once(SOURCE_ROOT."ActiveCampaigan/includes/ActiveCampaign.class.php");
$arrUrls = array('https://facebook.com','http://facebook.com','http://google.com','https://google.com');
$objLayered = new Layered_Controller();
$objLayered = new Layered_Controller();
$arrLayeredData = $objLayered->get_layered_rand($arrUrl[1]);
$doc = new DOMDocument();
@$doc->loadHTMLFile($arrLayeredData[0]['link_url']);
$nodes = $doc->getElementsByTagName('title');
//get and display what you need:
$title = $nodes->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}
?>
<?php 
echo "<meta property='og:type' content='website' /><meta property='og:url' content='".$arrLayeredData[0]['link_url']."' /><meta property='og:title' content='".$title."' /><meta property='og:description' content='".$description."' /><meta property='og:image:url' content='".$arrLayeredData[0]['link_url']."' />";
?>
</head>
<!-- Google Analytics Social Button Tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60807101-1', 'auto');
  ga('send', 'pageview');

</script>
<script
	type="text/javascript"
	src="<?php echo SITE_ROOT_URL.'js/'?>ga_social_tracking.js"></script>
<script>
(function(){
var twitterWidgets = document.createElement('script');
twitterWidgets.type = 'text/javascript';
twitterWidgets.async = true;
twitterWidgets.src = 'http://platform.twitter.com/widgets.js';
// Setup a callback to track once the script loads.
twitterWidgets.onload = _ga.trackTwitter;
document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
})();
</script>
<style>

.ulp-content
{
margin:15px!important;
}
.popup_top {
	position: absolute !important;
	top: 20px !important;
	left: 30% !important;
}

.popup_bottom {
	position: absolute !important;
	bottom: 20px !important;
	left: 30% !important;
}

.popup_left {
	position: absolute !important;
	top: 8% !important;
	left: 20px !important;
}

.popup_right {
	position: absolute !important;
	top: 8% !important;
	right: 20px !important;
}

.popup_top_left {
	position: fixed!important;
	left: 20px !important;
top:0px;
margin-top:20px!important;
}

.popup_top_right {
	position: fixed !important;
	right: 20px !important;
top:0px;
margin-top:20px!important;

}

.popup_bottom_left {
	position: absolute !important;
	bottom: 20px !important;
	left: auto;
	!
	important;
}

.popup_bottom_right {
	position: absolute !important;
	right: 20px !important;
	bottom: 20px !important;
}

.blackscreen {
	width: 100%;
	height: 100%;
	position: fixed;
	background: #000;
	opacity: 0.7;
	left: 0;
	top: 0;
	z-index: 1500;
}

.loader_popup {
	width: 30px;
	height: 30px;
	position: absolute;
	z-index: 2000;
	top: 45%;
	left: 50%;
}

.fixed_Class
{
position: fixed!important;
z-index: 10000000;
}

.loader_popup img {
	width: 50px;
	height: 50px;
}
#html_popup_data
{
/*z-index:10000!important;*/
position:fixed;
}
.ui-resizable
{
display:none!important;
}
.resize_div, .ui-resizable
{
display:none!important;
}
#ulp-layer-144a {
    text-align: left;
    z-index: 1000009;
}
</style>
<?php

if($_POST['user_email']!='' && $_POST['camp_id']!='')
{
	$api_key = $_POST['api_key'];
	$camp_id = $_POST['camp_id'];
	$email = $_POST['user_email'];
	$name = $_POST['user_name'];
	$type= $_POST['type_data'];
	$actoken= $_POST['const_access_token'];
	
	if($type==1){
		$api = new GetResponse($api_key);
		$data =  $api->addContact($camp_id,$name,$email,'standard','0');
		$objLayered->saveSubmitCount($_POST['layered_id']);
		$dataApiRes = $data->queued;
	} elseif($type==3)
	{
		$api = new Mailchimp_Controller($api_key);
		$data =  $api->listSuscribe($camp_id,$email);
		$objLayered->saveSubmitCount($_POST['layered_id']);
		$dataApiRes = $data->queued;
	} elseif($type==5)
	{
		$api = new Mailerlite_Controller($api_key);
		$subscriber = array(
	'email' => $email,
    'name' => $name
		);
		$data = $api->addSubscriber($subscriber,$camp_id);
		$objLayered->saveSubmitCount($_POST['layered_id']);
		var_dump($data);
	} 
 elseif($type==6)
	{
		
		$api = new constant_Controller($api_key,$actoken);
		$subscriber = array(
		'email' => $email,
        'name' => $name
		);
		
		$data = $api->addConstantSubscriber($subscriber,$camp_id);
		//$objLayered->saveSubmitCount($_POST['layered_id']);
//var_dump($data);
	}  elseif($type==2)
	{
		$aweber = new AWeberAPI(AWABER_CONSUMER_KEY,AWABER_CONSUMER_SECRET);
		$aweber->adapter->debug = false;
		//var_dump($_POST);exit;
		$campaigns = $aweber->getAccount($_POST['awaber_auth_token'],$_POST['auth_token_secret']);
		$listURL = "/accounts/{$_POST['awaber_account_id']}/lists/{$camp_id}";
		$list = $aweber->loadFromUrl($listURL);
		$objLayered->saveSubmitCount($_POST['layered_id']);
		$params = array(
        'email' => $email,
        'ad_tracking' => 'client_lib_example',
        'misc_notes' => 'my cool app',
        'name' => $name);
		$subscribers = $list->subscribers;
		$new_subscriber = $subscribers->create($params);
		var_dump($new_subscriber);
	}elseif($type==7)
	{
		iContactApi::getInstance()->setConfig(array(
			'appId'       => $_POST['api_key'], 
			'apiPassword' => $_POST['iContact_password'], 
			'apiUsername' => $_POST['iContact_username']
		));
		var_dump($_POST);
		$oiContact = iContactApi::getInstance();
		$addContact = $oiContact->addContact($email, null, null, $name,null, null,null,null,null,null,null, null,null, null);
		var_dump($oiContact->getErrors());
		var_dump($oiContact->subscribeContactToList($addContact->contactId,$_POST['camp_id'],'normal'));
		
	}elseif($type==4)
	{
		$list_id = $_REQUEST['camp_id'];
		$ac = new ActiveCampaign($_REQUEST['active_api_url'],$_REQUEST['active_api_key']);
		$contact = array(
		"email" => $email,
		"first_name" => $name,
		"p[{$list_id}]" => $list_id,
		"status[{$list_id}]" => 1, // "Active" status
	);
	$contact_sync = $ac->api("contact/sync", $contact);
	var_dump($contact_sync);exit;
	}
}

if($arrLayeredData[0]['popup_status']==1){
$url=$arrLayeredData[0]['link_url'];
$matched_pattern_data_pdf = preg_match($regex_pattern_pdf,$url);
$matched_pattern_data_img = preg_match($regex_pattern_img,$url);
//if(in_array($url,$arrUrls)){
if($matched_pattern_data_pdf > 0){
	
	echo "<div id='pdf'>
  <object width='100%' height='100%' type='application/pdf' data='".$url."' id='pdf_content'>
    <p>Insert your error message here, if the PDF cannot be displayed.</p>
  </object>
</div>";
	
} else if($matched_pattern_data_img > 0){
	
	echo "<img src='".$url."' width='100%' height='100%'>";
	
} else {
?>

<?php 
echo "<div style='display:none;'>".html_entity_decode($arrLayeredData[0]['autoresponder_html'])."</div>";
if($arrLayeredData[0]['popup_timing'] == 1)
{
	$doc = new DOMDocument();
	$doc->loadHTMLFile($url);
	$myhtml = $doc->saveHTML();
	$myhtml="<meta property='og:url' content='".$url."' /><link href='".$url."' rel='canonical'><base href='".$url."'>".$myhtml;
	echo htmlspecialchars_decode($myhtml);

}
else
{
?>
<link rel="stylesheet" href="<?php echo SITE_ROOT_URL; ?>assets/css/styles.css" />
<link rel="stylesheet" href="<?php echo SITE_ROOT_URL; ?>assets/countdown/jquery.countdown.css" />	
<?php 
	echo "<meta property='og:url' content='".$url."' /><iframe id='myFrame' src='".$url."' width='100%'  sandbox='allow-same-origin allow-forms allow-scripts' height='100%' style='border:none;margin:0;padding:0'></iframe>";
}
}
$arrPostDetail = $objLayered->get_post_detail($arrLayeredData[0]['poup_id']);
$htmlData = html_entity_decode($arrLayeredData[0]["popup_html"]);
$popup_name_id = $arrLayeredData[0]['poup_name'];
function get_Postion($postionId)
{
	$arrPostion = array('0'=>'popup_bottom_left','2'=>'popup_bottom_right','3'=>'popup_right','4'=>'popup_top_right','5'=>'popup_top','6'=>'popup_top_left','7'=>'popup_left','1'=>'popup_bottom');
	return $arrPostion[$postionId];
}
function get_cssFile($id)
{
	$arrfileData = $arrPopupsName = array('1'=>'subscribeform1.css','2'=>'terms.css','3'=>'socialemail1.css','4'=>'contactform1.css','5'=>'subscribeform2.css','6'=>'subscribenewsletter1.css','7'=>'contactform2.css','8'=>'report1.css'
	,'9'=>'socialemail2.css','10'=>'subscribenewsletter2.css','11'=>'massivetraffic1.css','12'=>'massivetraffic2.css','13'=>'socialemail3.css','14'=>'Massive Traffic 3','15'=>'subscribeform3.css','16'=>'macbook.css','17'=>'enjoyauroaboreelias.css','18'=>'chat1.css','19'=>'chat2.css','20'=>'chat3.css','21'=>'chat4.css','22'=>'chat5.css','23'=>'subscribe_form4.css');
	return  $file_path = SITE_CSS_URL.'view/'.$arrfileData[$id];
}
?>

<div
	class="blackscreen" style="display: none; z-index: 50000000000000;"></div>
<div class="loader_popup"
	style="display: none;; z-index: 50000000000001"><img
	src="<?php echo SITE_ROOT_URL; ?>images/loader.GIF" /></div>
<link
	rel='stylesheet' type='text/css'
	href="<?php echo SITE_ROOT_URL; ?>css/font-awesome.css" />
<link
	href="<?php echo get_cssFile($arrLayeredData[0]['poup_name']); ?>"
	rel="stylesheet">


<link
	rel='stylesheet' type='text/css'
	href="<?php echo SITE_ROOT_URL; ?>custom_template/jscss/a.css" />


<link
	rel="stylesheet"
	href="<?php echo SITE_ROOT_URL; ?>views/layered/animatemaster/animate.min.css">
<?php
if($arrLayeredData[0]['popup_email_provide']==1)
{
	$api_responder_key = $arrPostDetail[0]['get_response_api_key'];
} elseif($arrLayeredData[0]['popup_email_provide']==3)
{
	$api_responder_key = $arrPostDetail[0]['mailchimp_api_key'];
} elseif($arrLayeredData[0]['popup_email_provide']==5)
{
	$api_responder_key = $arrPostDetail[0]['mailerlite_api_key'];
} elseif($arrLayeredData[0]['popup_email_provide']==2)
{
	$api_responder_key = $arrPostDetail[0]['awaber_auth_token'];
}
elseif($arrLayeredData[0]['popup_email_provide']==6)
{
	$api_responder_key = $arrPostDetail[0]['constant_api_key'];
	$api_const_token=$arrPostDetail[0]['constant_access_token'];
} elseif($arrLayeredData[0]['popup_email_provide']==7)
{
	$api_responder_key = $arrPostDetail[0]['iContact_appId'];
}
?>

<input
	type="hidden" id="type"
	value="<?php echo $arrLayeredData[0]['popup_email_provide']; ?>">
<input type="hidden"
	id="layered_id" value="<?php echo $arrPostDetail[0]['id']; ?>"></input>
<input
	type="hidden" id="awaber_auth_token"
	value="<?php echo $arrPostDetail[0]['awaber_auth_token']; ?>"></input>
<input
	type="hidden" id="awaber_account_id"
	value="<?php echo $arrPostDetail[0]['awaber_account_id']; ?>"></input>
<input
	type="hidden" id="auth_token_secret"
	value="<?php echo $arrPostDetail[0]['auth_token_secret']; ?>"></input>
	<input
	type="hidden" id="iContact_user_name"
	value="<?php echo $arrPostDetail[0]['iContact_user_name']; ?>"></input>
<input
	type="hidden" id="iContact_password"
	value="<?php echo $arrPostDetail[0]['iContact_passwsord']; ?>"></input>
<input
	type="hidden" id="api_key" value="<?php echo $api_responder_key; ?>">
	<input
	type="hidden" id="const_access_token" value="<?php echo $api_const_token; ?>">
<input
	type="hidden" id="camp_id"
	value="<?php echo $arrPostDetail[0]['campign_id']; ?>"></input>
<input type="hidden" id="active_api_url" value="<?php echo $arrPostDetail[0]['active_api_url']; ?>">
<input type="hidden" id="active_api_key" value="<?php echo $arrPostDetail[0]['active_api_key']; ?>">
<div id="html_popup_data" style="background:<?php echo ($arrLayeredData[0]['popup_overlay']==0)?"#".$arrLayeredData[0]['popup_overlay_color']:''; ?>;opacity:0.<?php echo $arrLayeredData[0]['popup_overlay_opacity']; ?>; width:100%; height: 100%; top:0; left:0; z-index:0;display:none;">
</div>
<div id="pop_data" style="display:none;"> <?php echo $htmlData; ?></div>

<script
	src="<?php echo SITE_ROOT_URL; ?>js/jquery.min.js"
	type="text/javascript"></script>
<script
	src="<?php echo SITE_ROOT_URL; ?>js/posting_js.js"
	type="text/javascript"></script>
<?php } else { ?>
<?php require_once SOURCE_ROOT.'css.php'; ?>
<div style="height: 100%;">

<div class="alert alert-danger alert-dismissable" style="left: 20%;top: 45%;width: 54%;">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ãƒ&mdash;</button>
                                        <b>Alert!</b> The link is not published for all please contact to you provider.
                                    </div>
                                    </div>
                                    <?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<?php } ?>

<script src="<?php echo SITE_ROOT_URL; ?>assets/countdown/jquery.countdown.js"></script>
<script src="<?php echo SITE_ROOT_URL; ?>assets/js/script.js"></script>
<input type="hidden" id="dateTime" value="<?php echo $arrLayeredData[0]['countdown_timer']; ?>">
<script>
$(document).ready(function()
		{

	$(".ulp-content ").addClass("<?php echo get_Postion($arrLayeredData[0]['popup_postion']); ?>");
	
		});
function ulp_self_close()
{
	$(".ulp-content ").hide();
	$("#html_popup_data").hide();
        window.loacation.assign("<?php echo $arrLayeredData[0]['link_url'];?>");
	
}
<?php if($arrLayeredData[0]['popup_timing']==-1){?>
function addEvent(obj, evt, fn) {
    if (obj.addEventListener) {
        obj.addEventListener(evt, fn, false);
    }
    else if (obj.attachEvent) {
        obj.attachEvent("on" + evt, fn);
    }
}
addEvent(window,"load",function(e) {
    addEvent(document, "mouseout", function(e) {
        e = e ? e : window.event;
        var from = e.relatedTarget || e.toElement;
        if (!from || from.nodeName == "HTML") {
            // stop your drag event here
            // for now we can just use an alert
        	$(document).ready(function() { 
        		
        	    setTimeout(function() { 
        	$("#html_popup_data").fadeIn();
        	        $('#pop_data').fadeIn();
 $("#countdown img").remove();
        	 },000); 
        	});
        }
    });
});
<?php } 

else if($arrLayeredData[0]['popup_timing']==1)
{
	
	?>
	 $(function(){
		 $(window).scroll(function(){
			 
			 $("#html_popup_data").fadeIn();
 	         $('#pop_data').fadeIn();	
 $("#countdown img").remove();
 	         $(".ulp-content").addClass('fixed_Class');			
	 			});	 
		});
<?php
}
else { ?>
$(document).ready(function() { 


    setTimeout(function() { 
$("html body").css("overflow-x","none");
$("#html_popup_data").fadeIn();
        $('#pop_data').fadeIn();
 $("#countdown img").remove();
 }, <?php echo $arrLayeredData[0]['popup_timing'];?>000); 
});
<?php } ?>
</script>

 <script type="text/javascript">
$(document).ready(function(){
$(".adcls ").css('width','auto');
$(".adcls ").append("<div style='width: 39px; height: 19px; font-size: 23px; position:absolute;top: -4px;right:-19px;' class='ulp-layer' id='ulp-layer-335'><a href='#' onclick='return ulp_self_close();'>x</a></div>");
$("form").removeAttr('target');
$("input[name='ulp-name']").keyup(function() {
var sub_name=$("input[name='ulp-name']").val();
$("input[name='fullname']").val(sub_name);
$("input[name='name']").val(sub_name);
$("input[name='FNAME']").val(sub_name);
$("input[name='fields_fname']").val(sub_name);
});


$("input[name='ulp-email']").keyup(function() {
var sub_email=$("input[name='ulp-email']").val();
$("input[name='email']").val(sub_email);
$("input[name='EMAIL']").val(sub_email);
$("input[name='fields_email']").val(sub_email);

});


  });
  </script>
<script type="text/javascript" lang="javascript">
if ($('#ulp-layer-144 textarea').length > 0 ) {
	textareaval = $("#ulp-layer-144 textarea").html();
	$("#ulp-layer-144 textarea").html('');
	arrtextarea = textareaval.split("");
	EditframeLooper();
}
else if($('#ulp-layer-144a textarea').length > 0 ) {
	textareaval = $("#ulp-layer-144a textarea").html();
	$("#ulp-layer-144a textarea").html('');
	arrtextarea = textareaval.split("");
	EditChat2frameLooper();
} 
else if(($('#ulp-layer-146 input[type="text"]').length > 0 )) {
	textareaval = $('#ulp-layer-146 input[type="text"]').attr('placeholder');
	$('#ulp-layer-146 input[type="text"]').attr('placeholder','');
	arrtextarea = textareaval.split("");		
	EditChat3frameLooper();		
}
else if(($('#ulp-layer-147 input[type="text"]').length > 0 )) {
	textareaval = $('#ulp-layer-147 input[type="text"]').attr('placeholder');
	$('#ulp-layer-147 input[type="text"]').attr('placeholder','');
	arrtextarea = textareaval.split("");		
	EditChat4frameLooper();		
}
  
var arrtextarea;		
var path = "http://"+window.location.host+"/";
var audio=new Audio(path+"click/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
<?php if($arrLayeredData[0]['poup_name']=="18" || $arrLayeredData[0]['poup_name']=="19" || $arrLayeredData[0]['poup_name']=="20" || $arrLayeredData[0]['poup_name']=="21" || $arrLayeredData[0]['poup_name']=="22"){ ?>
audio.play();
<?php } ?>
//var count = 1;
function EditframeLooper()
{
	if(arrtextarea.length>0)
	{
		var value=arrtextarea.shift();
		//var audio=new Audio(path+"click/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
		$("#pop_data #ulp-layer-144 textarea").append(value);
		//audio.play();
	    setTimeout('EditframeLooper()',80);
	}
}
function EditChat2frameLooper()
{
	if(arrtextarea.length>0)
	{
		var value=arrtextarea.shift();
		$("#pop_data #ulp-layer-144a textarea").append(value);
	    setTimeout('EditChat2frameLooper()',80);
	}
} 

function EditChat3frameLooper()
{
    if(arrtextarea.length>0)
	{
		var value=arrtextarea.shift();
		//var audio=new Audio(path+"click/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
		$("#pop_data #ulp-layer-146 input").attr('placeholder',$("#pop_data #ulp-layer-146 input").attr('placeholder')+value);
		//audio.play();
	    setTimeout('EditChat3frameLooper()',80);
	}
}

function EditChat4frameLooper()
{
    if(arrtextarea.length>0)
	{
		var value=arrtextarea.shift();
		
		$("#pop_data #ulp-layer-147 input").attr('placeholder',$("#pop_data #ulp-layer-147 input").attr('placeholder')+value);
		//audio.play();
        setTimeout('EditChat4frameLooper()',80);
	}
}

function callpopupsoundeffect(){
	if ($('#popdata #ulp-layer-144 textarea').length > 0 ) {
		var textareaval = $("#popdata #ulp-layer-144 textarea").html();
		$("#pop_data #ulp-layer-144 textarea").html('');
		arrtextarea = textareaval.split("");
		EditframeLooper();
	}
else if ($('#popdata #ulp-layer-144a textarea').length > 0 ) {
		var textareaval = $("#popdata #ulp-layer-144a textarea").html();
		$("#pop_data #ulp-layer-144a textarea").html('');
		arrtextarea = textareaval.split("");
		EditChat2frameLooper();
	}
	else if(($('#popdata #ulp-layer-146 input[type="text"]').length > 0 )) {
		var textareaval = $('#popdata #ulp-layer-146 input[type="text"]').attr('placeholder');
		$('#pop_data #ulp-layer-146 input[type="text"]').attr('placeholder','');
		arrtextarea = textareaval.split("");		
		EditChat3frameLooper();		
	}
	else if(($('#popdata #ulp-layer-147 input[type="text"]').length > 0 )) {
		var textareaval = $('#popdata #ulp-layer-147 input[type="text"]').attr('placeholder');
		$('#pop_data #ulp-layer-147 input[type="text"]').attr('placeholder','');
		arrtextarea = textareaval.split("");		
		EditChat4frameLooper();		
	}
}
$(document).ready(function(){
//$("html body").removeAttr( 'style' );
var imglink=$(".img_link_span .image_link").attr("name");
var loction="window.location.assign('"+imglink+"')";

//$("html body").css("overflow","hidden");
$(".img_content .ui-droppable img").removeAttr("height");
$(".img_content .ui-droppable img").removeAttr("width");
$(".text_image").css("height","200");
$(".text_image").css("width","200");
$(".img_content .ui-droppable img").attr("onclick",loction);
$(".img_content .ui-droppable img").css("cursor","pointer");
$(".image_link").hide();
$(".image_caption").css("text-align","center");
$(".resize_table").css("margin","auto");
$("#ulp-layer-116 img").attr("style","");
var ovlay="<?php echo $arrLayeredData[0]['popup_overlay']; ?>";
//alert(ovlay);
if(ovlay==1)
{
$("#html_popup_data").css("height","0");
}
});
</script>

</html>