<?php 
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->get_campaign();

if(isset($_POST['submit']) && $_POST['submit']!='')
{

	$msg = $objCampaign->update_campaign($_POST);
	echo $msg;
}
?>