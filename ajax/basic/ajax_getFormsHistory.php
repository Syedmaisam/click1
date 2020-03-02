<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT.'controller/basic/getBasicHistoryController.php';
$obj  = new getBasicHistoryController();
if(isset($_POST['submit']))
{
	$profileVal = $obj->getFormsContentHistory();
	echo $profileVal;
}