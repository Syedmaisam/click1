<?php
include_once '../config/config.php';
include_once SOURCE_ROOT.'controller/getProfileValueController.php';


$obj  = new getProfileValueController();


if(isset($_POST['submit']))
{
	
	$profileVal = $obj->getProfileValue();

	echo $profileVal;

}