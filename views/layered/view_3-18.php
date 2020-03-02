<style>
.popup_top {
	position: absolute !important;
	top: 0px !important;
	left: 30% !important;
}

.popup_bottom {
	position: absolute !important;
	bottom: 0px !important;
	left: 30% !important;
}

.popup_left {
	position: absolute !important;
	top: 8% !important;
	left: 0% !important;
}

.popup_right {
	position: absolute !important;
	top: 8% !important;
	right: 0% !important;
}

.popup_top_left {
	position: fixed!important;
	left: 0px !important;
top:0px;
margin-top:0px!important;
}

.popup_top_right {
	position: fixed !important;
	right: 0px !important;
top:0px;
margin-top:0px!important;

}

.popup_bottom_left {
	position: absolute !important;
	bottom: 0px !important;
	left: auto;
	!
	important;
}

.popup_bottom_right {
	position: absolute !important;
	right: 0px !important;
	bottom: 0px !important;
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

.loader_popup img {
	width: 50px;
	height: 50px;
}
#html_popup_data
{
z-index:10000!important;
}

</style>
<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["ORIG_PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
include_once SOURCE_ROOT.'getResponse/GetResponseAPI.class.php';
include_once SOURCE_ROOT_CONTROLLER."Apis/mailerlite.php";
include_once SOURCE_ROOT_CONTROLLER."Apis/mailchimp.php";
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
require_once(SOURCE_ROOT.'Awaber/aweber_api/aweber_api.php');
$arrUrls = array('https://facebook.com','http://facebook.com','http://google.com','https://google.com');
$objLayered = new Layered_Controller();
if($_POST['api_key']!='' && $_POST['camp_id']!='')
{
	$api_key = $_POST['api_key'];
	$camp_id = $_POST['camp_id'];
	$email = $_POST['user_email'];
	$name = $_POST['user_name'];
	$type= $_POST['type_data'];
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
	}
	if($dataApiRes!='')
	{
		//$objLayered->saveSubmitCount($_POST['layered_id']);
	}
}
$objLayered = new Layered_Controller();
$arrLayeredData = $objLayered->get_layered_rand($arrUrl[1]);
if($arrLayeredData[0]['popup_status']==1){
$url=$arrLayeredData[0]['link_url'];
if(in_array($arrLayeredData[0]['link_url'],$arrUrls)){
$doc = new DOMDocument();
$doc->loadHTMLFile($url);
$myhtml = $doc->saveHTML();
$myhtml="<base href='".$url."'>".$myhtml;
echo htmlspecialchars_decode($myhtml);
} else {
echo "<iframe src='".$arrLayeredData[0]['link_url']."' style='height:100%;width:100%;border:none;margin:0;padding:0'></iframe>";//htmlspecialchars_decode($myhtml);
}
// Cokie Code
$objJustLink = new Justlink_Controller();
$cookie_name = "cliks";
$username = $arrLayeredData[0]['userId'];
$cookie_value = $arrLayeredData[0]['layered_randUrl'];
if(!isset($_COOKIE[$cookie_name])) {
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	$objJustLink->save_view_stat($username,$cookie_value,"VisitorCount");
}
else
{
	$objJustLink->save_view_stat($username,$cookie_value,"ViewCount");
}
// End of Code
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
	,'9'=>'socialemail2.css','10'=>'subscribenewsletter2.css','11'=>'massivetraffic1.css','12'=>'massivetraffic2.css','13'=>'socialemail3.css','14'=>'Massive Traffic 3','15'=>'subscribeform3.css','16'=>'macbook.css','17'=>'enjoyauroaboreelias.css');
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

?>
<?php require_once SOURCE_ROOT.'css.php'; ?>
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
	type="hidden" id="api_key" value="<?php echo $api_responder_key; ?>">
<input
	type="hidden" id="camp_id"
	value="<?php echo $arrPostDetail[0]['campign_id']; ?>"></input>
<div id="html_popup_data" style="background:<?php echo ($arrLayeredData[0]['popup_overlay']!='')?"#".$arrLayeredData[0]['popup_overlay_color']:''; ?>;opacity:0.<?php echo $arrLayeredData[0]['popup_overlay_opacity']; ?>; width:100%; height: 100%; position:fixed; top:0; left:0; z-index:0;display:none;" >
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
<script>
$(document).ready(function()
		{
	$(".ulp-content ").addClass("<?php echo get_Postion($arrLayeredData[0]['popup_postion']); ?>");
	
		});
function ulp_self_close()
{
	$(".ulp-content ").hide();
	$("#html_popup_data").hide();
	
}
$(document).ready(function() { 
    setTimeout(function() { 
var oid=<?php echo $arrLayeredData[0]['popup_overlay']; ?>

if(oid==0)
{
$("#html_popup_data").fadeIn();
}
        $('#pop_data').fadeIn();
 }, <?php echo $arrLayeredData[0]['popup_timing'];?>000); 
});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-59924576-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Google Analytics Social Button Tracking -->
<script type="text/javascript" src="<?php echo SITE_ROOT_URL.'js/'?>ga_social_tracking.js"></script>
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