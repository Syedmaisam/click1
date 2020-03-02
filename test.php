<?php
include_once "config/config.php";
include_once SOURCE_ROOT."controller/main.php";
$arrUrlsdata = explode("/",$_SERVER["ORIG_PATH_INFO"]);
$objMain = new Main_Controller();
$datasgetLayredRand = $objMain->getLayredRand($arrUrlsdata[1]);
$datasgetBasicRand = $objMain->getBasicRand($arrUrlsdata[1]);
$datasgetJustRand = $objMain->getJustRand($arrUrlsdata[1]);
$datasgetImageRand = $objMain->getImageRand($arrUrlsdata[1]);
if(count($datasgetLayredRand) > 0){
//var_dump($arrUrlsdata);exit;
//include_once SOURCE_ROOT.'views/layered/view.php';
$randDataUrl = $datasgetLayredRand[0]['link_url'];

} elseif(count($datasgetBasicRand) > 0)
{
$randDataUrl = $datasgetBasicRand[0]['contenturl'];
	//include_once SOURCE_ROOT.'views/basic/view.php';
	
} elseif(count($datasgetJustRand) > 0)
{
	$randDataUrl = $datasgetJustRand[0]['destination_url'];
} elseif(count($datasgetImageRand) > 0)
{
	$randDataUrl = $datasgetImageRand[0]['contentUrl'];
}
?> 