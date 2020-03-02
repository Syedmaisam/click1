<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objProfile = new Profile_Controller();
$objCampaign = new campaign_Controller();
$objDeleteMessage=$objCampaign->DeleteMessageInfo($arrUrl[1],$arrUrl[2],$arrUrl[3]);
$url=SITE_ROOT_URL.'views/campaign/messages.php/'.$arrUrl[2].'/'.$arrUrl[3];
header('location:'.$url);

?>