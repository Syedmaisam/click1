<?php
include_once '../config/config.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
//include_once SOURCE_ROOT.'classes/domain_class.php';
$objDomain = new Domain_Controller();
$arrUrl = explode(".",$_POST['domain_name']);
if($arrUrl[0]=="click" || $arrUrl[0]=="dap")
{
	echo "You Can Not Create With This Domain Name!";
} else {
$return = $objDomain->addOnDomain($_POST);
//var_dump($return);
echo $return;
}
?>