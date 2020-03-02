<?php
$sql="SELECT Count(*)  FROM `tbl_campaign` WHERE  `profile_id` = $profile_id And `user_id` = '$profile_email'
AND Month(`add_date`) = Month(Now()) AND Year(`add_date`) = Year(Now())";

$result=mysql_query($sql);
$row=mysql_fetch_row($result);


$result=mysql_query($sql);
$row=mysql_fetch_row($result);

//echo $_SESSION['product_level']=4;
//echo $row[0];
//exit;

if($_SESSION['product_level']==2 && $row[0]>=5)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==3 && $row[0]>=25)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==4 && $row[0]>=10)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==6 && $row[0]>=1)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}


?>