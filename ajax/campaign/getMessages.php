<?php

include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->get_user_messages_campaign($_POST['id'],$_POST['pid']);

$details = "<option value='0'>Select Message</option>";
if(count($arrCampaignData)!= 0)
{
	foreach ($arrCampaignData as $camp)
	{
		$messageId=$camp['id'];
		$messageText=$camp['message'];
		$details .= "<option value='$messageId'>$messageText</option>";
	}
	
	//echo $details;
	
}

echo $details;