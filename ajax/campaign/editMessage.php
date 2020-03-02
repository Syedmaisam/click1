<?php 
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->edit_Message($_POST);

if(isset($_POST['submit']) && $_POST['submit']!='')
{
	$msg = $objCampaign->edit_Message($_POST);
	echo $msg;
}
?>