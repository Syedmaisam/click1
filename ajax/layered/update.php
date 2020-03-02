<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
$objLayered = new Layered_Controller();
if(isset($_POST['update']) && $_POST['update']!='')
{
	$objLayered->update_layered($_POST);
}