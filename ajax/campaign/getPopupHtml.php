 <?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$tasks = $_POST['task'];
if($tasks == "getPopupHtml_default")
{
	$campid = $_POST['id'];
	$pid = $_POST['pid'];
	
	$popuphtml = $objCampaign->get_popup_html_default($campid , $pid);
	//var_dump($popuphtml);
	$messageText = $popuphtml;
	echo html_entity_decode($messageText[0]['popData']);
}
else if($tasks == "getPopupHtml")
{
	$campid = $_POST['id'];
	$pid = $_POST['pid'];
	
	$popuphtml = $objCampaign->get_popup_html($campid , $pid);
	//var_dump($popuphtml);
	$messageText = $popuphtml;
	echo html_entity_decode($messageText[0]['popData']);
}
else if($tasks == "getPopupMsg")
{
	$Msgid = $_POST['id'];
	$popuphtml = $objCampaign->get_popup_text($Msgid);
	$messageText = $popuphtml;
	echo html_entity_decode($messageText[0]['popData']);
}
