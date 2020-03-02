<?php

include_once '../../config/config.php';
include_once SOURCE_ROOT.'controller/image/getHistoryController.php';


$obj  = new getHistoryController();


if(isset($_POST['submit']))
{
	
	$profileVal = $obj->getHistory();

	echo $profileVal;

}