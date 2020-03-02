<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objProfile = new Profile_Controller();
$objCampaign = new campaign_Controller();
$profilename=$_POST['ProfileName'];
$profileId=$_POST['ProfileId'];
$arrData = $objProfile->get_profileImage($profilename);
$arrCampaignData = $objCampaign->get_campaign_data($profileId); 
$arrCampaignName = $objCampaign->getCampaignName($profileId);
foreach($arrCampaignName as $campnames)
{
$arrcomapigns.= "<option value='".$campnames['id']."'>".$campnames['campaign_name']."</option>";
}

echo $arrData[0]['profile_image_path'];echo "$";
echo $arrCampaignData[0]['message'];echo "#";
echo $arrCampaignData[0]['actionText'];echo "*";
echo $arrCampaignData[0]['actionLink'];echo "%";
echo "<option value='0'>Please Select Campaign</option>".$arrcomapigns;
//echo $arrCampaignData[0]['campaignId'];/* echo "!"; */
?>