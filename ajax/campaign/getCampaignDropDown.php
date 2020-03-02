 <?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();

$arrCampaignData = $objCampaign->get_user_all_campaign($_POST['id'],$_POST['basic']);
//var_dump($arrCampaignData); 
$arrImageData = $objCampaign->get_user_ProfileImage($_POST['id']);
$details = "<option value='0'>Please Select Campaign</option>";
if(count($arrCampaignData)!= 0)
{
	foreach ($arrCampaignData as $camp)
	{
		$campaignId=$camp['id'];
		$CampaignText=$camp['campaign_name'];
		$details .= "<option value='$campaignId'>$CampaignText</option>";
	}
	//echo $details;
}

echo $details,'##',$arrImageData[0]['profile_image_path'];