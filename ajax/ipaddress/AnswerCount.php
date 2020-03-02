<?php
header('Access-Control-Allow-Origin: *');
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'ipaddress/ipaddrr_Controller.php';


$insertTable = $_POST['tablename'];
$randUrl = $_POST['randomurl'];

$obj  = new ipaddr_Controller();

$ipfound = $obj->SaveFormPollAnswerCountByRandomLink($insertTable, $randUrl,$_POST); 
?>