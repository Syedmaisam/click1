<?php
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';
$objuserData = new user_Controller();
$udatap=$objuserData->get_All_User();

if($udatap=="" || $udatap==nul)
{
	header("location:".SITE_ROOT_URL."install.php");
}
 if($_SESSION['logeid']=="")
    
    {
    	
    	header("location:login.php");
    }
?>