<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'custom_template_image/customImageController.php';
$customImageObj = new customImageController();


$id = $_REQUEST['value'];
echo html_entity_decode($customImageObj->get_custom_popup_html($id));
