<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
$objbasic = new basicController();
$objbasic->deleteFormPollsdata($_POST['id']);

?>