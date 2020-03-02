<?php

include_once "config/config.php";
include_once SOURCE_ROOT."controller/main.php";
// Ip Address
include_once SOURCE_ROOT_CONTROLLER.'ipaddress/ipaddrr_Controller.php';
$obj  = new ipaddr_Controller();
// Basic Controller
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
$objBasic = new basicController();
// Link Controller
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
// Image Controller
include_once SOURCE_ROOT.'controller/image/getHistoryController.php';
$objHistoryController = new getHistoryController();
// Layerd Controller
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
$objLayered = new Layered_Controller();
$arrUrlsdata = explode("/",$_SERVER["REQUEST_URI"]);
//var_dump($arrUrlsdata[2]);exit; 
$arrUrlsdata[1] = $arrUrlsdata[2];
$objMain = new Main_Controller();
$datasgetLayredRand = $objMain->getLayredRand($arrUrlsdata[1]);
$datasgetBasicRand = $objMain->getBasicRand($arrUrlsdata[1]);
$datagetPollRand=$objMain->getFormPollRand($arrUrlsdata[1]);
$datasgetJustRand = $objMain->getJustRand($arrUrlsdata[1]);
$datasgetImageRand = $objMain->getImageRand($arrUrlsdata[1]);

if(count($datasgetLayredRand) > 0){

         $arrLayeredData = $objLayered->get_layered_rand($arrUrlsdata[1]);
         $obj->dashboardViewStat($_SERVER["REMOTE_ADDR"],$arrUrlsdata[1],$arrLayeredData[0]['userId']);
         include_once SOURCE_ROOT.'views/layered/view.php';

} elseif(count($datasgetBasicRand) > 0)
{
     
 $arrLinkData = $objBasic->getBasicDetailByRandomLink($arrUrlsdata[1]);	
        $obj->dashboardViewStat($_SERVER["REMOTE_ADDR"],$arrUrlsdata[1],$arrLinkData[0]['userId']);
	    include_once SOURCE_ROOT.'views/basic/view.php';
	
} elseif(count($datasgetJustRand) > 0)
{    

   $arrLinkData = $objJustLink->get_jusLink_byRand($arrUrlsdata[1]);
        $obj->dashboardViewStat($_SERVER["REMOTE_ADDR"],$arrUrlsdata[1],$arrLinkData[0]['user_id']);
	    include_once SOURCE_ROOT.'views/justLink/view.php';

} elseif(count($datasgetImageRand) > 0)
{
        $arrLinkData = $objHistoryController->getImagedata('',$arrUrlsdata[1]);
        $obj->dashboardViewStat($_SERVER["REMOTE_ADDR"],$arrUrlsdata[1],$arrLinkData[0]['userId']);
	    include_once SOURCE_ROOT.'views/image/view.php';

}
elseif (count($datagetPollRand)>=0)
{

	$arrLinkData = $objBasic->getFormPollDetailsValue('',$arrUrlsdata[1]);
	$obj->dashboardViewStat($_SERVER["REMOTE_ADDR"],$arrUrlsdata[1],$arrLinkData[0]['userId']);
	include_once SOURCE_ROOT.'views/basic/viewFormsPolls.php';

}   
else 
{
 echo "Invalid Url.";
}
?> 