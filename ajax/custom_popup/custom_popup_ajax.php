<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'custom_template_image/customImageController.php';
$customImageObj = new customImageController();



$result = $customImageObj->saveCustomImageTab($_FILES,$_POST);
if($result !="Invalid")
{
	echo "Uploaded Done.";
}
else
{
	echo "Invalid File Type.";
}

