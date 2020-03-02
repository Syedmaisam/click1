<?php

include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->MessageUpdate($_POST['id'],$_POST['campaignid']);
$url=SITE_ROOT_URL.'views/campaign/messages.php/'.$arrUrl[2];
header('location:'.$url);
?>