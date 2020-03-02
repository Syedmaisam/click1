<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'ipaddress/ipaddrr_Controller.php';


$typeid = $_POST['typeid'];
$type = $_POST['type'];
$insertTable = $_POST['tablename']; 
$randUrl = $_POST['rand'];
$userId = $_POST['userId'];

//$data = file_get_contents('http://ipinfo.io');
//$jsondata = json_decode($data);
//$ipaddr = $jsondata->ip;
$ipaddr = $_SERVER["REMOTE_ADDR"];


$obj  = new ipaddr_Controller();
//var_dump(insertTable);
//exit;
$ipfound = $obj->getipaddr($ipaddr,$type,$typeid,$insertTable);

