<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT.'controller/image/getHistoryController.php';
$objHistoryController = new getHistoryController();
$objHistoryController->deleteImagedata($_POST['id']);
?>