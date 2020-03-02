<?php 
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';
$objUser = new user_Controller();
//$arrCampaignData = $objCampaign->get_campaign();
if(isset($_POST['submit']) && $_POST['submit']=='save')
{
	$msg = $objUser->add_user($_POST);
	echo $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='savetrial')
{
	$msg = $objUser->add_user_trial($_POST);
	echo $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='login')
{
	$msg = $objUser->user_login($_POST);
	echo $msg;
}

if(isset($_POST['submit']) && $_POST['submit']=='savesettings')
{
	$msg = $objUser->save_custom_settings($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='upduser')
{
	$msg = $objUser->upduser($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='delrec')
{
	$msg = $objUser->delrec($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='loginsubuser')
{
	$msg = $objUser->login_subuser($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='backtoadmin')
{
	$msg = $objUser->backtoadmin();
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='installadmin')
{
	$msg = $objUser->installadmin($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='recoverpassword')
{
	$msg = $objUser->recoverpassword($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='checkrandomkey')
{
	$msg = $objUser->checkrandomkey($_POST);
	return $msg;
}
if(isset($_POST['submit']) && $_POST['submit']=='checkrandomkeytrial')
{
	$msg = $objUser->checkrandomkeytrial($_POST);
	return $msg;
}
?>