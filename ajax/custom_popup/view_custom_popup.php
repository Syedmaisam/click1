<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'custom_template_image/customImageController.php';
$customImageObj = new customImageController();


$id = $_REQUEST['value'];
$result = $customImageObj->get_custom_popup_html_for_edit($id);
$resArray = split("!@#", $result);
$res = $resArray[0];
$res2 = $resArray[1];
$htmlresult = html_entity_decode($res);
echo html_entity_decode($res);
